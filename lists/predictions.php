<?php

require_once '../db.php';
require_once '../api/mapper.php';
require_once '../api/classes.php';

$period = $_POST['period'];
$top = intval($_POST['top']);
$prediction_category = intval($_POST['category']);
$prediction_indicators = json_decode($_POST['indicators'], true);

require_once '../handlers/predictions/prediction.php';

$tables['headers'] = array(
	array("striped"=>true),
	array("striped"=>true),
	array("striped"=>true),
	array("striped"=>false),
	array("striped"=>false),
	array("striped"=>false),
	array("striped"=>true),
	array("striped"=>true),
	array("striped"=>true),
	array("striped"=>false),
	array("striped"=>false),
	array("striped"=>false),
	array("striped"=>true),
	array("striped"=>true),
	array("striped"=>true),
	array("striped"=>false),
	array("striped"=>false),
	array("striped"=>false),
	array("striped"=>true),
	array("striped"=>true),
	array("striped"=>true),
	array("striped"=>false),
	array("striped"=>false),
	array("striped"=>false),
	array("striped"=>true),
	array("striped"=>true),
	array("striped"=>true),
	array("striped"=>false),
	array("striped"=>false),
	array("striped"=>false),
	array("striped"=>true),
	array("striped"=>true),
	array("striped"=>true),				
);

?>

<h4 id="btn-datasets" data-toggle="collapse" data-target="#btndatasets" style="cursor: pointer;" ng-click="isActiveDatasets = !isActiveDatasets"><i class="fa" ng-class="{'fa-times-circle': isActiveDatasets, 'fa-plus-circle': !isActiveDatasets}"></i> Datasets</h4>

