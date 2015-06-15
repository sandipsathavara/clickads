<td class="delete">
<?php 
$i=0;
foreach ($this->configuration->getValue('list.object_actions') as $name => $params): 
if(0 != $i) :
echo "&nbsp;|&nbsp;";
endif;
if ('_delete' == $name): ?>
<?php echo $this->addCredentialCondition('[?php echo $helper->linkToDelete($'.$this->getSingularName().', '.$this->asPhp($params).') ?]', $params) ?>
<?php elseif ('_edit' == $name): ?>
<?php echo $this->addCredentialCondition('[?php echo $helper->linkToEdit($'.$this->getSingularName().', '.$this->asPhp($params).') ?]', $params) ?>
<?php else: ?>
<?php echo $this->addCredentialCondition($this->getLinkToAction($name, $params, true), $params) ?>
<?php endif; ?>

<?php $i++; endforeach; ?>

</td>
