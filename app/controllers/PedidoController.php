<?php
/**
 * Created by PhpStorm.
 * User: claudiohenrique
 * Date: 08/03/15
 * Time: 06:04
 */

class PedidoController extends BaseController {

    public function get($id_usuario){
        $informacoes_pedido = Pedido::where('clientes_id','=',$id_usuario)->join('produto_pedido','produto_pedido.pedidos_id','=','pedidos.id')
                                                                ->join('produtos','produtos.id','=','produto_pedido.produtos_id')
                                                                ->join('pagamento','pagamento.id','=','pedidos.pagamento_id')
                                                                ->join('restaurantes','restaurantes.id','=','pedidos.restaurantes_id')
                                                                ->get()->toArray();

        $data = array();
        $primeiro_id = $informacoes_pedido[0]['pedidos_id'];


        for($i = 0; $i < sizeof($informacoes_pedido); $i++) {

            /* Informações (id do Pedido, Numero do Pedido, Id do Restaurante, Tipo de Pagamento e Status */
            $pedido = array(
                "pedido_id" => $informacoes_pedido[$i]['pedidos_id'],
                "numero_pedido" => $informacoes_pedido[$i]['numero_pedido'],
                "restaurante_id" => $informacoes_pedido[$i]['nome_estabelecimento'],
                "tipo_pagamento" => $informacoes_pedido[$i]['tipo'],
                "valor_pedido" => $informacoes_pedido[$i]['valor_total'],
                "status" => $informacoes_pedido[$i]['status']
            );

            /* Produtos de um Pedido Especifico */
            foreach ($informacoes_pedido as $informacoes) {
                $pedido[] = array(
                    "nome_produto" => $informacoes['nome_produto'],
                    "quantidade" => $informacoes['quantidade'],
                    "preco" => $informacoes['preco'],
                    "observacoes_produto_pedido" => $informacoes['observacoes_produto_pedido']
                );
            }

        }

        echo '<pre>';
        print_r($pedido);


    }
}

