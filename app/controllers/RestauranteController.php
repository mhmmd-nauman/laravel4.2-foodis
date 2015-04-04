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

    /* Variaveis de Controle */
    public $flagDinheiro = false;
    public $flagMaquineta = false;
    public $flagOnline = false;
    public $cont = 0;

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

        $cidade = Cidade::where('nome','=',$cidade)->get();
        foreach($cidade as $city){
            $id =  $city->id;
            $nome = $city->nome;
        }

        /* Recupero todos os restaurantes da Cidade */
        $restaurantes = Restaurante::where('cidade_id','=',$id)->where('enabled','=',1)->select('*','restaurantes.id as id_restaurante')->join('cidade','cidade.id','=','restaurantes.cidade_id')->get()->toArray();


        /* For responsavel por buscar informações do estabelecimento e as informações de pagamento  */
        for($i = 0; $i < sizeof($restaurantes); $i++){

            /* Método para Recuperar formas de pagamento de um estabelecimento especifico */
            $pagamento_restaurante = RestauranteController::buscarInformacoesPagamento($restaurantes[$i]['id_restaurante']);

            $json = $restaurantes[$i]['horario_funcionamento'];
            $obj = json_decode($json,true);
            $hoje =  $obj[0][$diaAtual];

            /* Verifico se o dia atual da pesquisa o estabelimentmo não está fechado */
            if($hoje !== 'fechado'){
                $horario = explode('-',$hoje);
                $abertura = $horario[0];
                @$fechamento = $horario[1];
                //Verifico se baseado na hora atual do SERVIDOR o restaurante está aberto ou fechado
                //Caso a Hora atual do sistema for maior ou igual a hora de abertura do estabelecimento E A HORA Atual for menor que a do fechamento (Estabelecimento Fechado)
                if((strtotime($horaAtual) >= strtotime($abertura)) && (strtotime($horaAtual) < strtotime($fechamento))){
                    $status = true;
                }else{
                    $status = false;
                }
            }else{
                $status = false;
            }

                $data[$i] = array(
                    'id' => $restaurantes[$i]['id_restaurante'],
                    'nome' => $restaurantes[$i]['nome_estabelecimento'],
                    'open' => $status,
                    'cidade' => $restaurantes[$i]['nome'],
                    'minimo_entrega' => $restaurantes[$i]['minimo_entrega'],
                    'descricao' => $restaurantes[$i]['descricao'],
                    'logo' => $restaurantes[$i]['logo'],
                    'promocoes' => array(),
                    'endereco' => $restaurantes[$i]['endereco'],
                    'bairro' => $restaurantes[$i]['bairro'],
                    'cidade_entrega' => $restaurantes[$i]['cidade_entrega'],
                    'taxa_entrega' => $restaurantes[$i]['taxa_entrega'],
                    'pagamento' => array(
                        "dinheiro" => $pagamento_restaurante['dinheiro'],
                        "pagamentoonline" => $pagamento_restaurante['online'],
                        "maquinetadelivery" => array(
                            'status' => $pagamento_restaurante['maquineta']['status'],
                            'tipos' => $pagamento_restaurante['maquineta']['itens']
                        ),
                    ),

                    'configuracoes' => array(

                        "saboresfatias" => array(
                            "pequena" => $pagamento_restaurante['configuracoes']['quantidade_pequena'],
                            "media" => $pagamento_restaurante['configuracoes']['quantidade_media'],
                            "grande" => $pagamento_restaurante['configuracoes']['quantidade_grande'],
                        ),

                        "pagamentopizzaria" => array(
                            "type" => $pagamento_restaurante['tipo_pagamento'],
                        ),
                    ),
                );
            }

        $json = array("cidade" => $nome_cidade, "restaurantes" => $data);
        return Response::json($json);
    }


    /* Listo o Cardapio de um restaurante em especifico */
    public function cardapio($id_restaurante){

        $produtos = RestauranteController::buscarProdutos($id_restaurante);

        $data = array("id_restaurante" => $id_restaurante);
        $status = false;
        $cont = 0;
        $cont_main = 0;
        $preco = array('tipo' => 0, 'valor' => 0);
        $info = array();

        /* Recupero os produtos do Restaurante e exibo o JSON */
        foreach($produtos as $produto){
            if($produto['categoria'] === 'Pizzas'){
                $precos_produto = json_decode($produto['preco'],true);
                $status = true;
            }else{
                $preco = $produto['preco'];
            }

            if($status) {
                $preco = array();
                for ($i = 0; $i < sizeof($precos_produto); $i++) {
                    foreach ($precos_produto[$i] as $key => $value) {
                        $preco[$cont] = array(
                            'tipo' => $key,
                            'valor' => $value
                        );

                        $cont++;
                    }
                }

            }else{
                $preco = array(
                    array(
                        'tipo' => $produto['tipo'],
                        'valor' => $preco,
                    ),
                );

            }

            $categoria = strtolower($produto['categoria']);

            $data['cardapio'][$categoria][] = array(
                'id_produto' => $produto['produto_id'],
                'nome' => $produto['nome_produto'],
                'ingredientes' => $produto['ingredientes'],
                "precos" =>  $preco
            );

            $status = false;
            $preco = array();
            $cont = 0;

        }
        return Response::json($data);
    }

    /* Recupero o método de pagamento do restaurante especifico (id_restaurante) */
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
        $produtos = Produto::where('restaurantes_id','=',$id_restaurante)->select('*', 'produtos.id as produto_id')->join('categoria_produto','categoria_produto.id', '=' ,'produtos.categoria_produto_id')->get()->toArray();
        return $produtos;
    }

    /* Recupera as informações de pagamento de um restaurante especifico */
    public function buscarInformacoesPagamento($id_restaurante){
        /* Váriaveis de Controle Interno */
        $online = false;
        $maquineta = false;
        $dinheiro = false;

        //Verifico os métodos de pagamento e as configurações do estabelecimento
        $pagamentos = RestauranteController::buscarMetodoPagamento($id_restaurante);

        //Defino as flags de acordo com os tipos de pagameto disponivel pelo estabelecimento
        foreach($pagamentos as $pagamento){

            if($pagamento['slug'] === 'dinheiro'){
                $dinheiro = true;
            }

            if($pagamento['slug'] === 'maquinetadelivery'){
                $maquineta = true;
            }

            if($pagamento['slug'] === 'pagamentoonline'){
                $online  = true;
            }
        }

        $quantidade_pequena = 0;
        $quantidade_media = 0;
        $quantidade_grande = 0;
        $tipo_pagamento = 0;

        $configuracoes = RestauranteController::buscarConfiguracoesPizzaria($id_restaurante);
        if(!empty($configuracoes[0]['core_pizzaria_id'])) {
            $tipo_pagamento = $configuracoes[0]['core_pizzaria_id'];

            $objeto = json_decode($configuracoes[0]['configuracoes_pizzaria']);

            if (!empty($objeto->config)) {
                $quantidade_pequena = $objeto->config->quantidade->pequena;
                $quantidade_media = $objeto->config->quantidade->media;
                $quantidade_grande = $objeto->config->quantidade->grande;
            }
        }

        if($maquineta) {
            //Recupero os tipos de pagamento e as bandeiras de cartão de credito aceitas pelo estabelecimento
            $resturante_pagamento = new RestauranteCartao();
            $result = $resturante_pagamento->where('id_restaurante', '=', $id_restaurante)->join('pagamento_cartao', 'pagamento_cartao.id', '=', 'id_pagamento_cartao')->get()->toArray();

            $item = array();
            $k = 0;

            foreach ($result as $resultado) {
                $item[$k]['nome'] = $resultado['nome'];
                $item[$k]['img'] = $resultado['imagem'];
                $k++;
            }
        }

        $data = array(
            'dinheiro' => $dinheiro,
            'maquineta' => array(
                'status' => $maquineta,
                'itens' => $item,
            ),
            'online' => $online,
            'configuracoes' => array(
                'quantidade_pequena' => $quantidade_pequena,
                'quantidade_media' => $quantidade_media,
                'quantidade_grande' => $quantidade_grande
            ),

            'tipo_pagamento' => $tipo_pagamento
        );

        return $data;
    }


}