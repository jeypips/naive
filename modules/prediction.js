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
		
		self.data = function(scope) {

			scope.formHolder = {};
			
			scope.views = {};
			
			var d = new Date();

			scope.filter = {
				year: d.getFullYear()
			};
		
			
		};
		
		self.list = function(scope) {
			
			scope.views.list = true;			

			$('#content').load('lists/predictions.html', function() {
				$timeout(function() { $compile($('#content')[0])(scope); },100);								
				// instantiate datable
				$timeout(function() {
					$('#predictions').DataTable({
						"ordering": false,
						"processing": true,
						"lengthChange": false
					});	
				},200);
				
			});		
			
		};
		
		self.print = function(scope) {
			
			print(scope);
				
		};
		
		function print(scope) {
			
		var doc = new jsPDF({
			orientation: 'landscape',
			unit: 'pt',
			format: [612, 792]
		});	
		var doc = new jsPDF('l','mm','legal');
		
		//X-axis, Y-axis
		doc.setFontSize(12)
		doc.setFont('helvetica');
		doc.setFontType('bold');
		doc.text(10, 10, 'Economy');
		
		var columns = 
		["No", 
		"Province", 
		"LGU", 
		"Category", 
		"Sample"]		   	
		
		var rows = [
		["10","La Union","San Fernando City","First","dadsddadsddsasasddsasasasasdadsddsasasasdasdsdasddsasasddsasasasasasasasasasasasasasassadsadsadsadsadsasadsadsadsadsadsa"]	
		];	
		
	
		doc.autoTable(columns, rows,{
			theme: 'striped',
			margin: {top: 15, left: 10, },
			tableWidth: 335,
			columnStyles: {
				"No": {columnWidth: 100},
				"Province": {columnWidth: 100},					
				"LGU": {columnWidth: 100},
				"Category": {columnWidth: 100},
				"Sample": {columnWidth: 100}
			},
			styles: {
				lineColor: [75, 75, 75],
				lineWidth: 0.2,
				cellPadding: 5
			},
			headerStyles: {
				halign: 'center',		
				fillColor: [191, 191, 191],
				textColor: 50,
				fontSize: 10
			},
			bodyStyles: {
				halign: 'left',
				fillColor: [255, 255, 255],
				textColor: 50,
				fontSize: 10
			},
			alternateRowStyles: {
				fillColor: [255, 255, 255]
			}
		});
		
		doc.addPage(); // add
		
		//X-axis, Y-axis
		doc.setFontSize(12)
		doc.setFont('helvetica');
		doc.setFontType('bold');
		doc.text(10, 10, 'Government');
		
		var columns = 
		["No", 
		"Province", 
		"LGU", 
		"Category", 
		"Sample"]		   	
		
		var rows = [
		["10","La Union","San Fernando City","First","dadsddadsddsasasddsasasasasdadsddsasasasdasdsdasddsasasddsasasasasasasasasasasasasasassadsadsadsadsadsasadsadsadsadsadsa"]	
		];	
		
	
		doc.autoTable(columns, rows,{
			theme: 'striped',
			margin: {top: 15, left: 10, },
			tableWidth: 335,
			columnStyles: {
				"No": {columnWidth: 100},
				"Province": {columnWidth: 100},					
				"LGU": {columnWidth: 100},
				"Category": {columnWidth: 100},
				"Sample": {columnWidth: 100}
			},
			styles: {
				lineColor: [75, 75, 75],
				lineWidth: 0.2,
				cellPadding: 5
			},
			headerStyles: {
				halign: 'center',		
				fillColor: [191, 191, 191],
				textColor: 50,
				fontSize: 10
			},
			bodyStyles: {
				halign: 'left',
				fillColor: [255, 255, 255],
				textColor: 50,
				fontSize: 10
			},
			alternateRowStyles: {
				fillColor: [255, 255, 255]
			}
		});
		/* var columns = ["No", "Province", "LGU", "Category", "Date of Release"];			
			
 			doc.autoTable(columns, overall,{
				// tableLineColor: [189, 195, 199],
				// tableLineWidth: 0.75,
				margin: {top: 560, left: 50},
				tableWidth: 500,
				columnStyles: {
					"sa": {columnWidth: 100},
					"sa": {columnWidth: 100},					
					"sa": {columnWidth: 100},
					"sa": {columnWidth: 100},
					"sa": {columnWidth: 100}
				},
				styles: {
					lineColor: [75, 75, 75],
					lineWidth: 0.50,
					cellPadding: 5
				},
				headerStyles: {
					halign: 'center',		
					fillColor: [191, 191, 191],
					textColor: 50,
					fontSize: 10
				},
				bodyStyles: {
					halign: 'left',
					fillColor: [255, 255, 255],
					textColor: 50,
					fontSize: 10
				},
				alternateRowStyles: {
					fillColor: [255, 255, 255]
				}
			}); */
		
			var blob = doc.output('blob');
			window.open(URL.createObjectURL(blob));
		
		
		};
		
	};
	
	return new app();
	
});