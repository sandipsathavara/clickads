<pre>
    <?php echo __('cap_dear', '', 'forgetpassword') . ' ' . ucfirst($nickname) ?>,

    <?php echo __('cap_text_email', '', 'forgetpassword') ?>:<strong><?php echo $email ?></strong>

    <?php echo __('cap_text_password', '', 'forgetpassword') ?>:<strong><?php echo $password ?></strong>

    <?php echo link_to(__('cap_click', '', 'forgetpassword'), '@signin') ?> 

    <?php echo __('cap_support', '', 'forgetpassword') ?>

</pre>
