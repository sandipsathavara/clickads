<div class="block_content">
[?php include_partial('<?php echo $this->getModuleName() ?>/flashes') ?]
  [?php if (!$pager->getNbResults()): ?]
  	 <div class="message errormsg"><p>[?php echo __('No result', array(), 'sf_admin') ?]</p></div>
  [?php else: ?]
    <table cellpadding="0" cellspacing="0" width="100%" class="sortable">
      <thead>
        <tr>
		<?php if ($this->configuration->getValue('list.batch_actions')): ?>
				  <th><input id="sf_admin_list_batch_checkbox" type="checkbox" onclick="checkAll();" /></th>
		<?php endif; ?>
				  [?php include_partial('<?php echo $this->getModuleName() ?>/list_th_<?php echo $this->configuration->getValue('list.layout') ?>', array('sort' => $sort)) ?]
		<?php if ($this->configuration->getValue('list.object_actions')): ?>
				  <th>&nbsp;</th>
		<?php endif; ?>
        </tr>
      </thead>
      <tbody>
        [?php foreach ($pager->getResults() as $i => $<?php echo $this->getSingularName() ?>): $odd = fmod(++$i, 2) ? 'odd' : 'even' ?]
          <tr >
			<?php if ($this->configuration->getValue('list.batch_actions')): ?>
				  [?php include_partial('<?php echo $this->getModuleName() ?>/list_td_batch_actions', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'helper' => $helper)) ?]
			<?php endif; ?>
		            [?php include_partial('<?php echo $this->getModuleName() ?>/list_td_<?php echo $this->configuration->getValue('list.layout') ?>', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>)) ?]
			<?php if ($this->configuration->getValue('list.object_actions') ): ?>
				  [?php include_partial('<?php echo $this->getModuleName() ?>/list_td_actions', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'helper' => $helper)) ?]
			<?php endif; ?>
          </tr>
        [?php endforeach; ?]
      </tbody>
    </table>
	
    <div class="tableactions">[?php include_partial('<?php echo $this->getModuleName() ?>/list_batch_actions', array('helper' => $helper)) ?]</div>	
	
	<div class="pagination right">
		[?php if ($pager->haveToPaginate()): ?]
		  [?php include_partial('<?php echo $this->getModuleName() ?>/pagination', array('pager' => $pager)) ?]
		[?php endif; ?]
		<br />	
		[?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults(), 'sf_admin') ?]
		
		[?php if ($pager->haveToPaginate()): ?]
		  [?php echo __('(page %%page%%/%%nb_pages%%)', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage()), 'sf_admin') ?]
		[?php endif; ?]
    </div>
	[?php endif; ?]			  
</div>
<script type="text/javascript">
/* <![CDATA[ */
function checkAll()
{
  var boxes = document.getElementsByTagName('input'); for(var index = 0; index < boxes.length; index++) { box = boxes[index]; if (box.type == 'checkbox' && box.className == 'sf_admin_batch_checkbox') box.checked = document.getElementById('sf_admin_list_batch_checkbox').checked } return true;
}
/* ]]> */
</script>
