<div><h1><?php echo link_to(image_tag('/images/bq_logo_footer.png'),'@dashboard')?></h1></div>
<div>&nbsp;</div>
<div id="header">
	<div class="hdrl"></div>
	<div class="hdrr"></div>
	<ul id="nav">
		<li class="active"><?php echo link_to('Dashboard', '@dashboard') ?> </li>
		<li><?php echo link_to('Users', '@users') ?></li>
		<li><?php echo link_to('Posts', '@posts') ?></li>
                <li><?php echo link_to('Categories', '@categories') ?></li>
                <li><?php echo link_to('Location', '@setting') ?>
                    <ul>
			<li><?php echo link_to('Countries', '@countries') ?></li>
			<li><?php echo link_to('States', '@states') ?></li>
			<li><?php echo link_to('Cities', '@citys') ?></li>
                        <li><?php echo link_to('Import Location', '@location_import') ?></li>
                        
		    </ul>
                </li>
		
		<li><?php echo link_to('Ads', '@ads') ?></li>
		<li><?php echo link_to('Setting', '@setting') ?>
                    <ul>
			<li><?php echo link_to('General', '@setting') ?></li>
			<li><?php echo link_to('Pages ', '@pages') ?></li>
			<li><?php echo link_to('Emails', '@email') ?></li>
                        <li><?php echo link_to('Languages', '@languages') ?></li>
                        <li><?php echo link_to('Feature List', '@featurelist') ?></li>
                        
		    </ul>
                </li>
        
	</ul>
	<p class="user">Hello, <?php echo link_to('Admin'  , '@users_edit?id='.$sf_user->getAttribute('id','','oUserInfoClient'), array('title' => 'Logout')); ?>  | <?php echo link_to('Logout'  , 'login/logout', array('title' => 'Logout')); ?></p>
</div>
<!-- #header ends -->
