<?php
require_once('get_data.php');

$idd = $_GET['id'];
$grop = $_GET['grp'];
//$utrr = $_GET['utr'];

$arr = get_data($idd, $grop);

//print_r($arr->items[0]);

//echo $arr->items[0]->tnt_street;


if(empty($arr->items[0]->grp_id)){
	
	echo "user tenancy reference missing";
	
}elseif(empty($arr->items[0]->num_name)){
	
	echo "property paon missing";
	
}elseif(empty($arr->items[0]->tnt_street)){
	echo "Street missing";
	
}elseif(empty($arr->items[0]->num_of_tenants)){
	echo "Tenant Numbers Missing";
	
}elseif((int)$arr->items[0]->num_of_tenants == 0){
	echo "Tenant number cannot be zero";
	
}elseif(empty($arr->items[0]->tnt_admin_area)){
	echo "Admin area missing";
	
}elseif(empty($arr->items[0]->tnt_town)){
	echo "Town Missing";
	
}elseif(empty($arr->items[0]->tnt_postcode)){
	echo "Post Code Missing";
	
}elseif(empty($arr->items[0]->deposit_amnt2protect)){
	echo "Deposit amount to protect Missing";
	
}elseif(empty($arr->items[0]->deposit_amnt)){
	echo "Deposit amount Missing";
	
}elseif(empty($arr->items[0]->tenancy_end_date)){
	echo "Tenancy End Date Missing";
	
}elseif(empty($arr->items[0]->tenancy_start_date)){
	echo "Tenancy Start Date Missing";
	
}elseif(empty($arr->items[0]->dep_rcvd_date)){
	echo "Deposit received date missing";
	
}else{
$key = "786HU-4R73R-86RGH-943AH-G7854";
$member_id = "1917011";
$live_url = "https://api.custodial.tenancydepositscheme.com";
$sandbox_url = "https://sandbox.api.custodial.tenancydepositscheme.com";
$branch_id = "0";
$api_version = "v0.9";

$nl = 1;

if(!empty(trim($arr->items[0]->joint_ll_title))){
	$nl++;
	
}

//echo $nl;


    //global $key, $member_id, $live_url, $sandbox_url, $member_id, $branch_id, $api_version;
    $url = $sandbox_url . "/" . $api_version . "/" . "CreateDeposit";

    $data = array("member_id" => $member_id,
                  "branch_id" => $branch_id,
                  "api_key" => $key,
                  "region" => "EW",
                  "scheme_type" => "Custodial",
                  "tenancy" => array(
                      array(
                          "user_tenancy_reference" => $arr->items[0]->grp_id,
                          "property_paon" => $arr->items[0]->num_name,
                          "property_street" => $arr->items[0]->tnt_street,
                          "number_of_tenants" => (int)$arr->items[0]->num_of_tenants,
                          "number_of_landlords" => $nl,
                          "property_administrative_area" => $arr->items[0]->tnt_admin_area,
                          "property_town" => $arr->items[0]->tnt_town,
                          "property_postcode" => $arr->items[0]->tnt_postcode,
                          "deposit_amount_to_protect" => (float)$arr->items[0]->deposit_amnt2protect,
                          "deposit_amount" => (float)$arr->items[0]->deposit_amnt,
                          "tenancy_expected_end_date" => $arr->items[0]->tenancy_end_date,
                          "tenancy_start_date" => $arr->items[0]->tenancy_start_date,
                          "deposit_received_date" => $arr->items[0]->dep_rcvd_date,
                          "people" => array(
                              array(
                                  "person_classification" => "Primary Landlord",
                                  "person_title" => $arr->items[0]->ll_title,
                                  "person_firstname" => $arr->items[0]->ll_firstname,
                                  "person_surname" => $arr->items[0]->ll_lastname,
                                  "is_business" => "N",
                                  "person_email" => $arr->items[0]->ll_email,
                                  "person_paon" => $arr->items[0]->ll_buildnameornumber,
                                  "person_street" => $arr->items[0]->ll_street,
                                  "person_town" => $arr->items[0]->ll_town,
                                  "person_postcode" => $arr->items[0]->ll_postcode,
                                  "person_administrative_area" => $arr->items[0]->ll_county,
                              ),						  
                          )
                      )
                  ));

    //echo json_encode( $data );
	
	//print_r($data["tenancy"][0]["people"]);
	
	if(!empty($arr->items[0]->lt_lead_title) || !empty($arr->items[0]->lt_tnt_first_name) || !empty($arr->items[0]->lt_tnt_surname) || !empty($arr->items[0]->lt_tnt_email)){
	
	$var = array(
            "person_classification" => "Lead Tenant",
            "person_title" => $arr->items[0]->lt_lead_title,
            "person_firstname" => $arr->items[0]->lt_tnt_first_name,
            "person_surname" => $arr->items[0]->lt_tnt_surname,
            "is_business" => "N",
            "person_email" => $arr->items[0]->lt_tnt_email,
            "person_phone" => $arr->items[0]->lt_tnt_phone,
      );
	
		array_push($data["tenancy"][0]["people"], $var);
	}
	
	if(!empty($arr->items[0]->jt2_title) || !empty($arr->items[0]->fjt2_firstname) || !empty($arr->items[0]->jt2_surname) || !empty($arr->items[0]->jt2_mobile) || !empty($arr->items[0]->jt2_email)){
	
	$var1 = array(
            "person_classification" => "Joint Tenant",
            "person_title" => $arr->items[0]->jt2_title,
            "person_firstname" => $arr->items[0]->fjt2_firstname,
            "person_surname" => $arr->items[0]->jt2_surname,
            "is_business" => "N",
            "person_email" => $arr->items[0]->jt2_email,            
			"person_mobile" => $arr->items[0]->jt2_mobile,
      );
	
		array_push($data["tenancy"][0]["people"], $var1);
	}	
	
	if(!empty($arr->items[0]->jt3_title) || !empty($arr->items[0]->fjt3_firstname) || !empty($arr->items[0]->jt3_surname) || !empty($arr->items[0]->jt3_mobile) || !empty($arr->items[0]->jt3_email)){
	
	$var2 = array(
            "person_classification" => "Joint Tenant",
            "person_title" => $arr->items[0]->jt3_title,
            "person_firstname" => $arr->items[0]->fjt3_firstname,
            "person_surname" => $arr->items[0]->jt3_surname,
            "is_business" => "N",
            "person_email" => $arr->items[0]->jt3_email,            
			"person_mobile" => $arr->items[0]->jt3_mobile,
      );
	
		array_push($data["tenancy"][0]["people"], $var2);
	}	


	if(!empty($arr->items[0]->jt4_title) && !empty($arr->items[0]->fjt4_firstname) || !empty($arr->items[0]->jt4_surname) || !empty($arr->items[0]->jt4_mobile) || !empty($arr->items[0]->jt4_email)){
	
	$var3 = array(
            "person_classification" => "Joint Tenant",
            "person_title" => $arr->items[0]->jt4_title,
            "person_firstname" => $arr->items[0]->fjt4_firstname,
            "person_surname" => $arr->items[0]->jt4_surname,
            "is_business" => "N",
            "person_email" => $arr->items[0]->jt4_email,            
			"person_mobile" => $arr->items[0]->jt4_mobile,
      );
	
		array_push($data["tenancy"][0]["people"], $var3);
	}	
	
	if(!empty($arr->items[0]->jt5_title) || !empty($arr->items[0]->fjt5_firstname) || !empty($arr->items[0]->jt5_surname) || !empty($arr->items[0]->jt5_mobile) || !empty($arr->items[0]->jt5_email)){
	
	$var4 = array(
            "person_classification" => "Joint Tenant",
            "person_title" => $arr->items[0]->jt5_title,
            "person_firstname" => $arr->items[0]->fjt5_firstname,
            "person_surname" => $arr->items[0]->jt5_surname,
            "is_business" => "N",
            "person_email" => $arr->items[0]->jt5_email,            
			"person_mobile" => $arr->items[0]->jt5_mobile,
      );
	
		array_push($data["tenancy"][0]["people"], $var4);
	}		
	

	if(!empty($arr->items[0]->jt6_title) || !empty($arr->items[0]->fjt6_firstname) || !empty($arr->items[0]->jt6_surname) || !empty($arr->items[0]->jt6_mobile) || !empty($arr->items[0]->jt6_email)){
	
	$var5 = array(
            "person_classification" => "Joint Tenant",
            "person_title" => $arr->items[0]->jt6_title,
            "person_firstname" => $arr->items[0]->fjt6_firstname,
            "person_surname" => $arr->items[0]->jt6_surname,
            "is_business" => "N",
            "person_email" => $arr->items[0]->jt6_email,            
			"person_mobile" => $arr->items[0]->jt6_mobile,
      );
	
		array_push($data["tenancy"][0]["people"], $var5);
	}	
	
	
	if(!empty($arr->items[0]->jt7_title) || !empty($arr->items[0]->fjt7_firstname) || !empty($arr->items[0]->jt7_surname) || !empty($arr->items[0]->jt7_mobile) || !empty($arr->items[0]->jt7_email)){
	
	$var6 = array(
            "person_classification" => "Joint Tenant",
            "person_title" => $arr->items[0]->jt7_title,
            "person_firstname" => $arr->items[0]->fjt7_firstname,
            "person_surname" => $arr->items[0]->jt7_surname,
            "is_business" => "N",
            "person_email" => $arr->items[0]->jt7_email,            
			"person_mobile" => $arr->items[0]->jt7_mobile,
      );
	
		array_push($data["tenancy"][0]["people"], $var6);
	}	
	
	if(!empty($arr->items[0]->jt8_title) && !empty($arr->items[0]->fjt8_firstname) || !empty($arr->items[0]->jt8_surname) || !empty($arr->items[0]->jt8_mobile) || !empty($arr->items[0]->jt8_email)){
	
	$var7 = array(
            "person_classification" => "Joint Tenant",
            "person_title" => $arr->items[0]->jt8_title,
            "person_firstname" => $arr->items[0]->fjt8_firstname,
            "person_surname" => $arr->items[0]->jt8_surname,
            "is_business" => "N",
            "person_email" => $arr->items[0]->jt8_email,            
			"person_mobile" => $arr->items[0]->jt8_mobile,
      );
	
		array_push($data["tenancy"][0]["people"], $var7);
	}

	if(!empty($arr->items[0]->jt9_title) || !empty($arr->items[0]->jt9_firstname) || !empty($arr->items[0]->jt9_surname) || !empty($arr->items[0]->jt9_mobile) || !empty($arr->items[0]->jt9_email)){
	
	$var8 = array(
            "person_classification" => "Joint Tenant",
            "person_title" => $arr->items[0]->jt9_title,
            "person_firstname" => $arr->items[0]->jt9_firstname,
            "person_surname" => $arr->items[0]->jt9_surname,
            "is_business" => "N",
            "person_email" => $arr->items[0]->jt9_email,            
			"person_mobile" => $arr->items[0]->jt9_mobile,
      );
	
		array_push($data["tenancy"][0]["people"], $var8);
	}	
	
	
	if(!empty($arr->items[0]->joint_ll_title) || !empty($arr->items[0]->joint_ll_first_name) || !empty($arr->items[0]->joint_ll_surname) || !empty($arr->items[0]->joint_llll_buildnameornumber) || !empty($arr->items[0]->joint_ll_email) || !empty($arr->items[0]->joint_ll_mobile) || !empty($arr->items[0]->joint_ll_street) || !empty($arr->items[0]->joint_ll_town) || !empty($arr->items[0]->joint_ll_county) || !empty($arr->items[0]->joint_ll_postcode)){
	
	$var9 = array(
          "person_classification" => "Joint Landlord",
          "person_title" => $arr->items[0]->joint_ll_title,
          "person_firstname" => $arr->items[0]->joint_ll_first_name,
          "person_surname" => $arr->items[0]->joint_ll_surname,
          "is_business" => "N",
          "person_email" => $arr->items[0]->joint_ll_email,
          "person_paon" => $arr->items[0]->joint_llll_buildnameornumber,
          "person_street" => $arr->items[0]->joint_ll_street,
          "person_town" => $arr->items[0]->joint_ll_town,
          "person_postcode" => $arr->items[0]->joint_ll_postcode,
          "person_administrative_area" => $arr->items[0]->joint_ll_county,
		  "person_mobile" => $arr->items[0]->joint_ll_mobile,
     );
	
		//array_push($data["tenancy"][0]["people"], $var9);
	}	
	
	//print_r($data["tenancy"][0]["people"]);

    $options = array(
        "http" => array(
            "method" => "POST",
            "content" => json_encode( $data ),
            "header" => "Content-Type: application/json\r\n" .
                        "Accept: application/json\r\n"
        )
    );

    $context = stream_context_create( $options );
    $result = file_get_contents( $url, false, $context );
    $response = json_decode( $result );
    //var_dump($response);
    //return $response;
	echo "<strong>batch id:</strong> ".$response->batch_id."</br>";
	echo "<strong>Success:</strong> ".$response->success."</br>";

}

//register_deposit('1033');
//get_creation_status('2421713');