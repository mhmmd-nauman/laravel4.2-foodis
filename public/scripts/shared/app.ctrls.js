;(function() {
"use strict";

angular.module("app.ctrls", [])

// Root Controller
.controller("AppCtrl", ["$rootScope", "$scope",  function($rs, $scope) {
	var mm = window.matchMedia("(max-width: 767px)");
	$rs.isMobile = mm.matches ? true: false;

	$rs.safeApply = function(fn) {
		var phase = this.$root.$$phase;
		if(phase == '$apply' || phase == '$digest') {
			if(fn && (typeof(fn) === 'function')) {
				fn();
			}
		} else {
			this.$apply(fn);
		}
	};
	
	mm.addListener(function(m) {
		$rs.safeApply(function() {
			$rs.isMobile = (m.matches) ? true : false;
		});	
	});

	// theme-settings
	$scope.themeActive = "theme-one";	// second theme
	$scope.onThemeChange = function(theme) {
		$scope.themeActive = theme;
	}

	
	
}])



// Head Controller
.controller("HeadCtrl", ["$scope", "Fullscreen",  function($scope, Fullscreen){

	$scope.toggleSidebar = function() {
		$scope.sidebarOpen = $scope.sidebarOpen ? false : true;
	}

	$scope.fullScreen = function() {
		if (Fullscreen.isEnabled())
        	Fullscreen.cancel();
      	else
         	Fullscreen.all()
	}

}])

/// nav Controller
.controller("NavCtrl", ["$scope", "$rootScope", function($scope, $rs) {
	$scope.isCollapsed = false;	// show-hide collapse in profile-box
	
  
}])



// dashboard ctrl
.controller("DashboardCtrl", ["$scope", "$rootScope",   function($scope, $rs) {
	// line/bar data
	$scope.linedata = {
		labels: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
		series: [
			{
				name: "Earnings",
				data: [100, 150, 90, 40, 30, 50, 40]
			},
			{
				name: "Downloads",
				data: [50, 100, 40, 25, 20, 35, 30]
			}
		]
	};


	$scope.lineopts = {
		axisY: {
			offset: 25,
			labelOffset: {
				y: 5
			}
		},
		axisX: {
			showGrid: false
		},
		showArea: true,
		showLine: false,
		showPoint: true,
		fullWidth: true
	}



	// server load
	$scope.serverpieoptions = {
		barColor: "#5974d9"
	}
	$scope.serverpiepercent = 80;
	$scope.bouncepiepercent = 40;

	
	// forecast widget
	// =======================
	// icons possible values are: 
	// CLEAR_DAY, CLEAR_NIGHT, PARTLY_CLOUDY_DAY, PARTLY_CLOUDY_NIGHT, CLOUDY, RAIN
	// SLEET, SNOW, WIND, FOG 
	// see forecast api doc for more info: https://developer.forecast.io/docs/v2
	$scope.weathertoday = {
        icon: Skycons.PARTLY_CLOUDY_DAY,
        size: 48,
        color: "#38B4EE"
    };

    $scope.forecastDetails = [
    	{type: "Wind:", value: "7mph"},
    	{type: "Humidity:", value: "46%"},
    	{type: "Dew Pt:", value: "44"},
    	{type: "Visibility:", value: "1mi"},
    	{type: "Pressure:", value: "1015 mb"},
    	{type: "Precipitation", value: "55%"}
    ];

    $scope.weatherweeks = [
    	{icon: Skycons.PARTLY_CLOUDY_DAY, size: 32, color: "#fff", day: "Tue", temp: "34"},
    	{icon: Skycons.RAIN, size: 32, color: "#fff", day: "Wed", temp: "28"},
    	{icon: Skycons.SNOW, size: 32, color: "#fff", day: "Thu", temp: "4"},
    	{icon: Skycons.CLEAR_NIGHT, size: 32, color: "#fff", day: "Fri", temp: "40"},
    	{icon: Skycons.FOG, size: 28, color: "#fff", day: "Sat", temp: "-3"},
    	{icon: Skycons.SLEET, size: 28, color: "#fff", day: "Sun", temp: "18"},
    ]

}])


// profile page controller
.controller("PageProfileCtrl", ["$scope", function($scope) {
	$scope.linedata = {
		labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Nov", "Dec"],
		series: [
			{
				data: [50, 80, 100, 90, 120, 50, 80, 56, 135, 75, 148]
			}
		]
	};

	$scope.lineopts = {
		axisY: {
			offset: 25,
			labelOffset: {
				y: 5
			},

		},
		axisX: {
			showGrid: false,
			labelOffset: {
				x: 10
			}
		}
	}

}])

.controller('ModalCtrl', function($scope, $modal) {
    // Show a basic modal from a controller
    var myModal = $modal({title: 'My Title', content: 'My Content', show: true});

     // Pre-fetch an external template populated with a custom scope
     var myOtherModal = $modal({scope: $scope, template: '/../bower_components/angular-strap/src/modal.tpl.html', show: false});
     // Show when some event occurs (use $promise property to ensure the template has been loaded)
     $scope.showModal = function() {
         myOtherModal.$promise.then(myOtherModal.show);
    };


})

}())

