<?php

class dataset {	
	
	var $data;
	var $pillars_indicators; # pillars indicators structure
	var $actual_values; # rows of actual values per indicators per pillar
	var $actual_values_min_max; # rows of actual values maximum and minimum
	var $rank_values; # rows of rank values per indicators per pillar
	var $ranks; # rows of top ex. 10 ranks per indicators per pillar
	
	function __construct($cmcis,$pillars_indicators) {

		$this->data = $cmcis;
		$this->pillars_indicators = $pillars_indicators;

		$this->actual_values();
		$this->actual_values_min_max();

	}
	
	function get($top) {
		
		# rank value		
		foreach ($this->data as $i => $lgu) {

			foreach ($this->pillars_indicators as $pillar => $indicators) {

				foreach ($lgu[$pillar] as $key => $indicator) {

					// $rank = (floatval($indicator['actual'])-floatval($this->minimum($pillar,$key)))/(floatval($this->maximum($pillar,$key))-floatval($this->minimum($pillar,$key)));
					$rank = (floatval($indicator['actual'])-floatval($this->actual_values_min_max[$pillar][$key]['min']))/(floatval($this->actual_values_min_max[$pillar][$key]['max'])-floatval($this->actual_values_min_max[$pillar][$key]['min']));
					$this->data[$i][$pillar][$key]['rank'] = (string)$rank;

				};

			};
			
		};

		$this->rank_values();
		$this->ranks($top);
		
		# competitive value
		foreach ($this->data as $i => $lgu) {

			foreach ($this->pillars_indicators as $pillar => $indicators) {

				foreach ($lgu[$pillar] as $key => $indicator) {

					// $competitive = $this->competitive($top,$indicator['rank'],$pillar,$key);					
					$competitive = $this->is_competitive($indicator['rank'],$pillar,$key);
					$this->data[$i][$pillar][$key]['competitive'] = $competitive;

				};

			};
			
		};		

		return $this->data;	

	}
	
	function actual_values() {

		foreach ($this->pillars_indicators as $pi_key => $pi) {

			foreach ($this->data as $i => $lgu) {

				foreach ($lgu[$pi_key] as $indicator_key => $indicator) {

					$this->actual_values[$pi_key][$indicator_key][] = array("id"=>$lgu['id'],"actual_value"=>$indicator['actual']);

				};

			};

		};

	}
	
	function get_actual_values() {
		
		return $this->actual_values;		
		
	}
	
	function rank_values() {

		foreach ($this->pillars_indicators as $pi_key => $pi) {

			foreach ($this->data as $i => $lgu) {

				foreach ($lgu[$pi_key] as $indicator_key => $indicator) {

					$this->rank_values[$pi_key][$indicator_key][] = array("id"=>$lgu['id'],"rank_value"=>$indicator['rank']);

				};

			};

		};

	}	
	
	function get_rank_values() {
		
		return $this->rank_values;
		
	}

	function ranks($top) {
		
		foreach ($this->rank_values as $pillar => $actual_values) {
			
			foreach ($actual_values as $indicator => $values) {
				
 				$rank = [];
				
				$all = $values;							

				foreach ($all as $i => $value) {

					$rank[] = $value['rank_value'];

				};
				
				array_multisort($rank, SORT_DESC, $all);
				
				$tops = [];
				foreach ($all as $i => $value) {
					
					if (count($tops)<=$top) {

						if (!$this->hasTieInRank($tops,$value)) $tops[] = $value;

					};
					
				};
				
				$this->ranks[$pillar][$indicator] = array(
					"max"=>$tops[0]['rank_value'],
					"min"=>$tops[count($tops)-1]['rank_value']
				);

			};
			
		};
		
	}

	function competitive($top=null,$rank_value,$pillar,$indicator) {

		$rank = [];		

		$all = $this->rank_values[$pillar][$indicator];

		foreach ($all as $i => $value) {

			$rank[] = $value['rank_value'];

		};

		array_multisort($rank, SORT_DESC, $all);
		
		$tops = [];
		foreach ($all as $i => $value) {
			
			if (count($tops)<=$top) {

				if (!$this->hasTieInRank($tops,$value)) $tops[] = $value;

			};
			
		};

		$range = array(
			"max"=>$tops[0]['rank_value'],
			"min"=>$tops[count($tops)-1]['rank_value']
		);

		$competitive = "No";
		if ( ((floatval($rank_value))>=floatval($range['min']))&&((floatval($rank_value))<=floatval($range['max'])) ) $competitive = "Yes";
		
		return $competitive;
		
	}
	