<div class="collapse" id="btndatasets">
	<button class="btn btn-info pull-right" id="print-datasets" ng-click="app.print(this)"><i class="fa fa-print"></i></button>
	<!-- Nav tabs -->
	<ul class="nav nav-tabs customtab2" role="tablist">
		<li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home7" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Economy</span></a> </li>
		<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile7" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Government Efficiency</span></a> </li>
		<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages7" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Infrastructure</span></a> </li>
		<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages8" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Resiliency</span></a> </li>
		<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages9" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Overall</span></a> </li>
	</ul>
	<!-- Tab panes -->
	<div class="tab-content">
		<div class="tab-pane active" id="home7" role="tabpanel">
			<div class="table-responsive table-bordered card" style="margin-top: 25px;">
				<table class="table datasets" id="table-economy">
					<thead>
						<tr>
							<th>No</th>
							<th>Province</th>
							<th>LGU</th>
							<th>Category</th>
							<?php foreach ($prediction['headers']['economy'] as $i => $economy_h) { ?>
							<th class="<?=($tables['headers'][$i]['striped'])?"striped-column":""?>"><?=$economy_h['header']?></th>
							<?php }; ?>
						</tr>
					</thead>				
					<tbody>
						<?php foreach ($prediction['prediction']['dataset'] as $lgu) { ?>
						<tr>
							<td><?=$lgu['lgu_no']?></td>
							<td><?=$lgu['province']?></td>
							<td><?=$lgu['lgu']?></td>
							<td><?=$lgu['category']?></td>
							<td class="striped-column"><?=$lgu['economy']['local_economy_size']['actual']?></td>
							<td class="striped-column"><?=$lgu['economy']['local_economy_size']['rank']?></td>
							<td class="striped-column"><?=$lgu['economy']['local_economy_size']['competitive']?></td>
							<td><?=$lgu['economy']['local_economy_growth']['actual']?></td>
							<td><?=$lgu['economy']['local_economy_growth']['rank']?></td>
							<td><?=$lgu['economy']['local_economy_growth']['competitive']?></td>
							<td class="striped-column"><?=$lgu['economy']['local_economy_structure']['actual']?></td>
							<td class="striped-column"><?=$lgu['economy']['local_economy_structure']['rank']?></td>
							<td class="striped-column"><?=$lgu['economy']['local_economy_structure']['competitive']?></td>
							<td><?=$lgu['economy']['safety_compliant_business']['actual']?></td>
							<td><?=$lgu['economy']['safety_compliant_business']['rank']?></td>
							<td><?=$lgu['economy']['safety_compliant_business']['competitive']?></td>
							<td class="striped-column"><?=$lgu['economy']['increase_in_employment']['actual']?></td>
							<td class="striped-column"><?=$lgu['economy']['increase_in_employment']['rank']?></td>
							<td class="striped-column"><?=$lgu['economy']['increase_in_employment']['competitive']?></td>
							<td><?=$lgu['economy']['cost_of_living']['actual']?></td>
							<td><?=$lgu['economy']['cost_of_living']['rank']?></td>
							<td><?=$lgu['economy']['cost_of_living']['competitive']?></td>
							<td class="striped-column"><?=$lgu['economy']['cost_of_doing_business']['actual']?></td>
							<td class="striped-column"><?=$lgu['economy']['cost_of_doing_business']['rank']?></td>
							<td class="striped-column"><?=$lgu['economy']['cost_of_doing_business']['competitive']?></td>
							<td><?=$lgu['economy']['financial_deepening']['actual']?></td>
							<td><?=$lgu['economy']['financial_deepening']['rank']?></td>
							<td><?=$lgu['economy']['financial_deepening']['competitive']?></td>
							<td class="striped-column"><?=$lgu['economy']['productivity']['actual']?></td>
							<td class="striped-column"><?=$lgu['economy']['productivity']['rank']?></td>
							<td class="striped-column"><?=$lgu['economy']['productivity']['competitive']?></td>
							<td><?=$lgu['economy']['presence_of_business_and_professional']['actual']?></td>
							<td><?=$lgu['economy']['presence_of_business_and_professional']['rank']?></td>
							<td><?=$lgu['economy']['presence_of_business_and_professional']['competitive']?></td>
							<td class="striped-column"><?=$lgu['economy']['total']['actual']?></td>
							<td class="striped-column"><?=$lgu['economy']['total']['rank']?></td>
							<td class="striped-column"><?=$lgu['economy']['total']['competitive']?></td>
						</tr>
						<?php }; ?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="tab-pane" id="profile7" role="tabpanel">
			<div class="table-responsive table-bordered card" style="margin-top: 25px;">
				<table class="table datasets" id="table-government">
					<thead>
						<tr>
							<th>No</th>
							<th>Province</th>
							<th>LGU</th>
							<th>Category</th>
							<?php foreach ($prediction['headers']['government_efficiency'] as $i => $government_h) { ?>
							<th class="<?=($tables['headers'][$i]['striped'])?"striped-column":""?>"><?=$government_h['header']?></th>
							<?php }; ?>
						</tr>
					</thead>				
					<tbody>
						<?php foreach ($prediction['prediction']['dataset'] as $lgu) { ?>
						<tr>
							<td><?=$lgu['lgu_no']?></td>
							<td><?=$lgu['province']?></td>
							<td><?=$lgu['lgu']?></td>
							<td><?=$lgu['category']?></td>
							<td class="striped-column"><?=$lgu['government_efficiency']['compliance_to_national_directives']['actual']?></td>
							<td class="striped-column"><?=$lgu['government_efficiency']['compliance_to_national_directives']['rank']?></td>
							<td class="striped-column"><?=$lgu['government_efficiency']['compliance_to_national_directives']['competitive']?></td>
							
							<td><?=$lgu['government_efficiency']['investment_promotion_unit']['actual']?></td>
							<td><?=$lgu['government_efficiency']['investment_promotion_unit']['rank']?></td>
							<td><?=$lgu['government_efficiency']['investment_promotion_unit']['competitive']?></td>
							
							<td class="striped-column"><?=$lgu['government_efficiency']['registration_efficiency']['actual']?></td>
							<td class="striped-column"><?=$lgu['government_efficiency']['registration_efficiency']['rank']?></td>
							<td class="striped-column"><?=$lgu['government_efficiency']['registration_efficiency']['competitive']?></td>
							
							<td><?=$lgu['government_efficiency']['generate_local_resource']['actual']?></td>
							<td><?=$lgu['government_efficiency']['generate_local_resource']['rank']?></td>
							<td><?=$lgu['government_efficiency']['generate_local_resource']['competitive']?></td>
							
							<td class="striped-column"><?=$lgu['government_efficiency']['capacity_of_health_services']['actual']?></td>
							<td class="striped-column"><?=$lgu['government_efficiency']['capacity_of_health_services']['rank']?></td>
							<td class="striped-column"><?=$lgu['government_efficiency']['capacity_of_health_services']['competitive']?></td>
							
							<td><?=$lgu['government_efficiency']['capacity_of_school_services']['actual']?></td>
							<td><?=$lgu['government_efficiency']['capacity_of_school_services']['rank']?></td>
							<td><?=$lgu['government_efficiency']['capacity_of_school_services']['competitive']?></td>
							
							<td class="striped-column"><?=$lgu['government_efficiency']['recognition_of_performance']['actual']?></td>
							<td class="striped-column"><?=$lgu['government_efficiency']['recognition_of_performance']['rank']?></td>
							<td class="striped-column"><?=$lgu['government_efficiency']['recognition_of_performance']['competitive']?></td>
							
							<td><?=$lgu['government_efficiency']['business_permits_and_licensing']['actual']?></td>
							<td><?=$lgu['government_efficiency']['business_permits_and_licensing']['rank']?></td>
							<td><?=$lgu['government_efficiency']['business_permits_and_licensing']['competitive']?></td>
							
							<td class="striped-column"><?=$lgu['government_efficiency']['peace_and_order']['actual']?></td>
							<td class="striped-column"><?=$lgu['government_efficiency']['peace_and_order']['rank']?></td>
							<td class="striped-column"><?=$lgu['government_efficiency']['peace_and_order']['competitive']?></td>
							
							<td><?=$lgu['government_efficiency']['social_protection']['actual']?></td>
							<td><?=$lgu['government_efficiency']['social_protection']['rank']?></td>
							<td><?=$lgu['government_efficiency']['social_protection']['competitive']?></td>
							
							<td class="striped-column"><?=$lgu['government_efficiency']['total']['actual']?></td>
							<td class="striped-column"><?=$lgu['government_efficiency']['total']['rank']?></td>
							<td class="striped-column"><?=$lgu['government_efficiency']['total']['competitive']?></td>				
						</tr>
						<?php }; ?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="tab-pane" id="messages7" role="tabpanel">
			<div class="table-responsive table-bordered card" style="margin-top: 25px;">
				<table class="table datasets" id="table-infrastructure">
					<thead>
						<tr>
							<th>No</th>
							<th>Province</th>
							<th>LGU</th>
							<th>Category</th>
							<?php foreach ($prediction['headers']['infrastructure'] as $i => $infrastructure_h) { ?>
							<th class="<?=($tables['headers'][$i]['striped'])?"striped-column":""?>"><strong><?=$infrastructure_h['header']?></strong></th>
							<?php }; ?>
						</tr>
					</thead>				
					<tbody>
						<?php foreach ($prediction['prediction']['dataset'] as $lgu) { ?>
						<tr>
							<td><?=$lgu['lgu_no']?></td>
							<td><?=$lgu['province']?></td>
							<td><?=$lgu['lgu']?></td>
							<td><?=$lgu['category']?></td>
							
							<td class="striped-column"><?=$lgu['infrastructure']['road_network']['actual']?></td>
							<td class="striped-column"><?=$lgu['infrastructure']['road_network']['rank']?></td>
							<td class="striped-column"><?=$lgu['infrastructure']['road_network']['competitive']?></td>
							
							<td><?=$lgu['infrastructure']['distance_to_ports']['actual']?></td>
							<td><?=$lgu['infrastructure']['distance_to_ports']['rank']?></td>
							<td><?=$lgu['infrastructure']['distance_to_ports']['competitive']?></td>
							
							<td class="striped-column"><?=$lgu['infrastructure']['availability_of_basic_utilities']['actual']?></td>
							<td class="striped-column"><?=$lgu['infrastructure']['availability_of_basic_utilities']['rank']?></td>
							<td class="striped-column"><?=$lgu['infrastructure']['availability_of_basic_utilities']['competitive']?></td>
							
							<td><?=$lgu['infrastructure']['transportation_vehicles']['actual']?></td>
							<td><?=$lgu['infrastructure']['transportation_vehicles']['rank']?></td>
							<td><?=$lgu['infrastructure']['transportation_vehicles']['competitive']?></td>
							
							<td class="striped-column"><?=$lgu['infrastructure']['education']['actual']?></td>
							<td class="striped-column"><?=$lgu['infrastructure']['education']['rank']?></td>
							<td class="striped-column"><?=$lgu['infrastructure']['education']['competitive']?></td>
							
							<td><?=$lgu['infrastructure']['health']['actual']?></td>
							<td><?=$lgu['infrastructure']['health']['rank']?></td>
							<td><?=$lgu['infrastructure']['health']['competitive']?></td>
						
							<td class="striped-column"><?=$lgu['infrastructure']['lgu_investment']['actual']?></td>
							<td class="striped-column"><?=$lgu['infrastructure']['lgu_investment']['rank']?></td>
							<td class="striped-column"><?=$lgu['infrastructure']['lgu_investment']['competitive']?></td>
							
							<td><?=$lgu['infrastructure']['accommodation_capacity']['actual']?></td>
							<td><?=$lgu['infrastructure']['accommodation_capacity']['rank']?></td>
							<td><?=$lgu['infrastructure']['accommodation_capacity']['competitive']?></td>
							
							<td class="striped-column"><?=$lgu['infrastructure']['information_technology_capacity']['actual']?></td>
							<td class="striped-column"><?=$lgu['infrastructure']['information_technology_capacity']['rank']?></td>
							<td class="striped-column"><?=$lgu['infrastructure']['information_technology_capacity']['competitive']?></td>
							
							<td><?=$lgu['infrastructure']['financial_technology_capacity']['actual']?></td>
							<td><?=$lgu['infrastructure']['financial_technology_capacity']['rank']?></td>
							<td><?=$lgu['infrastructure']['financial_technology_capacity']['competitive']?></td>
							
							<td class="striped-column"><?=$lgu['infrastructure']['total']['actual']?></td>
							<td class="striped-column"><?=$lgu['infrastructure']['total']['rank']?></td>
							<td class="striped-column"><?=$lgu['infrastructure']['total']['competitive']?></td>					
						</tr>
						<?php }; ?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="tab-pane" id="messages8" role="tabpanel">
			<div class="table-responsive table-bordered card" style="margin-top: 25px;">
				<table class="table datasets" id="table-resiliency">
					<thead>
						<tr>
							<th>No</th>
							<th>Province</th>
							<th>LGU</th>
							<th>Category</th>						
							<?php foreach ($prediction['headers']['resiliency'] as $i => $resiliency_h) { ?>
							<th class="<?=($tables['headers'][$i]['striped'])?"striped-column":""?>"><strong><?=$resiliency_h['header']?></strong></th>
							<?php }; ?>						
						</tr>
					</thead>				
					<tbody>
						<?php foreach ($prediction['prediction']['dataset'] as $lgu) { ?>
						<tr>
							<td><?=$lgu['lgu_no']?></td>
							<td><?=$lgu['province']?></td>
							<td><?=$lgu['lgu']?></td>
							<td><?=$lgu['category']?></td>
							
							<td class="striped-column"><?=$lgu['resiliency']['land_use_plan']['actual']?></td>
							<td class="striped-column"><?=$lgu['resiliency']['land_use_plan']['rank']?></td>
							<td class="striped-column"><?=$lgu['resiliency']['land_use_plan']['competitive']?></td>
							
							<td><?=$lgu['resiliency']['disaster_risk_reduction_plan']['actual']?></td>
							<td><?=$lgu['resiliency']['disaster_risk_reduction_plan']['rank']?></td>
							<td><?=$lgu['resiliency']['disaster_risk_reduction_plan']['competitive']?></td>
							
							<td class="striped-column"><?=$lgu['resiliency']['annual_disaster_drill']['actual']?></td>
							<td class="striped-column"><?=$lgu['resiliency']['annual_disaster_drill']['rank']?></td>
							<td class="striped-column"><?=$lgu['resiliency']['annual_disaster_drill']['competitive']?></td>
							
							<td><?=$lgu['resiliency']['early_warning_system']['actual']?></td>
							<td><?=$lgu['resiliency']['early_warning_system']['rank']?></td>
							<td><?=$lgu['resiliency']['early_warning_system']['competitive']?></td>
							
							<td class="striped-column"><?=$lgu['resiliency']['budget_for_drrmp']['actual']?></td>
							<td class="striped-column"><?=$lgu['resiliency']['budget_for_drrmp']['rank']?></td>
							<td class="striped-column"><?=$lgu['resiliency']['budget_for_drrmp']['competitive']?></td>
							
							<td><?=$lgu['resiliency']['local_risk_assessments']['actual']?></td>
							<td><?=$lgu['resiliency']['local_risk_assessments']['rank']?></td>
							<td><?=$lgu['resiliency']['local_risk_assessments']['competitive']?></td>
							
							<td class="striped-column"><?=$lgu['resiliency']['emergency_infrastructure']['actual']?></td>
							<td class="striped-column"><?=$lgu['resiliency']['emergency_infrastructure']['rank']?></td>
							<td class="striped-column"><?=$lgu['resiliency']['emergency_infrastructure']['competitive']?></td>
							
							<td><?=$lgu['resiliency']['utilities']['actual']?></td>
							<td><?=$lgu['resiliency']['utilities']['rank']?></td>
							<td><?=$lgu['resiliency']['utilities']['competitive']?></td>
							
							<td class="striped-column"><?=$lgu['resiliency']['employed_population']['actual']?></td>
							<td class="striped-column"><?=$lgu['resiliency']['employed_population']['rank']?></td>
							<td class="striped-column"><?=$lgu['resiliency']['employed_population']['competitive']?></td>
							
							<td><?=$lgu['resiliency']['sanitary_system']['actual']?></td>
							<td><?=$lgu['resiliency']['sanitary_system']['rank']?></td>
							<td><?=$lgu['resiliency']['sanitary_system']['competitive']?></td>
							
							<td class="striped-column"><?=$lgu['resiliency']['total']['actual']?></td>
							<td class="striped-column"><?=$lgu['resiliency']['total']['rank']?></td>
							<td class="striped-column"><?=$lgu['resiliency']['total']['competitive']?></td>						
						</tr>
						<?php }; ?>
					</tbody>
				</table>
			</div>
		</div>
		
		<div class="tab-pane" id="messages9" role="tabpanel">
			<div class="table-responsive" style="margin-top: 25px;">
				<table class="table" id="table-total">
					<thead>
						<tr>
							<th>No</th>
							<th>Province</th>
							<th>LGU</th>
							<th>Category</th>
							<th>Actual Value</th>
							<th>Rank</th>
							<th>Competitive</th>
						</tr>
					</thead>				
					<tbody>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>	
		</div>
	</div>
