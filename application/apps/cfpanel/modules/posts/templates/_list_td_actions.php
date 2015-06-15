<td class="delete">
    <?php echo link_to('Preview', url_for('/index.php/' . slugify($posts->getCategories()->getName() . "-" . $posts->getCategories()->getId()) . '/' . slugify($posts->getTitle() . "-" . $posts->getId()) . '.html'), array('target' => '_blank')) ?>&nbsp;|&nbsp;
    <?php if (SettingTable::getSettingByName('is_verify_post')->getValue() == 'on') : ?>
        <?php echo $helper->linkToStatus($posts, array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'edit', 'label' => 'Status',)) ?>&nbsp;|&nbsp;
    <?php endif; ?>
    <?php echo $helper->linkToEdit($posts, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Edit',)) ?>&nbsp;|&nbsp;
    <?php echo $helper->linkToDelete($posts, array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
</td>
