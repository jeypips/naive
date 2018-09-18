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
		
		$this->process_frequencies();
		
	}
	
	private function process_frequencies() {		
		
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
				"city"=>array("yes"=>$this->frequency_by_category($pillar,1,"Yes"),"no"=>$this->frequency_by_category($pillar,1,"No")),
				"first_second"=>array("yes"=>$this->frequency_by_category($pillar,2,"Yes"),"no"=>$this->frequency_by_category($pillar,2,"No")),
				"third_fourth"=>array("yes"=>$this->frequency_by_category($pillar,3,"Yes"),"no"=>$this->frequency_by_category($pillar,3,"No")),
			);
			
			$frequency_indicators[] = array("indicator"=>"category","header"=>"LGU Category","data"=>$data);
			
			foreach ($indicators as $indicator) {
				
				if ($indicator=="total") continue;
				$data = array(
					"yes"=>array("yes"=>$this->frequency_by_indicator($pillar,$indicator,"Yes","Yes"),"no"=>$this->frequency_by_indicator($pillar,$indicator,"Yes","No")),
					"no"=>array("yes"=>$this->frequency_by_indicator($pillar,$indicator,"No","Yes"),"no"=>$this->frequency_by_indicator($pillar,$indicator,"No","No")),
				);				
				$frequency_indicators[] = array("indicator"=>$indicator,"header"=>$this->get_header_description($pillar,$indicator),"data"=>$data);

			};		
			
			$this->frequencies[] = array("header"=>$table_headers[$pillar],"indicators"=>$frequency_indicators);
			
		};
		
	}
	
	function get_frequencies() {

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
	
	private function frequency_by_category($pillar,$category,$competitive) {
		
		$count = 0;
		
		foreach ($this->dataset as $lgu) {
			
			if ($lgu['cat_no']!=$category) continue;
			
			if ($lgu[$pillar]['total']['competitive']==$competitive) $count++;
			
		};
		
		return $count;
		
	}
	
	private function frequency_by_indicator($pillar,$indicator,$competitive,$total_competive) {
		
		$count = 0;
		
		foreach ($this->dataset as $lgu) {

			if ( ($lgu[$pillar][$indicator]['competitive']==$competitive) && ($lgu[$pillar]['total']['competitive']==$total_competive) ) $count++;

		};
		
		return $count;		
		
	}
	
};

class likelihood_tables {
	
	var $dataset;
	var $pillars_indicators; # pillars indicators structure
	var $likelihoods;
	var $headers;
	var $total_lgus;
	
	function __construct($dataset,$pillars_indicators,$headers) {
		
		$this->dataset = $dataset;		
		$this->pillars_indicators = $pillars_indicators;	
		$this->headers = $headers;	
		
		$this->total_lgus = count($dataset);		
		
		$this->likelihoods = [];
		
		$this->process_likelihoods();
		
	}
	
	private function process_likelihoods() {		
		
		# headers
		$table_headers = array(
			"economy"=>"Economic Dynamism",
			"government_efficiency"=>"Government Efficiency",
			"infrastructure"=>"Infrastructure",
			"resiliency"=>"Resiliency",
		);
		
		foreach ($this->pillars_indicators as $pillar => $indicators) {

			$likelihood_indicators = [];
			
			$data = array(
				"city"=>array("yes"=>$this->likelihood_by_category($pillar,1,"Yes")."/".$this->likelihood_by_category_total($pillar,"Yes"),"no"=>$this->likelihood_by_category($pillar,1,"No")."/".$this->likelihood_by_category_total($pillar,"No"),"total"=>((string)($this->likelihood_by_category($pillar,1,"Yes")+$this->likelihood_by_category($pillar,1,"No")))."/".$this->total_lgus),
				"first_second"=>array("yes"=>$this->likelihood_by_category($pillar,2,"Yes")."/".$this->likelihood_by_category_total($pillar,"Yes"),"no"=>$this->likelihood_by_category($pillar,2,"No")."/".$this->likelihood_by_category_total($pillar,"No"),"total"=>((string)($this->likelihood_by_category($pillar,2,"Yes")+$this->likelihood_by_category($pillar,2,"No")))."/".$this->total_lgus),
				"third_fourth"=>array("yes"=>$this->likelihood_by_category($pillar,3,"Yes")."/".$this->likelihood_by_category_total($pillar,"Yes"),"no"=>$this->likelihood_by_category($pillar,3,"No")."/".$this->likelihood_by_category_total($pillar,"No"),"total"=>((string)($this->likelihood_by_category($pillar,3,"Yes")+$this->likelihood_by_category($pillar,3,"No")))."/".$this->total_lgus),
				"total"=>array("yes"=>$this->likelihood_by_category_total($pillar,"Yes")."/".$this->total_lgus,"no"=>$this->likelihood_by_category_total($pillar,"No")."/".$this->total_lgus),
			);
			
			$likelihood_indicators[] = array("indicator"=>"category","header"=>"LGU Category","data"=>$data);
			
			foreach ($indicators as $indicator) {
				
				if ($indicator=="total") continue;
				$data = array(
					"yes"=>array("yes"=>$this->likelihood_by_indicator($pillar,$indicator,"Yes","Yes")."/".$this->likelihood_by_indicator_total($pillar,$indicator,"Yes"),"no"=>$this->likelihood_by_indicator($pillar,$indicator,"Yes","No")."/".$this->likelihood_by_indicator_total($pillar,$indicator,"No"),"total"=>((string)($this->likelihood_by_indicator($pillar,$indicator,"Yes","Yes")+$this->likelihood_by_indicator($pillar,$indicator,"Yes","No")))."/".$this->total_lgus),
					"no"=>array("yes"=>$this->likelihood_by_indicator($pillar,$indicator,"No","Yes")."/".$this->likelihood_by_indicator_total($pillar,$indicator,"Yes"),"no"=>$this->likelihood_by_indicator($pillar,$indicator,"No","No")."/".$this->likelihood_by_indicator_total($pillar,$indicator,"No"),"total"=>((string)($this->likelihood_by_indicator($pillar,$indicator,"No","Yes")+$this->likelihood_by_indicator($pillar,$indicator,"No","No")))."/".$this->total_lgus),
					"total"=>array("yes"=>$this->likelihood_by_indicator_total($pillar,$indicator,"Yes")."/".$this->total_lgus,"no"=>$this->likelihood_by_indicator_total($pillar,$indicator,"No")."/".$this->total_lgus),
				);				
				$likelihood_indicators[] = array("indicator"=>$indicator,"header"=>$this->get_header_description($pillar,$indicator),"data"=>$data);

			};		
			
			$this->likelihoods[] = array("header"=>$table_headers[$pillar],"indicators"=>$likelihood_indicators);
			
		};
		
	}
	
