angular.module('app-module', ['bootstrap-modal','ui.bootstrap','block-ui','bootstrap-growl','bootstrap-modal','form-validator','window-open-post']).directive('fileModel', function($parse) {
	return {
	   restrict: 'A',
	   link: function(scope, element, attrs) {
		  var model = $parse(attrs.fileModel);
		  var modelSetter = model.assign;
		  
		  element.bind('change', function(){
			 scope.$apply(function(){
				modelSetter(scope, element[0].files[0]);
			 });
		  });

		  // scope.$watch(attrs.fileModel, function(file) {
			// $('#'+element['context']['id']).val(null);
		  // });
	   }
	};
}).factory('app', function($http,$timeout,$compile,bui,growl,bootstrapModal,validate,printPost) {

	function app() {

		var self = this;				

		function uploadFileToUrl(file, uploadUrl, scope) {
			
			scope.views.progress = 0;
			
			var fd = new FormData();
		   
			fd.append('file', file);
		
			var xhr = new XMLHttpRequest();
			xhr.upload.addEventListener("progress", uploadProgress, false);
			xhr.addEventListener("load", uploadComplete, false);
			xhr.open("POST", uploadUrl)
			scope.progressVisible = true;
			xhr.send(fd);
		   
			// upload progress
			function uploadProgress(evt) {
				scope.progress.startUpload = true;					
				scope.$apply(function(){
					scope.views.progress = 0;				
					if (evt.lengthComputable) {
						scope.progress.upload = Math.round(evt.loaded * 100 / evt.total);
					} else {
						scope.progress.upload = 'unable to compute';
					}
				});
			}

			function uploadComplete(evt) {
				/* This event is raised when the server send back a response */
				scope.$apply(function() {			

				});			

				// $('#excel').val(null);

			}

		};
		
		self.data = function(scope) {

			scope.formHolder = {};
			
			scope.views = {};
			scope.views.currentPage = 1;
			
			scope.imports = [];
			
			scope.progress = {};
			
			scope.progress.upload = 0;
			scope.progress.startUpload = false;			
			
			scope.progress.import = 0;
			scope.progress.startImport = false;	
			scope.progress.importStatus = '';	
			
			scope.alert = {};
			scope.alert.upload = {};
			scope.alert.import = {};
			
			scope.alert.upload.show = false;
			scope.alert.upload.msg = '';
			
			scope.alert.import.show = false;
			scope.alert.import.msg = '';			
			
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
			
			var d = new Date();

			scope.filter = {
				year: d.getFullYear()
			};
			
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
			  url: 'handlers/cmcis/cmcis.php',
			  data: scope.filter
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
		
		self.import = function(scope) {
			
			scope.progress.upload = 0;
			scope.progress.startUpload = false;		
			
			bootstrapModal.box2(scope,'Import from Excel','dialogs/import.html',function() {});
			
		};
		
		self.uploadFile = function(scope) {

		   scope.alert.upload.show = false;
		   scope.alert.upload.msg = '';
		
		   var file = scope.views.excel;
		   
		   if (file == undefined) {
				scope.alert.upload.show = true;
				scope.alert.upload.msg = 'No file selected';		   
				return;
		   };
		   
		   var f = file['name'];
		   var en = f.substring(f.indexOf("."),f.length);

		   if (en != ".xlsx") {
				scope.alert.upload.show = true;
				scope.alert.upload.msg = 'Only xlsx file is supported';		   
				return;
		   };		   

		   var uploadUrl = "import/upload-excel.php";
		   uploadFileToUrl(file, uploadUrl, scope);
		   
		};

		self.initImport = function(scope) {
			
			scope.alert.import.show = false;
			scope.alert.import.msg = '';			
			
			scope.progress.import = 0;
			scope.progress.startImport = false;	
			scope.progress.importStatus = '';			
			
			// check if file exists
			$http({
				method: 'GET',
				url: 'import/check-file.php'
			}).then(function success(response) {
				
				if (response.data['exists']) {
					
					fetchData(scope);
					
				} else {
					
					scope.alert.import.show = true;
					scope.alert.import.msg = 'Please file upload excel (xlsx) file';					
					
				};
				
			}, function error(response) {
				
			});
			
			
		};
		
		function fetchData(scope) {
			
			scope.alert.import.show = false;
			scope.alert.import.msg = '';
			
			scope.progress.import = 0;
			scope.progress.startImport = false;	
			scope.progress.importStatus = '';			

			if ((scope.views.period == undefined) || (scope.views.period == "")) {
				
				scope.alert.import.show = true;
				scope.alert.import.msg = 'Plese enter period';
				
				return;
				
			};						
			
			scope.progress.startImport = true;	
			scope.progress.importStatus = 'Analyzing data please wait...';			
			
			$http({
				method: 'GET',
				url: 'import/read.php'
			}).then(function success(response) {
				
				scope.imports = response.data;
				
				startImport(scope,0);
				
			}, function error(response) {
				
			});			
			
		};
		
		function startImport(scope) {
			
			scope.progress.startImport = true;
			scope.progress.importStatus = 'Initiating import...';

			processImport(scope,0);			
			
		};
		
		function processImport(scope,i) {
			
			$http({
			  method: 'POST',
			  url: 'import/process-import.php',
			  data: {i: i, import: scope.imports[i]}
			}).then(function mySucces(response) {

				scope.progress.importStatus = 'Importing...';			
			
				++i;
				
				$timeout(function() {
		
					scope.progress.import = Math.ceil(i*100/(scope.imports.length));		
		
					if (i < scope.imports.length) {
						
						processImport(scope,i);
						
					} else {
						
						$timeout(function() {
						
							scope.progress.importStatus = 'Importing data completed';
							
						}, 500);
						
					};
	
				}, 100);
				
			}, function myError(response) {
						  
				
			});			
			
		};
		
	};
	
	return new app();
	
});