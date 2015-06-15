<td>
 <?php  if($languages->getIsDefault() == 0 &&  $languages->getCulture() != 'en') : ?>	  
  <input type="checkbox" name="ids[]" value="<?php echo $languages->getPrimaryKey() ?>" class="sf_admin_batch_checkbox" />
 <?php endif; ?>
  
</td>
