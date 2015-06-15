<div class="widecolumn alignleft widecolumn-inner">
    <div class="content">
        <div class="blue_box">
            <div class="rt"><div><?php echo __('cap_change_password', '', 'changepass') ?></div></div>
            <div class="mid">
                <?php
                echo form_tag('@reset_password', array('name' => 'frmChangePassword', 'multipart' => true, 'onSubmit' => 'this.submit(); return false'));
                echo $oForm->renderHiddenFields();
                ?>

                <div class="member_registration">
                    <?php if ($sf_user->hasFlash('error')) : ?>
                        <div class="error"><?php echo $sf_user->getFlash('error'); ?></div>
                    <?php endif; ?>

                    <label for="memberOldPassword" ><?php echo __('cap_old_password', '', 'changepass') ?>:</label>
                    <p class="mybox">
                        <?php echo $oForm['old_password']->render(array('id' => 'memberOldPassword', 'maxlength' => '20', 'class' => 'textbox', 'style' => 'width:200px;')); ?>
                    </p>
                    <br class="alignnone" />
                    <div class="error"><?php echo $oForm['old_password']->renderError(); ?></div>
                    <div class="spcr"></div>

                    <label for="memberNewPassword" ><?php echo __('cap_new_password', '', 'changepass') ?>:</label>
                    <span></span>
                    <p class="mybox">
                        <?php echo $oForm['password']->render(array('id' => 'memberNewPassword', 'maxlength' => '20', 'class' => 'textbox', 'style' => 'width:200px;')); ?>
                    </p>
                    <br class="alignnone" />
                    <div class="error"><?php echo $oForm['password']->renderError(); ?></div>
                    <div class="spcr"></div>

                    <label for="memberRetypeNewPassword" ><?php echo __('cap_retype_new_password', '', 'changepass') ?>:</label>
                    <p class="mybox">
                        <?php echo $oForm['retype_password']->render(array('id' => 'memberRetypeNewPassword', 'maxlength' => '20', 'class' => 'textbox', 'style' => 'width:200px;')); ?>
                    </p>
                    <br class="alignnone" />
                    <div class="error"><?php echo $oForm['retype_password']->renderError(); ?></div>
                    <div class="spcr"></div>

                    <label>&nbsp;</label>
                    <p><?php echo tag('input', array('type' => 'submit', 'value' => __('cap_submit', '', 'changepass'))); ?></p>
                </div>
                </form>   
                <div class="alignnone"></div>
            </div>
            <div class="rb"></div>
        </div>

    </div>
</div>
