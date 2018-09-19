<?php

require_once '../db.php';
require_once '../api/mapper.php';
require_once '../api/classes.php';

$period = $_GET['period'];
$top = intval($_GET['top']);

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
<h4>Datasets <button id="print-datasets" class="btn btn-info pull-right" ng-click="app.print(this)"><i class="fa fa-print"></i></button></h4>
<ul class="nav nav-tabs customtab2" role="tablist" style="margin-top: 30px;">
	<li class="nav-item"> <a class="nav-link active show" data-toggle="tab" href="#economy" role="tab" aria-selected="false"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Economy</span></a> </li>
	<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#government" role="tab" aria-selected="true"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Government Efficiency</span></a> </li>
	<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#infra" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Infrastructure</span></a> </li>
	<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#resiliency" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Resiliency</span></a> </li>
	<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#overall" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Overall</span></a> </li>
</ul>
<div class="tab-content" id="predictions">
	<div class="tab-pane active show" id="economy" role="tabpanel">
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
	
	<div class="tab-pane" id="government" role="tabpanel">
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
	<div class="tab-pane" id="infra" role="tabpanel">
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
	<div class="tab-pane" id="resiliency" role="tabpanel">
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
	
	<div class="tab-pane p-20" id="overall" role="tabpanel">
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
<hr>

<button id="btn-frequency" type="button" class="btn btn-info waves-effect waves-light active" data-toggle="collapse" data-target="#btnfrequency" ng-click="isActive = !isActive">Frequency Tables <i class="fa" ng-class="{'fa-angle-down': isActive, 'fa-angle-right': !isActive}"></i></button>
<button id="print-frequency" class="btn btn-info pull-right" ng-click="app.print_frequency(this)"><i class="fa fa-print"></i></button>

<div class="collapse" id="btnfrequency">
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

<button id="btn-likelihood" type="button" class="btn btn-info waves-effect waves-light active" data-toggle="collapse" data-target="#btnlikelihood" ng-click="isActive = !isActive">Likelihood Tables <i class="fa" ng-class="{'fa-angle-down': isActive, 'fa-angle-right': !isActive}"></i></button><button  class="btn btn-info pull-right" ng-click="app.print_likelihood(this)"><i class="fa fa-print"></i></button>

<div class="collapse" id="btnlikelihood">
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

<h4>Calculate one variable in category <button  class="btn btn-info pull-right" ng-click=""><i class="fa fa-print"></i></button></h4>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<h4 class="card-title">Economy Dynamism</h4><hr>
				<div class="table-bordered">
				<table class="table">
					<thead>
						<tr>
							<th colspan="4"><center>City</center></th>
							<th colspan="4"><center>First-Second Class</center></th>
							<th colspan="4"><center>Third-Fourth Class</center></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>P(B)</td>
							<td>P(City)</td>
							<td>9/125</td>
							<td>0.072</td>
			
							<td>P(B)</td>
							<td>P(1stclass-2ndclass)</td>
							<td>37/125</td>
							<td>0.296</td>
							
							<td>P(B)</td>
							<td>P(3rdclass-4thclass)</td>
							<td>78/125</td>
							<td>0.624</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>	
	</div>
</div>