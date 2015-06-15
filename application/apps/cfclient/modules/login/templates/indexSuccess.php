<div class="widecolumn alignleft">
    <div class="content">
        <div class="blue_box">
            <div class="rt">
                <div><?php echo __('cap_login', '', 'login') ?></div>
            </div>
            <div class="mid">
                <?php
                echo form_tag('@signin', array('name' => 'frmRegister', 'onSubmit' => 'this.submit(); return false'));
                echo $oForm->renderHiddenFields();
                ?>
                <div class="member_registration">
                    <?php if ($sf_user->hasFlash('error')) : ?>
                        <div class="error"><?php echo $sf_user->getFlash('error'); ?></div>
                    <?php endif; ?>

                    <div class="spcr"></div>
                    <label for="email" ><?php echo __('cap_email', '', 'login') ?>:</label>
                    <p class="mybox"> <?php echo $oForm['email']->render(array('id' => 'email', 'maxlength' => '100', 'class' => 'textbox', 'style' => 'width:200px;')); ?> </p>

                    <br class="alignnone" />
                    <div class="error"><?php echo $oForm['email']->renderError(); ?></div>
                    <div class="spcr"></div>

                    <label for="password" ><?php echo __('cap_password', '', 'login') ?>:</label>
                    <p class="mybox"> <?php echo $oForm['password']->render(array('id' => 'password', 'maxlength' => '16', 'class' => 'textbox', 'style' => 'width:200px;')); ?> </p>

                    <br class="alignnone" />
                    <div class="error"><?php echo $oForm['password']->renderError(); ?></div>
                    <div class="spcr"></div>

                    <label for="isremember" >&nbsp;</label>
                    <p align="left"> <?php echo $oForm['isremember']->render(array('id' => 'isremember', 'maxlength' => '16', 'value' => true)); ?> &nbsp; <?php echo __('cap_rememberme', '', 'login'); ?> </p>

                    <label>&nbsp;</label>
                    <p> <?php echo link_to(__('cap_forget_password', '', 'login'), '@forget_password') ?> </p>

                    <br class="alignnone" />
                    <label>&nbsp;</label>
                    <p> <h3><?php echo link_to(__('cap_create_new_account', '', 'login'), '@register') ?> </h3></p>


                    <label>&nbsp;</label>
                    <p><?php echo tag('input', array('type' => 'submit', 'value' => __('cap_login_me', '', 'login'))); ?></p>
                </div>
                </form>
                <div class="alignnone"></div>
            </div>
            <div class="rb">
            </div>
        </div>
    </div>
</div>
