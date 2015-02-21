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

    /* Listo o Cardapio de um restaurante em especifico */

    public function getMenu($id_restaurante){
        $data = array(
          "id_restaurante" => $id_restaurante,
           "cardario" => array(

           "pizza" =>
               array(
                   array(
                       "id_produto" => 23,
                       "nome" => "Pizza de Calabresa",
                       "preco" => array(
                           "pequena" => 16,
                           "media" => 18.50,
                           "grande" => 20,
                       ),
                   ),
                   array(
                       "id_produto" => 23,
                       "nome" => "Pizza de Musarela",
                       "preco" => array(
                           "pequena" => 17,
                           "media" => 19.50,
                           "grande" => 22.40,
                       ),
                   )
               ),

           "esfihas" => array(
                  array(
                       "id_produto" => 23,
                       "nome" => "Esfiha de Carne",
                       "tipo" => "Aberta",
                       "preco" => 10,
                  ),
                   array(
                       "id_produto" => 23,
                       "nome" => "Esfiha de Carne",
                       "tipo" => "Fechada",
                       "preco" => 15,
                   )
               )
           ),
        );


        echo json_encode($data);
    }
}