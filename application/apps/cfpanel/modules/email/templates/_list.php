<div class="block_content">
<?php include_partial('email/flashes') ?>
  <?php if (!$pager->getNbResults()): ?>
  	 <div class="message errormsg"><p><?php echo __('No result', array(), 'sf_admin') ?></p></div>
  <?php else: ?>
    <table cellpadding="0" cellspacing="0" width="100%" class="sortable">
      <thead>
        <tr>
						  <?php include_partial('email/list_th_tabular', array('sort' => $sort)) ?>
						  <th>&nbsp;</th>
		        </tr>
      </thead>
      <tbody>
        <?php foreach ($pager->getResults() as $i => $emails): $odd = fmod(++$i, 2) ? 'odd' : 'even' ?>
          <tr >
							  <?php include_partial('email/list_td_batch_actions', array('emails' => $emails, 'helper' => $helper)) ?>
					            <?php include_partial('email/list_td_tabular', array('emails' => $emails)) ?>
							  <?php include_partial('email/list_td_actions', array('emails' => $emails, 'helper' => $helper)) ?>
			          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
	
    <div class="tableactions"><?php include_partial('email/list_batch_actions', array('helper' => $helper)) ?></div>	
	
	<div class="pagination right">
		<?php if ($pager->haveToPaginate()): ?>
		  <?php include_partial('email/pagination', array('pager' => $pager)) ?>
		<?php endif; ?>
		<br />	
		<?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults(), 'sf_admin') ?>
		
		<?php if ($pager->haveToPaginate()): ?>
		  <?php echo __('(page %%page%%/%%nb_pages%%)', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage()), 'sf_admin') ?>
		<?php endif; ?>
    </div>
	<?php endif; ?>			  
</div>
<script type="text/javascript">
/* <![CDATA[ */
function checkAll()
{
  var boxes = document.getElementsByTagName('input'); for(var index = 0; index < boxes.length; index++) { box = boxes[index]; if (box.type == 'checkbox' && box.className == 'sf_admin_batch_checkbox') box.checked = document.getElementById('sf_admin_list_batch_checkbox').checked } return true;
}
/* ]]> */
</script>
