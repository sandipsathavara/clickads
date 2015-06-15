<select name="cat" class="select alignleft">
    <option value=""><?php echo __('cap_select_category') ?></option>
    <?php
    foreach ($objRs as $k => $oCat) :
        if ($oCat->getLevel() == 0) :
            ?>
            <optgroup label="<?php echo $oCat->getName() ?>">
            <?php else: ?>
                <option value="<?php echo $oCat->getId() ?>" <?php echo ($action == $oCat->getId()) ? 'selected' : ''; ?> >&nbsp;&nbsp;&nbsp;<?php echo $oCat->getName() ?></option>    
            <?php
            endif;
            if ($oCat->getLevel() == 0) :
                ?>
            </optgroup>
    <?php endif; ?>
<?php endforeach; ?>
</select>
