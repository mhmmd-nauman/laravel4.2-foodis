<?php

/**
 * Created by PhpStorm.
 * User: claudiohenrique
 * Date: 18/02/15
 * Time: 21:21
 */

class ProdutoController extends BaseController {

    /*
     * Rotas de SET
     * */

    public function adicionarPizza(){
        $input = Request::getContent();
        $array = json_decode($input);
    }

    public function adicionarEsfiha(){
        $input = Request::getContent();
        echo $input;
    }

    public function adicionarSalgado(){
        $input = Request::getContent();
        echo $input;
    }

    public function adicionarSanduiche(){
        $input = Request::getContent();
        echo $input;
    }

    public function adicionarMassas(){
        $input = Request::getContent();
        echo $input;
    }

    public function adicionarOutros(){
        $input = Request::getContent();
        echo $input;
    }

    /*
     * Rotas de GET
     * */

    public function buscarPizza(){
        $data = array(
            "status" => 200,
             "pizzas" => array(
                 array(
                     "id" => 3,
                     "nome" => "Mussarela",
                 ),
                 array(
                     "id" => 15,
                     "nome" => "Calabresa",
                 ),
             )
        );

        echo json_encode($data);
    }
} 