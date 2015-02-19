;(function() {
    "use strict";

    angular.module("app.ui.table.ctrls", [])

// Responsive Table Data (static)
        .controller("ResponsiveTableDemoCtrl", ["$scope", function($scope) {

            $scope.responsiveData = [
                {
                    tempo:"20min",
                    numero: "1",
                    cliente: "Jose Bonifacio",
                    tags: ["pizza", "sanduiche"],
                    date: "20-3-2004",
                    endereco: "Rua Sao Francisco, 1267"
                },
                {
                    tempo:"20min",
                    numero: "2",
                    cliente: "Claudio Henrique",
                    tags: ["pizza", "sanduiche"],
                    date: "20-3-2004",
                    endereco: "Rua Sao Francisco, 1267"
                },
                {
                    tempo:"20min",
                    numero: "3",
                    cliente: "Antero Junior",
                    tags: ["pizza", "sanduiche"],
                    date: "20-3-2004",
                    endereco: "Rua Sao Francisco, 1267"
                },
                {
                    tempo:"20min",
                    numero: "4",
                    cliente: "Juliana Ximenes",
                    tags: ["pizza", "sanduiche"],
                    date: "20-3-2004",
                    endereco: "Rua Sao Francisco, 1267"
                },
                {
                    tempo:"20min",
                    numero: "5",
                    cliente: "Priscila Gomes",
                    tags: ["pizza", "sanduiche"],
                    date: "20-3-2004",
                    endereco: "Rua Sao Francisco, 1267"
                },

            ];
        }])


        .controller("DataTablePizza", ["$scope", "$filter" , "$http",  function($scope, $filter, $http) {

            $http.get('http://localhost/foodis-restaurante/public/produto/pizza/get').
                success(function(data, status, headers, config) {
                    var str = '';
                    var other = '';
                    var result = '';

                    $.each(data.pizzas, function(index, value){
                        str = value.nome + "<br>";
                        console.log(" " + str);
                    });
                    
                }).
                error(function(data, status, headers, config) {
                    // called asynchronously if an error occurs
                    // or server returns response with an error status.
                });

        }])


// Data Table
        .controller("DataTableCtrl", ["$scope", "$filter", function($scope, $filter) {
            // data
            $scope.datas = [
                {engine: "Mussarela", browser: "Ver Ingredientes", platform: "Editar | Desativar", version: 20.00, grade: "Sim"},
                {engine: "Presunto", browser: "Ver Ingredientes", platform: "Editar | Desativar", version: 20.00, grade: "Sim"},
                {engine: "Calabresa", browser: "Ver ingredientes", platform: "Editar | Desativar", version: 3.5, grade: "Não"},
                {engine: "Frango", browser: "Ver ingredientes", platform: "Editar | Desativar", version: "-", grade: "Sim"},
                {engine: "Lombinho", browser: "Ver ingredientes", platform: "Editar | Desativar", version: "-", grade: "Não"},
                {engine: "Carne de Sol", browser: "Ver ingredientes", platform: "Editar | Desativar", version: 5, grade: "Sim"},
                {engine: "Portuguesa", browser: "Ver ingredientes", platform: "Editar | Desativar", version: 7, grade: "Não"},
                {engine: "Catupiry", browser: "Ver ingredientes", platform: "Editar | Desativar", version: 419.3, grade: "Sim"},
                {engine: "Milho", browser: "Ver ingredientes", platform: "Editar | Desativar", version: 420, grade: "Não"},
            ];
            var prelength = $scope.datas.length;

            // create random data (uses `track by $index` in html for duplicacy)

//	for(var i = prelength; i < 100; i++) {
//		var rand = Math.floor(Math.random()*prelength);
//		$scope.datas.push($scope.datas[rand]);
//	}

            $scope.searchKeywords = "";
            $scope.filteredData = [];
            $scope.row = "";


            $scope.numPerPageOpts = [5, 7, 10, 25, 50, 100];
            $scope.numPerPage = $scope.numPerPageOpts[1];
            $scope.currentPage = 1;
            $scope.currentPageStores = []; // data to hold per pagination


            $scope.select = function(page) {
                var start = (page - 1)*$scope.numPerPage,
                    end = start + $scope.numPerPage;

                $scope.currentPageStores = $scope.filteredData.slice(start, end);
            }

            $scope.onFilterChange = function() {
                $scope.select(1);
                $scope.currentPage = 1;
                $scope.row = '';
            }

            $scope.onNumPerPageChange = function() {
                $scope.select(1);
                $scope.currentPage = 1;
            }

            $scope.onOrderChange = function() {
                $scope.select(1);
                $scope.currentPage = 1;
            }


            $scope.search = function() {
                $scope.filteredData = $filter("filter")($scope.datas, $scope.searchKeywords);
                $scope.onFilterChange();
            }

            $scope.order = function(rowName) {
                if($scope.row == rowName)
                    return;
                $scope.row = rowName;
                $scope.filteredData = $filter('orderBy')($scope.datas, rowName);
                $scope.onOrderChange();
            }

            // init
            $scope.search();
            $scope.select($scope.currentPage);

        }])

}())