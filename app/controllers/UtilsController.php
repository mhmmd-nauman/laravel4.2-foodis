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

    /* Recupera todos os produtos que estao cadastrado em um estabelecimento especifico */
    public static function getProdutosRestaurante($id_restaurante){
        return Produto::where('restaurantes_id','=',$id_restaurante)->get();
    }

    /* Retorna o dia em Português */
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

    /* Gera um PIN de 4 digitos para o usuario */
    public static function pinGenerator(){
        return rand(0,9);
    }

    /* Método responsavel pelo disparo de SMS */
    public static function enviarSMS($ddd,$numero){

    }

    /* Método responsavel por gerar o numero do pedido */
    public static function numeroPedido(){
        $result = DB::table('pedidos')->max('numero_pedido');
        return $result;
    }

}