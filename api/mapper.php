<?php

$pillars = array(
	"economy"=>array(
		"local_economy_size",
		"local_economy_growth",
		"local_economy_structure",
		"safety_compliant_business",
		"increase_in_employment",
		"cost_of_living",
		"cost_of_doing_business",
		"financial_deepening",
		"productivity",
		"presence_of_business_and_professional",
		"total",
	),
	"government_efficiency"=>array(
		"compliance_to_national_directives",
		"investment_promotion_unit",
		"registration_efficiency",
		"generate_local_resource",
		"capacity_of_health_services",
		"capacity_of_school_services",
		"recognition_of_performance",
		"business_permits_and_licensing",
		"peace_and_order",
		"social_protection",
		"total",
	),
	"infrastructure"=>array(
		"road_network",
		"distance_to_ports",
		"availability_of_basic_utilities",
		"transportation_vehicles",
		"education",
		"health",
		"lgu_investment",
		"accommodation_capacity",
		"information_technology_capacity",
		"financial_technology_capacity",
		"total",
	),
	"resiliency"=>array(
		"land_use_plan",
		"disaster_risk_reduction_plan",
		"annual_disaster_drill",
		"early_warning_system",
		"budget_for_drrmp",
		"local_risk_assessments",
		"emergency_infrastructure",
		"utilities",
		"employed_population",
		"sanitary_system",
		"total",
	)
);

