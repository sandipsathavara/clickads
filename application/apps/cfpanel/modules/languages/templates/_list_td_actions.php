<td class="delete">
    <?php echo $helper->linkToEdit($languages, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
	<?php 
	  if($languages->getIsDefault() == 0 &&  $languages->getCulture() != 'en') :
		   echo "&nbsp;|&nbsp;".$helper->linkToDelete($languages, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ;
		endif ; 
	?>
	 
</td>
