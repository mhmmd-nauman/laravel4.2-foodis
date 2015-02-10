;(function() {
	"use strict";

	angular.module("app", [
		/* Angular modules */
		"ngRoute",
		"ngAnimate",
		"ngSanitize",

		/* 3rd Party Modules */
		"ui.bootstrap",
		"ui.select",
		"textAngular",
		"easypiechart",
		"angular-skycons",
		"angular-loading-bar",
		"FBAngular",
		/* Custom Modules */
		"app.ctrls",
		"app.directives",
		"app.services",
		"app.ui.ctrls",
		"app.ui.form.ctrls",
		"app.ui.form.directives",
		"app.ui.table.ctrls",
		"app.chart.ctrls",
		"app.chart.directives",
		"app.todo",
		"app.email.ctrls",
		"ui.timepicker",

	])

	// globally set ui-select theme
	.config(["uiSelectConfig", function(uiSelectConfig) {
		uiSelectConfig.theme = "bootstrap";
	}])

	// disable spinner in loading-bar
	.config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
	    cfpLoadingBarProvider.includeSpinner = false;
	    cfpLoadingBarProvider.latencyThreshold = 50;
	}])

	// route provider
	.config(["$routeProvider", "$locationProvider", function($routeProvider, $locationProvider) {

		var routes = [
			"dashboard", "restaurantes/cadrest", "restaurantes/editrest", "prods/addprod", "prods/editprod", "pedidos/aberto","pedidos/pedido",
			"pedidos/andamento","pedidos/cancelado","pedidos/concluido","pedidos/rejeitado","funcs/addfunc","funcs/editfunc","funcs/editfunc2"
		];

		function setRoutes(route) {
			var url = '/' + route,
				config = {
					templateUrl: "views/" + route + ".html"
				};

			$routeProvider.when(url, config);
			return $routeProvider;
		}

		routes.forEach(function(route) {
			setRoutes(route);
		});

		$routeProvider
			.when("/", {redirectTo: "/dashboard"})
			.when("/404", {templateUrl: "views/pages/404.html"})
			.otherwise({redirectTo: "/404"});
		

	}])
}())

function toggle_visibility(id) 
{
    var e = document.getElementById(id);
    if (e.style.display == 'block' || e.style.display=='')
    {
        e.style.display = 'none';
    }
    else 
    {
        e.style.display = 'block';
    }
}
function toggle_visibility_select() 
{
   for(i=1;i<7;i++){
   	var delcat = "cat"+i;
   	var del = document.getElementById(delcat);
        del.style.display = 'none';
   }

   var index = document.getElementById("selectcat").selectedIndex;

   var optcat = "cat"+index;

   var x = document.getElementById(optcat);

   if (x.style.display == 'block' || x.style.display=='')
    {
        x.style.display = 'none';
    }
    else 
    {
        x.style.display = 'block';
    }
}