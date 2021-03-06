/**
 * Created by claudiohenrique on 14/02/15.
 */

//Criação da Função personalizada
jQuery.fn.reset = function (){
    $(this).each (function(){
        this.reset();
    });
}

function adicionarPizza(){
    //URL Utilizada na Requisicao
    var URL = 'http://localhost/foodis-restaurante/public/produto/add';

    //Informações referente ao produto
    var saborPizza = document.getElementById("sabor-pizza").value;
    var ingredientes = document.getElementById("ingredientes-pizza").value;

    //Checkbox dos precos
    var pizzaPequena = document.getElementById("pizza-pequena");
    var pizzaMedia = document.getElementById("pizza-media");
    var pizzaGrande = document.getElementById("pizza-grande");

    //Inputs com os preços da pizza.
    var precoPequena = document.getElementById("valor-pequena").value;
    var precoMedia = document.getElementById("valor-media").value;
    var precoGrande = document.getElementById("valor-grande").value;

    //Variaveis de controle.
    var preco = [];
    var obj = {};

    //Logica do Processamento
    if(pizzaPequena.checked){
        obj["pequena"] = "" + precoPequena;
    }

    if(pizzaMedia.checked){
       obj["media"] = "" + precoMedia;
    }

    if(pizzaGrande.checked){
       obj["grande"] = "" + precoGrande;
    }

    preco.push(obj);

       var data = {
           'sabor' : saborPizza,
           'id_categoria' : 1,
           'ingredientes' : ingredientes,
           'tipo': 'pizza',
            'precos' : {
                'pequena' : preco[0].pequena,
                'media' : preco[0].media,
                'grande' : preco[0].grande
            }
       };

    //JSON Pronto para ser enviado como requisicao
    var myJsonString = JSON.stringify(data);


    /* Envio da Requisição */

    $.ajax({
        url: URL,
        type: "POST",
        data: JSON.stringify(data),
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function (result) {
            /* Exibo a mensagem de sucesso */
            document.getElementById('mensagem-sucesso').style.display = 'block';
            $('form').reset();
        }
    })

}

function adicionarEsfiha(){
    //URL Utilizada na Requisicao
    var URL = 'http://localhost/foodis-restaurante/public/produto/add';

    //Informações relacionadas ao Produto
    var saborEsfiha = document.getElementById("sabor-esfiha").value;
    var ingredientesEsfiha = document.getElementById("ingredientes-esfiha").value;
    var precoEsfiha = document.getElementById("valor-esfiha").value;

    //Informações sobre o Tipo de Esfiha
    var esfihaAberta = document.getElementById("esfira-aberta");
    var esfihaFechada = document.getElementById("esfira-fechada");
    var tipoEsfiha = '';

    if(esfihaAberta.checked){
        tipoEsfiha = "Aberta";
    }

    if(esfihaFechada.checked){
        tipoEsfiha = "Fechada";
    }


    //Variaveis de Controle
    var data = {
        'sabor' : saborEsfiha,
        'id_categoria' : 2,
        'ingredientes' : ingredientesEsfiha,
        'type': 'esfiha',
        'tipo' : tipoEsfiha,
        'preco' : precoEsfiha
    };

    //JSON Pronto para ser enviado como requisicao
    var myJsonString = JSON.stringify(data);

    $.ajax({
        url: URL,
        type: "POST",
        data: JSON.stringify(data),
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function (result) {
            /* Exibo a mensagem de sucesso */
            document.getElementById('mensagem-sucesso').style.display = 'block';
            $('form').reset();
        }
    })

}

function adicionarSalgado(){
    //URL Utilizada na Requisicao
    var URL = 'http://localhost/foodis-restaurante/public/produto/add';

    //Informações Relacionadas ao Produto
    var nomeSalgado = document.getElementById("nome-salgado").value;
    var ingredientesSalgado = document.getElementById("ingredientes-salgado").value;
    var precoSalgado = document.getElementById("preco-salgado").value;

    var data = {
        'sabor' : nomeSalgado,
        'id_categoria' : 3,
        'tipo': 'unico',
        'ingredientes': ingredientesSalgado,
        'preco' : precoSalgado
    };

    //JSON Pronto para ser enviado como requisicao
    var myJsonString = JSON.stringify(data);

    $.ajax({
        url: URL,
        type: "POST",
        data: JSON.stringify(data),
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function (result) {
            /* Exibo a mensagem de sucesso */
            document.getElementById('mensagem-sucesso').style.display = 'block';
        }
    })

}

