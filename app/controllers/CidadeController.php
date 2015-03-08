<?php
/**
 * Created by PhpStorm.
 * User: claudiohenrique
 * Date: 08/03/15
 * Time: 03:44
 */

class CidadeController extends BaseController {

    //Rota para adicionar cidade ao banco de dados
    public function add(){
        $cidade = new Cidade;
        $input = Request::getContent();
        $obj = json_decode($input);
        $cidade->nome = $obj->nome;
        $cidade->UF = $obj->UF;
        if($cidade->save()){
            echo json_encode(
                array(
                    "status" => 200,
                    "message" => 'Cidade adicionade',
                )
            );
        }
    }


}