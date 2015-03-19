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
        $input = Input::all();
    }

    //Enviar SMS para o usuario
    public function sendSMS(){
      $input = Request::getContent();
      $objeto = json_decode($input);

      $pin = null;
      for($i = 0; $i < 4; $i++) {
          $pin .= UtilsController::pinGenerator();
      }

      $auth = new CoreAuth();
      $auth->pin = $pin;
      $auth->ddd = $objeto->ddd;
      $auth->celular = $objeto->numero;
      $auth->status = 'Pendente';
      if($auth->save()){
          $data = array(
              'status' => 200,
              'message' => 'Usuario cadastrado com sucesso'
          );

          return Response::json($data);
      }

      return Response::json($input);
    }

    /* Rota para consultar endereço baseado no cep*/
    public function consultarCEP($cep){
        $cep = Cep::find($cep);
        return Response::json($cep->toArray());
    }

    /* Rota para adicionar endereco de um Cliente */
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
            if($endereco->save()){
                return Response::json(array("status" => 200, "message" => "Address successfully registered"));
            }
        }
    }

}