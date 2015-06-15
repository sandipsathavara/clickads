[?php use_helper('I18N', 'Date') ?]
[?php include_partial('<?php echo $this->getModuleName() ?>/assets') ?]

<div class="block" id="searchBlock" style="display:none;">
 	<div class="block_head" >
		<div class="bheadl"></div>
		<div class="bheadr"></div>
		<h2>[?php echo '<?php echo $this->configuration->getFilterTitle() ?>' ?]</h2>
	</div>	
 	 [?php include_partial('<?php echo $this->getModuleName() ?>/filters', array('form' => $filters, 'configuration' => $configuration)) ?]
		<div class="bendl"></div>
	<div class="bendr"></div>
  </div>

<div class="block">

	<div class="block_head">
		<div class="bheadl"></div>
		<div class="bheadr"></div>
		<h2>[?php echo <?php echo $this->getI18NString('list.title') ?> ?]</h2>
		<ul>
			<li><a href="javascript:void(0);" id="showSearch">Search</a></li>
			<li>[?php include_partial('<?php echo $this->getModuleName() ?>/list_actions', array('helper' => $helper)) ?]</li>
		</ul>
	</div>	

<?php if ($this->configuration->hasFilterForm()): ?>
  <!-- div id="sf_admin_bar">
      [?php include_partial('<?php echo $this->getModuleName() ?>/list_header', array('pager' => $pager)) ?]
    [?php include_partial('<?php echo $this->getModuleName() ?>/filters', array('form' => $filters, 'configuration' => $configuration)) ?]
  </div -->
<?php endif; ?>

	<?php if ($this->configuration->getValue('list.batch_actions')): ?>
		<form action="[?php echo url_for('<?php echo $this->getUrlForAction('collection') ?>', array('action' => 'batch')) ?]" method="post">
	<?php endif; ?>
		[?php include_partial('<?php echo $this->getModuleName() ?>/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?]
	<?php if ($this->configuration->getValue('list.batch_actions')): ?>
		</form>
	<?php endif; ?>

		<div class="bendl"></div>
	<div class="bendr"></div>
  </div>

  <div id="sf_admin_footer">
    [?php include_partial('<?php echo $this->getModuleName() ?>/list_footer', array('pager' => $pager)) ?]
  </div>

