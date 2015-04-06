<?php

/**
 * Created by PhpStorm.
 * User: claudiohenrique
 * Date: 08/03/15
 * Time: 02:58
 */

class CadastroController extends BaseController {

    /* Esse método ira cadastrar os utilizadores do APP */
    public function cadastrarUsuario(){
        $input = Request::getContent();
        $objeto = json_decode($input);
        $status = 0;
        $data = array();
        try{
            $cliente = new Cliente();
            $cliente->nome = $objeto->nome;
            $cliente->sobrenome = $objeto->sobrenome;
            $cliente->cpf = $objeto->cpf;
            $cliente->email = $objeto->email;
            $cliente->senha = $objeto->senha;
            $cliente->enabled = 1;
            $cliente->core_auth_id = $objeto->core_auth_id;
            if($cliente->save()){
                $data = array("status" => 200, "message" => "Cadastro realizado com sucesso");
                $status = 200;
            }else{
                $data = array("status" => 400, "message" => "Ocorreu algum erro durante o cadastro");
                $status = 400;
            }
        }catch(Exception $e){

        }

        return Response::json($data,$status);
    }

    //Enviar SMS para o usuario
    public function sendSMS(){
      $input = Request::getContent();
      $objeto = json_decode($input);
      $status = 0;

      /* PIN GERADO RANDOMICAMENTE */
      $pin = null;
      for($i = 0; $i < 4; $i++) {
          $pin = $pin . UtilsController::pinGenerator();
      }

      /* Regra para verificar se o numero já possui dentro do sistema  */
      $usuario = CadastroController::usuarioPendente($objeto->ddd,$objeto->numero);

      /* Regra para verificar se o numero já possui o registro completo dentro do sistema */
      $existeCadastro = CadastroController::verificarCadastro($objeto->ddd,$objeto->numero);

      if(sizeof($existeCadastro) > 0 ){
            $data = array("status" => 403, "message" => "Numero informado já possui cadastro completo no sistema");
            $status = 403;
      }else if(sizeof($usuario) > 0){
          $data = array("status" => 402, "message" => "Numero informado já existe");
          $status = 402;
      }else {
          /* Gravo as Informações na base de dados */
          $auth = new CoreAuth();
          $auth->pin = $pin;
          $auth->ddd = $objeto->ddd;
          $auth->celular = $objeto->numero;
          $auth->status = 'Pendente';
          if ($auth->save()) {
              /* Configurações necessarias para efetuar a requisição sem nenhum problema */
              $sms = CadastroController::enviarSMS($pin, $objeto->ddd, $objeto->numero);
              if ($sms) {
                  $data = array(
                      "status" => 200,
                      "message" => "Mensagem enviada com sucesso"
                  );

                  $status = 200;
              } else {
                  $data = array(
                      "status" => 300,
                      "message" => "Erro ao enviar SMS"
                  );

                  $status = 300;
              }
          } else {
              $data = array(
                  'status' => 400,
                  'message' => 'Erro ao cadastrar um novo usuário ao sistema'
              );

              $status = 400;
          }
      }

        return Response::json($data,$status);
    }

    /* Método para validar o pin */
    public function validarPIN(){
        $input = Request::getContent();
        $objeto = json_decode($input);
        $status = 0;

        /* Verifico se o PIN informado pelo usuário é valido */
        $validar = CadastroController::buscarPIN($objeto->pinInformado,$objeto->ddd,$objeto->numero);
        $result = sizeof($validar);

        /* Lógica de validação */
        if($result > 0){
            $auth = CoreAuth::find($validar[0]['id']);
            $auth->status = 'Aprovado';
            if($auth->save()) {
                $data = array(
                    "status" => 200,
                    "message" => "PIN Correto, Usuario liberado para realizar o cadastro",
                    "id_core_auth" => $validar[0]['id']
                );

                $status = 200;
            }
        }else{
            $data = array(
                "status" => 300,
                "message" => "PIN Invalido, try again!!"
            );

            $status = 300;
        }

        return Response::json($data,$status);
    }

    /* Método para consultar endereço baseado no cep*/
    public function consultarCEP($cep){
        /* Consulta */
        $cep = Cep::find($cep);
        $dados = $cep->toQuerty();
        if($dados) {
            return Response::json($cep->toArray());
        }else{
            $data = array("status" => 400, "message" => "CEP Invalido");
            return Response::json($data,400);
        }
    }