</div>
<hr>

<h4 id="btn-frequency" data-toggle="collapse" data-target="#btnfrequency" style="cursor: pointer;" ng-click="isActive = !isActive"><i class="fa" ng-class="{'fa-times-circle': isActive, 'fa-plus-circle': !isActive}"></i> Frequency Tables</h4>

<div class="collapse" id="btnfrequency">
	<button id="print-frequency" class="btn btn-info pull-right" ng-click="app.print_frequency(this)"><i class="fa fa-print"></i></button>
	<div class="clearfix"></div>
<?php 

	foreach($prediction['prediction']['frequency_tables'] as $i => $frequency) {
		
?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<h4><?=$frequency['header']?></h4>
			<div class="table-bordered">
				<table class="table">
					<thead>
						<tr>
							<th rowspan="2" colspan="2">Frequency Table</th><th colspan="2">Competitive</th>
						</tr>
						<tr>
							<th>Yes</th><th>No</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td rowspan="3">LGU Category</td><td>City</td><td><?=$frequency['indicators'][0]['data']['city']['yes']?></td><td><?=$frequency['indicators'][0]['data']['city']['no']?></td>
						</tr>
						<tr>
							<td>1st-2nd Class</td><td><?=$frequency['indicators'][0]['data']['first_second']['yes']?></td><td><?=$frequency['indicators'][0]['data']['first_second']['no']?></td>
						</tr>
						<tr>
							<td>3rd-4th Class</td><td><?=$frequency['indicators'][0]['data']['third_fourth']['yes']?></td><td><?=$frequency['indicators'][0]['data']['third_fourth']['no']?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>	
	</div>
</div>

<div class="row">
	<?php
	
		foreach ($frequency['indicators'] as $key => $indicator) {
				
			if ($key==0) continue;
				
	?>
	<div class="col-lg-6">
		<div class="card">
			<h4><?=$frequency['header']?></h4>
			<div class="table-bordered">
				<table class="table">
					<thead>
						<tr>
							<th rowspan="2" colspan="2">Frequency Table</th><th colspan="2">Competitive</th>
						</tr>
						<tr>
							<th>Yes</th><th>No</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td rowspan="2"><?=$indicator['header']?></td><td>Yes</td><td><?=$indicator['data']['yes']['yes']?></td><td><?=$indicator['data']['yes']['no']?></td>
						</tr>
						<tr>
							<td>No</td><td><?=$indicator['data']['no']['yes']?></td><td><?=$indicator['data']['no']['no']?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>	
	</div>
	<?php }; ?>
</div>
<?php };?>
</div>