$headers = array(
	"economy"=>array(
		array("indicator"=>"local_economy_size","header"=>"Local Economy Size"),
		array("indicator"=>"local_economy_size","header"=>"Rank Value"),
		array("indicator"=>"local_economy_size","header"=>"Competitive"),
		
		array("indicator"=>"local_economy_growth","header"=>"Local Economy Growth"),
		array("indicator"=>"local_economy_growth","header"=>"Rank Value"),
		array("indicator"=>"local_economy_growth","header"=>"Competitive"),
		
		array("indicator"=>"local_economy_structure","header"=>"Local Economy Structure"),
		array("indicator"=>"local_economy_structure","header"=>"Rank Value"),
		array("indicator"=>"local_economy_structure","header"=>"Competitive"),
		
		array("indicator"=>"safety_compliant_business","header"=>"Safety Compliant Business"),
		array("indicator"=>"safety_compliant_business","header"=>"Rank Value"),
		array("indicator"=>"safety_compliant_business","header"=>"Competitive"),
		
		array("indicator"=>"increase_in_employment","header"=>"Increase in Employment"),
		array("indicator"=>"increase_in_employment","header"=>"Rank Value"),
		array("indicator"=>"increase_in_employment","header"=>"Competitive"),
		
		array("indicator"=>"cost_of_living","header"=>"Cost of Living"),
		array("indicator"=>"cost_of_living","header"=>"Rank Value"),
		array("indicator"=>"cost_of_living","header"=>"Competitive"),
		
		array("indicator"=>"cost_of_doing_business","header"=>"Cost of Doing Business"),
		array("indicator"=>"cost_of_doing_business","header"=>"Rank Value"),
		array("indicator"=>"cost_of_doing_business","header"=>"Competitive"),
		
		array("indicator"=>"financial_deepening","header"=>"Financial Deepening"),
		array("indicator"=>"financial_deepening","header"=>"Rank Value"),
		array("indicator"=>"financial_deepening","header"=>"Competitive"),
		
		array("indicator"=>"productivity","header"=>"Productivity"),
		array("indicator"=>"productivity","header"=>"Rank Value"),
		array("indicator"=>"productivity","header"=>"Competitive"),
		
		array("indicator"=>"presence_of_business_and_professional","header"=>"Presence of Business and Professional Organizations"),
		array("indicator"=>"presence_of_business_and_professional","header"=>"Rank Value"),
		array("indicator"=>"presence_of_business_and_professional","header"=>"Competitive"),
		
		array("indicator"=>"total","header"=>"Total"),
		array("indicator"=>"total","header"=>"Rank Value"),
		array("indicator"=>"total","header"=>"Competitive"),		
	),
	"government_efficiency"=>array(
		array("indicator"=>"compliance_to_national_directives","header"=>"Compliance to National Directives"),
		array("indicator"=>"compliance_to_national_directives","header"=>"Rank Value"),
		array("indicator"=>"compliance_to_national_directives","header"=>"Competitive"),
		
		array("indicator"=>"investment_promotion_unit","header"=>"Presence of Investment Promotion Unit"),
		array("indicator"=>"investment_promotion_unit","header"=>"Rank Value"),
		array("indicator"=>"investment_promotion_unit","header"=>"Competitive"),
		
		array("indicator"=>"registration_efficiency","header"=>"Business Registration Efficiency"),
		array("indicator"=>"registration_efficiency","header"=>"Rank Value"),
		array("indicator"=>"registration_efficiency","header"=>"Competitive"),
		
		array("indicator"=>"generate_local_resource","header"=>"Capacity to Generate Local Resource"),
		array("indicator"=>"generate_local_resource","header"=>"Rank Value"),
		array("indicator"=>"generate_local_resource","header"=>"Competitive"),
		
		array("indicator"=>"capacity_of_health_services","header"=>"Capacity of Health Services"),
		array("indicator"=>"capacity_of_health_services","header"=>"Rank Value"),
		array("indicator"=>"capacity_of_health_services","header"=>"Competitive"),
		
		array("indicator"=>"capacity_of_school_services","header"=>"Capacity of School Services"),
		array("indicator"=>"capacity_of_school_services","header"=>"Rank Value"),
		array("indicator"=>"capacity_of_school_services","header"=>"Competitive"),
		
		array("indicator"=>"recognition_of_performance","header"=>"Recognition of Performance"),
		array("indicator"=>"recognition_of_performance","header"=>"Rank Value"),
		array("indicator"=>"recognition_of_performance","header"=>"Competitive"),
		
		array("indicator"=>"business_permits_and_licensing","header"=>"Compliance to Business Permits and Licensing System (BPLS) Standards"),
		array("indicator"=>"business_permits_and_licensing","header"=>"Rank Value"),
		array("indicator"=>"business_permits_and_licensing","header"=>"Competitive"),
		
		array("indicator"=>"peace_and_order","header"=>"Peace and Order"),
		array("indicator"=>"peace_and_order","header"=>"Rank Value"),
		array("indicator"=>"peace_and_order","header"=>"Competitive"),
		
		array("indicator"=>"social_protection","header"=>"Social Protection"),
		array("indicator"=>"social_protection","header"=>"Rank Value"),
		array("indicator"=>"social_protection","header"=>"Competitive"),
		
		array("indicator"=>"total","header"=>"Total"),
		array("indicator"=>"total","header"=>"Rank Value"),
		array("indicator"=>"total","header"=>"Competitive"),
	),
	"infrastructure"=>array(
		array("indicator"=>"road_network","header"=>"Road Network"),
		array("indicator"=>"road_network","header"=>"Rank Value"),
		array("indicator"=>"road_network","header"=>"Competitive"),
		
		array("indicator"=>"distance_to_ports","header"=>"Distance to Ports"),
		array("indicator"=>"distance_to_ports","header"=>"Rank Value"),
		array("indicator"=>"distance_to_ports","header"=>"Competitive"),
		
		array("indicator"=>"availability_of_basic_utilities","header"=>"Availability of Basic Utilities"),
		array("indicator"=>"availability_of_basic_utilities","header"=>"Rank Value"),
		array("indicator"=>"availability_of_basic_utilities","header"=>"Competitive"),
		
		array("indicator"=>"transportation_vehicles","header"=>"Transportation Vehicles"),
		array("indicator"=>"transportation_vehicles","header"=>"Rank Value"),
		array("indicator"=>"transportation_vehicles","header"=>"Competitive"),
		
		array("indicator"=>"education","header"=>"Education"),
		array("indicator"=>"education","header"=>"Rank Value"),
		array("indicator"=>"education","header"=>"Competitive"),
		
		array("indicator"=>"health","header"=>"Health"),
		array("indicator"=>"health","header"=>"Rank Value"),
		array("indicator"=>"health","header"=>"Competitive"),
		
		array("indicator"=>"lgu_investment","header"=>"LGU Investment"),
		array("indicator"=>"lgu_investment","header"=>"Rank Value"),
		array("indicator"=>"lgu_investment","header"=>"Competitive"),
		
		array("indicator"=>"accommodation_capacity","header"=>"Accommodation Capacity"),
		array("indicator"=>"accommodation_capacity","header"=>"Rank Value"),
		array("indicator"=>"accommodation_capacity","header"=>"Competitive"),
		
		array("indicator"=>"information_technology_capacity","header"=>"Information Technology Capacity"),
		array("indicator"=>"information_technology_capacity","header"=>"Rank Value"),
		array("indicator"=>"information_technology_capacity","header"=>"Competitive"),
		
		array("indicator"=>"financial_technology_capacity","header"=>"Financial Technology Capacity"),	
		array("indicator"=>"financial_technology_capacity","header"=>"Rank Value"),	
		array("indicator"=>"financial_technology_capacity","header"=>"Competitive"),	
		
		array("indicator"=>"total","header"=>"Total"),
		array("indicator"=>"total","header"=>"Rank Value"),
		array("indicator"=>"total","header"=>"Competitive"),
		
	),
	"resiliency"=>array(
		array("indicator"=>"land_use_plan","header"=>"Land Use Plan"),
		array("indicator"=>"land_use_plan","header"=>"Rank Value"),
		array("indicator"=>"land_use_plan","header"=>"Competitive"),
		
		array("indicator"=>"disaster_risk_reduction_plan","header"=>"Disaster Risk Reduction Plan"),
		array("indicator"=>"disaster_risk_reduction_plan","header"=>"Rank Value"),
		array("indicator"=>"disaster_risk_reduction_plan","header"=>"Competitive"),
		
		array("indicator"=>"annual_disaster_drill","header"=>"Annual Disaster Drill"),
		array("indicator"=>"annual_disaster_drill","header"=>"Rank Value"),
		array("indicator"=>"annual_disaster_drill","header"=>"Competitive"),
		
		array("indicator"=>"early_warning_system","header"=>"Early Warning System"),
		array("indicator"=>"early_warning_system","header"=>"Rank Value"),
		array("indicator"=>"early_warning_system","header"=>"Competitive"),
		
		array("indicator"=>"budget_for_drrmp","header"=>"Budget for DRRMP"),	
		array("indicator"=>"budget_for_drrmp","header"=>"Rank Value"),	
		array("indicator"=>"budget_for_drrmp","header"=>"Competitive"),	
		
		array("indicator"=>"local_risk_assessments","header"=>"Local Risk Assessments"),
		array("indicator"=>"local_risk_assessments","header"=>"Rank Value"),
		array("indicator"=>"local_risk_assessments","header"=>"Competitive"),
		
		array("indicator"=>"emergency_infrastructure","header"=>"Emergency Infrastructure"),
		array("indicator"=>"emergency_infrastructure","header"=>"Rank Value"),
		array("indicator"=>"emergency_infrastructure","header"=>"Competitive"),
		
		array("indicator"=>"utilities","header"=>"Utilities"),
		array("indicator"=>"utilities","header"=>"Rank Value"),
		array("indicator"=>"utilities","header"=>"Utilities"),
		
		array("indicator"=>"employed_population","header"=>"Employed Population"),
		array("indicator"=>"employed_population","header"=>"Rank Value"),
		array("indicator"=>"employed_population","header"=>"Competitive"),
		
		array("indicator"=>"sanitary_system","header"=>"Sanitary System"),
		array("indicator"=>"sanitary_system","header"=>"Rank Value"),
		array("indicator"=>"sanitary_system","header"=>"Competitive"),
	
		array("indicator"=>"total","header"=>"Total"),
		array("indicator"=>"total","header"=>"Rank Value"),
		array("indicator"=>"total","header"=>"Competitive"),
	),
);

