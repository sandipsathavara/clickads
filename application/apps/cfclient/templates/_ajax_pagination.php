<?php  if ($pager->haveToPaginate()) : ?>
<div class="pagination"> 
 <ul class="paging">
        <?php echo '<li>'.link_to( '&lt;&lt;' , url_for($sf_request->getScriptName().$sf_request->getPathInfo(),true).'?page=1' , array('id'=>'page0') ).'</li>'; 
              echo '<li>'.link_to( '&lt;'  , url_for($sf_request->getScriptName().$sf_request->getPathInfo(),true).'?page='.$pager->getPreviousPage() , array('id'=>'page'.$pager->getPreviousPage()) ).'</li>'; 
	
			foreach ($pager->getLinks() as $page): 
			
				if ($page == $pager->getPage()): 
					echo '<li>'.link_to( $page , url_for($sf_request->getScriptName().$sf_request->getPathInfo(),true).'?page=1' , array('class'=>'active','id'=>'page0') ).'</li>';
				else: 
					echo "<li>".link_to( $page , url_for($sf_request->getScriptName().$sf_request->getPathInfo(),true).'?page='.$page , array('id'=>'page'.$page) )."</li>"; 
				endif; 
				
	  	   endforeach; 
		   
	   echo "<li>".link_to( '&gt;'  , url_for($sf_request->getScriptName().$sf_request->getPathInfo(),true).'?page='.$pager->getNextPage() , array('id'=>'page'.$pager->getNextPage()) )."</li>"; 
       echo "<li>".link_to( '&gt;&gt;' , url_for($sf_request->getScriptName().$sf_request->getPathInfo(),true).'?page='.$pager->getLastPage() , array('id'=>'page'.$pager->getLastPage()) )."</li>"; 
   ?>

        </ul>
</div>   
<?php endif ; ?>