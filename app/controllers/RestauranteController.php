<?php

/**
 * Created by PhpStorm.
 * User: claudiohenrique
 * Date: 21/02/15
 * Time: 04:23 PM (Na madruga! haha)
 */

date_default_timezone_set('America/Recife');


class RestauranteController extends BaseController {

    //Método responsavel por cadastrar um restaurante
    public function addRestaurante(){
        $restaurante = new Restaurante; //Model para fazer o insert
        $input = Request::getContent();
        $horarioFuncionamento = array(
            "segunda" => "8:00 AM - 22:00 PM",
            "terca" => "8:00 AM - 22:00 PM",
            "quarta" => "8:00 AM - 22:00 PM",
            "quinta" => "8:00 AM - 22:00 PM",
            "sexta" => "8:00 AM - 22:00 PM",
            "sabado" => "8:00 AM - 22:00 PM",
            "domingo" => "fechado"
        );

        $obj = json_decode($input);
        $restaurante->nome_estabelecimento = $obj->nome_estabelecimento;
        $restaurante->endereco = $obj->endereco;
        $restaurante->numero = $obj->numero;
        $restaurante->cep = $obj->cep;
        $restaurante->telefone_estabelecimento = $obj->telefone_estabelecimento;
        $restaurante->telefone_propietario = $obj->telefone_propietario;
        $restaurante->enabled = 1;
        $restaurante->dias_funcionamento = '';
        $restaurante->horario_funcionamento  = json_encode($horarioFuncionamento);
        $restaurante->cidade_entrega = 'Juazeiro';
        $restaurante->categoria_restaurante_id = 1;
        $restaurante->taxas_id = 1;
        $restaurante->cidade_id = 1;
        if($restaurante->save()){
            echo json_encode(
                array(
                    "status" => 200,
                    "message" => "Restaurante adicionado com sucesso",
                )
            );
        }

    }

    //Método responsavel por registrar uma categoria
    public function addCategoria($nome_categoria){
        $categoria = new CategoriaRestaurante();
        $categoria->categoria = $nome_categoria;
        if($categoria->save()){
            echo json_encode(array(
                "status" => 200,
                "message" => "Categoria cadastrada com sucesso",
            ));
        }
    }

    //Método responsavel por adicionar o metodos de pagamento para um estabelecimento
    public function setMetodoPagamento(){
        $metodo = new RestaurantePagamento();
        $metodo->tipo_pagamento = 1;
        $metodo->restaurantes_id = 1;
    }

    /* Listo todos os Restaurantes Abertos em uma Determinada Cidade */
    public function open($cidade){
        /* Configurações iniciais para a consulta (Dia Atual) e (Hora Atual) */
        $dias = array("segunda","terca","quarta","quinta","sexta","sabado","domingo");
        $diaAtual = UtilsController::getDay(date('l'));
        $horaAtual = date('H:i');

        /* Váriaveis de Controle */
        $status = false;
        $flagDinheiro = 0;
        $flagMaquineta = 0;
        $flagOnline = 0;

        $cidade = Cidade::where('nome','=',$cidade)->get();
        foreach($cidade as $city){
            $id =  $city->id;
            $nome = $city->nome;
        }

        /* Recupero todos os restaurantes da Cidade */
        $resturantes = Restaurante::where('cidade_id','=',$id)->get()->toArray();
        $data = array("cidade" => $nome);

        /* Rotina para Verificar se um estabelecimento está aberto ou não */
        for($i = 0; $i < sizeof($resturantes); $i++){
            $json = $resturantes[$i]['horario_funcionamento'];
            $obj = json_decode($json,true);
            $hoje =  $obj[0][$diaAtual];
            /* Verifico se o dia atual da pesquisa o estabelimentmo não está fechado */
            if($hoje !== 'fechado'){
                $horario = explode('-',$hoje);
                $abertura = $horario[0];
                @$fechamento = $horario[1];
                //Verifico se baseado na hora atual do SERVIDOR o restaurante está aberto ou fechado
                if((strtotime($horaAtual) >= strtotime($abertura)) && (strtotime($horaAtual) < strtotime($fechamento))){
                    $status = true;
                }else{
                    $status = false;
                }
            }else{
                $status = false;
            }

            /* Rotina para verificar o status do restaurante */
            if($status){
                $pagamentos = DB::table('restaurante_pagamento')
                    ->leftJoin('pagamento', 'restaurante_pagamento.tipo_pagamento_id', '=', 'pagamento.id')
                    ->where('restaurante_pagamento.restaurantes_id', '=', $resturantes[$i]['id'])
                    ->get();


                for($w = 0; $w < sizeof($pagamentos); $w++){
                    if($pagamentos[$w]->slug === 'dinheiro'){
                        $flagDinheiro = 1;
                    }

                    if($pagamentos[$w]->slug === 'maquinetadelivery'){
                        $flagMaquineta = 1;
                    }

                    if($pagamentos[$w]->slug === 'pagamentoonline'){
                        $flagOnline = 1;
                    }

                    $payments = array(
                        "pagamento" => array(
                            'dinheiro' => $flagDinheiro,
                            'maquinetadelivery' => $flagMaquineta,
                            'pagamentoonline' => $flagOnline,
                        ),
                    );

                }

                $result = array_merge($resturantes[$i],$payments);
                array_push($data,$result);

                /* Rotina para verificar o status do restaurante */
                $payments = array(
                    "pagamento" => array(
                        'dinheiro' => 0,
                        'maquinetadelivery' => 0,
                        'pagamentoonline' => 0,
                    ),
                );

            }
        }
        echo '<pre>';
        print_r($data);
    }


