<?php
 /**
 * Created by PhpStorm.
 * User: claudiohenrique
 * Date: 20/02/15
 * Time: 16:13
 */

class FuncionarioController extends BaseController {

    public function add(){
        $input = Request::getContent();
        $obj = json_decode($input);

        /* Inserindo Uusiario no Banco de dados */
        $usuario = new Usuario;
        $usuario->login = $obj->usuario;
        $usuario->senha = crypt($obj->password, '$2a$10$1qAz2wSx3eDc4rFv5tGb5t');
        $usuario->nivel = $obj->permissao;
        $usuario->enable = 1;
        if($usuario->save()){
            echo json_encode(
                array(
                    "status" => 200,
                    "message" => "Usuario Cadastrado com sucesso",
                )
            );
        }

    }

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