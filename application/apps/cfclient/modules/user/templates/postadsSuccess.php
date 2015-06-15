<?php
use_javascript('/sfDependentSelectPlugin/js/SelectDependiente');
use_javascript('swfobject-895.js');
?>

<style>
    #list li img {
        margin: 0 auto;
        display: block;
    }
    #list li {
        margin: 0.5em 0.30em;
        padding: 0;
        display: inline-block;
        text-align: center;
        vertical-align: top;
    }
    #list li p {
        text-align: center;
        width: 100%;
        margin: 0 auto;
        cursor: pointer;
    }

    .name
    {
        color: #1B1B1B;
        font-size: 1.17em;
    }

    .total_price {
        background: none repeat scroll 0 0 #F4F4F4;
        border-top: 1px solid #CECECE;
        padding: 15px;
        text-align: right;
        position:relative;

    }





</style>
<div class="widecolumn alignleft">
    <div class="content">
        <div class="blue_box">
            <div class="rt"><h2><?php echo __('cap_post_ad', '', 'postad') ?></h2></div>

            <div style="display: none" id="warn-message-noflash">
                <p>The Adobe Flash Player or an HTML5 supported browser is required for image upload.
                    <a  href='http://get.adobe.com/flashplayer'>
                        Get the latest Flash Player</a></p>
            </div>			  

            <div class="mid">
                <?php
                echo form_tag('@add_post_ads', array('name' => 'frm', 'multipart' => true, 'onSubmit' => 'this.submit()'));
                echo $oForm->renderHiddenFields();
                ?>                        
                <div class="member_registration">

                    <label for="title" > <span class='required' >*</span><?php echo __('cap_location', '', 'postad') ?>:</label>
                    <p class="mybox"><?php echo $oForm['state_id']->render(array('id' => 'posts_state_id')); ?></p>
                    <p class="mybox"><?php echo $oForm['city_id']->render(array('id' => 'posts_city_id')); ?></p>
                    <br class="alignnone" />
                    <div class="error"><?php echo $oForm['state_id']->renderError(); ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $oForm['city_id']->renderError(); ?>
                    </div>


                    <label for="title" > <span class='required' >*</span><?php echo __('cap_category', '', 'postad') ?>:</label>
                    <p class="mybox"><?php echo $oForm['cat_id']->render(array('id' => 'posts_cat_id')); ?></p>

                    <br class="alignnone" />
                    <div class="error"><?php echo $oForm['cat_id']->renderError(); ?></div>
                    <div class="spcr"></div>


                    <label for="title" > <span class='required' >*</span><?php echo __('cap_title', '', 'postad') ?>:</label>
                    <p class="mybox"><?php echo $oForm['title']->render(array('id' => 'title', 'maxlength' => '255', 'class' => 'textbox', 'style' => 'width:400px;')); ?></p>

                    <br class="alignnone" />
                    <div class="error"><?php echo $oForm['title']->renderError(); ?></div>
                    <div class="spcr"></div>


                    <label for="title" > <span class='required' >*</span><?php echo __('cap_photo', '', 'postad') ?>:</label>
                    <p class="mybox">
                        <?php echo __('upload_multiple_images'); ?>&nbsp;&nbsp;&nbsp;<br />

                        <?php echo $oForm['image']->render(array('id' => 'image', 'multiple ' => 'multiple', 'name' => 'posts[image][]')); ?>
                    </p>

                    <br class="alignnone" />
                    <div class="error"><?php echo $oForm['image']->renderError(); ?></div>
                    <div class="spcr"></div>


                    <label for="title" >&nbsp;</label>

                    <div class="mybox">
                        <ul id="list" >

                            <?php
                            if (isset($objPost) && $objPost != '') :
                                foreach ($objPost->getPostImages() as $oImage) :

                                    $name = is_file(sfConfig::get('sf_upload_dir') . '/posts/' . $objPost->getId() . '/s/' . $oImage->getImage()) ? $objPost->getId() . '/s/' . $oImage->getImage() : '';

                                    if ($name != '') :
                                        ?>
                                        <li ><?php echo image_tag('/uploads/posts/' . $name, array('alt' => $name)) . "&nbsp;&nbsp;<p id='dbrm_" . $oImage->getId() . "' >" . __('cap_remove') ?> </p><li>
                                            <?php
                                        endif;
                                    endforeach;
                                endif;
                                ?>		  


                        </ul>
                    </div>

                    <br class="alignnone" />

                    <br class="alignnone" />
                    <label for="posts_description" ><span class='required' >*</span><?php echo __('cap_description', '', 'postad') ?>:</label>
                    <p>
                        <?php echo $oForm['description']->render(array('id' => 'posts_description', 'style' => 'width:400px;')); ?>
                    </p>

                    <br class="alignnone" />
                    <div class="error"><?php echo $oForm['description']->renderError(); ?></div>
                    <div class="spcr"></div>

                    <label for="price" ><?php echo __('cap_price', '', 'postad') ?>:</label>
                    <p class="mybox">
                        <?php echo $oForm['price']->render(array('id' => 'price', 'maxlength' => '13', 'class' => 'textbox', 'style' => 'width:200px;'));
                        ?>
                    </p>


                    <br class="alignnone" />
                    <div class="error"><?php echo $oForm['price']->renderError(); ?></div>
                    <div class="spcr"></div>

                    <?php if (!$oForm['lang']->isHidden()) : ?>
                        <label for="language" ><span class='required' >*</span><?php echo __('cap_language', '', 'postad') ?>:</label>
                        <p class="mybox">
                            <?php echo $oForm['lang']->render(array('id' => 'language')); ?>
                        </p>

                        <br class="alignnone" />
                        <div class="error"><?php echo $oForm['lang']->renderError(); ?></div>
                        <div class="spcr"></div>
                    <?php endif; ?>

                    <div class="seller"><h2><?php echo __('cap_seller_info', '', 'postad') ?></h2></div>						

                    <br class="alignnone" />
                    <label for="phone" ><span class='required' >*</span><?php echo __('cap_name', '', 'postad') ?>:</label>
                    <p class="mybox">
                        <?php echo $oForm['name']->render(array('id' => 'name', 'maxlength' => '100', 'class' => 'textbox', 'style' => 'width:400px;')); ?>
                    </p>

                    <br class="alignnone" />
                    <div class="error"><?php echo $oForm['name']->renderError(); ?></div>
                    <div class="spcr"></div>

                    <label for="phone" ><span class='required' >*</span><?php echo __('cap_phone', '', 'postad') ?>:</label>
                    <p class="mybox">
                        <?php echo $oForm['phone']->render(array('id' => 'phone', 'maxlength' => '100', 'class' => 'textbox', 'style' => 'width:400px;')); ?>
                    </p>

                    <br class="alignnone" />
                    <div class="error"><?php echo $oForm['phone']->renderError(); ?></div>
                    <div class="spcr"></div>

                    <label for="reply_to" ><span class='required' >*</span><?php echo __('cap_email', '', 'postad') ?>:</label>
                    <p class="mybox">
                        <?php echo $oForm['reply_to']->render(array('id' => 'reply_to', 'maxlength' => '255', 'class' => 'textbox', 'style' => 'width:400px;')); ?>
                    </p>

                    <br class="alignnone" />
                    <div class="error"><?php echo $oForm['reply_to']->renderError(); ?></div>
                    <div class="spcr"></div>

                    <?php if($sf_params->get('post_id') == '' ):  ?>    
                    <div class="seller"><h2><?php echo __('cap_featured_ad', '', 'postad') ?></h2></div>	
                    <br class="alignnone" />
                    <label>&nbsp;</label>
                    <p class="mybox">
                        <?php echo $oForm['is_featured']->render(array('id' => 'is_featured', 'maxlength' => '255', 'value' => 1)); ?>
                        &nbsp;<b  class="name"><?php echo __('cap_featured_list', '', 'postad') ?> </b> <?php echo format_currency(sfConfig::get('feature_monthly_price'), sfConfig::get('currency_code')) ?> <br> 
                            <span class="description"><?php echo __('help_featured_list', '', 'postad') ?></span>
                            <br/>
                    </p>
                    <?php endif; ?>    
                    <br class="alignnone" />
                    <div class="spcr"></div>
                    <label>&nbsp;</label>
                    <p>
                        <?php echo tag('input', array('type' => 'submit', 'style' => 'width: 235px;', 'name' => 'submit_complete', 'value' => __('cap_post', '', 'postad'))); ?>&nbsp;
                    </p>
                </div>


                </form>
                <div class="alignnone"></div>
            </div>
            <div class="rb"></div>
        </div>
    </div>	
