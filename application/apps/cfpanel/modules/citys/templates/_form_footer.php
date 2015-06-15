<?php  $city_form = $sf_request->getParameter('citys',ESC_RAW);  
	
	   $country_id = !isset($city_form) ? $citys->getCountryId() : $city_form['country_id'] ;
	   $state_id = !isset($city_form) ? $citys->getStateId() : $city_form['state_id'] ; 		
?>
<script language="javascript" >

	//--- Select state on load form ---//    
	$.fn.selectStatesOnLoad( '<?php echo isset($country_id) ? $country_id : ''; ?>', 
	                    '<?php echo isset($state_id) ? $state_id : '' ; ?>', 
						'citys_state_id' , 
					    '<?php echo url_for('citys/getStateByCountryId') ?>' ); 

</script>