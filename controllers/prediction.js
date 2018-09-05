var app = angular.module('prediction',['account-module','app-module']);

app.controller('predictionCtrl',function($scope,app) {

	$scope.app = app;

	app.data($scope);
		
});

