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
			
			scope.tables = {};			
			scope.tables.headers = [
				{"striped":true},
				{"striped":true},
				{"striped":true},
				{"striped":false},
				{"striped":false},
				{"striped":false},
				{"striped":true},
				{"striped":true},
				{"striped":true},
				{"striped":false},
				{"striped":false},
				{"striped":false},
				{"striped":true},
				{"striped":true},
				{"striped":true},
				{"striped":false},
				{"striped":false},
				{"striped":false},
				{"striped":true},
				{"striped":true},
				{"striped":true},
				{"striped":false},
				{"striped":false},
				{"striped":false},
				{"striped":true},
				{"striped":true},
				{"striped":true},
				{"striped":false},
				{"striped":false},
				{"striped":false},
				{"striped":true},
				{"striped":true},
				{"striped":true},				
			];
			
		};
		
		self.prediction_ = function(scope) {
			
			if ((scope.filter.prediction.period == undefined) || (scope.filter.prediction.period == "")) {			
				growl.show('danger',{from: 'top', amount: 55}, 'Please enter period');				
				return;
			};
			
			if ((scope.filter.prediction.top == undefined) || (scope.filter.prediction.top == "")) {			
				growl.show('danger',{from: 'top', amount: 55}, 'Please enter top');				
				return;
			};			
			
			bui.show("Analyzing data please wait...");
			
			$http({
				method: 'POST',
				url: 'api/prediction.php',
				data: scope.filter.prediction
			}).then(function success(response) {

				scope.prediction = angular.copy(response.data);
				
				$('#content').load('lists/predictions.html', function() {
					
					$timeout(function() {
						$compile($('#predictions')[0])(scope);
					}, 500);				
					
					// instantiate datable
					$timeout(function() {
						$('#table-economy').DataTable({
							"ordering": false,
							"processing": true,
							"lengthChange": true,
							"scrollX": true
						});
					}, 1000);
					$timeout(function() {					
						$('#table-government').DataTable({
							"ordering": false,
							"processing": true,
							"lengthChange": true,
							"scrollX": true
						});
					}, 1000);	
					$timeout(function() {					
						$('#table-infrastructure').DataTable({
							"ordering": false,
							"processing": true,
							"lengthChange": true,
							"scrollX": true
						});
					}, 1000);
					$timeout(function() {				
						$('#table-resiliency').DataTable({
							"ordering": false,
							"processing": true,
							"lengthChange": true,
							"scrollX": true
						});				
					}, 1000);

					$timeout(function() {
						bui.hide();
					},2000);
					
				});					
				
			}, function error(response) {
				
				bui.hide();				
				
			});
			
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
			
			bui.show("Analyzing data please wait...");

				
			$('#content').load('lists/predictions.php?period='+scope.filter.prediction.period+'&top='+scope.filter.prediction.top, function() {
				
				$timeout(function() {
					$compile($('#print-datasets')[0])(scope);
				}, 500);
				
				$timeout(function() {
					$compile($('#print-frequency')[0])(scope);
				}, 500);
				
				$timeout(function() {
					$compile($('#print-likelihood')[0])(scope);
				}, 500);
				
				$timeout(function() {
					$compile($('#btn-frequency')[0])(scope);
				}, 500);
				
				$timeout(function() {
					$compile($('#btn-likelihood')[0])(scope);
				}, 500);
				
				// instantiate datable
				$('table.datasets').DataTable({
					"ordering": false,
					"processing": false,
					"lengthChange": true,
				});
				
 				$timeout(function() {
					
					jQuery('.dataTable').wrap('<div class="dataTables_scroll" />');
					
				}, 1000);					

				bui.hide();
				
			});
			
		};
		
		self.edit = function(scope) {
			
			scope.btns.ok.disabled = !scope.btns.ok.disabled;
			
		};
		
		//print likelihood tables
		self.print_likelihood = function(scope) {
			
			$http({
			method: 'POST',
			url: 'api/prediction.php',
			data: scope.filter.prediction
			}).then(function success(response) {

				print_likelihood(response.data);
			
			}, function error() {
				
			});
			
		};
		
		function print_likelihood(prediction) {			
			
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
			doc.text(10, 10, 'Likelihood Tables '+prediction.year);
			
			angular.forEach(prediction.prediction.likelihood_tables, function(likelihood,i) {				
				
				if (i>0) doc.addPage();
				
				doc.setFontSize(12)
				doc.setFont('helvetica');
				doc.setFontType('normal');
				doc.text(10, 18, likelihood.header);
				
				var likelihood_header = [
					{title: "Likelihood Table", dataKey: "1"},
					{title: "", dataKey: "2"},
					{title: "Competitive", dataKey: "3"},
					{title: "", dataKey: "4"},
					{title: "", dataKey: "5"}
				];
				var likelihood_rows = [
					{"3": "Yes", "4": "No"},
					{"1": "LGU Category", "2": "City", "3": likelihood.indicators[0].data.city.yes, "4": likelihood.indicators[0].data.city.no, "5": likelihood.indicators[0].data.city.total},
					{"2": "1st-2nd Class", "3": likelihood.indicators[0].data.first_second.yes, "4": likelihood.indicators[0].data.first_second.no, "5": likelihood.indicators[0].data.first_second.total},
					{"2": "3rd-4th Class", "3": likelihood.indicators[0].data.third_fourth.yes, "4": likelihood.indicators[0].data.third_fourth.no, "5": likelihood.indicators[0].data.third_fourth.total},
					{"3": likelihood.indicators[0].data.total.yes, "4": likelihood.indicators[0].data.total.no},
				];			
				
				doc.autoTable(likelihood_header, likelihood_rows,{
					theme: 'striped',
					margin: {
						top: 20, 
						left: 10 
					},
					tableWidth: 500,
					styles: {
						lineColor: [75, 75, 75],
						lineWidth: 0.02,
						cellPadding: 3,
						overflow: 'linebreak',
						columnWidth: 'wrap',
						
					},
					headerStyles: {
						halign: 'center',
						fillColor: [191, 191, 191],
						textColor: 50,
						fontSize: 12
					},
					bodyStyles: {
						halign: 'left',
						fillColor: [255, 255, 255],
						textColor: 50,
						fontSize: 12
					},
					alternateRowStyles: {
						fillColor: [255, 255, 255]
					}
				});
				
				/*
				**	indicators
				*/
				angular.forEach(likelihood.indicators, function(indicator,key) {
					
					if (key==0) return;
					
					// console.log(indicator.data);
					
					/* doc.setFontSize(12)
					doc.setFont('helvetica');
					doc.setFontType('normal');
					doc.text(10, 83, 'Economy Dynamism');	 */		
					
					var likelihood_header = [
						{title: "Likelihood Table", dataKey: "1"},
						{title: "", dataKey: "2"},
						{title: "Competitive", dataKey: "3"},
						{title: "", dataKey: "4"},
						{title: "", dataKey: "5"}
					];
					var likelihood_rows = [
						{"3": "Yes", "4": "No"},
						{"1": indicator.header,"2": "Yes","3": indicator.data.yes.yes, "4": indicator.data.yes.no, "5": indicator.data.yes.total},
						{"2": "No","3": indicator.data.no.yes, "4": indicator.data.no.no, "5": indicator.data.no.total},
						{"3": indicator.data.total.yes, "4": indicator.data.total.no}
					];
					
					var top = 20;
					var left = 160;
					
					// key = 1,2
					if (key>1) left+=160;
					
					if (key>=2) {
						top = 87;
						left = 10;
					};
					
					if (key==3) left+=150;
					
					if (key>=4) {
						top = 144;
						left = 10;
					};
					if (key==5) left+=150;
					
					if (key==6) {
						top = 20;
						left = 10;
						doc.addPage();
					};
					
					if (key>=7){ 
						top = 20;
						left+=150;
					};
					if(key>=8){
						top = 80;
						left = 10;
					};
					if(key==9) left+=150;
					
					if(key==10){
						top = 140;
						left = 10;
					};		
					doc.autoTable(likelihood_header, likelihood_rows,{
						theme: 'striped',
						margin: {
							top: top, 
							left: left 
						},
						tableWidth: 500,
						styles: {
							lineColor: [75, 75, 75],
							lineWidth: 0.02,
							cellPadding: 3,
							overflow: 'linebreak',
							columnWidth: 'wrap',
						},
						columnStyles: {
							1: {columnWidth: 48},
							2: {columnWidth: 15},
							3: {columnWidth: 30},
							4: {columnWidth: 25}
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
				
				});
				/*
				**
				*/
			
			/*
			** end category
			*/
			
			});
			
			var blob = doc.output('blob');
			window.open(URL.createObjectURL(blob));
		
		};
		
		//print frequency tables
		self.print_frequency = function(scope) {
			
			$http({
			method: 'POST',
			url: 'api/prediction.php',
			data: scope.filter.prediction
			}).then(function success(response) {

				print_frequency(response.data);
			
			}, function error() {
				
			});
			
		};
		
		function print_frequency(prediction) {			
			
			// console.log(prediction.prediction.frequency_tables);
			
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
			doc.text(10, 10, 'Frequency Tables '+prediction.year);

			/*
			**	category
			*/
			
			angular.forEach(prediction.prediction.frequency_tables, function(frequency,i) {				
				
				if (i>0) doc.addPage();
				
				doc.setFontSize(12)
				doc.setFont('helvetica');
				doc.setFontType('normal');
				doc.text(10, 18, frequency.header);
				
				var frequency_header = [
					{title: "Frequency Table", dataKey: "1"},
					{title: "", dataKey: "2"},
					{title: "Competitive", dataKey: "3"},
					{title: "", dataKey: "4"}
				];
				var frequency_rows = [
					{"": "","3": "Yes", "4": "No"},
					{"1": "LGU Category", "2": "City", "3": frequency.indicators[0].data.city.yes, "4": frequency.indicators[0].data.city.no},
					{"": "", "2": "1st-2nd Class", "3": frequency.indicators[0].data.first_second.yes, "4": frequency.indicators[0].data.first_second.no},
					{"": "", "2": "3rd-4th Class", "3": frequency.indicators[0].data.third_fourth.yes, "4": frequency.indicators[0].data.third_fourth.no},
				];			
				
				doc.autoTable(frequency_header, frequency_rows,{
					theme: 'striped',
					margin: {
						top: 20, 
						left: 10 
					},
					tableWidth: 500,
					styles: {
						lineColor: [75, 75, 75],
						lineWidth: 0.02,
						cellPadding: 3,
						overflow: 'linebreak',
						columnWidth: 'wrap',
						
					},
					headerStyles: {
						halign: 'center',
						fillColor: [191, 191, 191],
						textColor: 50,
						fontSize: 12
					},
					bodyStyles: {
						halign: 'left',
						fillColor: [255, 255, 255],
						textColor: 50,
						fontSize: 12
					},
					alternateRowStyles: {
						fillColor: [255, 255, 255]
					}
				});
				
				/*
				**	indicators
				*/
				angular.forEach(frequency.indicators, function(indicator,key) {
					
					if (key==0) return;
					
					// console.log(indicator.data);
					
					/* doc.setFontSize(12)
					doc.setFont('helvetica');
					doc.setFontType('normal');
					doc.text(10, 83, 'Economy Dynamism');	 */		
					
					var frequency_header = [
						{title: "Frequency Table", dataKey: "1"},
						{title: "", dataKey: "2"},
						{title: "Competitive", dataKey: "3"},
						{title: "", dataKey: "4"}
					];
					var frequency_rows = [
						{"": "", "3": "Yes", "4": "No"},
						{"1": indicator.header,"2": "Yes","3": indicator.data.yes.yes, "4": indicator.data.yes.no},
						{"": "", "2": "No","3": indicator.data.no.yes, "4": indicator.data.no.no}
					];
					
					var top = 20;
					var left = 130;
					
					// key = 1,2
					if (key>1) left+=115;
					
					if (key>=3) {
						top = 85;
						left = 10;
					};
					if (key==4) left+=115;
					if (key==5) left+=230;
					
					if (key>=6) {
						top = 140;
						left = 10;
					};
					
					if (key==7) left+=115;
					if (key==8) left+=230;
					
					if(key==9) {
						top = 20;
						left = 10;
						doc.addPage();
					};
					
					if(key==10) {
						top = 20;
						left = 130;
					};
							
					doc.autoTable(frequency_header, frequency_rows,{
						theme: 'striped',
						margin: {
							top: top, 
							left: left 
						},
						tableWidth: 500,
						styles: {
							lineColor: [75, 75, 75],
							lineWidth: 0.02,
							cellPadding: 3,
							overflow: 'linebreak',
							columnWidth: 'wrap',
						},
						columnStyles: {
							1: {columnWidth: 48},
							2: {columnWidth: 15},
							3: {columnWidth: 30},
							4: {columnWidth: 15}
						},
						headerStyles: {
							halign: 'center',
							fillColor: [191, 191, 191],
							textColor: 50,
							fontSize: 12
						},
						bodyStyles: {
							halign: 'left',
							fillColor: [255, 255, 255],
							textColor: 50,
							fontSize: 12
						},
						alternateRowStyles: {
							fillColor: [255, 255, 255]
						}
					});			
				
				});
				/*
				**
				*/
			
			/*
			** end category
			*/
			
			});
			
			var blob = doc.output('blob');
			window.open(URL.createObjectURL(blob));
		
		};
		
		self.print = function(scope) {
			
			$http({
				method: 'POST',
				url: 'api/prediction.php',
				data: scope.filter.prediction
			}).then(function success(response) {

				print(response.data);
			
			});
				
		};
		
		function print(prediction) {			
			
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
			doc.text(35, 10, ''+prediction.year);
			
			doc.setFontSize(12)
			doc.setFont('helvetica');
			doc.setFontType('normal');
			doc.text(10, 20, 'Economy');
			
			var economy = ["No","Province","LGU","Category"];
			
			angular.forEach(prediction.headers.economy, function(economy_h,i) {

				if (i<6) {
					economy.push(economy_h.header);
				};
				
			});
			
			var rows = [];
			angular.forEach(prediction.prediction.dataset, function(lgu,i) {
				
				var row = [];
				row.push(lgu.lgu_no);
				row.push(lgu.province);
				row.push(lgu.lgu);
				row.push(lgu.category);
				row.push(lgu.economy.local_economy_size.actual);
				row.push(lgu.economy.local_economy_size.rank);
				row.push(lgu.economy.local_economy_size.competitive);
				row.push(lgu.economy.local_economy_growth.actual);
				row.push(lgu.economy.local_economy_growth.rank);
				row.push(lgu.economy.local_economy_growth.competitive);
				
				rows.push(row);
				
			});		
	
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
					columnWidth: 'wrap',
					
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
			doc.setFontSize(16)
			doc.setFont('helvetica');
			doc.setFontType('bold');
			doc.text(10, 10, 'Datasets');
			doc.text(35, 10, ''+prediction.year);
			
			doc.setFontSize(12)
			doc.setFont('helvetica');
			doc.setFontType('normal');
			doc.text(10, 20, 'Economy');
			
			var economy = ["No","Province","LGU","Category"];
			
			angular.forEach(prediction.headers.economy, function(economy_h,i) {

				if ((i<12) && (i=>6) && (i>5)) {
					economy.push(economy_h.header);
				};
				
			});
			
			var rows1 = [];
			angular.forEach(prediction.prediction.dataset, function(lgu,i) {
				
				var row1 = [];
				row1.push(lgu.lgu_no);
				row1.push(lgu.province);
				row1.push(lgu.lgu);
				row1.push(lgu.category);
				row1.push(lgu.economy.local_economy_structure.actual);
				row1.push(lgu.economy.local_economy_structure.rank);
				row1.push(lgu.economy.local_economy_structure.competitive);				
				row1.push(lgu.economy.safety_compliant_business.actual);
				row1.push(lgu.economy.safety_compliant_business.rank);
				row1.push(lgu.economy.safety_compliant_business.competitive);	
				
				rows1.push(row1);
				
			});		
	
			doc.autoTable(economy, rows1,{
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
					fontSize: 9.5
				},
				bodyStyles: {
					halign: 'left',
					fillColor: [255, 255, 255],
					textColor: 50,
					fontSize: 9.5
				},
				alternateRowStyles: {
					fillColor: [255, 255, 255]
				}
			});
			
			doc.addPage(); // add
			
			//X-axis, Y-axis
			doc.setFontSize(16)
			doc.setFont('helvetica');
			doc.setFontType('bold');
			doc.text(10, 10, 'Datasets');
			doc.text(35, 10, ''+prediction.year);
			
			doc.setFontSize(12)
			doc.setFont('helvetica');
			doc.setFontType('normal');
			doc.text(10, 20, 'Economy');
			
			var economy = ["No","Province","LGU","Category"];
			
			angular.forEach(prediction.headers.economy, function(economy_h,i) {

				if ((i<18) && (i=>6) && (i>11)) {
					economy.push(economy_h.header);
				};
				
			});
			
			var rows2 = [];
			angular.forEach(prediction.prediction.dataset, function(lgu,i) {
				
				var row2 = [];
				row2.push(lgu.lgu_no);
				row2.push(lgu.province);
				row2.push(lgu.lgu);
				row2.push(lgu.category);
				row2.push(lgu.economy.increase_in_employment.actual);
				row2.push(lgu.economy.increase_in_employment.rank);
				row2.push(lgu.economy.increase_in_employment.competitive);				
				row2.push(lgu.economy.cost_of_living.actual);
				row2.push(lgu.economy.cost_of_living.rank);
				row2.push(lgu.economy.cost_of_living.competitive);	
				
				rows2.push(row2);
				
			});		
	
			doc.autoTable(economy, rows2,{
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
			doc.setFontSize(16)
			doc.setFont('helvetica');
			doc.setFontType('bold');
			doc.text(10, 10, 'Datasets');
			doc.text(35, 10, ''+prediction.year);
			
			doc.setFontSize(12)
			doc.setFont('helvetica');
			doc.setFontType('normal');
			doc.text(10, 20, 'Economy');
			
			var economy = ["No","Province","LGU","Category"];
			
			angular.forEach(prediction.headers.economy, function(economy_h,i) {

				if ((i<24) && (i=>6) && (i>17)) {
					economy.push(economy_h.header);
				};
				
			});
			
			var rows3 = [];
			angular.forEach(prediction.prediction.dataset, function(lgu,i) {
				
				var row3 = [];
				row3.push(lgu.lgu_no);
				row3.push(lgu.province);
				row3.push(lgu.lgu);
				row3.push(lgu.category);
				row3.push(lgu.economy.cost_of_doing_business.actual);
				row3.push(lgu.economy.cost_of_doing_business.rank);
				row3.push(lgu.economy.cost_of_doing_business.competitive);				
				row3.push(lgu.economy.financial_deepening.actual);
				row3.push(lgu.economy.financial_deepening.rank);
				row3.push(lgu.economy.financial_deepening.competitive);	
				
				rows3.push(row3);
				
			});		
	
			doc.autoTable(economy, rows3,{
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
			doc.setFontSize(16)
			doc.setFont('helvetica');
			doc.setFontType('bold');
			doc.text(10, 10, 'Datasets');
			doc.text(35, 10, ''+prediction.year);
			
			doc.setFontSize(12)
			doc.setFont('helvetica');
			doc.setFontType('normal');
			doc.text(10, 20, 'Economy');
			
			var economy = ["No","Province","LGU","Category"];
			
			angular.forEach(prediction.headers.economy, function(economy_h,i) {

				if ((i<30) && (i=>6) && (i>23)) {
					economy.push(economy_h.header);
				};
				
			});
			
			var rows4 = [];
			angular.forEach(prediction.prediction.dataset, function(lgu,i) {
				
				var row4 = [];
				row4.push(lgu.lgu_no);
				row4.push(lgu.province);
				row4.push(lgu.lgu);
				row4.push(lgu.category);
				row4.push(lgu.economy.productivity.actual);
				row4.push(lgu.economy.productivity.rank);
				row4.push(lgu.economy.productivity.competitive);				
				row4.push(lgu.economy.presence_of_business_and_professional.actual);
				row4.push(lgu.economy.presence_of_business_and_professional.rank);
				row4.push(lgu.economy.presence_of_business_and_professional.competitive);	
				
				rows4.push(row4);
				
			});		
	
			doc.autoTable(economy, rows4,{
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
					fontSize: 8.8
				},
				bodyStyles: {
					halign: 'left',
					fillColor: [255, 255, 255],
					textColor: 50,
					fontSize: 8.8
				},
				alternateRowStyles: {
					fillColor: [255, 255, 255]
				}
			});
			
			doc.addPage(); // add
			
			//X-axis, Y-axis
			doc.setFontSize(16)
			doc.setFont('helvetica');
			doc.setFontType('bold');
			doc.text(10, 10, 'Datasets');
			doc.text(35, 10, ''+prediction.year);
			
			doc.setFontSize(12)
			doc.setFont('helvetica');
			doc.setFontType('normal');
			doc.text(10, 20, 'Economy');
			
			var economy = ["No","Province","LGU","Category"];
			
			angular.forEach(prediction.headers.economy, function(economy_h,i) {

				if ((i<36) && (i=>6) && (i>29)) {
					economy.push(economy_h.header);
				};
				
			});
			
			var rows5 = [];
			angular.forEach(prediction.prediction.dataset, function(lgu,i) {
				
				var row5 = [];
				row5.push(lgu.lgu_no);
				row5.push(lgu.province);
				row5.push(lgu.lgu);
				row5.push(lgu.category);
				row5.push(lgu.economy.total.actual);
				row5.push(lgu.economy.total.rank);
				row5.push(lgu.economy.total.competitive);
				
				rows5.push(row5);
				
			});		
	
			doc.autoTable(economy, rows5,{
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
			
			doc.addPage(); // add //government_efficiency
			
			//X-axis, Y-axis
			doc.setFontSize(16)
			doc.setFont('helvetica');
			doc.setFontType('bold');
			doc.text(10, 10, 'Datasets');
			doc.text(35, 10, ''+prediction.year);
			
			doc.setFontSize(12)
			doc.setFont('helvetica');
			doc.setFontType('normal');
			doc.text(10, 20, 'Government Efficiency');
			
			var government_efficiency = ["No","Province","LGU","Category"];
			
			angular.forEach(prediction.headers.government_efficiency, function(government_efficiency_h,i) {

				if (i<6) {
					government_efficiency.push(government_efficiency_h.header);
				};
				
			});
			
			var rows6 = [];
			angular.forEach(prediction.prediction.dataset, function(lgu,i) {
				
				var row6 = [];
				row6.push(lgu.lgu_no);
				row6.push(lgu.province);
				row6.push(lgu.lgu);
				row6.push(lgu.category);
				row6.push(lgu.government_efficiency.compliance_to_national_directives.actual);
				row6.push(lgu.government_efficiency.compliance_to_national_directives.rank);
				row6.push(lgu.government_efficiency.compliance_to_national_directives.competitive);
				row6.push(lgu.government_efficiency.investment_promotion_unit.actual);
				row6.push(lgu.government_efficiency.investment_promotion_unit.rank);
				row6.push(lgu.government_efficiency.investment_promotion_unit.competitive);
				
				rows6.push(row6);
				
			});		
	
			doc.autoTable(government_efficiency, rows6,{
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
					fontSize: 9
				},
				bodyStyles: {
					halign: 'left',
					fillColor: [255, 255, 255],
					textColor: 50,
					fontSize: 9
				},
				alternateRowStyles: {
					fillColor: [255, 255, 255]
				}
			});
			
			doc.addPage(); // add //government_efficiency
			
			//X-axis, Y-axis
			doc.setFontSize(16)
			doc.setFont('helvetica');
			doc.setFontType('bold');
			doc.text(10, 10, 'Datasets');
			doc.text(35, 10, ''+prediction.year);
			
			doc.setFontSize(12)
			doc.setFont('helvetica');
			doc.setFontType('normal');
			doc.text(10, 20, 'Government Efficiency');
			
			var government_efficiency = ["No","Province","LGU","Category"];
			
			angular.forEach(prediction.headers.government_efficiency, function(government_efficiency_h,i) {

				if ((i<12) && (i=>6) && (i>5)) {
					government_efficiency.push(government_efficiency_h.header);
				};
				
			});
			
			var rows7 = [];
			angular.forEach(prediction.prediction.dataset, function(lgu,i) {
				
				var row7 = [];
				row7.push(lgu.lgu_no);
				row7.push(lgu.province);
				row7.push(lgu.lgu);
				row7.push(lgu.category);
				row7.push(lgu.government_efficiency.registration_efficiency.actual);
				row7.push(lgu.government_efficiency.registration_efficiency.rank);
				row7.push(lgu.government_efficiency.registration_efficiency.competitive);
				row7.push(lgu.government_efficiency.generate_local_resource.actual);
				row7.push(lgu.government_efficiency.generate_local_resource.rank);
				row7.push(lgu.government_efficiency.generate_local_resource.competitive);
				
				rows7.push(row7);
				
			});		
	
			doc.autoTable(government_efficiency, rows7,{
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
					fontSize: 8.8
				},
				bodyStyles: {
					halign: 'left',
					fillColor: [255, 255, 255],
					textColor: 50,
					fontSize: 8.8
				},
				alternateRowStyles: {
					fillColor: [255, 255, 255]
				}
			});
			
			doc.addPage(); // add //government_efficiency
			
			//X-axis, Y-axis
			doc.setFontSize(16)
			doc.setFont('helvetica');
			doc.setFontType('bold');
			doc.text(10, 10, 'Datasets');
			doc.text(35, 10, ''+prediction.year);
			
			doc.setFontSize(12)
			doc.setFont('helvetica');
			doc.setFontType('normal');
			doc.text(10, 20, 'Government Efficiency');
			
			var government_efficiency = ["No","Province","LGU","Category"];
			
			angular.forEach(prediction.headers.government_efficiency, function(government_efficiency_h,i) {

				if ((i<18) && (i=>6) && (i>11)) {
					government_efficiency.push(government_efficiency_h.header);
				};
				
			});
			
			var rows8 = [];
			angular.forEach(prediction.prediction.dataset, function(lgu,i) {
				
				var row8 = [];
				row8.push(lgu.lgu_no);
				row8.push(lgu.province);
				row8.push(lgu.lgu);
				row8.push(lgu.category);
				row8.push(lgu.government_efficiency.capacity_of_health_services.actual);
				row8.push(lgu.government_efficiency.capacity_of_health_services.rank);
				row8.push(lgu.government_efficiency.capacity_of_health_services.competitive);
				row8.push(lgu.government_efficiency.capacity_of_school_services.actual);
				row8.push(lgu.government_efficiency.capacity_of_school_services.rank);
				row8.push(lgu.government_efficiency.capacity_of_school_services.competitive);
				
				rows8.push(row8);
				
			});		
	
			doc.autoTable(government_efficiency, rows8,{
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
					fontSize: 9.5
				},
				bodyStyles: {
					halign: 'left',
					fillColor: [255, 255, 255],
					textColor: 50,
					fontSize: 9.5
				},
				alternateRowStyles: {
					fillColor: [255, 255, 255]
				}
			});
			
			doc.addPage(); // add //government_efficiency
			
			//X-axis, Y-axis
			doc.setFontSize(16)
			doc.setFont('helvetica');
			doc.setFontType('bold');
			doc.text(10, 10, 'Datasets');
			doc.text(35, 10, ''+prediction.year);
			
			doc.setFontSize(12)
			doc.setFont('helvetica');
			doc.setFontType('normal');
			doc.text(10, 20, 'Government Efficiency');
			
			var government_efficiency = ["No","Province","LGU","Category"];
			
			angular.forEach(prediction.headers.government_efficiency, function(government_efficiency_h,i) {

				if ((i<24) && (i=>6) && (i>17)) {
					government_efficiency.push(government_efficiency_h.header);
				};
				
			});
			
			var rows9 = [];
			angular.forEach(prediction.prediction.dataset, function(lgu,i) {
				
				var row9 = [];
				row9.push(lgu.lgu_no);
				row9.push(lgu.province);
				row9.push(lgu.lgu);
				row9.push(lgu.category);
				row9.push(lgu.government_efficiency.recognition_of_performance.actual);
				row9.push(lgu.government_efficiency.recognition_of_performance.rank);
				row9.push(lgu.government_efficiency.recognition_of_performance.competitive);
				row9.push(lgu.government_efficiency.business_permits_and_licensing.actual);
				row9.push(lgu.government_efficiency.business_permits_and_licensing.rank);
				row9.push(lgu.government_efficiency.business_permits_and_licensing.competitive);
				
				rows9.push(row9);
				
			});		
	
			doc.autoTable(government_efficiency, rows9,{
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
					fontSize: 7.6
				},
				bodyStyles: {
					halign: 'left',
					fillColor: [255, 255, 255],
					textColor: 50,
					fontSize: 7.6
				},
				alternateRowStyles: {
					fillColor: [255, 255, 255]
				}
			});
			
			doc.addPage(); // add //government_efficiency
			
			//X-axis, Y-axis
			doc.setFontSize(16)
			doc.setFont('helvetica');
			doc.setFontType('bold');
			doc.text(10, 10, 'Datasets');
			doc.text(35, 10, ''+prediction.year);
			
			doc.setFontSize(12)
			doc.setFont('helvetica');
			doc.setFontType('normal');
			doc.text(10, 20, 'Government Efficiency');
			
			var government_efficiency = ["No","Province","LGU","Category"];
			
			angular.forEach(prediction.headers.government_efficiency, function(government_efficiency_h,i) {

				if ((i<30) && (i=>6) && (i>23)) {
					government_efficiency.push(government_efficiency_h.header);
				};
				
			});
			
			var rows10 = [];
			angular.forEach(prediction.prediction.dataset, function(lgu,i) {
				
				var row10 = [];
				row10.push(lgu.lgu_no);
				row10.push(lgu.province);
				row10.push(lgu.lgu);
				row10.push(lgu.category);
				row10.push(lgu.government_efficiency.peace_and_order.actual);
				row10.push(lgu.government_efficiency.peace_and_order.rank);
				row10.push(lgu.government_efficiency.peace_and_order.competitive);
				row10.push(lgu.government_efficiency.social_protection.actual);
				row10.push(lgu.government_efficiency.social_protection.rank);
				row10.push(lgu.government_efficiency.social_protection.competitive);
				
				rows10.push(row10);
				
			});		
	
			doc.autoTable(government_efficiency, rows10,{
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
			
			doc.addPage(); // add //government_efficiency
			
			//X-axis, Y-axis
			doc.setFontSize(16)
			doc.setFont('helvetica');
			doc.setFontType('bold');
			doc.text(10, 10, 'Datasets');
			doc.text(35, 10, ''+prediction.year);
			
			doc.setFontSize(12)
			doc.setFont('helvetica');
			doc.setFontType('normal');
			doc.text(10, 20, 'Government Efficiency');
			
			var government_efficiency = ["No","Province","LGU","Category"];
			
			angular.forEach(prediction.headers.government_efficiency, function(government_efficiency_h,i) {

				if ((i<36) && (i=>6) && (i>29)) {
					government_efficiency.push(government_efficiency_h.header);
				};
				
			});
			
			var rows11 = [];
			angular.forEach(prediction.prediction.dataset, function(lgu,i) {
				
				var row11 = [];
				row11.push(lgu.lgu_no);
				row11.push(lgu.province);
				row11.push(lgu.lgu);
				row11.push(lgu.category);
				row11.push(lgu.government_efficiency.total.actual);
				row11.push(lgu.government_efficiency.total.rank);
				row11.push(lgu.government_efficiency.total.competitive);
				
				rows11.push(row11);
				
			});		
	
			doc.autoTable(government_efficiency, rows11,{
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
			
			doc.addPage(); // add //infrastructure
			
			//X-axis, Y-axis
			doc.setFontSize(16)
			doc.setFont('helvetica');
			doc.setFontType('bold');
			doc.text(10, 10, 'Datasets');
			doc.text(35, 10, ''+prediction.year);
			
			doc.setFontSize(12)
			doc.setFont('helvetica');
			doc.setFontType('normal');
			doc.text(10, 20, 'Infrastructure');
			
			var infrastructure = ["No","Province","LGU","Category"];
			
			angular.forEach(prediction.headers.infrastructure, function(infrastructure_h,i) {

				if (i<6) {
					infrastructure.push(infrastructure_h.header);
				};
				
			});
			
			var rows12 = [];
			angular.forEach(prediction.prediction.dataset, function(lgu,i) {
				
				var row12 = [];
				row12.push(lgu.lgu_no);
				row12.push(lgu.province);
				row12.push(lgu.lgu);
				row12.push(lgu.category);
				row12.push(lgu.infrastructure.road_network.actual);
				row12.push(lgu.infrastructure.road_network.rank);
				row12.push(lgu.infrastructure.road_network.competitive);
				row12.push(lgu.infrastructure.distance_to_ports.actual);
				row12.push(lgu.infrastructure.distance_to_ports.rank);
				row12.push(lgu.infrastructure.distance_to_ports.competitive);
				
				rows12.push(row12);
				
			});		
	
			doc.autoTable(infrastructure, rows12,{
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
			
			doc.addPage(); // add //infrastructure
			
			//X-axis, Y-axis
			doc.setFontSize(16)
			doc.setFont('helvetica');
			doc.setFontType('bold');
			doc.text(10, 10, 'Datasets');
			doc.text(35, 10, ''+prediction.year);
			
			doc.setFontSize(12)
			doc.setFont('helvetica');
			doc.setFontType('normal');
			doc.text(10, 20, 'Infrastructure');
			
			var infrastructure = ["No","Province","LGU","Category"];
			
			angular.forEach(prediction.headers.infrastructure, function(infrastructure_h,i) {

				if ((i<12) && (i=>6) && (i>5)) {
					infrastructure.push(infrastructure_h.header);
				};
				
			});
			
			var rows13 = [];
			angular.forEach(prediction.prediction.dataset, function(lgu,i) {
				
				var row13 = [];
				row13.push(lgu.lgu_no);
				row13.push(lgu.province);
				row13.push(lgu.lgu);
				row13.push(lgu.category);
				row13.push(lgu.infrastructure.availability_of_basic_utilities.actual);
				row13.push(lgu.infrastructure.availability_of_basic_utilities.rank);
				row13.push(lgu.infrastructure.availability_of_basic_utilities.competitive);
				row13.push(lgu.infrastructure.transportation_vehicles.actual);
				row13.push(lgu.infrastructure.transportation_vehicles.rank);
				row13.push(lgu.infrastructure.transportation_vehicles.competitive);
				
				rows13.push(row13);
				
			});		
	
			doc.autoTable(infrastructure, rows13,{
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
			
			doc.addPage(); // add //infrastructure
			
			//X-axis, Y-axis
			doc.setFontSize(16)
			doc.setFont('helvetica');
			doc.setFontType('bold');
			doc.text(10, 10, 'Datasets');
			doc.text(35, 10, ''+prediction.year);
			
			doc.setFontSize(12)
			doc.setFont('helvetica');
			doc.setFontType('normal');
			doc.text(10, 20, 'Infrastructure');
			
			var infrastructure = ["No","Province","LGU","Category"];
			
			angular.forEach(prediction.headers.infrastructure, function(infrastructure_h,i) {

				if ((i<18) && (i=>6) && (i>11)) {
					infrastructure.push(infrastructure_h.header);
				};
				
			});
			
			var rows14 = [];
			angular.forEach(prediction.prediction.dataset, function(lgu,i) {
				
				var row14 = [];
				row14.push(lgu.lgu_no);
				row14.push(lgu.province);
				row14.push(lgu.lgu);
				row14.push(lgu.category);
				row14.push(lgu.infrastructure.education.actual);
				row14.push(lgu.infrastructure.education.rank);
				row14.push(lgu.infrastructure.education.competitive);
				row14.push(lgu.infrastructure.health.actual);
				row14.push(lgu.infrastructure.health.rank);
				row14.push(lgu.infrastructure.health.competitive);
				
				rows14.push(row14);
				
			});		
	
			doc.autoTable(infrastructure, rows14,{
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
			
			doc.addPage(); // add //infrastructure
			
			//X-axis, Y-axis
			doc.setFontSize(16)
			doc.setFont('helvetica');
			doc.setFontType('bold');
			doc.text(10, 10, 'Datasets');
			doc.text(35, 10, ''+prediction.year);
			
			doc.setFontSize(12)
			doc.setFont('helvetica');
			doc.setFontType('normal');
			doc.text(10, 20, 'Infrastructure');
			
			var infrastructure = ["No","Province","LGU","Category"];
			
			angular.forEach(prediction.headers.infrastructure, function(infrastructure_h,i) {

				if ((i<24) && (i=>6) && (i>17)) {
					infrastructure.push(infrastructure_h.header);
				};
				
			});
			
			var rows15 = [];
			angular.forEach(prediction.prediction.dataset, function(lgu,i) {
				
				var row15 = [];
				row15.push(lgu.lgu_no);
				row15.push(lgu.province);
				row15.push(lgu.lgu);
				row15.push(lgu.category);
				row15.push(lgu.infrastructure.lgu_investment.actual);
				row15.push(lgu.infrastructure.lgu_investment.rank);
				row15.push(lgu.infrastructure.lgu_investment.competitive);
				row15.push(lgu.infrastructure.accommodation_capacity.actual);
				row15.push(lgu.infrastructure.accommodation_capacity.rank);
				row15.push(lgu.infrastructure.accommodation_capacity.competitive);
				
				rows15.push(row15);
				
			});		
	
			doc.autoTable(infrastructure, rows15,{
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
			
			doc.addPage(); // add //infrastructure
			
			//X-axis, Y-axis
			doc.setFontSize(16)
			doc.setFont('helvetica');
			doc.setFontType('bold');
			doc.text(10, 10, 'Datasets');
			doc.text(35, 10, ''+prediction.year);
			
			doc.setFontSize(12)
			doc.setFont('helvetica');
			doc.setFontType('normal');
			doc.text(10, 20, 'Infrastructure');
			
			var infrastructure = ["No","Province","LGU","Category"];
			
			angular.forEach(prediction.headers.infrastructure, function(infrastructure_h,i) {

				if ((i<30) && (i=>6) && (i>23)) {
					infrastructure.push(infrastructure_h.header);
				};
				
			});
			
			var rows16 = [];
			angular.forEach(prediction.prediction.dataset, function(lgu,i) {
				
				var row16 = [];
				row16.push(lgu.lgu_no);
				row16.push(lgu.province);
				row16.push(lgu.lgu);
				row16.push(lgu.category);
				row16.push(lgu.infrastructure.information_technology_capacity.actual);
				row16.push(lgu.infrastructure.information_technology_capacity.rank);
				row16.push(lgu.infrastructure.information_technology_capacity.competitive);
				row16.push(lgu.infrastructure.financial_technology_capacity.actual);
				row16.push(lgu.infrastructure.financial_technology_capacity.rank);
				row16.push(lgu.infrastructure.financial_technology_capacity.competitive);
				
				rows16.push(row16);
				
			});		
	
			doc.autoTable(infrastructure, rows16,{
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
					fontSize: 9
				},
				bodyStyles: {
					halign: 'left',
					fillColor: [255, 255, 255],
					textColor: 50,
					fontSize: 9
				},
				alternateRowStyles: {
					fillColor: [255, 255, 255]
				}
			});
			
			doc.addPage(); // add //infrastructure
			
			//X-axis, Y-axis
			doc.setFontSize(16)
			doc.setFont('helvetica');
			doc.setFontType('bold');
			doc.text(10, 10, 'Datasets');
			doc.text(35, 10, ''+prediction.year);
			
			doc.setFontSize(12)
			doc.setFont('helvetica');
			doc.setFontType('normal');
			doc.text(10, 20, 'Infrastructure');
			
			var infrastructure = ["No","Province","LGU","Category"];
			
			angular.forEach(prediction.headers.infrastructure, function(infrastructure_h,i) {

				if ((i<36) && (i=>6) && (i>29)) {
					infrastructure.push(infrastructure_h.header);
				};
				
			});
			
			var rows17 = [];
			angular.forEach(prediction.prediction.dataset, function(lgu,i) {
				
			var row17 = [];
				row17.push(lgu.lgu_no);
				row17.push(lgu.province);
				row17.push(lgu.lgu);
				row17.push(lgu.category);
				row17.push(lgu.infrastructure.total.actual);
				row17.push(lgu.infrastructure.total.rank);
				row17.push(lgu.infrastructure.total.competitive);
				
				rows17.push(row17);
				
			});		
	
			doc.autoTable(infrastructure, rows17,{
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
			
			
			doc.addPage(); // add //resiliency
			
			//X-axis, Y-axis
			doc.setFontSize(16)
			doc.setFont('helvetica');
			doc.setFontType('bold');
			doc.text(10, 10, 'Datasets');
			doc.text(35, 10, ''+prediction.year);
			
			doc.setFontSize(12)
			doc.setFont('helvetica');
			doc.setFontType('normal');
			doc.text(10, 20, 'Resiliency');
			
			var resiliency = ["No","Province","LGU","Category"];
			
			angular.forEach(prediction.headers.resiliency, function(resiliency_h,i) {

				if (i<6) {
					resiliency.push(resiliency_h.header);
				};
				
			});
			
			var rows18 = [];
			angular.forEach(prediction.prediction.dataset, function(lgu,i) {
				
			var row18 = [];
				row18.push(lgu.lgu_no);
				row18.push(lgu.province);
				row18.push(lgu.lgu);
				row18.push(lgu.category);
				row18.push(lgu.resiliency.land_use_plan.actual);
				row18.push(lgu.resiliency.land_use_plan.rank);
				row18.push(lgu.resiliency.land_use_plan.competitive);
				row18.push(lgu.resiliency.disaster_risk_reduction_plan.actual);
				row18.push(lgu.resiliency.disaster_risk_reduction_plan.rank);
				row18.push(lgu.resiliency.disaster_risk_reduction_plan.competitive);
				
				rows18.push(row18);
				
			});		
	
			doc.autoTable(resiliency, rows18,{
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
			
			doc.addPage(); // add //resiliency
			
			//X-axis, Y-axis
			doc.setFontSize(16)
			doc.setFont('helvetica');
			doc.setFontType('bold');
			doc.text(10, 10, 'Datasets');
			doc.text(35, 10, ''+prediction.year);
			
			doc.setFontSize(12)
			doc.setFont('helvetica');
			doc.setFontType('normal');
			doc.text(10, 20, 'Resiliency');
			
			var resiliency = ["No","Province","LGU","Category"];
			
			angular.forEach(prediction.headers.resiliency, function(resiliency_h,i) {

				if ((i<12) && (i=>6) && (i>5)) {
					resiliency.push(resiliency_h.header);
				};
				
			});
			
			var rows19 = [];
			angular.forEach(prediction.prediction.dataset, function(lgu,i) {
				
			var row19 = [];
				row19.push(lgu.lgu_no);
				row19.push(lgu.province);
				row19.push(lgu.lgu);
				row19.push(lgu.category);
				row19.push(lgu.resiliency.annual_disaster_drill.actual);
				row19.push(lgu.resiliency.annual_disaster_drill.rank);
				row19.push(lgu.resiliency.annual_disaster_drill.competitive);
				row19.push(lgu.resiliency.early_warning_system.actual);
				row19.push(lgu.resiliency.early_warning_system.rank);
				row19.push(lgu.resiliency.early_warning_system.competitive);
				
				rows19.push(row19);
				
			});		
	
			doc.autoTable(resiliency, rows19,{
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
			
			doc.addPage(); // add //resiliency
			
			//X-axis, Y-axis
			doc.setFontSize(16)
			doc.setFont('helvetica');
			doc.setFontType('bold');
			doc.text(10, 10, 'Datasets');
			doc.text(35, 10, ''+prediction.year);
			
			doc.setFontSize(12)
			doc.setFont('helvetica');
			doc.setFontType('normal');
			doc.text(10, 20, 'Resiliency');
			
			var resiliency = ["No","Province","LGU","Category"];
			
			angular.forEach(prediction.headers.resiliency, function(resiliency_h,i) {

				if ((i<18) && (i=>6) && (i>11)) {
					resiliency.push(resiliency_h.header);
				};
				
			});
			
			var rows20 = [];
			angular.forEach(prediction.prediction.dataset, function(lgu,i) {
				
			var row20 = [];
				row20.push(lgu.lgu_no);
				row20.push(lgu.province);
				row20.push(lgu.lgu);
				row20.push(lgu.category);
				row20.push(lgu.resiliency.budget_for_drrmp.actual);
				row20.push(lgu.resiliency.budget_for_drrmp.rank);
				row20.push(lgu.resiliency.budget_for_drrmp.competitive);
				row20.push(lgu.resiliency.local_risk_assessments.actual);
				row20.push(lgu.resiliency.local_risk_assessments.rank);
				row20.push(lgu.resiliency.local_risk_assessments.competitive);
				
				rows20.push(row20);
				
			});		
	
			doc.autoTable(resiliency, rows20,{
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
			
			doc.addPage(); // add //resiliency
			
			//X-axis, Y-axis
			doc.setFontSize(16)
			doc.setFont('helvetica');
			doc.setFontType('bold');
			doc.text(10, 10, 'Datasets');
			doc.text(35, 10, ''+prediction.year);
			
			doc.setFontSize(12)
			doc.setFont('helvetica');
			doc.setFontType('normal');
			doc.text(10, 20, 'Resiliency');
			
			var resiliency = ["No","Province","LGU","Category"];
			
			angular.forEach(prediction.headers.resiliency, function(resiliency_h,i) {

				if ((i<24) && (i=>6) && (i>17)) {
					resiliency.push(resiliency_h.header);
				};
				
			});
			
			var rows21 = [];
			angular.forEach(prediction.prediction.dataset, function(lgu,i) {
				
			var row21 = [];
				row21.push(lgu.lgu_no);
				row21.push(lgu.province);
				row21.push(lgu.lgu);
				row21.push(lgu.category);
				row21.push(lgu.resiliency.emergency_infrastructure.actual);
				row21.push(lgu.resiliency.emergency_infrastructure.rank);
				row21.push(lgu.resiliency.emergency_infrastructure.competitive);
				row21.push(lgu.resiliency.utilities.actual);
				row21.push(lgu.resiliency.utilities.rank);
				row21.push(lgu.resiliency.utilities.competitive);
				
				rows21.push(row21);
				
			});		
	
			doc.autoTable(resiliency, rows21,{
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
			
			doc.addPage(); // add //resiliency
			
			//X-axis, Y-axis
			doc.setFontSize(16)
			doc.setFont('helvetica');
			doc.setFontType('bold');
			doc.text(10, 10, 'Datasets');
			doc.text(35, 10, ''+prediction.year);
			
			doc.setFontSize(12)
			doc.setFont('helvetica');
			doc.setFontType('normal');
			doc.text(10, 20, 'Resiliency');
			
			var resiliency = ["No","Province","LGU","Category"];
			
			angular.forEach(prediction.headers.resiliency, function(resiliency_h,i) {

				if ((i<30) && (i=>6) && (i>23)) {
					resiliency.push(resiliency_h.header);
				};
				
			});
			
			var rows22 = [];
			angular.forEach(prediction.prediction.dataset, function(lgu,i) {
				
			var row22 = [];
				row22.push(lgu.lgu_no);
				row22.push(lgu.province);
				row22.push(lgu.lgu);
				row22.push(lgu.category);
				row22.push(lgu.resiliency.employed_population.actual);
				row22.push(lgu.resiliency.employed_population.rank);
				row22.push(lgu.resiliency.employed_population.competitive);
				row22.push(lgu.resiliency.sanitary_system.actual);
				row22.push(lgu.resiliency.sanitary_system.rank);
				row22.push(lgu.resiliency.sanitary_system.competitive);
				
				rows22.push(row22);
				
			});		
	
			doc.autoTable(resiliency, rows22,{
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
			
			doc.addPage(); // add //resiliency
			
			//X-axis, Y-axis
			doc.setFontSize(16)
			doc.setFont('helvetica');
			doc.setFontType('bold');
			doc.text(10, 10, 'Datasets');
			doc.text(35, 10, ''+prediction.year);
			
			doc.setFontSize(12)
			doc.setFont('helvetica');
			doc.setFontType('normal');
			doc.text(10, 20, 'Resiliency');
			
			var resiliency = ["No","Province","LGU","Category"];
			
			angular.forEach(prediction.headers.resiliency, function(resiliency_h,i) {

				if ((i<36) && (i=>6) && (i>29)) {
					resiliency.push(resiliency_h.header);
				};
				
			});
			
			var rows23 = [];
			angular.forEach(prediction.prediction.dataset, function(lgu,i) {
				
			var row23 = [];
				row23.push(lgu.lgu_no);
				row23.push(lgu.province);
				row23.push(lgu.lgu);
				row23.push(lgu.category);
				row23.push(lgu.resiliency.total.actual);
				row23.push(lgu.resiliency.total.rank);
				row23.push(lgu.resiliency.total.competitive);
				
				rows23.push(row23);
				
			});		
	
			doc.autoTable(resiliency, rows23,{
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
			
			var blob = doc.output('blob');
			window.open(URL.createObjectURL(blob));
		
		
		};
		
	};
	
	return new app();
	
});