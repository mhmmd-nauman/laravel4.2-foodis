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

      $pin = null;
      for($i = 0; $i < 4; $i++) {
          $pin .= UtilsController::pinGenerator();
      }

      echo 'Váriaveis : '.'<br>';
      print_r($input);

      return Response::json(
        array(
            "status" => 200,
            "message" => "Tudo ok",
        ));
    }

    /* Rota para consultar endereço baseado no cep*/
    public function consultarCEP($cep){
        $cep = Cep::find($cep);
        return Response::json($cep->toArray());
    }

}