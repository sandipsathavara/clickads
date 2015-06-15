<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<?php include_title() ?>
<?php include_http_metas() ?>
<?php include_metas() ?>
<?php include_stylesheets() ?>

<!--[if lt IE 8]><style type="text/css" media="all">@import url("<?php echo url_for('sfPanelThemePlugin/css')?>/ie.css");</style><![endif]-->
<?php include_javascripts() ?>

<link rel="shortcut icon" href="/favicon.ico" />
</head>

<body>
	<div id="hld"> <!-- hld begins -->
	   <div class="wrapper"> <!-- wrapper begins -->
	  <?php 
            if($sf_user->isAuthenticated()) :  
                include_partial('global/top');  
            else :		
      ?>			 
	  
    <div id="login_company_logo" align="center" class="login_company_logo" style="padding:0;" > 
        <?php echo image_tag('bq_logo_footer.png', array('alt' => 'Classifieds Logo')) ?>
      </div>
	<?php endif; ?>
	
	  <div class="container-fluid"> 
		  <?php echo $sf_content ?> 
	  </div>
	<?php if($sf_user->isAuthenticated()) : ?>  
	      <div id="footer"><?php  echo include_partial('global/footer'); ?></div>
	<?php endif; ?> 
	  
      
		</div>	 <!-- wrapper ends -->
	</div>	 <!-- hld ends -->



</body>
</html>