    /* Listo todos os Restaurantes Abertos em uma Determinada Cidade */

    public function getOpen($cidade){
        $data = array(
            "cidade" => $cidade,
            "restaurantes" => array(
                //Primeiro Registro
                array(
                    "id" => 234,
                    "nome" => "Pizza Hunt",
                    "descricao" => "Pizza Hunt, a melhor opção em pizzas na cidade de Petrolina! PROMOÇÃO: Pizza Grande + Refrigerante 2 litros, apenas R$20",
                    "endereco" => "Rua São Jose N120 ",
                    "bairro" => "Areia Branca",
                    "cidade" => "Petrolina",
                    "open" => true,
                    "horario" => array(
                        "abertura" => "08:00 AM",
                        "fechamento" => "12:00 PM",
                    ),

                    "pagamento" => array(
                        "dinheiro" => true,
                        "maquineta-delivery" => true,
                        "pagamento-online" => false,
                    ),


                    "configuracoes" => array(
                        "sabores-fatias" => array(
                            "pequena" => 1,
                            "media" => 2,
                            "grande" => 4
                        ),

                        "pagamento-pizzaria" => array(
                            "type" => 1
                        ),
                    ),



                ),
                //Segundo Registro
                array(
                    "id" => 234,
                    "nome" => "Habibs",
                    "descricao" => "Habibs, a melhor opção em comida oriental na cidade. ",
                    "endereco" => "Rua São Paulo N882 ",
                    "bairro" => "Centro",
                    "cidade" => "Petrolina",
                    "open" => true,
                    "horario" => array(
                        "open" => "08:00 AM",
                        "close" => "12:00 PM",
                    ),

                    "pagamento" => array(
                        "dinheiro" => true,
                        "maquineta-delivery" => true,
                        "pagamento-online" => false,
                    ),

                    "configuracoes" => array(
                        "saboresfatias" => array(
                            "pequena" => 1,
                            "media" => 2,
                            "grande" => 4
                        ),

                        "pagamentopizzaria" => array(
                            "type" => 1
                        ),
                    ),


                )
            )
        );

        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    /* Listo o Cardapio de um restaurante em especifico */

    public function getMenu($id_restaurante){
        /*
         * {
                "id_restaurante": "234",
                "cardapio": {
                    "pizzas": [
                        {
                            "id_produto": 20,
                            "nome": "Calabresa",
                            "precos": [
                                {
                                    "tipo": "pequena",
                                    "valor": 16
                                },
                                {
                                    "tipo": "media",
                                    "valor": 18
                                },
                                {
                                    "tipo": "grande",
                                    "valor": 22
                                }
                            ]
                        },
                        {
                            "id_produto": 21,
                            "nome": "Mussarela",
                            "precos": [
                                {
                                    "tipo": "pequena",
                                    "valor": 16
                                },
                                {
                                    "tipo": "media",
                                    "valor": 18
                                },
                                {
                                    "tipo": "grande",
                                    "valor": 22
                                }
                            ]
                        }
                    ],
                    "esfihas": [
                        {
                            "id_produto": 23,
                            "nome": "Esfiha de Carne",
                            "precos": [
                                {
                                    "tipo": "aberta",
                                    "valor": 16
                                },
                                {
                                    "tipo": "fechada",
                                    "valor": 18
                                }
                            ]
                        },
                        {
                            "id_produto": 24,
                            "nome": "Esfiha de Calabresa",
                            "precos": [
                                {
                                    "tipo": "aberta",
                                    "valor": 16
                                },
                                {
                                    "tipo": "fechada",
                                    "valor": 18
                                }
                            ]
                        },
                        {
                            "id_produto": 25,
                            "nome": "Esfiha de Queijo",
                            "precos": [
                                {
                                    "tipo": "aberta",
                                    "valor": 16
                                },
                                {
                                    "tipo": "fechada",
                                    "valor": 18
                                }
                            ]
                        }
                    ]
                }
            }
                     *
         * */

    }

    public function sendPedido(){
        $data = array(
            "status" => "1",
            "message" => "Aguardando aprovação do estabelecimento",
            "pedido" => array(

            )
        );

        $data['pedido'][0] = array(
            "id_produto" => 2,
            "quantidade" => 1,
        );

        $data['pedido'][1] = array(
            "id_produto" => 243,
            "quantidade" => 2,
        );

        echo json_encode($data);
    }


    /*
     * Essa rotina retorna o calculo da pizza de acordo com a regra de négocio do cliente, implementamos dois "tipos" de forma de se cobrar
     * 1. Pela pizza mais cara
     * 2. Pela media dos sabores.
    */

    public function getCalculoPizzaria($id_restaurante){
        $type = 1;
        return $type;
    }
}