$indicators_headers = array(
	"local_economy_size"=>"Local Economy Size",
	"local_economy_growth"=>"Local Economy Growth",	
	"local_economy_structure"=>"Local Economy Structure",		
	"safety_compliant_business"=>"Safety Compliant Business",	
	"increase_in_employment"=>"Increase in Employment",
	"cost_of_living"=>"Cost of Living",
	"cost_of_doing_business"=>"Cost of Doing Business",
	"financial_deepening"=>"Financial Deepening",
	"productivity"=>"Productivity",
	"presence_of_business_and_professional"=>"Presence of Business and Professional Organizations",
	"compliance_to_national_directives"=>"Compliance to National Directives",
	"investment_promotion_unit"=>"Presence of Investment Promotion Unit",
	"registration_efficiency"=>"Business Registration Efficiency",
	"generate_local_resource"=>"Capacity to Generate Local Resource",
	"capacity_of_health_services"=>"Capacity of Health Services",
	"capacity_of_school_services"=>"Capacity of School Services",
	"recognition_of_performance"=>"Recognition of Performance",
	"business_permits_and_licensing"=>"Compliance to Business Permits and Licensing System (BPLS) Standards",	
	"peace_and_order"=>"Peace and Order",
	"social_protection"=>"Social Protection",
	"road_network"=>"Road Network",
	"distance_to_ports"=>"Distance to Ports",
	"availability_of_basic_utilities"=>"Availability of Basic Utilities",
	"transportation_vehicles"=>"Transportation Vehicles",
	"education"=>"Education",
	"health"=>"Health",
	"lgu_investment"=>"LGU Investment",
	"accommodation_capacity"=>"Accommodation Capacity",
	"information_technology_capacity"=>"Information Technology Capacity",	
	"financial_technology_capacity"=>"Financial Technology Capacity",
	"land_use_plan"=>"Land Use Plan",
	"disaster_risk_reduction_plan"=>"Disaster Risk Reduction Plan",
	"annual_disaster_drill"=>"Annual Disaster Drill",
	"early_warning_system"=>"Early Warning System",
	"budget_for_drrmp"=>"Budget for DRRMP",
	"local_risk_assessments"=>"Local Risk Assessments",
	"emergency_infrastructure"=>"Emergency Infrastructure",
	"utilities"=>"Utilities",
	"employed_population"=>"Employed Population",
	"sanitary_system"=>"Sanitary System",
);

?>