	function get_likelihoods() {

		return $this->likelihoods;
		
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
	
	private function likelihood_by_category($pillar,$category,$competitive) {
		
		$count = 0;
		
		foreach ($this->dataset as $lgu) {
			
			if ($lgu['cat_no']!=$category) continue;
			
			if ($lgu[$pillar]['total']['competitive']==$competitive) $count++;
			
		};
		
		return $count;
		
	}
	
	private function likelihood_by_category_total($pillar,$competitive) {
		
		$total = 0;
		
		foreach ($this->dataset as $lgu) {
			
			if ($lgu[$pillar]['total']['competitive']==$competitive) $total++;
			
		};
		
		return $total;
		
	}	
	
	private function likelihood_by_indicator($pillar,$indicator,$competitive,$total_competive) {
		
		$count = 0;
		
		foreach ($this->dataset as $lgu) {

			if ( ($lgu[$pillar][$indicator]['competitive']==$competitive) && ($lgu[$pillar]['total']['competitive']==$total_competive) ) $count++;

		};
		
		return $count;		
		
	}
	
	private function likelihood_by_indicator_total($pillar,$indicator,$total_competive) {
		
		$total = 0;
		
		foreach ($this->dataset as $lgu) {

			// if ( ($lgu[$pillar][$indicator]['competitive']==$competitive) && ($lgu[$pillar]['total']['competitive']==$total_competive) ) $total++;
			if ($lgu[$pillar]['total']['competitive']==$total_competive) $total++;

		};
		
		return $total;		
		
	}	
	
};

class probabilities {
	
	var $likelihoods;
	var $pillars;
	var $probabilities;
	
	function __construct($likelihoods,$pillars) {

		$this->likelihoods = $likelihoods;
		$this->pillars = $pillars;
		
		$this->probabilities = [];
		
		$this->equations();

	}

	private function equations() {
		
		$pillars_indexes = array("economy"=>0,"government_efficiency"=>1,"infrastructure"=>2,"resiliency"=>3);
		
		foreach ($this->pillars as $pillar => $indicators) {

			$frequency_by_indicator = $this->get_frequency_by_indicator($pillars_indexes[$pillar],"category");
			
			$city = $this->get_frequency_indicator_data($frequency_by_indicator,"city");
			$first_second = $this->get_frequency_indicator_data($frequency_by_indicator,"first_second");
			$third_fourth = $this->get_frequency_indicator_data($frequency_by_indicator,"third_fourth");
			
			$this->probabilities[$pillar] = array(
				array(  # city
					"id"=>1,"description"=>"City","equations"=>array(
						array("description"=>"P(B)","value"=>0),
						array("description"=>"P(A)","value"=>0),
						array("description"=>"P(B|A)","value"=>0),
					),
				),
				array( # first-second class
					"id"=>2,"description"=>"First-Second Class","equations"=>array(
						array("description"=>"P(B)","value"=>0),
						array("description"=>"P(A)","value"=>0),
						array("description"=>"P(B|A)","value"=>0),						
					),
				),
				array( # third-fourth class
					"id"=>3,"description"=>"Third-Fourth Class","equations"=>array(
						array("description"=>"P(B)","value"=>0),
						array("description"=>"P(A)","value"=>0),
						array("description"=>"P(B|A)","value"=>0),						
					),
				),
			);
			
		};
	
	}
	
	public function get_probabilities() {

		return $this->probabilities;
		// return $this->likelihoods;
	
	}
	
	private function get_frequency_by_indicator($pillar,$indicator) {
		
		$frequency_by_indicator = array();
		
		foreach ($this->likelihoods as $i => $likelihood) {
			
			if ($i == $pillar) {
			
				foreach ($likelihood['indicators'] as $li) {
					
					if ($li['indicator'] == $indicator) $frequency_by_indicator = $li;
					
				};
			
			};
			
		};
		
		return $frequency_by_indicator;
	
	}
	
	private function get_frequency_indicator_data($frequency_by_indicator,$category) {
		
		$data = array();
		
		foreach ($frequency_by_indicator['data'] as $c => $d) {

			if ($c == $category) $data = $d;
			
		};
		
		return $data;
		
	}
	
};

?>