</div>

<script language="javascript">

    var supportFlash = !!(swfobject.getFlashPlayerVersion().major >= 10)
    var useFileApi = (typeof FileReader !== "undefined");

    if (!useFileApi && !supportFlash) {
        $("#warn-message-noflash").show();
    }


    $(document).ready(function() {


        $("#image").change(function(evt) {

            var files = evt.target.files; // FileList object

            // Loop through the FileList and render image files as thumbnails.
            for (var i = 0, f; f = files[i]; i++) {

                // Only process image files.
                if (!f.type.match('image.*')) {
                    continue;
                }

                var reader = new FileReader();

                // Closure to capture the file information.
                reader.onload = (function(theFile) {
                    return function(e) {

                        var span = document.createElement('li');
                        span.className = 'photo';
                        span.innerHTML = ['<img class="thumb" src="', e.target.result,
                            '" title="', escape(theFile.name), '"/> <p id="rm_', i, '">Remove</p>'].join('');
                        $('#list').append(span);


                        $("p[id^='rm_']").click(function() {
                            $(this).parents('li').remove();
                        });
                    };
                })(f);
                // Read in the image file as a data URL.
                reader.readAsDataURL(f);
            }

        });

        $("p[id^='dbrm_']").click(function() {

            if (confirm('<?php echo __('cap_are_you_sure') ?>'))
            {
                $.ajax({
                    type: "POST",
                    url: "<?php echo url_for('user/deleteimage') ?>",
                    data: {img_id: $(this).attr('id')}

                })

                $(this).parents('li').remove();
            }

        });


    });

</script>