	function is_competitive($rank_value,$pillar,$indicator) {
		
		$competitive = "No";
		if ( ((floatval($rank_value))<=floatval($this->ranks[$pillar][$indicator]['max'])) && ((floatval($rank_value))>floatval($this->ranks[$pillar][$indicator]['min'])) ) $competitive = "Yes";
		
		return $competitive;		
		
	}
	
	function maximum($pillar,$indicator) {
		
		$maximum = max(array_column($this->actual_values[$pillar][$indicator],'actual_value'));
		
		return $maximum;

	}
	
	function minimum($pillar,$indicator) {
		
		$minimum = min(array_column($this->actual_values[$pillar][$indicator],'actual_value'));
		
		return $minimum;

	}
	
	function actual_values_min_max() {
		
		foreach ($this->actual_values as $pillar => $actual_values) {
			
			foreach ($actual_values as $indicator => $values) {
				
				$this->actual_values_min_max[$pillar][$indicator] = array(
					"max"=>max(array_column($values,'actual_value')),
					"min"=>min(array_column($values,'actual_value'))
				);
				
			};
			
		};
		
	}
	
	function get_actual_values_min_max() {
		
		return $this->actual_values_min_max;		
		
	}
	
	function hasTieInRank($rows,$row) {
		
		$hasTieInRank = false;
		
		foreach ($rows as $i => $value) {
			
			if ($value['rank_value'] == $row['rank_value']) {
				$hasTieInRank = true;
				break;
			};
			
		};
		
		return $hasTieInRank;
		
	}
	
};

class frequency_tables {
	
	var $dataset;
	var $pillars_indicators; # pillars indicators structure
	var $frequencies;
	var $headers;
	
	function __construct($dataset,$pillars_indicators,$headers) {
		
		$this->dataset = $dataset;		
		$this->pillars_indicators = $pillars_indicators;	
		$this->headers = $headers;	
		
		$this->frequencies = [];
		
		$this->frequency();
		
	}
	
	private function frequency() {		
		
		# headers
		$table_headers = array(
			"economy"=>"Economic Dynamism",
			"government_efficiency"=>"Government Efficiency",
			"infrastructure"=>"Infrastructure",
			"resiliency"=>"Resiliency",
		);
		
		foreach ($this->pillars_indicators as $pillar => $indicators) {

			$frequency_indicators = [];
			
			$data = array(
				"city"=>array("yes"=>0,"no"=>0),
				"first_second"=>array("yes"=>0,"no"=>0),
				"third_fourth"=>array("yes"=>0,"no"=>0),
			);
			
			$frequency_indicators[] = array("indicator"=>"category","header"=>"LGU Category","data"=>$data);
			
			foreach ($indicators as $indicator) {
				
				if ($indicator=="total") continue;
				$data = array(
					"yes"=>array("yes"=>0,"no"=>0),
					"no"=>array("yes"=>0,"no"=>0),
				);				
				$frequency_indicators[] = array("indicator"=>$indicator,"header"=>$this->get_header_description($pillar,$indicator),"data"=>$data);

			};		
			
			$this->frequencies[] = array("header"=>$table_headers[$pillar],"indicators"=>$frequency_indicators);
			
		};
		
		// echo json_encode($this->frequencies);
		
		// exit();
		
	}
	
	function get_frequency() {
		
		return $this->frequencies;
		
	}
	
	private function get_header_description($pillar,$indicator) {
		
		$header = "";
		
		foreach ($this->headers[$pillar] as $h) {

			if ($h['indicator'] == $indicator) {
				if ( ($h['header']=="Rank Value") || ($h['header']=="Competitive") ) continue;				
				$header = $h['header'];
			};
			
		};
		
		return $header;
		
	}
	
};

?>