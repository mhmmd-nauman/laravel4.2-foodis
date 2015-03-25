<?php

/**
 * Created by PhpStorm.
 * User: claudiohenrique
 * Date: 08/03/15
 * Time: 02:58
 */

class CadastroController extends BaseController {

    //Cadastrar Usuario
    public function cadastrarUsuario(){
        $input = Request::getContent();
        $objeto = json_decode($input,true);

        echo '<pre>';
        print_r($objeto);
    }

    //Enviar SMS para o usuario
    public function sendSMS(){
      $input = Request::getContent();
      $objeto = json_decode($input);

      $password = Hash::make($objeto->senha);

      $pin = null;
      for($i = 0; $i < 4; $i++) {
          $pin .= UtilsController::pinGenerator();
      }

      $auth = new CoreAuth();
      $auth->pin = $pin;
      $auth->ddd = $objeto->ddd;
      $auth->celular = $objeto->numero;
      $auth->password = $password;
      $auth->status = 'Pendente';
      if($auth->save()){
          //Falta implementar Envio do SMS

          $data = array(
              'status' => 200,
              'message' => 'SMS Enviado com sucesso'
          );

          return Response::json($data);
      }

      return Response::json($input);
    }

    /* Método para validar o pin */
    public function validarPIN(){
        $input = Request::getContent();
        $objeto = json_decode($input);

        $validar = CadastroController::buscarPIN($objeto->pinInformado,$objeto->ddd,$objeto->numero);
        $result = sizeof($validar);

        if($result){
            $auth = CoreAuth::find($validar[0]['id']);
            $auth->status = 'Aprovado';
            if($auth->save()) {
                $data = array(
                    "status" => 200,
                    "message" => "PIN Correto, Usuario liberado para realizar o cadastro"
                );
            }
        }else{
            $data = array(
                "status" => 300,
                "message" => "PIN Invalido, try again!!"
            );
        }

        return Response::json($data);
    }

    /* Método para consultar endereço baseado no cep*/
    public function consultarCEP($cep){
        $cep = Cep::find($cep);
        return Response::json($cep->toArray());
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
        $enderecos =  Endereco::where('clientes_id','=',$id_usuario)->get();
        return Response::json($enderecos);
    }

    /* Método para remover Endereço cadastro de um usuario */
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

}