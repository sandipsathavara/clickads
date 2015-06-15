<?php
use_helper('Text');
$objImages = $objPosts->getPostImages();

$img_path = '/uploads/posts/' . $objPosts->getId() . '/b/';

if (!cache('post_' . $objPosts->getId())):
    ?>

    <div class="widecolumn alignleft">
        <div class="content">
            <div class="auction_detail">
                <h3>
                    <div style="width:600px" ><?php echo strtoupper($objPosts->getTitle()); ?></div>
                </h3>


                <ul class="bxslider">
                    <?php
                    if ($objImages->count() == 0) :
                        echo "<li>";
                        echo image_tag('/uploads/posts/noimage.jpg');
                        echo "</li>";
                    else :
                        foreach ($objImages as $oImage) :
                            $name = is_file(sfConfig::get('sf_upload_dir') . '/posts/' . $objPosts->getId() . '/b/' . $oImage->getImage()) ? '/uploads/posts/' . $objPosts->getId() . '/b/' . $oImage->getImage() : '/uploads/posts/noimage.jpg';
                            echo "<li>";
                            echo image_tag($name);
                            echo "</li>";
                        endforeach;
                    endif;
                    ?>
                </ul>    
                <!-- div -->
                <?php if ($objImages->count() > 1) : ?>

                    <div id="bx-pager">

                        <?php
                        $i = 0;
                        foreach ($objImages as $oImage):
                            // echo "<li>";
                            echo link_to(image_tag('/uploads/posts/' . $objPosts->getId() . '/s/' . $oImage->getImage(), array('id' => 'images_' . $oImage->getId(), 'title' => $oImage->getImage())), '@', array('data-slide-index' => $i));
                            // echo "</li>";
                            $i++;
                        endforeach;
                        ?>

                    </div>

                <?php endif; ?>


                <div class="spcr"></div>
                <div class="spcr"></div>



                <div>
                    <div class="on_going_auction">
                        <div class="prc alignleft"><span><?php echo image_tag('ico-user.png') ?> <?php echo ucfirst($nickName); ?></span></div>
                        <div class="prc alignleft"><span><?php echo image_tag('ico-date.png') ?> <?php echo format_datetime($objPosts->getCreatedAt(), 'p'); ?></span></div>
                        <div class="prc alignright"><span><?php echo image_tag('ico-price.png') ?> <?php echo format_currency($objPosts->getPrice(), $objPosts->getCitys()->getCountries()->getCurrency()); ?> </span></div>
                        <div class="prc alignright"><span><?php echo image_tag('ico-phone.png') ?> <?php echo $objPosts->getPhone(); ?></span></div>
                    </div>
                    <div class="alignnone"></div>
                </div>
            </div>
            <div class="spcr"></div>
            <div class="tabing">
                <div id="TabbedPanels1" class="TabbedPanels">
                    <ul class="TabbedPanelsTabGroup">
                        <li class="TabbedPanelsTab" tabindex="0"><span><?php echo __('cap_description', '', 'postad') ?></span></li>
                        <li class="TabbedPanelsTab" tabindex="0"><span><?php echo __('cap_map', '', 'postad') ?></span></li>
                        <li class="TabbedPanelsTab" tabindex="0"><span><?php echo __('cap_replyad', '', 'postad') ?></span></li>
                        <li class="TabbedPanelsTab" tabindex="0"><span><?php echo __('cap_share', '', 'postad') ?></span></li>
                    </ul>
                    <div class="TabbedPanelsContentGroup">
                        <div class="TabbedPanelsContent"> <?php echo $objPosts->getRawValue()->getDescription(); ?> </div>

                        <div class="TabbedPanelsContent">
                            <div id="map_canvas" style="height:400px;" ></div>
                        </div>  

                        <div class="TabbedPanelsContent">
                            <div class="content">
                                <div class="blue_box">
                                    <div class="rt">
                                        <div><?php echo __('cap_replyad') ?></div>
                                    </div>

                                    <div class="mid">
                                        <form name="frmRegister" onSubmit="this.submit();
                                                    return false" method="post">
                                            <div class="member_registration">
                                                <?php if ($sf_user->hasFlash('error')) : ?>
                                                    <div class="error"><?php echo $sf_user->getFlash('error'); ?></div>
                                                    <div class="spcr"></div>
                                                <?php endif; ?>
                                                <label for="ad_name"><span class="required">*</span><?php echo __('cap_name') ?>*:</label>
                                                <p class="mybox"> <?php echo $oForm['name']->render(array('class' => 'textbox', 'style' => 'width:250px;')); ?> </p>
                                                <br class="alignnone" />
                                                <div class="error"><?php echo $oForm['name']->renderError(); ?></div>
                                                <div class="spcr"></div>
                                                <label for="ad_email"><span class="required">*</span><?php echo __('cap_email') ?>:</label>
                                                <p class="mybox"> <?php echo $oForm['email']->render(array('class' => 'textbox', 'style' => 'width:250px;')); ?> </p>
                                                <br class="alignnone" />
                                                <div class="error"><?php echo $oForm['email']->renderError(); ?></div>
                                                <div class="spcr"></div>
                                                <label for="ad_phone"><?php echo __('cap_phone') ?>:</label>
                                                <p class="mybox"> <?php echo $oForm['phone']->render(array('class' => 'textbox', 'style' => 'width:250px;')); ?> </p>
                                                <br class="alignnone" />
                                                <div class="error"><?php echo $oForm['phone']->renderError(); ?></div>
                                                <div class="spcr"></div>
                                                <label for="message"><span class="required">*</span><?php echo __('cap_messages') ?>:</label>
                                                <p class="mybox"> <?php echo $oForm['message']->render(array('cols' => '70', 'rows' => '6')); ?> </p>
                                                <br class="alignnone" />
                                                <div class="error"><?php echo $oForm['message']->renderError(); ?></div>
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
                                                <p class="mybox"> <?php echo $oForm['captcha']->render(array('id' => 'captcha', 'class' => 'textbox captcha', 'style' => 'width:200px;')); ?> </p>
                                                <br class="alignnone" />
                                                <div class="error"><?php echo $oForm['captcha']->renderError(); ?></div>
                                                <div class="spcr"></div>
                                                <label>&nbsp;</label>
                                                <p >
                                                    <input type="submit" value="SEND" />
                                                </p>
                                            </div>
                                        </form>
                                        <div class="alignnone"></div>
                                    </div>
                                    <div class="rb"> </div>
                                </div>
                            </div>
                        </div>

                        <div class="TabbedPanelsContent">
                            <div class="spcr"></div>
                            <!-- AddThis Button BEGIN -->
                            <div class="addthis_toolbox addthis_default_style addthis_32x32_style"> <a class="addthis_button_preferred_1"></a> <a class="addthis_button_preferred_2"></a> <a class="addthis_button_preferred_3"></a> <a class="addthis_button_preferred_4"></a> <a class="addthis_button_compact"></a> <a class="addthis_counter addthis_bubble_style"></a> </div>
                            <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4f91ac2b036af33f"></script> 
                            <!-- AddThis Button END --> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php cache_save() ?>
