<body>

	<div id="content">
	    @yield('conteudo')
	</div>


	<!-- Dev only -->
	<script src="assets/scripts/dev/less.min.js"></script>

	<!-- Vendors -->
	<script src="assets/scripts/vendors/jquery.min.js"></script> <!-- load before angular -->
	<script src="assets/scripts/vendors/angular.min.js"></script>

	<!-- Plugins -->
	<script src="assets/scripts/plugins/angular-route.min.js"></script>
	<script src="assets/scripts/plugins/angular-animate.min.js"></script>
	<script src="assets/scripts/plugins/angular-sanitize.min.js"></script>
	<script src="assets/scripts/plugins/ui-bootstrap-tpls.min.js"></script>
	<script src="assets/scripts/plugins/select.min.js"></script>
	<script src="assets/scripts/plugins/bootstrap-slider.min.js"></script>
	<script src="assets/scripts/plugins/textAngular.min.js"></script>
	<script src="assets/scripts/plugins/perfect-scrollbar.min.js"></script>
	<script src="assets/scripts/plugins/chartist.js"></script>
	<script src="assets/scripts/plugins/angular.easypiechart.js"></script>
	<script src="assets/scripts/plugins/angular-skycons.min.js"></script>
	<script src="assets/scripts/plugins/loading-bar.min.js"></script>
	<script src="assets/scripts/plugins/angular-fullscreen.js"></script>
	
	<!-- Custom scripts -->
	<script src="assets/scripts/app.js"></script>
	<script src="assets/scripts/shared/app.ctrls.js"></script>
	<script src="assets/scripts/shared/app.directives.js"></script>
	<script src="assets/scripts/shared/app.services.js"></script>
	<script src="assets/scripts/ui/app.ui.ctrls.js"></script>
	<script src="assets/scripts/form/app.ui.form.ctrls.js"></script>
	<script src="assets/scripts/form/app.ui.form.directives.js"></script>
	<script src="assets/scripts/tables/app.ui.table.ctrls.js"></script>
	<script src="assets/scripts/charts/app.chart.ctrls.js"></script>
	<script src="assets/scripts/charts/app.chart.directives.js"></script>
	<script src="assets/scripts/todo/app.todo.js"></script>
	<script src="assets/scripts/email/app.email.ctrls.js"></script>
	

	<!-- Set this in dist index.html after removing above scripts-->
	<!-- 
		<script src="scripts/vendors.js"></script>	
		<script src="scripts/plugins.js"></script>
		<script src="scripts/app.js"></script>		
	-->
	<!-- !End -->
</body>
</html>