<?php use_helper('Text');?>
<div class="block small left ">
	<div class="block_head">
		<div class="bheadl"></div>
		<div class="bheadr"></div>
		<h2>Total Active Users</h2>
	</div>
	
	<div class="block_content" style="font-size:18px;">
		<?php echo $totalUsers ; ?>
	</div>
		<div class="bendl"></div>
	<div class="bendr"></div>

</div>

<div class="block small right">
	<div class="block_head">
		<div class="bheadl"></div>
		<div class="bheadr"></div>
		<h2>Total Active Posts</h2>
	</div>
	
	<div class="block_content" style="font-size:18px;">
		<?php echo $totalPosts ; ?>
	</div>
		<div class="bendl"></div>
	<div class="bendr"></div>

</div>

<div class="block">
	<div class="block_head">
		<div class="bheadl"></div>
		<div class="bheadr"></div>
		<h2>Site Stats Of Year : <?php echo date('Y'); ?></h2>
		<ul class="tabs">
			<li><a href="#days">Per days</a></li>
			<li><a href="#months">Per months</a></li>
		</ul>
	</div>		<!-- .block_head ends -->
	<div class="block_content tab_content" id="days">
		<table class="stats" rel="line" cellpadding="0" cellspacing="0" width="100%">
			<thead>
				<tr>
					<td>&nbsp;</td>
					<?php for($i=1;$i<=date('j');$i++): ?>
						<th scope="col"><?php echo $i; ?></th>
					<?php endfor; ?>
				</tr>
			</thead>
			
			<tbody>
				<tr>
					<th>New Register</th>
					<?php for($i=1;$i<=date('j');$i++): ?>
						<td><?php echo isset($arrCurrUsers[$i]) ? $arrCurrUsers[$i] : 0; ?></td>
					<?php endfor; ?>
				</tr>

				<tr>
					<th>New Posts</th>								
					<?php for($i=1;$i<=date('j');$i++): ?>
						<td><?php echo isset($arrCurrPosts[$i]) ? $arrCurrPosts[$i] : 0; ?></td>
					<?php endfor; ?>
				</tr>
			</tbody>
		</table>
		
	</div>		<!-- .block_content ends -->
	<div class="block_content tab_content" id="months">
		<table class="stats" rel="bar" cellpadding="0" cellspacing="0" width="100%">
			<thead>
				<tr>
					<td>&nbsp;</td>
					<th scope="col">JAN</th>
					<th scope="col">FEB</th>
					<th scope="col">MAR</th>
					<th scope="col">APR</th>
					<th scope="col">MAY</th>
					<th scope="col">JUN</th>
					<th scope="col">JUL</th>
					<th scope="col">AUG</th>
					<th scope="col">SEP</th>
					<th scope="col">OCT</th>
					<th scope="col">NOV</th>
					<th scope="col">DEC</th>
					<th scope="col">JAN</th>
					<th scope="col">FEB</th>
				</tr>
			</thead>
			
			<tbody>
				<tr>
					<th scope="row">Register Users</th>
					
					<?php for($i=1;$i<=12;$i++): ?>
						<td><?php echo isset($arrMonthUsers[$i]) ? $arrMonthUsers[$i] : 0; ?></td>
					<?php endfor; ?>
					
					
				</tr>
				
				<tr>
					<th scope="row">Posts Classifieds</th>	
					<?php for($i=1;$i<=12;$i++): ?>
						<td><?php echo isset($arrMonthPosts[$i]) ? $arrMonthPosts[$i] : 0; ?></td>
					<?php endfor; ?>						
				</tr>
			</tbody>
		</table>	
	
	</div>		<!-- .block_content ends -->
	
	<div class="bendl"></div>
	<div class="bendr"></div>
</div>
<!-- .block ends -->
<div class="block small left">

	<div class="block_head">
		<div class="bheadl"></div>
		<div class="bheadr"></div>
		<h2>New Users</h2>	
	</div>		<!-- .block_head ends -->
	
	<div class="block_content">
			<table cellpadding="0" cellspacing="0" width="100%" class="sortable">
				<tbody>
				 <?php foreach ($newest10Users as $oUser) : ?>	
					 <tr>
						 <td><?php echo link_to($oUser->getNickname(),url_for('@users_edit?id='.$oUser->getId())) ?></td>
						 <td><?php echo _auto_link_email_addresses ( $oUser->getEmail() )?></a></td>
					 </tr>
				 <?php endforeach; ?>
				</tbody>
			</table>
	  </div>
		    <!-- .block_content ends -->
	<div class="bendl"></div>
	<div class="bendr"></div>
</div>		<!-- .block.small.left ends -->

<div class="block small right">

	<div class="block_head">
		<div class="bheadl"></div>
		<div class="bheadr"></div>
		<h2>New Posts</h2>
	</div>		<!-- .block_head ends -->
	
	<div class="block_content">
		<table cellpadding="0" cellspacing="0" width="100%" class="sortable">
			<tbody>
			 <?php foreach ($newest10Posts as $oPost) : ?>	
				 <tr>
					 <td><?php echo link_to($oPost->getTitle(), url_for('/index.php/'.slugify($oPost->getCategories()->getName()."-".$oPost->getCategories()->getId() ).'/'.slugify($oPost->getTitle()."-".$oPost->getId()).'.html' ),array('target' => '_blank') ) ?></td>
				 </tr>
			 <?php endforeach; ?>
			</tbody>
		</table>
		
	</div>		<!-- .block_content ends -->
	
	<div class="bendl"></div>
	<div class="bendr"></div>
	
</div>		<!-- .block.small.right ends -->

			
			