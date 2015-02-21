<?php
/**
 * Created by PhpStorm.
 * User: claudiohenrique
 * Date: 21/02/15
 * Time: 04:23 PM (Na madruga! haha)
 */

class RestauranteController extends BaseController {

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
                    "endereco" => "Rua São Jose N120, Centro, Petrolina ",

                    "horario" => array(
                        "abertura" => "08:00 AM",
                        "fechamento" => "12:00 PM",
                    ),

                    "pagamento" => array(
                        "dinheiro" => true,
                        "maquineta-delivery" => true,
                        "pagamento-online" => false,
                    ),


                ),
                //Segundo Registro
                array(
                    "id" => 234,
                    "nome" => "Habibs",
                    "descricao" => "Habibs, a melhor opção em comida oriental na cidade. ",
                    "endereco" => "Rua São Paulo N882, Areia Branca, Petrolina ",

                    "horario" => array(
                        "open" => "08:00 AM",
                        "close" => "12:00 PM",
                    ),
                    "pagamento" => array(
                        "dinheiro" => true,
                        "maquineta-delivery" => true,
                        "pagamento-online" => false,
                    ),


                )
            )
        );

        echo json_encode($data, JSON_PRETTY_PRINT);
    }
}