<hr>

<h4 id="btn-likelihood" data-toggle="collapse" data-target="#btnlikelihood" style="cursor: pointer;" ng-click="isActivelikelihood = !isActivelikelihood"><i class="fa" ng-class="{'fa-times-circle': isActivelikelihood, 'fa-plus-circle': !isActivelikelihood}"></i> Likelihood Tables</h4>

<div class="collapse" id="btnlikelihood">
<button  class="btn btn-info pull-right" ng-click="app.print_likelihood(this)" id="print-likelihood"><i class="fa fa-print"></i></button>
<div class="clearfix"></div>
<?php 

	foreach($prediction['prediction']['likelihood_tables'] as $i => $likelihood) {
		
?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<h4><?=$likelihood['header']?></h4>
			<div class="table-bordered">
				<table class="table">
					<thead>
						<tr>
							<th rowspan="2" colspan="2">Likelihood Table</th><th colspan="2">Competitive</th>
						</tr>
						<tr>
							<th>Yes</th><th>No</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td rowspan="4">LGU Category</td><td>City</td><td><?=$likelihood['indicators'][0]['data']['city']['yes']?></td><td><?=$likelihood['indicators'][0]['data']['city']['no']?></td><td><?=$likelihood['indicators'][0]['data']['city']['total']?></td>
						</tr>
						<tr>
							<td>1st-2nd Class</td><td><?=$likelihood['indicators'][0]['data']['first_second']['yes']?></td><td><?=$likelihood['indicators'][0]['data']['first_second']['no']?></td><td><?=$likelihood['indicators'][0]['data']['first_second']['total']?></td>
						</tr>
						<tr>
							<td>3rd-4th Class</td><td><?=$likelihood['indicators'][0]['data']['third_fourth']['yes']?></td><td><?=$likelihood['indicators'][0]['data']['third_fourth']['no']?></td><td><?=$likelihood['indicators'][0]['data']['third_fourth']['total']?></td>
						</tr>
						<tr>
							<td>&nbsp;</td><td><?=$likelihood['indicators'][0]['data']['total']['yes']?></td></td><td><?=$likelihood['indicators'][0]['data']['total']['no']?></td><td>&nbsp;</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>	
	</div>
</div>

<div class="row">
	<?php
	
		foreach ($likelihood['indicators'] as $key => $indicator) {
				
			if ($key==0) continue;
				
	?>
	<div class="col-lg-6">
		<div class="card">
			<h4><?=$likelihood['header']?></h4>
			<div class="table-bordered">
				<table class="table">
					<thead>
						<tr>
							<th rowspan="2" colspan="2">Likelihood Table</th><th colspan="2">Competitive</th>
						</tr>
						<tr>
							<th>Yes</th><th>No</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td rowspan="3"><?=$indicator['header']?></td><td>Yes</td><td><?=$indicator['data']['yes']['yes']?></td><td><?=$indicator['data']['yes']['no']?></td><td><?=$indicator['data']['yes']['total']?></td>
						</tr>
						<tr>
							<td>No</td><td><?=$indicator['data']['no']['yes']?></td><td><?=$indicator['data']['no']['no']?></td><td><?=$indicator['data']['no']['total']?></td>
						</tr>
						<tr>
							<td>&nbsp;</td><td><?=$indicator['data']['total']['yes']?></td><td><?=$indicator['data']['total']['no']?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>	
	</div>
	<?php };?>
</div>
<?php };?>
</div>
<hr>

