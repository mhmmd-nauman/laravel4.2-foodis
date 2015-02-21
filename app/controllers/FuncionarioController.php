<?php
 /**
 * Created by PhpStorm.
 * User: claudiohenrique
 * Date: 20/02/15
 * Time: 16:13
 */

class FuncionarioController extends BaseController {
    public function get(){
        $data = array(
            "status" => 200,
            "funcionario" => array(
                array(
                    "id" => 3,
                    "nome" => "Cláudio Henrique",
                    "username" => "atendimento01",
                    "nivel" => "atendente"
                ),
                array(
                    "id" => 8,
                    "nome" => "Antero Junior",
                    "username" => "atendimento02",
                    "nivel" => "atendente"
                ),
            )
        );

        echo json_encode($data);
    }
}