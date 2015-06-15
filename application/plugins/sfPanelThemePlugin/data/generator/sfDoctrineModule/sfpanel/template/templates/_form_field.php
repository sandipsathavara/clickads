[?php if ($field->isPartial()): ?]
  [?php include_partial('<?php echo $this->getModuleName() ?>/'.$name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?]
[?php elseif ($field->isComponent()): ?]
  [?php include_component('<?php echo $this->getModuleName() ?>', $name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?]
[?php else: ?]
      <p id="[?php echo $name ?]">
		  [?php echo $form[$name]->renderLabel($label) ?] 
		  [?php echo $form[$name]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes) ?]
		  
		  [?php if ( $field->isReal() ) : ?]
			  [?php echo $form[$name]->renderError() ?]
		  [?php endif; ?]	  
		  
		  [?php if ($help): ?]
			<span class="help">[?php echo __($help, array(), '<?php echo $this->getI18nCatalogue() ?>') ?]</span>
		  [?php elseif ($help = $form[$name]->renderHelp()): ?]
			<span class="help">[?php echo $help ?]</span>
		  [?php endif; ?]
      </p>
[?php endif; ?]


 