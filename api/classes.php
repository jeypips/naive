<?php

class dataset {	
	
	var $data;
	var $pillars_indicators;
	var $actual_values;
	
	function __construct($cmcis,$pillars_indicators) {

		$this->data = $cmcis;
		$this->pillars_indicators = $pillars_indicators;
		
		$this->actual_values();

	}
	
	function get($top) {
		
		# rank value		
		foreach ($this->data as $i => $lgu) {

			foreach ($this->pillars_indicators as $pillar => $indicators) {

				foreach ($lgu[$pillar] as $key => $indicator) {

					$rank = (floatval($indicator['actual'])-floatval($this->minimum($pillar,$key)))/(floatval($this->maximum($pillar,$key))-floatval($this->minimum($pillar,$key)));
					$this->data[$i][$pillar][$key]['rank'] = (string)$rank;

				};

			};
			
		};

		$this->rank_values();
		
		# competitive value
		foreach ($this->data as $i => $lgu) {

			foreach ($this->pillars_indicators as $pillar => $indicators) {

				foreach ($lgu[$pillar] as $key => $indicator) {

					$competitive = $this->competitive($top,$indicator['rank'],$pillar,$key);

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
	
	function competitive($top=null,$rank_value,$pillar,$indicator) {

		$rank = [];		

		$all = $this->rank_values[$pillar][$indicator];

		foreach ($all as $i => $value) {

			$rank[] = $value['rank_value'];

		};

		array_multisort($rank, SORT_DESC, $all);
		
		$tops = [];
		
		$top = $top-1;
		foreach ($all as $i => $value) {
			
			if ($i>$top) break;
			
			$tops[] = $value;
			
		};

		$range = array(
			"top"=>$tops[0]['rank_value'],
			"bottom"=>$tops[count($tops)-1]['rank_value']
		);

		$competitive = "No";
		if ( ((floatval($rank_value))>=floatval($range['top']))&&((floatval($rank_value))>=floatval($range['bottom'])) ) $competitive = "Yes";
		
		return $competitive;
		
	}
	
	function maximum($pillar,$indicator) {
	
		$rank = [];
	
		foreach ($this->actual_values[$pillar][$indicator] as $i => $value) {

			$rank[] = $value['actual_value'];

		};
		
		array_multisort($rank, SORT_DESC, $this->actual_values[$pillar][$indicator]);

		return $this->actual_values[$pillar][$indicator][0]['actual_value'];

	}
	
	function minimum($pillar,$indicator) {
		
		$rank = [];
	
		foreach ($this->actual_values[$pillar][$indicator] as $i => $value) {

			$rank[] = $value['actual_value'];

		};

		array_multisort($rank, SORT_ASC, $this->actual_values[$pillar][$indicator]);

		return $this->actual_values[$pillar][$indicator][0]['actual_value'];	

	}
	
};

?>