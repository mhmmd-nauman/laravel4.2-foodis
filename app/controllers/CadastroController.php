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
    public function sendSMS($ddd, $numero){

    }

    public function sendPIN(){

    }

    /* Rota para consultar endereço baseado no cep*/
    public function consultarCEP($cep){
        $cep = Cep::find('56332-740');
        return Response::json($cep->toArray());
    }

}