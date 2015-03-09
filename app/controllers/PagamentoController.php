<?php

/**
 * Created by PhpStorm.
 * User: claudiohenrique
 * Date: 08/03/15
 * Time: 06:33
 */

class PagamentoController extends BaseController {

    /* Rota para adicionar método de pagamento */
    public function add(){
        $input = Request::getContent();
        $obj = json_decode($input);

        $pagamento = new Pagamento();
        $pagamento->tipo = $obj->tipo;
        $pagamento->enabled = 1;
        if($pagamento->save()){
            echo json_encode(
                array(
                    "status" => 200,
                    "message" => "Método de Pagamento adicionado com sucesso",
                )
            );
        }
    }


}