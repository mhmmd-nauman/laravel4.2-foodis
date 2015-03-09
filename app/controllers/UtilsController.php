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

    public static function getDay($day){
        $dia = '';

        switch (true){
            case stristr($day,'Sunday'):
                $dia = 'domingo';
                break;
            case stristr($day,'Monday'):
                $dia = 'segunda';
                break;
            case stristr($day,'Tuesday'):
                $dia = 'terca';
                break;
            case stristr($day,'Wednesday'):
                $dia = 'quarta';
                break;
            case stristr($day,'Thursday'):
                $dia = 'quinta';
                break;
            case stristr($day,'Friday'):
                $dia = 'sexta';
                break;
            case stristr($day,'Saturday'):
                $dia = 'sabado';
                break;
        }

        return $dia;
    }

    public static function clearTime($time){

    }

    /* Recupero o Endereço de acordo com CEP */
    public static function getCEP($cep){
        return file_get_contents("http://viacep.com.br/ws/$cep/json/");
    }
}