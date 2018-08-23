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

			scope.cmci = {};
			scope.cmci.id = 0;			
			
			//
			scope.cmci.data = {};
			
			scope.cmci.data.economy = {};
			scope.cmci.data.economy.id = 0;
			scope.cmci.data.government = {};
			scope.cmci.data.government.id = 0;
			scope.cmci.data.infra = {};
			scope.cmci.data.infra.id = 0;
			scope.cmci.data.resiliency = {};
			scope.cmci.data.resiliency.id = 0;
			//
			
			scope.cmcis = [];
			
		};
		
		function lgus(scope){
			
			$http({ 
				method: 'POST',
				url: 'api/suggestions/lgus.php'
			}).then(function mySucces(response) {
				
				scope.lgus = response.data;
				
			},function myError(response) {
				
				//error
				
			});
		};
		
		self.list = function(scope) {
			
			bui.show();
			
			if (scope.$id > 2) scope = scope.$parent;			
			
			scope.views.list = true;			
			
			scope.cmci = {};
			scope.cmci.id = 0;						
			
			//
			scope.cmci.data = {};
			
			scope.cmci.data.economy = {};
			scope.cmci.data.economy.id = 0;
			scope.cmci.data.government = {};
			scope.cmci.data.government.id = 0;
			scope.cmci.data.infra = {};
			scope.cmci.data.infra.id = 0;
			scope.cmci.data.resiliency = {};
			scope.cmci.data.resiliency.id = 0;
			//
			
			scope.currentPage = scope.views.currentPage;
			scope.pageSize = 10;
			scope.maxSize = 5;
			
			$http({
			  method: 'POST',
			  url: 'handlers/cmcis/cmcis.php'
			}).then(function success(response) {
				
				scope.cmcis = angular.copy(response.data);
				scope.filterData = scope.cmcis;
				scope.currentPage = scope.views.currentPage;
				
				bui.hide();
				
			}, function error(response) {
				
				bui.hide();

			});			
			
			$('#content').load('lists/cmcis.html',function() {
				$timeout(function() { $compile($('#content')[0])(scope); }, 500);
			});			
			
		};
		
		function mode(scope,row) {
			
			if (row != null) {

				scope.btns = {
					ok: {disabled: true, label: 'Update'},
					cancel: {disabled: false, label: 'Close'}
				};				
			
			
			} else {
				
				scope.btns = {
					ok: {disabled: false, label: 'Save'},
					cancel: {disabled: false, label: 'Cancel'}
				};				
				
			};
			
		};
		
		self.cmci = function(scope,row) {
			
			bui.show();
			
			scope.views.list = false;
			
			lgus(scope);
			
			mode(scope,row);
			
			$('#content').load('forms/cmci.html',function() {
				$timeout(function() {
					
					$compile($('#content')[0])(scope);
					
					if (row != null) {					
						
						$http({
						  method: 'POST',
						  url: 'handlers/cmcis/view.php',
						  data: {id: row.id}
						}).then(function success(response) {
							
							scope.cmci = angular.copy(response.data);
							bui.hide();							
							
						}, function error(response) {
							
							bui.hide();				
							
						});
						
					} else {
						
						scope.cmci = {};
						scope.cmci.id = 0;
						
						//
						scope.cmci.data = {};
						
						scope.cmci.data.economy = {};
						scope.cmci.data.economy.id = 0;
						scope.cmci.data.government = {};
						scope.cmci.data.government.id = 0;
						scope.cmci.data.infra = {};
						scope.cmci.data.infra.id = 0;
						scope.cmci.data.resiliency = {};
						scope.cmci.data.resiliency.id = 0;
						//
						
						
					};
					
					bui.hide();
					
				}, 500);
			});						
			
		};
		
		self.cancel = function(scope) {		
			
			self.list(scope);
			
		};
		
		self.edit = function(scope) {
			
			scope.btns.ok.disabled = !scope.btns.ok.disabled;
			
		};
		
		self.save = function(scope) {

			if (validate.form(scope,'cmci')) {
				growl.show('danger',{from: 'top', amount: 55},'Some fields are required');				
				return;
			};

			if (validate.form(scope,'economy')) {
				growl.show('danger',{from: 'top', amount: 55},'Some fields in economy are required');				
				return;
			};	

			if (validate.form(scope,'government')) {
				growl.show('danger',{from: 'top', amount: 55},'Some fields in government efficiency are required');				
				return;
			};
			
			if (validate.form(scope,'infra')) {
				growl.show('danger',{from: 'top', amount: 55},'Some fields in infrastructure are required');				
				return;
			};

			if (validate.form(scope,'resiliency')) {
				growl.show('danger',{from: 'top', amount: 55},'Some fields in resiliency are required');				
				return;
			};			
			
			$http({
			  method: 'POST',
			  url: 'handlers/cmcis/save.php',
			  data: scope.cmci
			}).then(function success(response) {
				
				bui.hide();
				if (scope.cmci.id == 0) growl.show('alert alert-info',{from: 'top', amount: 55},'New CMCI info successfully added');				
				else growl.show('alert alert-info',{from: 'top', amount: 55},'CMCI info successfully updated');				
				
				mode(scope,scope.cmci);
				
			}, function error(response) {
				
				bui.hide();				
				
			});				
			
		};
		
		self.delete = function(scope,row) {
			
			var onOk = function() {
				
				$http({
					method: 'POST',
					url: 'handlers/cmcis/delete.php',
					data: {id: row.id}
				}).then(function mySuccess(response) {

					self.list(scope);
					growl.show('alert alert-danger',{from: 'top', amount: 55},'CMCI info successfully deleted');

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