<h4 id="btn-probability" data-toggle="collapse" data-target="#btnprobability" style="cursor: pointer;" ng-click="isActiveProbability = !isActiveProbability"><i class="fa" ng-class="{'fa-times-circle': isActiveProbability, 'fa-plus-circle': !isActiveProbability}"></i> Calculate one variable in category</h4>
<div id="btnprobability" class="collapse">
	<button  class="btn btn-info pull-right" ng-click="app.print_probability(this)" id="print-probability"><i class="fa fa-print"></i></button>
	<div class="clearfix"></div>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<h4 class="card-title">Economy Dynamism</h4><hr>
					<div class="table-responsive table-bordered">
					<table class="table">
						<thead>
							<tr>
								<th colspan="4"><center><?=$prediction['prediction']['probabilities']['economy'][0]['description']?></center></th>
								<th colspan="4"><center><?=$prediction['prediction']['probabilities']['economy'][1]['description']?></center></th>
								<th colspan="4"><center><?=$prediction['prediction']['probabilities']['economy'][2]['description']?></center></th>
							</tr>
						</thead>
						<tbody>
							<tr>
							<?php
		
								foreach ($prediction['prediction']['probabilities']['economy'] as $i => $equation) {
										
							?>
								<td><?=$equation['equations'][0][0][0]?></td>
								<td><?=$equation['equations'][0][0][1]?></td>
								<td><?=$equation['equations'][0][0][2]?></td>
								<td><?=$equation['equations'][0][0][3]?></td>
							<?php }; ?>	
							</tr>
							
							<tr>
							<?php
		
								foreach ($prediction['prediction']['probabilities']['economy'] as $i => $equation) {
										
							?>
								<td><?=$equation['equations'][0][1][0]?></td>
								<td><?=$equation['equations'][0][1][1]?></td>
								<td><?=$equation['equations'][0][1][2]?></td>
								<td><?=$equation['equations'][0][1][3]?></td>
								
							<?php }; ?>	
							</tr>
							
							<tr>
							<?php
		
								foreach ($prediction['prediction']['probabilities']['economy'] as $i => $equation) {
										
							?>
								<td><?=$equation['equations'][0][2][0]?></td>
								<td><?=$equation['equations'][0][2][1]?></td>
								<td><?=$equation['equations'][0][2][2]?></td>
								<td><?=$equation['equations'][0][2][3]?></td>
								
							<?php }; ?>	
							</tr>
							
							<tr>
							<?php
		
								foreach ($prediction['prediction']['probabilities']['economy'] as $i => $equation) {
										
							?>
								<td><?=$equation['equations'][1][0][0]?></td>
								<td><?=$equation['equations'][1][0][1]?></td>
								<td><?=$equation['equations'][1][0][2]?></td>
								<td><?=$equation['equations'][1][0][3]?></td>
							<?php }; ?>	
							</tr>
							
							<tr>
							<?php
		
								foreach ($prediction['prediction']['probabilities']['economy'] as $i => $equation) {
										
							?>
								<td><?=$equation['equations'][1][1][0]?></td>
								<td><?=$equation['equations'][1][1][1]?></td>
								<td><?=$equation['equations'][1][1][2]?></td>
								<td><?=$equation['equations'][1][1][3]?></td>
								
							<?php }; ?>	
							</tr>
							
							<tr>
							<?php
		
								foreach ($prediction['prediction']['probabilities']['economy'] as $i => $equation) {
										
							?>
								<td><?=$equation['equations'][1][2][0]?></td>
								<td><?=$equation['equations'][1][2][1]?></td>
								<td><?=$equation['equations'][1][2][2]?></td>
								<td><?=$equation['equations'][1][2][3]?></td>
								
							<?php }; ?>	
							</tr>
						</tbody>
					</table>
				</div>
			</div>	
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<h4 class="card-title">Government Efficiency</h4><hr>
					<div class="table-responsive table-bordered">
					<table class="table">
						<thead>
							<tr>
								<th colspan="4"><center><?=$prediction['prediction']['probabilities']['government_efficiency'][0]['description']?></center></th>
								<th colspan="4"><center><?=$prediction['prediction']['probabilities']['government_efficiency'][1]['description']?></center></th>
								<th colspan="4"><center><?=$prediction['prediction']['probabilities']['government_efficiency'][2]['description']?></center></th>
							</tr>
						</thead>
						<tbody>
							<tr>
							<?php
		
								foreach ($prediction['prediction']['probabilities']['government_efficiency'] as $i => $equation) {
										
							?>
								<td><?=$equation['equations'][0][0][0]?></td>
								<td><?=$equation['equations'][0][0][1]?></td>
								<td><?=$equation['equations'][0][0][2]?></td>
								<td><?=$equation['equations'][0][0][3]?></td>
							<?php }; ?>	
							</tr>
							
							<tr>
							<?php
		
								foreach ($prediction['prediction']['probabilities']['government_efficiency'] as $i => $equation) {
										
							?>
								<td><?=$equation['equations'][0][1][0]?></td>
								<td><?=$equation['equations'][0][1][1]?></td>
								<td><?=$equation['equations'][0][1][2]?></td>
								<td><?=$equation['equations'][0][1][3]?></td>
								
							<?php }; ?>	
							</tr>
							
							<tr>
							<?php
		
								foreach ($prediction['prediction']['probabilities']['government_efficiency'] as $i => $equation) {
										
							?>
								<td><?=$equation['equations'][0][2][0]?></td>
								<td><?=$equation['equations'][0][2][1]?></td>
								<td><?=$equation['equations'][0][2][2]?></td>
								<td><?=$equation['equations'][0][2][3]?></td>
								
							<?php }; ?>	
							</tr>
							
							<tr>
							<?php
		
								foreach ($prediction['prediction']['probabilities']['government_efficiency'] as $i => $equation) {
										
							?>
								<td><?=$equation['equations'][1][0][0]?></td>
								<td><?=$equation['equations'][1][0][1]?></td>
								<td><?=$equation['equations'][1][0][2]?></td>
								<td><?=$equation['equations'][1][0][3]?></td>
							<?php }; ?>	
							</tr>
							
							<tr>
							<?php
		
								foreach ($prediction['prediction']['probabilities']['government_efficiency'] as $i => $equation) {
										
							?>
								<td><?=$equation['equations'][1][1][0]?></td>
								<td><?=$equation['equations'][1][1][1]?></td>
								<td><?=$equation['equations'][1][1][2]?></td>
								<td><?=$equation['equations'][1][1][3]?></td>
								
							<?php }; ?>	
							</tr>
							
							<tr>
							<?php
		
								foreach ($prediction['prediction']['probabilities']['government_efficiency'] as $i => $equation) {
										
							?>
								<td><?=$equation['equations'][1][2][0]?></td>
								<td><?=$equation['equations'][1][2][1]?></td>
								<td><?=$equation['equations'][1][2][2]?></td>
								<td><?=$equation['equations'][1][2][3]?></td>
								
							<?php }; ?>	
							</tr>
							
						</tbody>
					</table>
				</div>
			</div>	
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<h4 class="card-title">Infrastructure</h4><hr>
					<div class="table-responsive table-bordered">
					<table class="table">
						<thead>
							<tr>
								<th colspan="4"><center><?=$prediction['prediction']['probabilities']['infrastructure'][0]['description']?></center></th>
								<th colspan="4"><center><?=$prediction['prediction']['probabilities']['infrastructure'][1]['description']?></center></th>
								<th colspan="4"><center><?=$prediction['prediction']['probabilities']['infrastructure'][2]['description']?></center></th>
							</tr>
						</thead>
						<tbody>
							<tr>
							<?php
		
								foreach ($prediction['prediction']['probabilities']['infrastructure'] as $i => $equation) {
										
							?>
								<td><?=$equation['equations'][0][0][0]?></td>
								<td><?=$equation['equations'][0][0][1]?></td>
								<td><?=$equation['equations'][0][0][2]?></td>
								<td><?=$equation['equations'][0][0][3]?></td>
							<?php }; ?>	
							</tr>
							
							<tr>
							<?php
		
								foreach ($prediction['prediction']['probabilities']['infrastructure'] as $i => $equation) {
										
							?>
								<td><?=$equation['equations'][0][1][0]?></td>
								<td><?=$equation['equations'][0][1][1]?></td>
								<td><?=$equation['equations'][0][1][2]?></td>
								<td><?=$equation['equations'][0][1][3]?></td>
								
							<?php }; ?>	
							</tr>
							
							<tr>
							<?php
		
								foreach ($prediction['prediction']['probabilities']['infrastructure'] as $i => $equation) {
										
							?>
								<td><?=$equation['equations'][0][2][0]?></td>
								<td><?=$equation['equations'][0][2][1]?></td>
								<td><?=$equation['equations'][0][2][2]?></td>
								<td><?=$equation['equations'][0][2][3]?></td>
								
							<?php }; ?>	
							</tr>
							
							<tr>
							<?php
		
								foreach ($prediction['prediction']['probabilities']['infrastructure'] as $i => $equation) {
										
							?>
								<td><?=$equation['equations'][1][0][0]?></td>
								<td><?=$equation['equations'][1][0][1]?></td>
								<td><?=$equation['equations'][1][0][2]?></td>
								<td><?=$equation['equations'][1][0][3]?></td>
							<?php }; ?>	
							</tr>
							
							<tr>
							<?php
		
								foreach ($prediction['prediction']['probabilities']['infrastructure'] as $i => $equation) {
										
							?>
								<td><?=$equation['equations'][1][1][0]?></td>
								<td><?=$equation['equations'][1][1][1]?></td>
								<td><?=$equation['equations'][1][1][2]?></td>
								<td><?=$equation['equations'][1][1][3]?></td>
								
							<?php }; ?>	
							</tr>
							
							<tr>
							<?php
		
								foreach ($prediction['prediction']['probabilities']['infrastructure'] as $i => $equation) {
										
							?>
								<td><?=$equation['equations'][1][2][0]?></td>
								<td><?=$equation['equations'][1][2][1]?></td>
								<td><?=$equation['equations'][1][2][2]?></td>
								<td><?=$equation['equations'][1][2][3]?></td>
								
							<?php }; ?>	
							</tr>
							
						</tbody>
					</table>
				</div>
			</div>	
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<h4 class="card-title">Resiliency</h4><hr>
					<div class="table-responsive table-bordered">
					<table class="table">
						<thead>
							<tr>
								<th colspan="4"><center><?=$prediction['prediction']['probabilities']['resiliency'][0]['description']?></center></th>
								<th colspan="4"><center><?=$prediction['prediction']['probabilities']['resiliency'][1]['description']?></center></th>
								<th colspan="4"><center><?=$prediction['prediction']['probabilities']['resiliency'][2]['description']?></center></th>
							</tr>
						</thead>
						<tbody>
							<tr>
							<?php
		
								foreach ($prediction['prediction']['probabilities']['resiliency'] as $i => $equation) {
										
							?>
								<td><?=$equation['equations'][0][0][0]?></td>
								<td><?=$equation['equations'][0][0][1]?></td>
								<td><?=$equation['equations'][0][0][2]?></td>
								<td><?=$equation['equations'][0][0][3]?></td>
							<?php }; ?>	
							</tr>
							
							<tr>
							<?php
		
								foreach ($prediction['prediction']['probabilities']['resiliency'] as $i => $equation) {
										
							?>
								<td><?=$equation['equations'][0][1][0]?></td>
								<td><?=$equation['equations'][0][1][1]?></td>
								<td><?=$equation['equations'][0][1][2]?></td>
								<td><?=$equation['equations'][0][1][3]?></td>
								
							<?php }; ?>	
							</tr>
							
							<tr>
							<?php
		
								foreach ($prediction['prediction']['probabilities']['resiliency'] as $i => $equation) {
										
							?>
								<td><?=$equation['equations'][0][2][0]?></td>
								<td><?=$equation['equations'][0][2][1]?></td>
								<td><?=$equation['equations'][0][2][2]?></td>
								<td><?=$equation['equations'][0][2][3]?></td>
								
							<?php }; ?>	
							</tr>
							
							<tr>
							<?php
		
								foreach ($prediction['prediction']['probabilities']['resiliency'] as $i => $equation) {
										
							?>
								<td><?=$equation['equations'][1][0][0]?></td>
								<td><?=$equation['equations'][1][0][1]?></td>
								<td><?=$equation['equations'][1][0][2]?></td>
								<td><?=$equation['equations'][1][0][3]?></td>
							<?php }; ?>	
							</tr>
							
							<tr>
							<?php
		
								foreach ($prediction['prediction']['probabilities']['resiliency'] as $i => $equation) {
										
							?>
								<td><?=$equation['equations'][1][1][0]?></td>
								<td><?=$equation['equations'][1][1][1]?></td>
								<td><?=$equation['equations'][1][1][2]?></td>
								<td><?=$equation['equations'][1][1][3]?></td>
								
							<?php }; ?>	
							</tr>
							
							<tr>
							<?php
		
								foreach ($prediction['prediction']['probabilities']['resiliency'] as $i => $equation) {
										
							?>
								<td><?=$equation['equations'][1][2][0]?></td>
								<td><?=$equation['equations'][1][2][1]?></td>
								<td><?=$equation['equations'][1][2][2]?></td>
								<td><?=$equation['equations'][1][2][3]?></td>
								
							<?php }; ?>	
							</tr>
							
						</tbody>
					</table>
				</div>
			</div>	
		</div>
	</div>
