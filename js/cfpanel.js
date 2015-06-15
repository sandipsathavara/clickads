//--- Selected state on onload page ---//
$.fn.selectStatesOnLoad = function ( country_id, state_id , element_id,url )
{
	jQuery.ajax({
		  type:'POST',
		  dataType:'html',
		  data:'cid='+country_id,
		  success:function(data, textStatus){
			  
			 $('#'+element_id).html(data);
			 $('#'+element_id).val(state_id)
		 },
		url: url 
	})
}

$(document).ready(function()
{
	
	/**
	  Create Slug Thru jquery
	*/
	$("#pages_en_title").keyup(function(){
		var Text = $(this).val();
		Text = Text.toLowerCase().replace(/[^a-zA-Z0-9]+/g,'-');
		$("#pages_slug").val(Text);	
	});
	
	/**
	  Create Slug Thru jquery
	*/
	$("#pages_slug").keyup(function(){
		var Text = $(this).val();
		Text = Text.toLowerCase().replace(/[^a-zA-Z0-9]+/g,'-');
		$("#pages_slug").val(Text);	
	})
	
})