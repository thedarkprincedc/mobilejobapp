'use strict';

/* Controllers */

//var MobileJobAppControllers = angular.module('MobileJobAppControllers', []);
MobileJobAppControllers.controller('admin_controller', ['$scope', '$http', '$resource',
	function($scope, $http, $resource) {
	$scope.scrape = {};
	var jobupdateinfo = $resource("../index.php/getjobupdateinfofromdb", {}, {
					  	query : {
						  method: 'GET',
						  isArray : true
					   }
   					}).query(function(item){
   						$scope.scrape = {"url" : item[0].url,
   										 "lastupdated":item[0].lastupdated,
   										 "nextupdate":item[0].nextupdate,
   						};
   					});
   	$scope.onUpdateManually = function(){
   		/*console.log("");
   		$scope.scrape.nextupdate = "Running: this is going to take a while";
   		$resource("../index.php/updatejobdb",{},{query :{isArray : false}}).query(function(item){
   			//$scope.jobupdateinfo.query();
   			console.log(item);
   		});*/
   	};
}]);
