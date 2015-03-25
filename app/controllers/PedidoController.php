<?php
/**
 * Created by PhpStorm.
 * User: claudiohenrique
 * Date: 08/03/15
 * Time: 06:04
 */

class PedidoController extends BaseController {

    public function get($id_usuario){
        $pedidos = Pedido::where('clientes_id','=',$id_usuario)->join('produto_pedido','produto_pedido.pedidos_id','=','pedidos.id')
                                                               ->join('produtos','produtos.id','=','produto_pedido.produtos_id')->get()->toArray();


        $data = array_add();

        echo '<pre>';
        print_r($pedidos);
    }
}

