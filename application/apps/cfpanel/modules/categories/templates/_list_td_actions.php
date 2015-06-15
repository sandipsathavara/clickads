<span style="float:right;">
	<?php if ( ! $categories->getNode()->isLeaf() ) :  ?>
	   <?php echo link_to(__('Add Child', array(), 'messages'), 'categories/ListNew?id='.$categories->getId(), array()) ?>&nbsp;|
	 <?php else: 
	 	echo str_repeat('&nbsp;',15);
	   endif; ?>	
    <?php echo $helper->linkToEdit($categories, array( 'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>&nbsp;|&nbsp;<?php echo $helper->linkToDelete($categories, array( 'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>

</span>