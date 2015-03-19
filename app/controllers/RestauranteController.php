<?php

/**
 * Created by PhpStorm.
 * User: claudiohenrique
 * Date: 21/02/15
 * Time: 04:23 PM (Na madruga! haha)
 */

date_default_timezone_set('America/Recife');


class RestauranteController extends BaseController {

    /*
     * REGRAS DE CALCULO CASO O ESTELECIMENTO VENDA PIZZA:
     *
     * Esses são os tipo que sao utilizados para a realização do calculo
     *
     * -- models/CorePizzaria.php
     * -> Tabela responsavel por conter essas especificações
     *
     * 1. Pela pizza mais cara
     * 2. Pela media dos sabores.
    */

    public $payments;

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

        $nome_cidade = $cidade;


        /* Configurações iniciais para a consulta (Dia Atual) e (Hora Atual) */
        $dias = array("segunda","terca","quarta","quinta","sexta","sabado","domingo");
        $diaAtual = UtilsController::getDay(date('l'));
        $horaAtual = date('H:i');

        /* Váriaveis de Controle */
        $status = false;

        /* Variaveis de Controle */
        $flagDinheiro = 0;
        $flagMaquineta = 0;
        $flag_online = 0;
        $cont = 0;

        $cidade = Cidade::where('nome','=',$cidade)->get();
        foreach($cidade as $city){
            $id =  $city->id;
            $nome = $city->nome;
        }

        /* Recupero todos os restaurantes da Cidade */
        $resturantes = Restaurante::where('cidade_id','=',$id)->get()->toArray();

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

            //Caso o restaurantes esteja aberto entro aqui para buscar as informações do estabelecimento
            if($status){

                $pagamentos = RestauranteController::buscarMetodoPagamento($resturantes[$i]['id']);

                //Defino as flags de acordo com os tipos de pagameto disponivel pelo estabelecimento
                foreach($pagamentos as $pagamento){

                    if($pagamento['slug'] === 'dinheiro'){
                        $this->flagDinheiro = true;
                    }

                    if($pagamento['slug'] === 'maquinetadelivery'){
                        $this->flagMaquineta = true;
                    }

                    if($pagamento['slug'] === 'pagamentoonline'){
                        $flag_online = true;
                    }
                }

                $quantidade_pequena = 0;
                $quantidade_media = 0;
                $quantidade_grande = 0;
                $tipo_pagamento = 0;

                $configuracoes = RestauranteController::buscarConfiguracoesPizzaria($resturantes[$i]['id']);
                if(!empty($configuracoes[0]['core_pizzaria_id'])) {
                    $tipo_pagamento = $configuracoes[0]['core_pizzaria_id'];

                    $objeto = json_decode($configuracoes[0]['configuracoes_pizzaria']);

                    if (!empty($objeto->config)) {
                        $quantidade_pequena = $objeto->config->quantidade->pequena;
                        $quantidade_media = $objeto->config->quantidade->media;
                        $quantidade_grande = $objeto->config->quantidade->grande;
                    }
                }

                $data[$i] = array(
                    'id' => $resturantes[$i]['id'],
                    'nome' => $resturantes[$i]['nome_estabelecimento'],
                    'descricao' => $resturantes[$i]['descricao'],
                    'logo' => 'imagem.png',
                    'promocoes' => array(),
                    'endereco' => $resturantes[$i]['endereco'],
                    'bairro' => $resturantes[$i]['bairro'],
                    'cidade' => $resturantes[$i]['cidade_entrega'],

                    'pagamento' => array(
                        "dinheiro" => $this->flagDinheiro,
                        "maquinetadelivery" => $this->flagMaquineta,
                        "pagamentoonline" => $flag_online
                    ),

                    'configuracoes' => array(

                        "saboresfatias" => array(
                            "pequena" => $quantidade_pequena,
                            "media" => $quantidade_media,
                            "grande" => $quantidade_grande,
                        ),

                        "pagamentopizzaria" => array(
                            "type" => $tipo_pagamento,
                        ),
                    )
                );

                /* Reseto os Valores para Não Influenciar em outros estabelecimentos */
                $quantidade_pequena = null;
                $quantidade_media = null;
                $quantidade_grande = null;
                $this->flagDinheiro = 0;
                $this->flagMaquineta = 0;
                $flag_online = 0;

            }

        }

        $json = array("cidade" => $nome_cidade, "restaurantes" => $data);
        return Response::json($json);
    }


    /* Listo o Cardapio de um restaurante em especifico */

    public function cardapio($id_restaurante){
        $produtos = RestauranteController::buscarProdutos($id_restaurante);
        $data = array();
        $valor_tamanho = array();
        $cont = 0;
        $precos = array();


        foreach($produtos as $produto){
            $categoria = strtolower($produto['categoria']);

            if($categoria === 'pizzas'){
                $objeto = json_decode($produto['preco'],true);
                $tamanho = sizeof($objeto);

                foreach($objeto as $key => $value){
                    $precos['precos'] = array(

                    );
                }
            }

            $data = array_add($data, $categoria , array(

            ));

        }

        echo '<pre>';
        print_r($produtos);
        print_r($precos);

    }

    public function sendPedido(){

    }

    /* Recupero o método de pagamento do restaurante em questão (id_restaurante) */
    public function buscarMetodoPagamento($id_restaurante){
        $pagamento = RestaurantePagamento::where('restaurantes_id','=',$id_restaurante)->join('pagamento', 'pagamento.id', '=', 'tipo_pagamento_id')->get()->toArray();
        return $pagamento;
    }

    /* Recuperar as Configurações do Estabelecimento caso ele seja um pizzaria */
    public function buscarConfiguracoesPizzaria($id_restaurante){
        $restaurante = CorePedidos::where('restaurantes_id','=',$id_restaurante)->get()->toArray();
        return $restaurante;
    }

    /* Recuperar os Produtos cadastrados para um restaurante especifico */
    public function buscarProdutos($id_restaurante){
        $produtos = Produto::where('restaurantes_id','=',$id_restaurante)->join('categoria_produto','categoria_produto.id', '=' ,'categoria_produto_id')->get()->toArray();
        return $produtos;
    }

}