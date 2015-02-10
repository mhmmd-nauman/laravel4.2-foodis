@include('template.header')
<body ng-app="app" 
	id="app" 
	class="app {{themeActive}}" custom-page 
	ng-controller="AppCtrl">
	@include('angular-stuff'); <!-- app/views/angular-stuff.php -->
</body>
</html>