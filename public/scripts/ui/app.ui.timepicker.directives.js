/*global angular */
/*
 Directive for jQuery UI timepicker (http://jonthornton.github.io/jquery-timepicker/)

 */
angular.module('ui.timepicker', [])

.value('uiTimepickerConfig', {
    'step' : 15,
    'asMoment' : true
})

.directive('uiTimepicker', ['uiTimepickerConfig','$parse', function(uiTimepickerConfig, $parse) {
    var isAMoment = function(date) {
        return moment !== undefined && moment.isMoment(date) && date.isValid();
    };
    var isDateOrMoment = function(date) {
        return angular.isDefined(date) && date !== null &&
          ( angular.isDate(date) || isAMoment(date) );
    };

    return {
        restrict: 'A',
        require: 'ngModel',
        priority: 1,
        link: function(scope, element, attrs, ngModel) {
            'use strict';
            var config = angular.copy(uiTimepickerConfig);
            var asMoment = config.asMoment || false;
            delete config.asMoment;

            ngModel.$render = function () {
                var date = ngModel.$modelValue;
                if (!isDateOrMoment(date)) {
                    throw new Error('ng-Model value must be a Date or Moment object - currently it is a ' + typeof date + '.');
                }
                if (isAMoment(date)) {
                    date = date.toDate();
                }
                if (!element.is(':focus')) {
                    element.timepicker('setTime', date);
                }
            };

            scope.$watch(attrs.ngModel, function() {
                ngModel.$render();
            }, true);

            config.appendTo = element.parent();

            element.timepicker(
                angular.extend(
                    config, attrs.uiTimepicker ?
                    $parse(attrs.uiTimepicker)(scope):
                    {}
                )
            );

            var asDate = function() {
                return isAMoment(ngModel.$modelValue) ? ngModel.$modelValue.toDate() : ngModel.$modelValue;
            };

            var asMomentOrDate = function(date) {
                return asMoment ? moment(date) : date;
            };

            if(element.is('input'))  {
                ngModel.$parsers.unshift(function(){
                    var date = element.timepicker('getTime', asDate() );
                    return asMomentOrDate(date);
                });
            } else {
                element.on('changeTime', function() {
                    scope.$evalAsync(function() {
                        var date = element.timepicker('getTime', asDate() );
                        ngModel.$setViewValue(date);
                    });
                });
            }
        }
    };
}]);
