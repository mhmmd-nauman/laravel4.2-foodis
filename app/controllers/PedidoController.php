<?php
/**
 * Created by PhpStorm.
 * User: claudiohenrique
 * Date: 08/03/15
 * Time: 06:04
 */

class PedidoController extends BaseController {

    public function get($id_usuario){
        /* Realizo a consulta para retornar todas as informações relevantes do pedido */
        $informacoes_pedido = Pedido::where('clientes_id','=',$id_usuario)->join('produto_pedido','produto_pedido.pedidos_id','=','pedidos.id')
                                                                ->join('produtos','produtos.id','=','produto_pedido.produtos_id')
                                                                ->join('pagamento','pagamento.id','=','pedidos.pagamento_id')
                                                                ->join('restaurantes','restaurantes.id','=','pedidos.restaurantes_id')
                                                                ->get()->toArray();

        $data = array();
        $count = 0;

        /* Adiciono as informações uteis dentro do array $pedido*/
        if(sizeof($informacoes_pedido) > 0){
            $pedido[] = array(
                "pedido_id" => $informacoes_pedido[0]['pedidos_id'],
                "numero_pedido" => $informacoes_pedido[0]['numero_pedido'],
                "restaurante_id" => $informacoes_pedido[0]['nome_estabelecimento'],
                "tipo_pagamento" => $informacoes_pedido[0]['tipo'],
                "valor_pedido" => $informacoes_pedido[0]['valor_total'],
                "status" => $informacoes_pedido[0]['status']
            );
        }

        for($i = 0; $i < sizeof($informacoes_pedido); $i++) {
            if ($informacoes_pedido[$i]['pedidos_id'] != $pedido[$count]['pedido_id']) {
                    /* Informações (id do Pedido, Numero do Pedido, Id do Restaurante, Tipo de Pagamento e Status */
                    $pedido[] = array(
                        "pedido_id" => $informacoes_pedido[$i]['pedidos_id'],
                        "numero_pedido" => $informacoes_pedido[$i]['numero_pedido'],
                        "restaurante_id" => $informacoes_pedido[$i]['nome_estabelecimento'],
                        "tipo_pagamento" => $informacoes_pedido[$i]['tipo'],
                        "valor_pedido" => $informacoes_pedido[$i]['valor_total'],
                        "status" => $informacoes_pedido[$i]['status']
                    );
                    $count++;
             }
        }

        /* Retorno os pedidos do usuário especifico */
        return Response::json($data);

    }

    /* Método para Registrar Pedido */
    public function add(){
        $numeroPedido = UtilsController::numeroPedido() + 1;
        $input = Request::getContent();
        $objeto = json_decode($input);

        /* Insiro as informações no banco de dados */
        try {
            $pedido = new Pedido();
            $pedido->valor_total = $objeto->valor_total;
            $pedido->status = 'Aberto';
            $pedido->numero_pedido = $numeroPedido;
            $pedido->clientes_id = $objeto->id_cliente;
            $pedido->endereco_id = $objeto->id_endereco;
            $pedido->restaurantes_id = $objeto->id_restaurante;
            $pedido->pagamento_id = $objeto->id_pagamento;
            $pedido->valor_troco = $objeto->valor_troco;
            if ($pedido->save()) {
                $array = (array) $objeto->produtos;
                $adicionarProduto = PedidoController::addProduto($array,$pedido->id);
                $data = array("status" => 200, "id_pedido" => $pedido->id, "message" => "Order successfully added");
            } else {
                $data = array("status" => 400, "message" => "Erro ao adicionar Pedido");
                return Response::json($data, 400);
            }
        }catch(Exception $e){
           $data = array("status" => 400, "message" => "Exception :/ ");
            echo $e->getMessage();
        }

        return Response::json($data, 200);
    }

    /* Método para Registrar Produtos do Pedido */
    public function addProduto($data,$id_pedido){
        $produtos = array();
        $i = 0;

        /* Convertendo um object (stdClass) para um array - Não consegui fazer o casting utilizando o (array) */
        foreach($data as $datas){
            $produtos[] = array(
                'nome_produto' => $datas->title,
                'id_produto' => $datas->id,
                'tipo' => $datas->tipo,
                'quantidade' => $datas->purchaseQuantity,
                'valor' => $datas->price,
                'observacoes' => $datas->description
            );
        }

        $tamanho = sizeof($produtos);

        /* Insiro as informações no banco de dados */
        try {
            for($i = 0; $i < $tamanho; $i++) {
                $produto = new ProdutoPedido();
                $produto->pedidos_id = $id_pedido;
                $produto->produtos_id = $produtos[$i]['id_produto'];
                $produto->tipo = $produtos[$i]['tipo'];
                $produto->quantidade = $produtos[$i]['quantidade'];
                $produto->valor  = $produtos[$i]['valor'];
                $produto->observacoes_produto_pedido = $produtos[$i]['observacoes'];
                $produto->save();
            }

        }catch(Exception $e){
            $data = array("status" => 400, "message" => "Exception :/ ");
            return Response::json($data, 400);
        }

    }

}

