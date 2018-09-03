<?php

class dataset {	
	
	var $data;
	var $pillars_indicators;
	var $pillars;
	
	function __construct($cmcis,$pillars_indicators) {

		$this->data = $cmcis;
		$this->pillars_indicators = $pillars_indicators;
		
		$this->pillars();

	}
	
	function get() {
			
		foreach ($this->data as $i => $lgu) {

			foreach ($this->pillars_indicators as $pillar => $indicators) {
				
				foreach ($lgu[$pillar] as $key => $indicator) {
					
					$this->data[$i][$pillar][$key]['rank'] = $this->minimum($pillar,$key);
					
				};
				
			};

			break;
			
		};

		return $this->data;

	}
	
	function pillars() {

		foreach ($this->pillars_indicators as $pi_key => $pi) {
			
			foreach ($this->data as $i => $lgu) {

				foreach ($lgu[$pi_key] as $indicator_key => $indicator) {
					
					$this->pillars[$pi_key][$indicator_key][] = array("id"=>$lgu['id'],"value"=>$indicator['actual']);
					
				};

			};

		};

		return $this->pillars;

	}
	
	function rankValue($pillar,$top=null,$id) {

		foreach ($this->data as $i => $lgu) {

			foreach ($lgu[$pillar] as $key => $indicator) {
				
			};

		};
		
		return $this->data;
		
	}
	
	function competitive($top=null) {
		
	}
	
	private function indicator($indicator) {
		
		foreach ($this->data as $lgu) {
			
			
			
		};
		
	}
	
	function maximum($pillar,$indicator) {
	
		$rank = [];
	
		foreach ($this->pillars[$pillar][$indicator] as $i => $value) {

			$rank[] = $value['value'];

		};
		
		array_multisort($rank, SORT_DESC, $this->pillars[$pillar][$indicator]);

		return $this->pillars[$pillar][$indicator][0]['value'];

	}
	
	function minimum($pillar,$indicator) {
		
		$rank = [];
	
		foreach ($this->pillars[$pillar][$indicator] as $i => $value) {

			$rank[] = $value['value'];

		};

		array_multisort($rank, SORT_ASC, $this->pillars[$pillar][$indicator]);

		return $this->pillars[$pillar][$indicator][0]['value'];	

	}
	
};

?>