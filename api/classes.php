<?php

class dataset {	
	
	var $data;
	var $pillars_indicators;
	var $pillars;
	
	function __construct($cmcis,$pillars_indicators) {

		$this->data = $cmcis;
		$this->pillars_indicators = $pillars_indicators;

	}
	
	function indicators() {

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
	
	function highest($indicator,$rank = null) {
		
		// array_multisort($rank_per_judge, SORT_DESC, $portions[$ip]['judges'][$ij]['contestants']);		
		
	}
	
	function lowest($indicator,$rank = null) {
		
	}
	
};

?>