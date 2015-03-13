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
        $precos = array();
        $input = Request::getContent();
        $obj = json_decode($input);

        /* Váriaveis Global de Acesso de Todos os Produtos */
        $nome_produto = $obj->sabor;

        /* Essas duas variaveis seram dinamicas */
        $restaurante_id = 3;
        $categoria_produto = $obj->id_categoria;


        /* Tratamento e Validações de Acordo com o tipo do produto */


        if($obj->tipo == 'pizza'){

            if(isset($obj->precos->pequena)){
                array_push($precos, $preco = array("pequena" => $obj->precos->pequena));
            }

            if(isset($obj->precos->media)){
                array_push($precos, $preco = array("media" => $obj->precos->media));
            }

            if(isset($obj->precos->grande)) {
                array_push($precos, $preco = array("grande" => $obj->precos->grande));
            }
        }else {
            if (isset($obj->tipo)) {
               $precos = $obj->preco;
            }
        }

        /* O preço da pizza é o unico produto que tem a coluna PREÇO1 serializado. */
        if($obj->tipo == 'pizzaa') {
            $jsonPrecos = json_encode($precos);
        }else{
            $jsonPrecos = $precos;
        }

        $ingredientes = $obj->ingredientes;
        $tipo_produto = $obj->tipo;

        /* Insert do produto no Banco de Dados */
        $produto = new Produto;
        $produto->nome_produto = $nome_produto;
        $produto->ingredientes = $ingredientes;
        $produto->preco = $jsonPrecos;
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

    //Essa rota retorna todos os produtos de uma determinada categoria
    public function get($tipo_produto){
        $data = array();
        $preco_produto = array();
        $preco = array();

        $categorias = UtilsController::getCategoriaProduto($tipo_produto);
        foreach($categorias as $categoria){
            $id_categoria = $categoria->id;
        }

        $produtos = UtilsController::getProdutos($id_categoria);

        foreach($produtos as $produto){
           if($produto->enabled == 1) {
               $precos = json_decode($produto->preco);

               array_push($data, array(
                   "id_produto" => $produto->id,
                   "nome_produto" => $produto->nome_produto,
                   "preco" => $precos,
                   "tipo" => $produto->tipo
                ));

           }
        }

        return Response::json($data);
    }

    //Essa rota retorna todos os produtos de um estabelecimento especifico
    public function getAll($id_restaurante){
        $data = array();

        $produtos = UtilsController::getProdutosRestaurante($id_restaurante);

        foreach($produtos as $produto){
            if($produto->enabled == 1) {
                $precos = json_decode($produto->preco);

                array_push($data, array(
                    "id_produto" => $produto->id,
                    "nome_produto" => $produto->nome_produto,
                    "preco" => $precos,
                    "tipo" => $produto->tipo
                ));

            }
        }

        return Response::json($data);
    }

}