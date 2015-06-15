<div class="widecolumn alignleft">
    <div class="content">
        <div class="blue_box">
            <div class="rt">
                <div><?php echo __('cap_forgetpassword', '', 'forgetpassword') ?></div>
            </div>
            <div class="mid">
                <?php
                echo form_tag('@forget_password', array('name' => 'frmForget', 'onSubmit' => 'this.submit(); return false'));
                echo $oForm->renderHiddenFields();
                ?>
                <div class="member_registration">
                    <?php if ($sf_user->hasFlash('error')) : ?>
                        <div class="error"><?php echo $sf_user->getFlash('error'); ?></div>
                    <?php endif; ?>

                    <br class="alignnone" />
                    <div class="error"><?php echo $oForm['email']->renderError(); ?></div>
                    <div class="spcr"></div>

                    <label for="email" ><?php echo __('cap_email', '', 'forgetpassword') ?>:</label>
                    <p class="mybox"> <?php echo $oForm['email']->render(array('id' => 'email', 'class' => 'textbox', 'style' => 'width:200px;')); ?> </p>



                    <label>&nbsp;</label>
                    <p>
                        <?php echo tag('input', array('type' => 'submit', 'value' => __('cap_reset', '', 'forgetpassword'))); ?>

                    </p>
                </div>
                </form>
                <div class="alignnone"></div>
            </div>
            <div class="rb">
            </div>
        </div>
    </div>
</div>



