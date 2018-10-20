angular.module('app-module', ['bootstrap-modal','ui.bootstrap','block-ui','bootstrap-growl','bootstrap-modal','form-validator','window-open-post']).factory('app', function($http,$timeout,$compile,bui,growl,bootstrapModal,validate,printPost) {

	function app() {

		var self = this;
		
		self.data = function(scope) {
			
			scope.formHolder = {};
			
			scope.dashboard = {};
			scope.dashboard.year = '';
			
		};
		
		self.list = function(scope) {
			
			bui.show();
			
			$('#content').load('dashboard/dashboard.html',function() {
				$timeout(function() { $compile($('#content')[0])(scope); }, 500);
			});			
			
			bui.hide();
		};
		
	};
	
	return new app();

});