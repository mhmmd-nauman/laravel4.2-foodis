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
      $pin = null;
      for($i = 0; $i < 4; $i++) {
          $pin .= UtilsController::pinGenerator();
      }

      echo  json_encode(
        array(
            "status" => 200,
            "message" => "Tudo ok",
        )
      );

    }

    /* Rota para consultar endereço baseado no cep*/
    public function consultarCEP($cep){
        $cep = Cep::find($cep);
        return Response::json($cep->toArray());
    }

}