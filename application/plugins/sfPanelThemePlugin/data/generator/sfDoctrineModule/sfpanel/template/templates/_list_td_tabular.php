<?php foreach ($this->configuration->getValue('list.display') as $name => $field): ?>
<?php echo $this->addCredentialCondition(sprintf(<<<EOF
<td >
  [?php echo %s ?]
</td>

EOF
,  $this->renderField($field)), $field->getConfig()) ?>
<?php endforeach; ?>