</div>
<hr>
<h4 id="btn-conditional" data-toggle="collapse" data-target="#btnconditional" style="cursor: pointer;" ng-click="isActiveConditional = !isActiveConditional"><i class="fa" ng-class="{'fa-times-circle': isActiveConditional, 'fa-plus-circle': !isActiveConditional}"></i> Calculate Conditional Probabilities</h4>
<div id="btnconditional" class="collapse">
	<button  class="btn btn-info pull-right" ng-click="app.print_conditional(this)" id="print-conditional"><i class="fa fa-print"></i></button>
	<div class="clearfix"></div>
	<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<h4 class="card-title">Economy Dynamism</h4><hr>
						<div class="table-responsive table-bordered">
						<table class="table">
							<thead>
								<tr>
									<th colspan="4"><center><?=$prediction['prediction']['conditional_probabilities']['economy'][0]['description']?></center></th>
									<th colspan="4"><center><?=$prediction['prediction']['conditional_probabilities']['economy'][1]['description']?></center></th>
									<th colspan="4"><center><?=$prediction['prediction']['conditional_probabilities']['economy'][2]['description']?></center></th>
								</tr>
							</thead>
							<tbody>
								<tr>
								<?php
			
									foreach ($prediction['prediction']['conditional_probabilities']['economy'] as $i => $equation) {
											
								?>
									<td><?=$equation['equations'][0][0]?></td>
									<td><?=$equation['equations'][0][1]?></td>
									<td><?=$equation['equations'][0][2]?></td>
									<td><?=$equation['equations'][0][3]?></td>
								<?php }; ?>	
								</tr>
								
								<tr>
								<?php
			
									foreach ($prediction['prediction']['conditional_probabilities']['economy'] as $i => $equation) {
											
								?>
									<td><?=$equation['equations'][1][0]?></td>
									<td><?=$equation['equations'][1][1]?></td>
									<td><?=$equation['equations'][1][2]?></td>
									<td><?=$equation['equations'][1][3]?></td>
								<?php }; ?>	
								</tr>
								
							</tbody>
						</table>
					</div>
				</div>	
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<h4 class="card-title">Government Efficiency</h4><hr>
						<div class="table-responsive table-bordered">
						<table class="table">
							<thead>
								<tr>
									<th colspan="4"><center><?=$prediction['prediction']['conditional_probabilities']['government_efficiency'][0]['description']?></center></th>
									<th colspan="4"><center><?=$prediction['prediction']['conditional_probabilities']['government_efficiency'][1]['description']?></center></th>
									<th colspan="4"><center><?=$prediction['prediction']['conditional_probabilities']['government_efficiency'][2]['description']?></center></th>
								</tr>
							</thead>
							<tbody>
								<tr>
								<?php
			
									foreach ($prediction['prediction']['conditional_probabilities']['government_efficiency'] as $i => $equation) {
											
								?>
									<td><?=$equation['equations'][0][0]?></td>
									<td><?=$equation['equations'][0][1]?></td>
									<td><?=$equation['equations'][0][2]?></td>
									<td><?=$equation['equations'][0][3]?></td>
								<?php }; ?>	
								</tr>
								
								<tr>
								<?php
			
									foreach ($prediction['prediction']['conditional_probabilities']['government_efficiency'] as $i => $equation) {
											
								?>
									<td><?=$equation['equations'][1][0]?></td>
									<td><?=$equation['equations'][1][1]?></td>
									<td><?=$equation['equations'][1][2]?></td>
									<td><?=$equation['equations'][1][3]?></td>
								<?php }; ?>	
								</tr>
								
							</tbody>
						</table>
					</div>
				</div>	
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<h4 class="card-title">Infrastructure</h4><hr>
						<div class="table-responsive table-bordered">
						<table class="table">
							<thead>
								<tr>
									<th colspan="4"><center><?=$prediction['prediction']['conditional_probabilities']['infrastructure'][0]['description']?></center></th>
									<th colspan="4"><center><?=$prediction['prediction']['conditional_probabilities']['infrastructure'][1]['description']?></center></th>
									<th colspan="4"><center><?=$prediction['prediction']['conditional_probabilities']['infrastructure'][2]['description']?></center></th>
								</tr>
							</thead>
							<tbody>
								<tr>
								<?php
			
									foreach ($prediction['prediction']['conditional_probabilities']['infrastructure'] as $i => $equation) {
											
								?>
									<td><?=$equation['equations'][0][0]?></td>
									<td><?=$equation['equations'][0][1]?></td>
									<td><?=$equation['equations'][0][2]?></td>
									<td><?=$equation['equations'][0][3]?></td>
								<?php }; ?>	
								</tr>
								
								<tr>
								<?php
			
									foreach ($prediction['prediction']['conditional_probabilities']['infrastructure'] as $i => $equation) {
											
								?>
									<td><?=$equation['equations'][1][0]?></td>
									<td><?=$equation['equations'][1][1]?></td>
									<td><?=$equation['equations'][1][2]?></td>
									<td><?=$equation['equations'][1][3]?></td>
								<?php }; ?>	
								</tr>
								
							</tbody>
						</table>
					</div>
				</div>	
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<h4 class="card-title">Resiliency</h4><hr>
						<div class="table-responsive table-bordered">
						<table class="table">
							<thead>
								<tr>
									<th colspan="4"><center><?=$prediction['prediction']['conditional_probabilities']['resiliency'][0]['description']?></center></th>
									<th colspan="4"><center><?=$prediction['prediction']['conditional_probabilities']['resiliency'][1]['description']?></center></th>
									<th colspan="4"><center><?=$prediction['prediction']['conditional_probabilities']['resiliency'][2]['description']?></center></th>
								</tr>
							</thead>
							<tbody>
								<tr>
								<?php
			
									foreach ($prediction['prediction']['conditional_probabilities']['resiliency'] as $i => $equation) {
											
								?>
									<td><?=$equation['equations'][0][0]?></td>
									<td><?=$equation['equations'][0][1]?></td>
									<td><?=$equation['equations'][0][2]?></td>
									<td><?=$equation['equations'][0][3]?></td>
								<?php }; ?>	
								</tr>
								
								<tr>
								<?php
			
									foreach ($prediction['prediction']['conditional_probabilities']['resiliency'] as $i => $equation) {
											
								?>
									<td><?=$equation['equations'][1][0]?></td>
									<td><?=$equation['equations'][1][1]?></td>
									<td><?=$equation['equations'][1][2]?></td>
									<td><?=$equation['equations'][1][3]?></td>
								<?php }; ?>	
								</tr>
								
							</tbody>
						</table>
					</div>
				</div>	
			</div>
		</div>
		
	</div>
	
	<hr>
