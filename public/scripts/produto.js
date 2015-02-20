/**
 * Created by claudiohenrique on 14/02/15.
 */


function adicionarPizza(){
    //URL Utilizada na Requisicao
        var URL = 'http://localhost/foodis-restaurante/public/produto/pizza/add';

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
           'ingredientes' : ingredientes,
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

            /* Faço o reload da página */
            setTimeout(function() { window.location.reload(true); }, 1000);
        }
    })

}

function adicionarEsfiha(){
    //URL Utilizada na Requisicao
    var URL = 'http://localhost/foodis-restaurante/public/produto/esfiha/add';

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
        'ingredientes' : ingredientesEsfiha,
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

            /* Faço o reload da página */
            setTimeout(function() { window.location.reload(true); }, 1000);
        }
    })

}

function adicionarSalgado(){
    //URL Utilizada na Requisicao
    var URL = 'http://localhost/foodis-restaurante/public/produto/salgado/add';

    //Informações Relacionadas ao Produto
    var nomeSalgado = document.getElementById("nome-salgado").value;
    var ingredientesSalgado = document.getElementById("ingredientes-salgado").value;
    var precoSalgado = document.getElementById("preco-salgado").value;

    var data = {
       'sabor' : nomeSalgado,
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

            /* Faço o reload da página */
            setTimeout(function() { window.location.reload(true); }, 1000);
        }
    })

}

function adicionarSanduiche(){
    //URL Utilizada na Requisicao
    var URL = 'http://localhost/foodis-restaurante/public/produto/sanduiche/add';

    //Informações Relacionadas ao Produto
    var saborSanduiche = document.getElementById("sabor-sanduiche").value;
    var ingredientesSanduiche = document.getElementById("ingredientes-sanduiche").value;
    var precoSanduiche = document.getElementById("preco-sanduiche").value;

    var data = {
        'sabor' : saborSanduiche,
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
    var URL = 'http://localhost/foodis-restaurante/public/produto/massas/add';

    //Informações Relacionadas ao Produto
    var saborMassa = document.getElementById("sabor-massas").value;
    var ingredientesMassa = document.getElementById("ingredientes-massas").value;
    var precoMassa = document.getElementById("preco-massas").value;

    var data = {
        'sabor' : saborMassa,
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

            /* Faço o reload da página */
            setTimeout(function() { window.location.reload(true); }, 1000);
        }
    })
}

function adicionarOutro(){
    //URL Utilizada na Requisicao
    var URL = 'http://localhost/foodis-restaurante/public/produto/massas/add';

    //Informações Relacionadas ao Produto
    var nomeOutro = document.getElementById("nome-outros");
    var precoOutro = document.getElementById("preco-outros");
    var e = document.getElementById("categorias");
    var tipoOutro = e.options[e.selectedIndex].text;
    var mensagem = document.getElementById("mensagem-sucesso");

    var data = {
        'nome-produto' : nomeOutro.value,
        'tipo': tipoOutro,
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

            /* Faço o reload da página */
            setTimeout(function() { window.location.reload(true); }, 1000);
        }
    })
}


