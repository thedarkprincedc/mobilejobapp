var MobileJobApp = angular.module('MobileJobApp', [
  'ngRoute',
  'ngResource',
  'ngSanitize',
  'MobileJobAppControllers'
]);
MobileJobApp.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
      when('/joblistings', {
        templateUrl: 'partials/joblistings.html',
        controller: 'joblistings_controller'
      }).
     when('/admin', {
        templateUrl: 'partials/admin.html',
        controller: 'admin_controller'
      }).
      otherwise({
        redirectTo: '/joblistings'
      });
  }]);
