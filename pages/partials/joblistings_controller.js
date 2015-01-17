'use strict';

/* Controllers */

MobileJobAppControllers.controller('joblistings_controller', ['$scope', '$http', '$resource',
	function($scope, $http, $resource) {
		$scope.joblist = [];
		$scope.jobinfo = {};
		var job = $resource("../index.php/getjobfromdb", {}, {
					  	query : {
						  method: 'GET',
						  params : {
						  },
						  isArray : true
					   }
   					}).query(function(item){
   						$scope.joblist = angular.fromJson(item[0].jsondata);
   						console.log(angular.fromJson(item[0].jsondata));
   					});
		$scope.onJobItemClick = function(title, object){
			$scope.jobinfo = object;
			$scope.jobinfo.title = title;
			console.log(object);
			//console.log($scope.joblist[0].info.description);
			//$scope.jobinfo.desc = $scope.joblist[0].info.description;
		};
}]);