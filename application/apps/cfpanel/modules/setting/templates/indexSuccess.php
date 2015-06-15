<?php
$oFrmSetting = $oForm['setting']
?>
<div class="block">

    <div class="block_head">
        <div class="bheadl"></div>
        <div class="bheadr"></div>
        <h2>Setting</h2>
    </div>		<!-- .block_head ends -->

    <div class="block_content">

        <?php
        echo form_tag('@setting', array('name' => 'frmUser', 'multipart' => true, 'onSubmit' => 'this.submit()'));
        echo $oFrmSetting->renderHiddenFields();
        if ($sf_user->hasFlash('notice')):
            ?>
            <div class="message success"><?php echo $sf_user->getFlash('notice') ?></div>
        <?php endif; ?>

        <p>
            <label for="website_title">Site Title:</label><br />
            <?php echo $oFrmSetting['website_title']['value']->render(array('id' => 'website_title', 'class' => 'text small')); ?>
            <span class="error"><?php echo $oFrmSetting['website_title']['value']->renderError(); ?></span>

        </p>

        <p class="fileupload">
            <label for="fileupload">Site Logo:</label><br />
            <?php echo $oFrmSetting['site_logo']['value']->render(array('id' => 'fileupload')); ?>  
            <span class="error"><?php echo $oFrmSetting['site_logo']['value']->renderError(); ?></span>

        </p>

        <p class="fileupload">
            <label for="favicon">Site favicon:</label><br />
            <?php echo $oFrmSetting['favicon']['value']->render(array('id' => 'favicon')); ?>
            <span class="error"><?php echo $oFrmSetting['favicon']['value']->renderError(); ?></span>
        </p>


        <p>
            <label for="admin_email">Admin email:</label><br />
            <?php echo $oFrmSetting['admin_email']['value']->render(array('id' => 'admin_email', 'class' => 'text small')); ?><br />
            <span class="error"><?php echo $oFrmSetting['admin_email']['value']->renderError(); ?></span>
        </p>

        <p>
            <label for="is_verify_user">Verify user:</label>
            <?php echo $oFrmSetting['is_verify_user']['value']->render(array('id' => 'is_verify_user', 'class' => 'checkbox', 'value' => 'on')); ?>
            <span>User must verify his email address</span><br />
            <span class="error"><?php echo $oFrmSetting['is_verify_user']['value']->renderError(); ?></span>
        </p>

        <p>
            <label for="is_user_login">User login:</label>
            <?php echo $oFrmSetting['is_user_login']['value']->render(array('id' => 'is_user_login', 'class' => 'checkbox', 'value' => 'on')); ?>
            <span>Users must be registered and logged in to for ads</span><br />

            <span class="error"><?php echo $oFrmSetting['is_user_login']['value']->renderError(); ?></span>
        </p>

        <p>
            <label for="is_verify_post">Verify post:</label>
            <?php echo $oFrmSetting['is_verify_post']['value']->render(array('id' => 'is_verify_post', 'class' => 'checkbox', 'value' => 'on')); ?>
            <span>A classified post is being held for moderation</span><br />
            <span class="error"><?php echo $oFrmSetting['is_verify_post']['value']->renderError(); ?></span>
        </p>

        <hr/>

        <p>
            <?php echo tag('input', array('type' => 'submit', 'value' => 'submit', 'class' => 'submit mid')); ?>
        </p>
        </form>


    </div>		<!-- .block_content ends -->

    <div class="bendl"></div>
    <div class="bendr"></div>

</div>


