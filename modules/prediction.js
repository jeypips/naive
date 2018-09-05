angular.module('app-module', ['bootstrap-modal','ui.bootstrap','block-ui','bootstrap-growl','bootstrap-modal','form-validator','window-open-post']).factory('app', function($http,$timeout,$compile,bui,growl,bootstrapModal,validate,printPost) {

	function app() {

		var self = this;
		
		self.data = function(scope) {

			scope.formHolder = {};
			
			scope.views = {};
			
			var d = new Date();

			scope.filter = {};
			scope.filter.prediction = {};
			scope.filter.prediction.period = d.getFullYear();
		
			scope.prediction = [];
			
		};
		
		self.prediction = function(scope) {
			
			if ((scope.filter.prediction.period == undefined) || (scope.filter.prediction.period == "")) {			
				growl.show('danger',{from: 'top', amount: 55}, 'Please enter period');				
				return;
			};
			
			if ((scope.filter.prediction.top == undefined) || (scope.filter.prediction.top == "")) {			
				growl.show('danger',{from: 'top', amount: 55}, 'Please enter top');				
				return;
			};			
			
			$http({
				method: 'POST',
				url: 'api/prediction.php',
				data: scope.filter.prediction
			}).then(function success(response) {
				
				scope.prediction = angular.copy(response.data);
				
			}, function error(response) {
				
			});
		
			$('#content').load('lists/predictions.html', function() {
				
				$timeout(function() {
					$compile($('#predictions')[0])(scope);
				}, 500);				
				
				// instantiate datable
				$timeout(function() {
					$('#table-economy').DataTable({
						"ordering": false,
						"processing": true,
						"lengthChange": false,
						"scrollX": true
					});
				}, 1000);
				
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
			doc.setFontSize(16)
			doc.setFont('helvetica');
			doc.setFontType('bold');
			doc.text(10, 10, 'Datasets');
			
			doc.setFontSize(12)
			doc.setFont('helvetica');
			doc.setFontType('normal');
			doc.text(10, 20, 'Economy');
			
			var economy = 
			["No", 
			"Province", 
			"LGU", 
			"Category", 
			"Sample"];		   	
			
			var rows = [
			["10",
			"La Union",
			"San Fernando City",
			"First",
			"SAMPLE SAMPLE SAMPLE"]
			];	
		
	
			doc.autoTable(economy, rows,{
				theme: 'striped',
				margin: {
					top: 22, 
					left: 10 
				},
				tableWidth: 500,
				styles: {
					lineColor: [75, 75, 75],
					lineWidth: 0.50,
					cellPadding: 3,
					overflow: 'linebreak',
					columnWidth: 'wrap'
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
			doc.setFontType('normal');
			doc.text(10, 10, 'Government Efficiency');
		
			var government = 
			["No","Province","LGU","Category","Sample"]		   	
			
			var rows = [
			["10","La Union","San Fernando City","First","dadsddadsddsasasddsasasasasdadsddsasasasdasdsdasddsasasddsasasasasasasasasasasasasasassadsadsadsadsadsasadsadsadsadsadsa"]	
			];	
		
	
			doc.autoTable(government, rows,{
				theme: 'striped',
				margin: {
					top: 12, 
					left: 10 
				},
				tableWidth: 500,
				styles: {
					lineColor: [75, 75, 75],
					lineWidth: 0.50,
					cellPadding: 3,
					overflow: 'linebreak',
					columnWidth: 'wrap'
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
		
			var blob = doc.output('blob');
			window.open(URL.createObjectURL(blob));
		
		
		};
		
	};
	
	return new app();
	
});