    /* Método para adicionar endereco de um Cliente */
    public function addEndereco(){
        $input = Request::getContent();
        if(!empty($input)){
            $obj = json_decode($input);
            $endereco = new Endereco();
            $endereco->endereco = $obj->rua;
            $endereco->bairro = $obj->bairro;
            $endereco->numero = $obj->numero;
            $endereco->cep = $obj->cep;
            $endereco->ponto_referencia = $obj->ponto_referencia;
            $endereco->cidade = $obj->cidade;
            $endereco->uf = $obj->uf;
            $endereco->clientes_id = $obj->clientes_id;
            $endereco->nome_endereco = $obj->nome_endereco;
            $endereco->enabled = 1;
            if($endereco->save()){
                return Response::json(array("status" => 200, "message" => "Address successfully registered"));
            }
        }
    }

    /* Método utilizado para consultar PIN na base de dados */
    public function buscarPIN($pin,$ddd,$numero){
        $auth = CoreAuth::where('pin','=',$pin)->where('ddd','=',$ddd)->where('celular','=',$numero)->get()->toArray();
        return $auth;
    }

    /* Método utilizado para consultar Endereços cadastrados de um usuario */
    public function consultarEndereco($id_usuario){
        $enderecos =  Endereco::where('clientes_id','=',$id_usuario)->where('enabled','=',1)->get();
        return Response::json($enderecos);
    }

    /*
        Método para remover Endereço cadastro de um usuario
        O Método apenas seta enabled = 0;
    */

    public function deletarEndereco($id_endereco){
        $endereco = Endereco::find($id_endereco);
        $endereco->enabled = 0;
        if($endereco->save()){
            $data = array(
                "status" => 200,
                "message" => "Address removed successfully"
            );

            return Response::json($data);
        }
    }

    /* Método para re-enviar o SMS caso ocorra algum problema no CLIENT */
    public function reSend(){
        $input = Request::getContent();
        $objeto = json_decode($input);

        $pin = CadastroController::pinUsuario($objeto->ddd,$objeto->numero);
        $sms = CadastroController::enviarSMS($pin[0]['pin'],$objeto->ddd,$objeto->numero);
        if($sms){
            $data = array(
                "status" => 200,
                "message" => "Mensagem enviada com sucesso"
            );
        }else{
            $data = array(
                "status" => 300,
                "message" => "Erro ao enviar SMS"
            );
        }

        return Response::json($data);
    }

    /* Método para enviar SMS */
    public function enviarSMS($pin,$ddd,$numero){

        $status = false;

        $header = Array(
            'Proxy-Connection: Close',
            'User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1017.2 Safari/535.19',
            'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            'Accept-Language: en-US,en;q=0.8',
            'Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.3',
            'Cookie: __qca=blabla',
            'Connection: Close'
        );

        $mensagem = urlencode("Bem vindo ao Foodis, SEU PIN: $pin");

        $sms = "https://rest.nexmo.com/sms/json?api_key=8f899a50&api_secret=aa25fcca&from=Foodis&to=55$ddd$numero&text=$mensagem";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $sms);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

        $output = curl_exec($ch);
        curl_close($ch);

        /* Verifico se tudo correu bem e se a mensagem foi enviada com sucesso */
        if(!empty($output)) {
            $JSON = json_decode($output, true);
            if (!strcmp($JSON['messages'][0]['status'], "0")) {
                $status = true;
            }
        }

        return $status;
    }

    /* Método para Consultar PIN do Usuário */
    public function pinUsuario($ddd,$numero){
        $pin = CoreAuth::where('ddd','=',$ddd)->where('celular','=',$numero)->get()->toArray();
        return $pin;
    }

    /* Método para Consultar se o Usuário já fez o Registro do Sistema porem possui o status de Pendente */
    public function usuarioPendente($ddd,$numero){
        $pin = CoreAuth::where('ddd','=',$ddd)->where('celular','=',$numero)->get()->toArray();
        return $pin;
    }

    /* Método para Verificar se o Usuário já realizou o cadastro */
    public function verificarCadastro($ddd,$numero){
        $pin = CadastroController::pinUsuario($ddd,$numero);
        $usuario = Cliente::where('core_auth_id','=',$pin[0]['id'])->get()->toArray();
        return $usuario;
    }

}