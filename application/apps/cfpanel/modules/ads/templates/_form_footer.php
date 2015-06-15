<?php  
   $ads_form = $sf_request->getParameter('ads',ESC_RAW);  
   $ad_type = !isset($ads_form) ? $ads->getAdType() : $ads_form['ad_type'] ;
?>

<script language="javascript" >

$(document).ready(function() {

	
	
	 $("input[id^='ads_ad_type_']").bind('click',function() {
		$.fn.showHideAdType(this);
	 });

	 $.fn.showHideAdType = function (obj)  {
		
		if($(obj).val() == 'BANNER')
		{	
			$("#banner_image").slideDown()	
			$("#banner_image").next().slideDown()
			$("#target_url").slideDown()
			$("#ad_data").hide()
		}
		else
		{	
			$("#banner_image").next().hide()
			$("#target_url").hide()
			$("#banner_image").hide()
			$("#ad_data").slideDown()
		}
	 }
	 
	 //--- Hide Widgets ---//
	$(".sf_admin_form_field_ad_data,.sf_admin_form_field_banner_image").hide();
	  
<?php  if($ad_type) : ?>
   $.fn.showHideAdType( '#ads_ad_type_<?php echo $ad_type; ?>' );
<?php else:  ?>   				
   $.fn.showHideAdType( '#ads_ad_type_BANNER' );
<?php endif;  ?>


});


</script>