<?php endif; ?>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBToVk0IGRcFWpTJv6-DddcLJEt75zmFSs&sensor=true"></script> 
<script type="text/javascript">
                                            var geocoder;
                                            var map;
                                            var markersArray = [];
                                            var marker;


                                            function initialize() {
                                                geocoder = new google.maps.Geocoder();
                                                var myOptions = {
                                                    zoom: 10,
                                                    mapTypeId: google.maps.MapTypeId.ROADMAP
                                                }
                                                map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

                                                codeAddress();
                                            }

                                            function codeAddress() {
                                                var address = '<?php echo strtolower($objPosts->getCitys()->getName()) ?>';
                                                geocoder.geocode({'address': address}, function(results, status) {
                                                    if (status == google.maps.GeocoderStatus.OK) {
                                                        clearOverlays();


                                                        map.setCenter(results[0].geometry.location);
                                                        marker = new google.maps.Marker({
                                                            map: map,
                                                            title: results[0]['formatted_address'],
                                                            position: results[0].geometry.location,
                                                            animation: google.maps.Animation.DROP
                                                        });

                                                        markersArray.push(marker);

                                                    } else {
                                                        alert("Geocode was not successful for the following reason: " + status);
                                                    }
                                                });
                                            }


                                            function clearOverlays() {
                                                if (markersArray) {
                                                    for (i in markersArray) {
                                                        markersArray[i].setMap(null);
                                                    }
                                                }
                                            }

                                            google.maps.event.addDomListener(window, 'load', initialize);

                                            $(function()
                                            {
                                                $('#TabbedPanels1 .TabbedPanelsTabGroup li:last').addClass('last');

                                                $('.TabbedPanelsTab').click(function() {
                                                    google.maps.event.trigger(map, "resize");
                                                    initialize()
                                                });
                                            });

                                            var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");

<?php if ($oForm->hasErrors() || $sf_user->hasFlash('error')) : ?>
                  TabbedPanels1.showPanel(2)
<?php endif; ?>


                                            $(document).ready(function() {



                                                $('#bx-pager').bxSlider({
                                                    minSlides: 3,
                                                    maxSlides: 3,
                                                    slideWidth: 114,
                                                    slideMargin: 10,
                                                    pager: false
                                                });

                                                $('.bxslider').bxSlider({
                                                    pagerCustom: '#bx-pager',
                                                    slideWidth: '400',
                                                    controls: false
                                                });


                                                /* $$(window).load(function() {
                                                 $('#carousel').flexslider({
                                                 animation: "slide",
                                                 controlNav: false,
                                                 animationLoop: false,
                                                 slideshow: false,
                                                 itemWidth: 114,
                                                 itemMargin: 3,
                                                 asNavFor: '#slider'
                                                 });
                                                 
                                                 $('#slider').flexslider({
                                                 animation: "slide",
                                                 controlNav: false,
                                                 animationLoop: false,
                                                 slideshow: false,
                                                 itemWidth: '50%',
                                                 sync: "#carousel"
                                                 });
                                                 });('#img-gallery').bxSlider({
                                                 mode: 'vertical',
                                                 pager: false,
                                                 slideWidth: 150,
                                                 minSlides: 3,
                                                 slideMargin: 10
                                                 });
                                                 
                                                 $("img[id^='images_']").click(function() {
                                                 $('#main_image').attr('src', '<?php echo @$img_path ?>' + $(this).attr('title') + '');
                                                 });*/

                                            });


</script> 