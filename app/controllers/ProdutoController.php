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
        echo $input;
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

    public function buscarEsfiha(){
        $data = array(
            "status" => 200,
            "esfiha" => array(
                array(
                    "id" => 3,
                    "nome" => "Carne",
                ),
                array(
                    "id" => 15,
                    "nome" => "Queijo",
                ),
            )
        );

        echo json_encode($data);
    }


    public function buscarSalgado (){
        $data = array(
            "status" => 200,
            "salgado" => array(
                array(
                    "id" => 3,
                    "nome" => "Coxinha",
                    "preco" => 5
                ),
                array(
                    "id" => 15,
                    "nome" => "Pastel de Carne",
                    "preco" => 7
                ),
            )
        );

        echo json_encode($data);
    }

    public function buscarSanduiche(){
        $data = array(
            "status" => 200,
            "sanduiche" => array(
                array(
                    "id" => 3,
                    "nome" => "BIS Catupiry",
                    "preco" => 5
                ),
                array(
                    "id" => 15,
                    "nome" => "BIS Cupim",
                    "preco" => 7
                ),
            )
        );

        echo json_encode($data);
    }
} 