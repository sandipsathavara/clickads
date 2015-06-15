<?php $city_filter =  $sf_user->getAttribute('citys.filters', '', 'admin_module',ESC_RAW); ?>
<script language="javascript" >
	//--- Select state on load form in filter ---//    
	$.fn.selectStatesOnLoad('<?php echo isset($city_filter['country_id']) ? $city_filter['country_id'] : ''; ?>', 
	                    '<?php echo isset($city_filter['state_id']) ? $city_filter['state_id'] : '' ; ?>', 
	                    'city_filters_state_id' , 
					    '<?php echo url_for('citys/getStateByCountryId') ?>' ); 
</script>