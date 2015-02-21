<header class="site-head clearfix" 
		id="site-head"
		ng-controller="HeadCtrl"
		ng-include=" 'views/header.html' ">
		<!-- linked header (static) view -->
	</header>
		

	<div class="main-container clearfix">
		<aside class="nav-wrap" 
			id="site-nav"
			ng-controller="NavCtrl"
			ng-include=" 'views/nav.html' " custom-scrollbar>
		
		</aside>

		<div class="content-container" 
			id="content" ng-view>
			<!-- content using routing -->
		</div>

		<footer id="site-foot" class="site-foot clearfix">
			<p class="left"><strong>Foodis</strong> - Seu delivery chegou! (2015) </p>
            <p class="right">v1.1</p>
		</footer>

	</div>



	<!-- Dev only -->
	<script src="scripts/dev/less.min.js"></script>	

	<!-- Vendors -->
	<script src="scripts/vendors/jquery.min.js"></script> <!-- load before angular -->
    <script src="scripts/produto.js"></script>
	<script src="scripts/vendors/angular.min.js"></script>

	<!--angularstrap-->
	<script src="//cdnjs.cloudflare.com/ajax/libs/angular-strap/2.1.2/angular-strap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/angular-strap/2.1.2/angular-strap.tpl.min.js"></script>

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
	<script src="scripts/plugins/jquery.bpopup.min.js"></script>
	<script src="scripts/plugins/ngDialog.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/0.9.0/jquery.mask.min.js"></script>
	
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
	<script src="scripts/ui/app.ui.timepicker.directives.js"></script>

	

	<!-- Set this in dist index.html after removing above scripts-->
	<!-- 
		<script src="scripts/vendors.js"></script>	
		<script src="scripts/plugins.js"></script>
		<script src="scripts/app.js"></script>		
	-->
	<!-- !End -->