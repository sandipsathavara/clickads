<div class="widecolumn alignleft">
    <div class="content">
        <div class="blue_box">
            <div class="rt">
                <div><?php echo __('cap_registration', '', 'register') ?></div>
            </div>
            <div class="mid">

                <?php
                echo form_tag('@register', array('name' => 'frmUser', 'multipart' => true, 'onSubmit' => 'this.submit()'));
                echo $oForm->renderHiddenFields();
                ?>                        
                <div class="member_registration">

                    <label for="email" ><?php echo __('cap_email', '', 'register') ?>:</label>
                    <p class="mybox">
                        <?php echo $oForm['email']->render(array('id' => 'email', 'maxlength' => '100', 'class' => 'textbox', 'style' => 'width:200px;')); ?>
                    </p>
                    <br class="alignnone" />
                    <div class="error"><?php echo $oForm['email']->renderError(); ?></div>
                    <div class="spcr"></div>


                    <label for="password" ><?php echo __('cap_password', '', 'register') ?>:</label>
                    <p class="mybox">
                        <?php echo $oForm['password']->render(array('id' => 'password', 'maxlength' => '20', 'class' => 'textbox', 'style' => 'width:200px;')); ?>
                    </p>
                    <br class="alignnone" />
                    <div class="error"><?php echo $oForm['password']->renderError(); ?></div>
                    <div class="spcr"></div>


                    <label for="retype_password" ><?php echo __('cap_repeat_password', '', 'register') ?>:</label>
                    <p class="mybox">
                        <?php echo $oForm['retype_password']->render(array('id' => 'retype_password', 'maxlength' => '20', 'class' => 'textbox', 'style' => 'width:200px;')); ?>
                    </p>
                    <br class="alignnone" />
                    <div class="error"><?php echo $oForm['retype_password']->renderError(); ?></div>
                    <div class="spcr"></div>

                    <label for="nickname" ><?php echo __('cap_nickname', '', 'register') ?>:</label>
                    <p class="mybox">
                        <?php echo $oForm['nickname']->render(array('id' => 'nickname', 'maxlength' => '100', 'class' => 'textbox', 'style' => 'width:200px;')); ?>
                    </p>

                    <br class="alignnone" />
                    <div class="error"><?php echo $oForm['nickname']->renderError(); ?></div>
                    <div class="spcr"></div>
                    <label>&nbsp;</label>
                    <p> 
                        <?php
                        $url = url_for('captcha/index');
                        echo link_to("<img src='$url?" . time() . "' onClick='this.src=\"$url?r=\" + Math.random() + \"&reload=1\"' border='0' class='captcha' />", '@register', array('onClick' => 'return false', 'title' => __('tit_reload_image')));
                        ?>
                    </p>

                    <br class="alignnone" />
                    <div class="spcr"></div>
                    <label for="captcha"><?php echo __('cap_verification_code', '', 'register') ?>:</label>
                    <p class="mybox">
                        <?php echo $oForm['captcha']->render(array('id' => 'captcha', 'class' => 'textbox captcha', 'style' => 'width:200px;')); ?>
                    </p>
                    <br class="alignnone" />
                    <div class="error"><?php echo $oForm['captcha']->renderError(); ?></div>
                    <div class="spcr"></div>


                    <label>&nbsp;</label>
                    <p style="margin-top:8px;">
                        <?php echo $oForm['is_accept']->render(array('id' => 'memberIsAccept', 'class' => 'inline')); ?>
                        &nbsp;&nbsp;<?php echo __('I accept the Terms and Conditions', '', 'register') ?>
                    </p>

                    <br class="alignnone" />
                    <div class="error"><?php echo $oForm['is_accept']->renderError(); ?></div>
                    <div class="spcr"></div>

                    <label>&nbsp;</label>
                    <p><?php echo tag('input', array('type' => 'submit', 'value' => __('cap_register_me', '', 'register'))); ?></p>
                </div>
                </form>
                <div class="alignnone"></div>
            </div>
            <div class="rb">
            </div>
            <div class="spcr"></div>
            <div class="spcr"></div>
        </div>
    </div>
</div>