<h4 id="btn-normalized" data-toggle="collapse" data-target="#btnnormalized" style="cursor: pointer;" ng-click="isActiveNormalized = !isActiveNormalized"><i class="fa" ng-class="{'fa-times-circle': isActiveNormalized, 'fa-plus-circle': !isActiveNormalized}"></i> Normalize the Probabilities</h4>
<div id="btnnormalized" class="collapse">
	<button  class="btn btn-info pull-right" ng-click="app.print_normalized(this)" id="print-normalized"><i class="fa fa-print"></i></button>
	<div class="clearfix"></div>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<h4 class="card-title">Economy Dynamism</h4><hr>
					<div class="table-responsive table-bordered">
					<table class="table">
						<thead>
							<tr>
								<th colspan="3"><center><?=$prediction['prediction']['normalized_probabilities']['economy'][0]['description']?></center></th>
								<th colspan="3"><center><?=$prediction['prediction']['normalized_probabilities']['economy'][1]['description']?></center></th>
								<th colspan="3"><center><?=$prediction['prediction']['normalized_probabilities']['economy'][2]['description']?></center></th>
							</tr>
						</thead>
						<tbody>
							<tr>
							<?php
		
								foreach ($prediction['prediction']['normalized_probabilities']['economy'] as $i => $equation) {
										
							?>
								<td><?=$equation['equations'][0][0]?></td>
								<td><?=$equation['equations'][0][1]?></td>
								<td><?=$equation['equations'][0][2]?></td>
							<?php }; ?>	
							</tr>
							
							<tr>
							<?php
		
								foreach ($prediction['prediction']['normalized_probabilities']['economy'] as $i => $equation) {
										
							?>
								<td><?=$equation['equations'][1][0]?></td>
								<td><?=$equation['equations'][1][1]?></td>
								<td><?=$equation['equations'][1][2]?></td>
							<?php }; ?>	
							</tr>
							
							<tr>
							<?php
		
								foreach ($prediction['prediction']['normalized_probabilities']['economy'] as $i => $equation) {
										
							?>
								<td><?=$equation['equations'][2][0]?></td>
								<td><?=$equation['equations'][2][1]?></td>
								<td><?=$equation['equations'][2][2]?></td>
							<?php }; ?>	
							</tr>
							
						</tbody>
					</table>
				</div>
			</div>	
		</div>
	</div>
	
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<h4 class="card-title">Government Efficiency</h4><hr>
					<div class="table-responsive table-bordered">
					<table class="table">
						<thead>
							<tr>
								<th colspan="3"><center><?=$prediction['prediction']['normalized_probabilities']['government_efficiency'][0]['description']?></center></th>
								<th colspan="3"><center><?=$prediction['prediction']['normalized_probabilities']['government_efficiency'][1]['description']?></center></th>
								<th colspan="3"><center><?=$prediction['prediction']['normalized_probabilities']['government_efficiency'][2]['description']?></center></th>
							</tr>
						</thead>
						<tbody>
							<tr>
							<?php
		
								foreach ($prediction['prediction']['normalized_probabilities']['government_efficiency'] as $i => $equation) {
										
							?>
								<td><?=$equation['equations'][0][0]?></td>
								<td><?=$equation['equations'][0][1]?></td>
								<td><?=$equation['equations'][0][2]?></td>
							<?php }; ?>	
							</tr>
							
							<tr>
							<?php
		
								foreach ($prediction['prediction']['normalized_probabilities']['government_efficiency'] as $i => $equation) {
										
							?>
								<td><?=$equation['equations'][1][0]?></td>
								<td><?=$equation['equations'][1][1]?></td>
								<td><?=$equation['equations'][1][2]?></td>
							<?php }; ?>	
							</tr>
							
							<tr>
							<?php
		
								foreach ($prediction['prediction']['normalized_probabilities']['government_efficiency'] as $i => $equation) {
										
							?>
								<td><?=$equation['equations'][2][0]?></td>
								<td><?=$equation['equations'][2][1]?></td>
								<td><?=$equation['equations'][2][2]?></td>
							<?php }; ?>	
							</tr>
							
						</tbody>
					</table>
				</div>
			</div>	
		</div>
	</div>
	
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<h4 class="card-title">Infrastructure</h4><hr>
					<div class="table-responsive table-bordered">
					<table class="table">
						<thead>
							<tr>
								<th colspan="3"><center><?=$prediction['prediction']['normalized_probabilities']['infrastructure'][0]['description']?></center></th>
								<th colspan="3"><center><?=$prediction['prediction']['normalized_probabilities']['infrastructure'][1]['description']?></center></th>
								<th colspan="3"><center><?=$prediction['prediction']['normalized_probabilities']['infrastructure'][2]['description']?></center></th>
							</tr>
						</thead>
						<tbody>
							<tr>
							<?php
		
								foreach ($prediction['prediction']['normalized_probabilities']['infrastructure'] as $i => $equation) {
										
							?>
								<td><?=$equation['equations'][0][0]?></td>
								<td><?=$equation['equations'][0][1]?></td>
								<td><?=$equation['equations'][0][2]?></td>
							<?php }; ?>	
							</tr>
							
							<tr>
							<?php
		
								foreach ($prediction['prediction']['normalized_probabilities']['infrastructure'] as $i => $equation) {
										
							?>
								<td><?=$equation['equations'][1][0]?></td>
								<td><?=$equation['equations'][1][1]?></td>
								<td><?=$equation['equations'][1][2]?></td>
							<?php }; ?>	
							</tr>
							
							<tr>
							<?php
		
								foreach ($prediction['prediction']['normalized_probabilities']['infrastructure'] as $i => $equation) {
										
							?>
								<td><?=$equation['equations'][2][0]?></td>
								<td><?=$equation['equations'][2][1]?></td>
								<td><?=$equation['equations'][2][2]?></td>
							<?php }; ?>	
							</tr>
							
						</tbody>
					</table>
				</div>
			</div>	
		</div>
	</div>
	
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<h4 class="card-title">Resiliency</h4><hr>
					<div class="table-responsive table-bordered">
					<table class="table">
						<thead>
							<tr>
								<th colspan="3"><center><?=$prediction['prediction']['normalized_probabilities']['resiliency'][0]['description']?></center></th>
								<th colspan="3"><center><?=$prediction['prediction']['normalized_probabilities']['resiliency'][1]['description']?></center></th>
								<th colspan="3"><center><?=$prediction['prediction']['normalized_probabilities']['resiliency'][2]['description']?></center></th>
							</tr>
						</thead>
						<tbody>
							<tr>
							<?php
		
								foreach ($prediction['prediction']['normalized_probabilities']['resiliency'] as $i => $equation) {
										
							?>
								<td><?=$equation['equations'][0][0]?></td>
								<td><?=$equation['equations'][0][1]?></td>
								<td><?=$equation['equations'][0][2]?></td>
							<?php }; ?>	
							</tr>
							
							<tr>
							<?php
		
								foreach ($prediction['prediction']['normalized_probabilities']['resiliency'] as $i => $equation) {
										
							?>
								<td><?=$equation['equations'][1][0]?></td>
								<td><?=$equation['equations'][1][1]?></td>
								<td><?=$equation['equations'][1][2]?></td>
							<?php }; ?>	
							</tr>
							
							<tr>
							<?php
		
								foreach ($prediction['prediction']['normalized_probabilities']['resiliency'] as $i => $equation) {
										
							?>
								<td><?=$equation['equations'][2][0]?></td>
								<td><?=$equation['equations'][2][1]?></td>
								<td><?=$equation['equations'][2][2]?></td>
							<?php }; ?>	
							</tr>
							
						</tbody>
					</table>
				</div>
			</div>	
		</div>
	</div>
