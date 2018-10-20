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
			<div class="table-responsive table-bordered card" style="margin-top: 25px;">
							<?php }; ?>
			</div>
		</div>
			<div class="table-responsive table-bordered card" style="margin-top: 25px;">
							<?php }; ?>
			</div>
		</div>
			<div class="table-responsive table-bordered card" style="margin-top: 25px;">
							<?php }; ?>
			</div>
		</div>
			<div class="table-responsive table-bordered card" style="margin-top: 25px;">
			</div>
		</div>
		
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
