<?php
/**
 * Created by PhpStorm.
 * User: claudiohenrique
 * Date: 08/03/15
 * Time: 06:08
 */

class UtilsController extends BaseController {
    /* Recupera o id da categoria de um determinado tipo de produto, exemplo (Pizza) */
    public static function getCategoriaProduto($tipo_produto){
        return CategoriaProduto::where('categoria', 'LIKE', "%$tipo_produto%")->get();
    }

    /* Recupera os produtos de uma categoria */
    public static function getProdutos($id_categoria){
        return Produto::where('categoria_produto_id', '=', $id_categoria)->get();
    }
}