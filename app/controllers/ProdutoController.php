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

    public function add(){
        $input = Request::getContent();
        $obj = json_decode($input);

        /* Essas duas variaveis seram dinamicas */
        $restaurante_id = 3;
        $categoria_produto = 1;

        /* Tratamento e Validações de Acordo com o tipo do produto */
        if($obj->tipo == 'pizza'){
            $nome_produto = $obj->sabor;
            $precos = array(
                "pequena" => $obj->precos->pequena,
                "media" => $obj->precos->media,
                "grande" => $obj->precos->grande,
            );

            $precos = json_encode($precos);

            $ingredientes = $obj->ingredientes;
            $tipo_produto = $obj->type;
        }else{
            $nome_produto = $obj->sabor;
            $precos = $obj->preco;
            $ingredientes = $obj->ingredientes;
            $tipo_produto = $obj->tipo;
        }

        /* Insert do produto no Banco de Dados */
        $produto = new Produto;
        $produto->nome_produto = $nome_produto;
        $produto->ingredientes = $ingredientes;
        $produto->preco = $precos;
        $produto->restaurantes_id = $restaurante_id;
        $produto->tipo = $tipo_produto;
        $produto->enabled = 1;
        $produto->categoria_produto_id = $categoria_produto;
        if($produto->save()){
            echo json_encode(
                array(
                    "status" => 200,
                    "message" => "Produto adicionado com sucesso",
                )
            );
        }

    }

    /*
     * Rotas de GET
     * */

    public function get($tipo_produto){
        $categorias = UtilsController::getCategoriaProduto($tipo_produto);
        foreach($categorias as $categoria){
            $id_categoria = $categoria->id;
        }

        $produtos = UtilsController::getProdutos($id_categoria);
        echo '<pre>';
        print_r($produtos);

    }

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

    public function buscarMassas(){
        $data = array(
            "status" => 200,
            "massas" => array(
                array(
                    "id" => 3,
                    "nome" => "Lazanha",
                    "preco" => 25
                ),
                array(
                    "id" => 15,
                    "nome" => "Kebab",
                    "preco" => 7
                ),
            )
        );

        echo json_encode($data);
    }

    public function buscarOutros(){
        $data = array(
            "status" => 200,
            "outros" => array(
                array(
                    "id" => 3,
                    "nome" => "Coca-Cola de 2 Litros",
                    "preco" => 6
                ),
                array(
                    "id" => 15,
                    "nome" => "Fanta de 1 Litro",
                    "preco" => 4
                ),
            )
        );

        echo json_encode($data);
    }

} 