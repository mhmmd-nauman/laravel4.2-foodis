<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="Appboard - Admin Template with Angularjs">
    <meta name="keywords" content="appboard, webapp, admin, dashboard, template, ui">
    <meta name="author" content="solutionportal">
    <!-- <base href="/"> -->

    <title>Foodis - Dashboard</title>

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- Icons -->
    <link rel="stylesheet" href="fonts/font-awesome/font-awesome.css">
    
    <!-- Css/Less Stylesheets -->
    <link rel="stylesheet" href="styles/vendors/bootstrap.min.css">
    <link rel="stylesheet/less" href="styles/main.less">
     
        <!-- Set this in dist folder in index.html file -->
<!--    <link rel="stylesheet" href="styles/bootstrap.min.css">
        <link rel="stylesheet" href="styles/main.min.css">  
    -->
    
    <!-- Match Media polyfill for IE9 -->
    <!--[if IE 9]><!--> <script src="scripts/ie/matchMedia.js"></script>  <!--<![endif]--> 

</head>
<body ng-app="app" 
	id="app" 
	class="app {{themeActive}}" custom-page 
	ng-controller="AppCtrl">

		<div class="page page-auth clearfix">

			<div class="auth-container">
				<!-- site logo -->
				<h1 class="site-logo h2 mb15"><a href="/"><span>Foodis</span>&nbsp;Painel Administrativo</a></h1>
				<h3 class="text-normal h4 text-center">Entre com seus dados</h3>

				<div class="form-container">
					<form class="form-horizontal" action="logar" METHOD="POST">
						<div class="form-group form-group-lg">
							<input class="form-control" type="text" placeholder="Usuário" id="user" name="user">
						</div>

						<div class="form-group form-group-lg">
							<input class="form-control" type="password" placeholder="Senha" id="pass" name="pass">
						</div>

						<div class="clearfix"><a href="#/pages/forget-pass" class="right small">Perdeu sua senha?</a></div>
						<div class="clearfix mb15">
							<button type="submit" class="btn btn-lg btn-w120 btn-primary text-uppercase">Entrar</button>
							<div class="ui-checkbox ui-checkbox-primary mt15 right">
								<label>
									<input type="checkbox">
									<span>Lembrar-se</span>
								</label>
							</div>
						</div>
					</form>
				</div>

			</div>
	<!-- #end auth-wrap -->
		</div>
		<script src="scripts/dev/less.min.js"></script>	

		<!-- Vendors -->
		<script src="scripts/vendors/jquery.min.js"></script> <!-- load before angular -->
		<script src="scripts/vendors/angular.min.js"></script>

		<!-- Plugins -->
		<script src="scripts/plugins/angular-route.min.js"></script>
		<script src="scripts/plugins/angular-animate.min.js"></script>
		<script src="scripts/plugins/angular-sanitize.min.js"></script>
		<script src="scripts/plugins/ui-bootstrap-tpls.min.js"></script>
		<script src="scripts/plugins/select.min.js"></script>
		<script src="scripts/plugins/bootstrap-slider.min.js"></script>
		<script src="scripts/plugins/textAngular.min.js"></script>
		<script src="scripts/plugins/perfect-scrollbar.min.js"></script>
		<script src="scripts/plugins/chartist.js"></script>
		<script src="scripts/plugins/angular.easypiechart.js"></script>
		<script src="scripts/plugins/angular-skycons.min.js"></script>
		<script src="scripts/plugins/loading-bar.min.js"></script>
		<script src="scripts/plugins/angular-fullscreen.js"></script>
		
		<!-- Custom scripts -->
		<script src="scripts/app.js"></script>
		<script src="scripts/shared/app.ctrls.js"></script>
		<script src="scripts/shared/app.directives.js"></script>
		<script src="scripts/shared/app.services.js"></script>
		<script src="scripts/ui/app.ui.ctrls.js"></script>
		<script src="scripts/form/app.ui.form.ctrls.js"></script>
		<script src="scripts/form/app.ui.form.directives.js"></script>
		<script src="scripts/tables/app.ui.table.ctrls.js"></script>
		<script src="scripts/charts/app.chart.ctrls.js"></script>
		<script src="scripts/charts/app.chart.directives.js"></script>
		<script src="scripts/todo/app.todo.js"></script>
		<script src="scripts/email/app.email.ctrls.js"></script>
</body>
</html>