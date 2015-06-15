<?php if ($field->isPartial()): ?>
    <?php include_partial('posts/' . $name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php elseif ($field->isComponent()): ?>
    <?php include_component('posts', $name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php else: ?>
    <p id="<?php echo $name ?>">
        <?php echo $form[$name]->renderLabel($label) ?> 
        <?php echo $form[$name]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes) ?>


        <?php echo $form[$name]->renderError() ?>

        <?php if ($help): ?>
            <span class="help"><?php echo __($help, array(), 'messages') ?></span>
        <?php elseif ($help = $form[$name]->renderHelp()): ?>
            <span class="help"><?php echo $help ?></span>
        <?php endif; ?>
    </p>

    <?php if ($name == 'image') : ?>
        <div class="mybox">
            <ul id="list" >

                <?php 
                if (isset($posts) && $posts != '') :
                    
                   
                    foreach ($posts->getPostImages() as $oImage) :

                        $name = is_file(sfConfig::get('sf_upload_dir') . '/posts/' . $posts->getId() . '/s/' . $oImage->getImage()) ? $posts->getId() . '/s/' . $oImage->getImage() : '';

                        if ($name != '') :
                            ?>
                            <li ><?php echo image_tag('/uploads/posts/' . $name, array('alt' => $name)) . "&nbsp;&nbsp;<p id='dbrm_" . $oImage->getId() . "' >" . __('Remove') . "</p>" ?><li>
                                <?php
                            endif;
                        endforeach;
                    endif;
                    ?>		  


            </ul>
        </div>
    <?php endif;

endif;
?>
