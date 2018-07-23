angular.module('app-module', ['bootstrap-modal','ui.bootstrap','block-ui','bootstrap-growl','bootstrap-modal','form-validator','window-open-post']).factory('app', function($http,$timeout,$compile,bui,growl,bootstrapModal,validate,printPost) {

	function app() {

		var self = this;				

		self.data = function(scope) {

			scope.formHolder = {};
			
			scope.views = {};
			scope.views.currentPage = 1;

			scope.views.list = true;
			
			scope.btns = {
				ok: {disabled: false, label: 'Save'},
				cancel: {disabled: false, label: 'Cancel'}
			};

			scope.lgu = {};
			scope.lgu.id = 0;			
			
			scope.lgus = [];
			
		};
		
		function provinces(scope){
			
			$http({ 
				method: 'POST',
				url: 'api/suggestions/provinces.php'
			}).then(function mySucces(response) {
				
				scope.provinces = response.data;
				// scope.municipalities = [];
				
			},function myError(response) {
				
				//error
				
			});
		};

		self.list = function(scope) {
			
			bui.show();
			
			if (scope.$id > 2) scope = scope.$parent;			
			
			scope.views.list = true;			
			
			scope.lgu = {};
			scope.lgu.id = 0;						
			
			scope.currentPage = scope.views.currentPage;
			scope.pageSize = 10;
			scope.maxSize = 5;
			
			$http({
			  method: 'POST',
			  url: 'handlers/lgus/lgus.php'
			}).then(function success(response) {
				
				scope.lgus = angular.copy(response.data);
				scope.filterData = scope.lgus;
				scope.currentPage = scope.views.currentPage;
				
				bui.hide();
				
			}, function error(response) {
				
				bui.hide();

			});			
			
			$('#content').load('lists/lgus.html',function() {
				$timeout(function() { $compile($('#content')[0])(scope); }, 500);
			});			
			
		};
		
		function mode(scope,row) {
			
			if (row != null) {

				scope.btns = {
					ok: {disabled: false, label: 'Update'},
					cancel: {disabled: false, label: 'Close'}
				};				
			
			
			} else {
				
				scope.btns = {
					ok: {disabled: false, label: 'Save'},
					cancel: {disabled: false, label: 'Cancel'}
				};				
				
			};
			
		};
		
		self.lgu = function(scope,row) {			
			
			bui.show();
			
			scope.views.list = false;
			provinces(scope);
			
			mode(scope,row);
			
			$('#content').load('forms/lgu.html',function() {
				$timeout(function() {
					
					$compile($('#content')[0])(scope);
					
					if (row != null) {
						
						$http({
						  method: 'POST',
						  url: 'handlers/lgus/view.php',
						  data: {where: {id: row.id}, model: model(scope,'lgu',["id"])}
						}).then(function success(response) {
							
							scope.lgu = angular.copy(response.data);
							bui.hide();							
							
						}, function error(response) {
							
							bui.hide();				
							
						});
						
					} else {
						
						scope.lgu = {};
						scope.lgu.id = 0;
						
					};
					
					bui.hide();
					
				}, 500);
			});						
			
		};
		
		self.cancel = function(scope) {			
			
			scope.lgu = {};
			scope.lgu.id = 0;			
			
			self.list(scope);
			
		};
		
		self.save = function(scope) {

			if (validate.form(scope,'lgu')) {
				growl.show('danger',{from: 'top', amount: 55},'Some fields are required');				
				return;
			};

			$http({
			  method: 'POST',
			  url: 'handlers/lgus/save.php',
			  data: scope.lgu
			}).then(function success(response) {
				
				bui.hide();
				if (scope.lgu.id == 0) growl.show('alert alert-info',{from: 'top', amount: 55},'New LGU info successfully added');				
				else growl.show('alert alert-info',{from: 'top', amount: 55},'LGU info successfully updated');				
				self.list(scope);								
				
			}, function error(response) {
				
				bui.hide();				
				
			});				
			
		};
		
		self.delete = function(scope,row) {
			
			var onOk = function() {
				
				$http({
					method: 'POST',
					url: 'handlers/lgus/delete.php',
					data: {id: row.id}
				}).then(function mySuccess(response) {

					self.list(scope);
					growl.show('alert alert-danger',{from: 'top', amount: 55},'LGU info successfully deleted');

				}, function myError(response) {

				});

			};

			bootstrapModal.confirm(scope,'Confirmation','Are you sure you want to delete this profile?',onOk,function() {});			
			
		};

		function model(scope,form,model) {
			
			angular.forEach(scope.formHolder[form].$$controls,function (elem,i) {
				
				model.push(elem.$$attr.name);
				
			});
			
			return model;
			
		};
		
	};
	
	return new app();
	
});