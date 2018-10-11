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
			$total = $this->get_frequency_indicator_data($frequency_by_indicator,"total");

			$this->probabilities[$pillar] = array(
				array(  # city
					"id"=>1,"description"=>"City","equations"=>array(
						array( # no
							array( # p(b)
								"P(B)","P(City)",$city['total'],eval("return ".stripslashes($city['total']).";")
							),
							array( # p(a)
								"P(A)","P(No)",$total['no'],eval("return ".stripslashes($total['no']).";")
							),
							array( # p(b|a)
								"P(B|A)","P(City|No)",$city['no'],eval("return ".stripslashes($city['no']).";")
							),							
						),
						array( # yes
							array( # p(b)
								"P(B)","P(City)",$city['total'],eval("return ".stripslashes($city['total']).";")
							),
							array( # p(a)
								"P(A)","P(Yes)",$total['yes'],eval("return ".stripslashes($total['yes']).";")
							),
							array( # p(b|a)
								"P(B|A)","P(City|Yes)",$city['yes'],eval("return ".stripslashes($city['yes']).";")
							),
						),						
					),
				),
				array( # first-second class
					"id"=>2,"description"=>"First-Second Class","equations"=>array(
						array( # no
							array( # p(b)
								"P(B)","P(First-Second Class)",$first_second['total'],eval("return ".stripslashes($first_second['total']).";")
							),
							array( # p(a)
								"P(A)","P(No)",$total['no'],eval("return ".stripslashes($total['no']).";")
							),
							array( # p(b|a)
								"P(B|A)","P(First-Second Class|No)",$first_second['no'],eval("return ".stripslashes($first_second['no']).";")
							),							
						),
						array( # yes
							array( # p(b)
								"P(B)","P(First-Second Class)",$first_second['total'],eval("return ".stripslashes($first_second['total']).";")
							),
							array( # p(a)
								"P(A)","P(Yes)",$total['yes'],eval("return ".stripslashes($total['yes']).";")
							),
							array( # p(b|a)
								"P(B|A)","P(First-Second Class|Yes)",$first_second['yes'],eval("return ".stripslashes($first_second['yes']).";")
							),
						),					
					),
				),
				array( # third-fourth class
					"id"=>3,"description"=>"Third-Fourth Class","equations"=>array(
						array( # no
							array( # p(b)
								"P(B)","P(Third-Fourth Class)",$third_fourth['total'],eval("return ".stripslashes($third_fourth['total']).";")
							),
							array( # p(a)
								"P(A)","P(No)",$total['no'],eval("return ".stripslashes($total['no']).";")
							),
							array( # p(b|a)
								"P(B|A)","P(Third-Fourth Class|No)",$third_fourth['no'],eval("return ".stripslashes($third_fourth['no']).";")
							),							
						),
						array( # yes
							array( # p(b)
								"P(B)","P(Third-Fourth Class)",$third_fourth['total'],eval("return ".stripslashes($third_fourth['total']).";")
							),
							array( # p(a)
								"P(A)","P(Yes)",$total['yes'],eval("return ".stripslashes($total['yes']).";")
							),
							array( # p(b|a)
								"P(B|A)","P(Third-Fourth Class|Yes)",$third_fourth['yes'],eval("return ".stripslashes($third_fourth['yes']).";")
							),
						),				
					),
				),
			);
			
		};
	
	}
	
	public function get_probabilities() {

		return $this->probabilities;
	
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

class conditional_probabilities {

	var $probabilities;
	var $pillars;
	var $conditional_probabilities;

	function __construct($probabilities,$pillars) {
		
		$this->probabilities = $probabilities;
		$this->pillars = $pillars;
		
		$this->conditional_probabilities = [];
		
		$this->process();
		
	}
	
	private function process() {
		
		$categories = array("city"=>0,"first_second"=>1,"third_fourth"=>2);
		$no_yes = array("no"=>0,"yes"=>1);
		$operands = array("pb"=>0,"pa"=>1,"pba"=>2);
		
		foreach ($this->pillars as $pillar => $indicators) {
			
			$city_equations = $this->get_probability_equation($pillar,$categories['city']);
			$city_pb_no = $this->get_operand($city_equations,$no_yes['no'],$operands['pb']);
			$city_pa_no = $this->get_operand($city_equations,$no_yes['no'],$operands['pa']);
			$city_pba_no = $this->get_operand($city_equations,$no_yes['no'],$operands['pba']);			
			$city_pb_yes = $this->get_operand($city_equations,$no_yes['yes'],$operands['pb']);
			$city_pa_yes = $this->get_operand($city_equations,$no_yes['yes'],$operands['pa']);
			$city_pba_yes = $this->get_operand($city_equations,$no_yes['yes'],$operands['pba']);
			
			$first_second_equations = $this->get_probability_equation($pillar,$categories['first_second']);			
			$first_second_pb_no = $this->get_operand($first_second_equations,$no_yes['no'],$operands['pb']);
			$first_second_pa_no = $this->get_operand($first_second_equations,$no_yes['no'],$operands['pa']);
			$first_second_pba_no = $this->get_operand($first_second_equations,$no_yes['no'],$operands['pba']);			
			$first_second_pb_yes = $this->get_operand($first_second_equations,$no_yes['yes'],$operands['pb']);
			$first_second_pa_yes = $this->get_operand($first_second_equations,$no_yes['yes'],$operands['pa']);
			$first_second_pba_yes = $this->get_operand($first_second_equations,$no_yes['yes'],$operands['pba']);
			
			$third_fourth_equations = $this->get_probability_equation($pillar,$categories['third_fourth']);			
			$third_fourth_pb_no = $this->get_operand($third_fourth_equations,$no_yes['no'],$operands['pb']);
			$third_fourth_pa_no = $this->get_operand($third_fourth_equations,$no_yes['no'],$operands['pa']);
			$third_fourth_pba_no = $this->get_operand($third_fourth_equations,$no_yes['no'],$operands['pba']);			
			$third_fourth_pb_yes = $this->get_operand($third_fourth_equations,$no_yes['yes'],$operands['pb']);
			$third_fourth_pa_yes = $this->get_operand($third_fourth_equations,$no_yes['yes'],$operands['pa']);
			$third_fourth_pba_yes = $this->get_operand($third_fourth_equations,$no_yes['yes'],$operands['pba']);			
			
			$this->conditional_probabilities[$pillar] = array(
				array(  # city
					"id"=>1,"description"=>"City","equations"=>array(
						array( # no
							"P(A|B)","P(No|City)","P(B|A)*P(No)/P(City)",(floatval($city_pba_no)*floatval($city_pa_no))/floatval($city_pb_no)
						),
						array( # yes
							"P(A|B)","P(Yes|City)","P(B|A)*P(Yes)/P(City)",(floatval($city_pba_yes)*floatval($city_pa_yes))/floatval($city_pb_yes)
						),						
					),
				),
				array(  # first-second class
					"id"=>2,"description"=>"First-Second Class","equations"=>array(
						array( # no
							"P(A|B)","P(No|City)","P(B|A)*P(No)/P(City)",(floatval($first_second_pba_no)*floatval($first_second_pa_no))/floatval($first_second_pb_no)
						),
						array( # yes
							"P(A|B)","P(Yes|City)","P(B|A)*P(Yes)/P(City)",(floatval($first_second_pba_yes)*floatval($first_second_pa_yes))/floatval($first_second_pb_yes)
						),							
					),
				),
				array(  # third-fourth class
					"id"=>3,"description"=>"Third-Fourth Class","equations"=>array(
						array( # no
							"P(A|B)","P(No|City)","P(B|A)*P(No)/P(City)",(floatval($third_fourth_pba_no)*floatval($third_fourth_pa_no))/floatval($third_fourth_pb_no)
						),
						array( # yes
							"P(A|B)","P(Yes|City)","P(B|A)*P(Yes)/P(City)",(floatval($third_fourth_pba_yes)*floatval($third_fourth_pa_yes))/floatval($third_fourth_pb_yes)
						),							
					),
				),				
			);			
			
		}
		
	}
	
	public function get_conditional_probabilities() {
		
		return $this->conditional_probabilities;
		
	}
	
	private function get_probability_equation($pillar,$category) {
		
		return $this->probabilities[$pillar][$category]['equations'];
		
	}
	
	private function get_operand($equations,$no_yes,$operand) {
		
		$value = $equations[$no_yes][$operand][3];
		
		return $value;
		
	}
	
}

class normalize_probabilities {

	var $conditional_probabilities;
	var $pillars;
	var $normalized_probabilities;
	
	function __construct($conditional_probabilities,$pillars) {
		
		$this->conditional_probabilities = $conditional_probabilities;
		$this->pillars = $pillars;
		
		$this->normalized_probabilities = [];
		
		$this->normalize();
		
	}
	
	private function normalize() {
		
		$categories = array("city"=>0,"first_second"=>1,"third_fourth"=>2);
		$no_yes = array("no"=>0,"yes"=>1);
		
		foreach ($this->pillars as $pillar => $indicators) {

			$city_equations = $this->get_conditional_probability_equation($pillar,$categories['city']);
			$city_cp_no = $this->get_conditional_probability($city_equations,$no_yes['no']);
			$city_cp_yes = $this->get_conditional_probability($city_equations,$no_yes['yes']);
			
			$first_second_equations = $this->get_conditional_probability_equation($pillar,$categories['first_second']);
			$first_second_cp_no = $this->get_conditional_probability($first_second_equations,$no_yes['no']);
			$first_second_cp_yes =$this-> get_conditional_probability($first_second_equations,$no_yes['yes']);
			
			$third_fourth_equations = $this->get_conditional_probability_equation($pillar,$categories['third_fourth']);
			$third_fourth_cp_no = $this->get_conditional_probability($third_fourth_equations,$no_yes['no']);
			$third_fourth_cp_yes = $this->get_conditional_probability($third_fourth_equations,$no_yes['yes']);
		
			$this->normalized_probabilities[$pillar] = array(
				array(  # city
					"id"=>1,
					"description"=>"City",
					"equations"=>array(
						array(
							"Sum of Probabilities",
							"P(No|City) + P(Yes|City)",
							$city_cp_no+$city_cp_yes,
						),
						array(
							"Likelihood of Competitiveness",
							"P(Yes|City)/Sum of Probabilities",	
							number_format((($city_cp_yes/($city_cp_no+$city_cp_yes))*100),2)."%",
						),
						array(
							"Likelihood of Not Competitive",
							"P(No|City)/Sum of Probabilities",
							number_format((($city_cp_no/($city_cp_no+$city_cp_yes))*100),2)."%",							
						),							
					),
				),
				array(  # first-second class
					"id"=>2,					
					"description"=>"First-Second Class",
					"equations"=>array(
						array(
							"Sum of Probabilities",
							"P(No|First-Second Class) + P(Yes|First-Second Class)",
							$first_second_cp_no+$first_second_cp_yes,
						),
						array(
							"Likelihood of Competitiveness",
							"P(Yes|First-Second Class)/Sum of Probabilities",	
							number_format((($first_second_cp_yes/($first_second_cp_no+$first_second_cp_yes))*100),2)."%",
						),
						array(
							"Likelihood of Not Competitive",
							"P(No|First-Second Class)/Sum of Probabilities",
							number_format((($first_second_cp_no/($first_second_cp_no+$first_second_cp_yes))*100),2)."%",							
						),
					),						
				),
				array(  # third-fourth class
					"id"=>3,					
					"description"=>"Third-Fourth Class",
					"equations"=>array(
						array(
							"Sum of Probabilities",
							"P(No|Third-Fourth Class) + P(Yes|Third-Fourth Class)",
							$third_fourth_cp_no+$third_fourth_cp_yes,
						),
						array(
							"Likelihood of Competitiveness",
							"P(Yes|Third-Fourth Class)/Sum of Probabilities",
							number_format((($third_fourth_cp_yes/($third_fourth_cp_no+$third_fourth_cp_yes))*100),2)."%",
						),
						array(
							"Likelihood of Not Competitive",
							"P(No|Third-Fourth Class)/Sum of Probabilities",
							number_format((($third_fourth_cp_no/($third_fourth_cp_no+$third_fourth_cp_yes))*100),2)."%",							
						),
					),						
				),
			);
			
		};
		
	}
	
	public function get_normalized_probabilities() {
		
		return $this->normalized_probabilities;
		
	}
	
	private function get_conditional_probability_equation($pillar,$category) {
		
		return $this->conditional_probabilities[$pillar][$category]['equations'];		
		
	}
	
	private function get_conditional_probability($equations,$no_yes) {
		
		return $equations[$no_yes][3];
		
	}
	
}

class classifier {
	
	var $likelihoods;
	var $pillars;
	var $prediction_category;
	var $prediction_indicators;
	var $classified;
	
	function __construct($likelihoods,$pillars,$prediction_category,$prediction_indicators) {
		
		$this->likelihoods = $likelihoods;
		$this->pillars = $pillars;
		$this->prediction_category = $prediction_category;
		$this->prediction_indicators = $prediction_indicators;
		
		$this->classified = [];
		
		$this->classify();
		
	}
	
	private function classify() {
		
		$categories = array("City","1st-2nd class","3rd-4th class");		
		
		$b[] = "Let B equals";		
		
		$b[] = array("LGU Category",$categories[$this->prediction_category-1]);
		
		$indicators = [];
		
		foreach ($this->prediction_indicators as $i => $prediction_indicators) {
			
			foreach ($prediction_indicators['indicators'] as $key => $indicator) {

				if ($indicator['value']) $indicators[] = $indicator; 
				
			};
			
		};
		
		foreach ($indicators as $indicator) {
			
			$b[] = array($indicator['name'],($indicator['yes'])?"Yes":"No");
			
		};
	
		$this->classified[] = $b;
	
		// var_dump($indicators);
	
	}
	
	public function get_classifed() {

		return $this->classified;
		// return $this->likelihoods;
		// return $this->prediction_indicators;
	
	}
	
}

?>