</div>
<hr>
<h4 id="btn-naive" data-toggle="collapse" data-target="#btnnaive" style="cursor: pointer;" ng-click="isActiveNaive = !isActiveNaive"><i class="fa" ng-class="{'fa-times-circle': isActiveNaive, 'fa-plus-circle': !isActiveNaive}"></i> <?=$prediction['prediction']['classified'][0]?></h4>
<div id="btnnaive" class="collapse">
<button  class="btn btn-info pull-right" ng-click="app.print_naive(this)" id="print-naive"><i class="fa fa-print"></i></button>
	<div class="clearfix"></div>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="table-responsive table-bordered">
					<table class="table">
					<br>
					<?php foreach ($prediction['prediction']['classified'] as $i => $classified) { ?>
					
					<?php if (($i == 0 ) || ($i == count($indicators)+7) || ($i == count($indicators)+13)) continue; ?>
					
					<?php if (($i == count($indicators)+3) || ($i == count($indicators)+9)) {?>
						<br>
					<?php }; ?>
					
					<?php if (($i == count($indicators)+4) || ($i == count($indicators)+10)) {?>
						<hr>
					<?php }; ?>
					
					<div class="col-lg-12">
						<h5><?=$classified?></h5>
					</div>
					<?php };?>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<hr>
<h4 id="btn-results" data-toggle="collapse" data-target="#btnresults" style="cursor: pointer;" ng-click="isActiveResults = !isActiveResults"><i class="fa" ng-class="{'fa-times-circle': isActiveResults, 'fa-plus-circle': !isActiveResults}"></i> <?=$prediction['prediction']['results'][0]?> & <?=$prediction['prediction']['normalized_results'][0]?></h4>
<div id="btnresults" class="collapse">
	<button  class="btn btn-info pull-right" ng-click="app.print_results(this)" id="print-results"><i class="fa fa-print"></i></button>
	<div class="clearfix"></div>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<h4 class="card-title"><?=$prediction['prediction']['results'][0]?>:</h4><hr>
				<div class="col-lg-12">
					<h5><?=$prediction['prediction']['results'][1]?></h5>
					<h5><?=$prediction['prediction']['results'][2]?></h5>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<h4 class="card-title"><?=$prediction['prediction']['normalized_results'][0]?><span class="pull-right" style="margin-right: 250px;">Total</span></h4><hr>
				<div class="row">
				<div class="col-lg-8">
					<h5><?=$prediction['prediction']['normalized_results'][1]?></h5>
					<hr>
					<h5><?=$prediction['prediction']['normalized_results'][3]?></h5>
					<hr>
					<h5><?=$prediction['prediction']['normalized_results'][5]?></h5>
				</div>
				<div class="col-lg-4">
					<h5><?=$prediction['prediction']['normalized_results'][2]?></h5>
					<hr>
					<h5><?=$prediction['prediction']['normalized_results'][4]?></h5>
					<hr>
					<h5><?=$prediction['prediction']['normalized_results'][6]?></h5>
				</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
			<h4 class="card-title">Prediction Result:</h4><hr>
				<center><h4><?=$prediction['prediction']['prediction_result']?></h4></center>
			</div>
		</div>
	</div>
</div>