function adicionarSanduiche(){
    //URL Utilizada na Requisicao
    var URL = 'http://localhost/foodis-restaurante/public/produto/add';

    //Informações Relacionadas ao Produto
    var saborSanduiche = document.getElementById("sabor-sanduiche").value;
    var ingredientesSanduiche = document.getElementById("ingredientes-sanduiche").value;
    var precoSanduiche = document.getElementById("preco-sanduiche").value;

    var data = {
        'sabor' : saborSanduiche,
        'tipo': 'unico',
        'id_categoria' : 4,
        'ingredientes': ingredientesSanduiche,
        'preco' : precoSanduiche
    };

    //JSON Pronto para ser enviado como requisicao
    var myJsonString = JSON.stringify(data);

    $.ajax({
        url: URL,
        type: "POST",
        data: JSON.stringify(data),
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function (result) {
            /* Exibo a mensagem de sucesso */
            document.getElementById('mensagem-sucesso').style.display = 'block';

            /* Faço o reload da página */
            setTimeout(function() { window.location.reload(true); }, 1000);
        }
    })

}



function adicionarMassas(){
    //URL Utilizada na Requisicao
    var URL = 'http://localhost/foodis-restaurante/public/produto/add';

    //Informações Relacionadas ao Produto
    var saborMassa = document.getElementById("sabor-massas").value;
    var ingredientesMassa = document.getElementById("ingredientes-massas").value;
    var precoMassa = document.getElementById("preco-massas").value;

    var data = {
        'sabor' : saborMassa,
        'tipo': 'unico',
        'id_categoria' : 5,
        'ingredientes': ingredientesMassa,
        'preco' : precoMassa
    };

    //JSON Pronto para ser enviado como requisicao
    var myJsonString = JSON.stringify(data);

    $.ajax({
        url: URL,
        type: "POST",
        data: JSON.stringify(data),
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function (result) {
            /* Exibo a mensagem de sucesso */
            document.getElementById('mensagem-sucesso').style.display = 'block';
        }
    })
}

function adicionarPrato(){
    //URL Utilizada na Requisicao
    var URL = 'http://localhost/foodis-restaurante/public/produto/add';

    //Informações Relacionadas ao Produto
    var nomePrato = document.getElementById("nome-prato").value;
    var ingredientesPrato = document.getElementById("ingredientes-prato").value;
    var precoPrato = document.getElementById("valor-prato").value;

    var data = {
        'sabor' : nomePrato,
        'tipo': 'unico',
        'id_categoria' : 6,
        'ingredientes': ingredientesPrato,
        'preco' : precoPrato
    };

    //JSON Pronto para ser enviado como requisicao
    var myJsonString = JSON.stringify(data);

    $.ajax({
        url: URL,
        type: "POST",
        data: JSON.stringify(data),
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function (result) {
            /* Exibo a mensagem de sucesso */
            document.getElementById('mensagem-sucesso').style.display = 'block';
        }
    })

}


function adicionarJaponesa(){
    //URL Utilizada na Requisicao
    var URL = 'http://localhost/foodis-restaurante/public/produto/add';

    //Informações Relacionadas ao Produto
    var nomeJaponesa = document.getElementById("nome-japonesa").value;
    var ingredientesJaponesa = document.getElementById("ingredientes-japonesa").value;
    var precoJaponesa = document.getElementById("valor-japonesa").value;

    var data = {
        'sabor' : nomeJaponesa,
        'tipo': 'unico',
        'id_categoria' : 7,
        'ingredientes': ingredientesJaponesa,
        'preco' : precoJaponesa
    };

    //JSON Pronto para ser enviado como requisicao
    var myJsonString = JSON.stringify(data);

    $.ajax({
        url: URL,
        type: "POST",
        data: JSON.stringify(data),
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function (result) {
            /* Exibo a mensagem de sucesso */
            document.getElementById('mensagem-sucesso').style.display = 'block';
        }
    })

}



function adicionarOutro(){
    //URL Utilizada na Requisicao
    var URL = 'http://localhost/foodis-restaurante/public/produto/add';

    //Informações Relacionadas ao Produto
    var nomeOutro = document.getElementById("nome-outros");
    var precoOutro = document.getElementById("preco-outros");
    var tipoOutro = $( "#addOutros option:selected" ).val();
    var mensagem = document.getElementById("mensagem-sucesso");

    alert(tipoOutro);


    var data = {
        'sabor' : nomeOutro.value,
        'ingredientes' : '',
        'tipo': 'unico',
        'id_categoria': tipoOutro,
        'preco' : precoOutro.value
    };

    //JSON Pronto para ser enviado como requisicao
    var myJsonString = JSON.stringify(data);

    $.ajax({
        url: URL,
        type: "POST",
        data: JSON.stringify(data),
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function (result) {
            /* Exibo a mensagem de sucesso */
            document.getElementById('mensagem-sucesso').style.display = 'block';

        }
    })
}



