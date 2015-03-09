<?php
/**
 * Created by PhpStorm.
 * User: claudiohenrique
 * Date: 08/03/15
 * Time: 23:03
 */

class CategoriaProdutoController extends BaseController {

    /* Metodo para adicionar uma Categoria para Produtos */
    public function  add(){
        $input = Request::getContent();
        $obj = json_decode($input);
        $categoria = new CategoriaProduto();
        $categoria->categoria = $obj->categoria;
        if($categoria->save()){
            echo json_encode(
                array(
                    "status" => 200,
                    "message" =>  "Categoria adicionada com sucesso",
                )
            );
        }
    }

}