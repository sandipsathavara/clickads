<?php
use_helper('General');
use_helper('Text');

$cat_slug = $sf_request->getParameter('cat_slug');
$sub_cat_slug = $sf_request->getParameter('sub_cat_slug');
$id = $sf_request->getParameter('id');

#--- Get Results Count from pager ---#
$objPager = $pager->getResults();

$objFeature = $pagerFeature->getResults();


if (count($objFeature)) :
    ?>
    <div align="right"><?php include_partial('global/ajax_pagination', array('pager' => $pagerFeature, 'module' => 'user')) ?></div><br />
    <?php
    foreach ($objFeature as $post):
        ?>
        <div class="auc_list_single" > 

            <div class="pad">
                <div class="img alignleft">
                    <?php
                    $name = is_file(sfConfig::get('sf_upload_dir') . '/posts/' . $post->getId() . '/s/' . $post->getImage()) ? $post->getId() . '/s/' . $post->getImage() : 'noimage.jpg';
                    echo link_to(image_tag('/uploads/posts/' . $name, array('alt' => $name)), "@postdetail?sub_cat_slug=$sub_cat_slug&post_slug=" . slugify($post->getTitle() . "-" . $post->getId()));
                    ?>
                </div>
                <div class="info alignleft">
                    <h2><?php echo link_to(strtoupper($post->getTitle()), "@postdetail?sub_cat_slug=$sub_cat_slug&post_slug=" . slugify($post->getTitle() . "-" . $post->getId())); ?></h2>
                    <p><?php echo truncate_text(strip_tags($post->getDescription(ESC_RAW)), 130, '...'); ?></p>

                    <!-- AddThis Button BEGIN -->
                    <div class="addthis_toolbox addthis_default_style ">
                        <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                        <a class="addthis_button_tweet"></a>
                        <a class="addthis_button_pinterest_pinit"></a>
                        <a class="addthis_counter addthis_pill_style"></a>
                    </div>
                    <script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=xa-508bc1fe4715af49"></script>
                    <!-- AddThis Button END -->

                </div>

                <div class="list-price-date alignright">
                    <span class="price"><?php echo $post->getPrice() != '' ? $post->getPrice() == 0.00 ? 'Free' : format_currency($post->getPrice(), $post->getCitys()->getCountries()->getCurrency())  : ''; ?></span><br /><span class="time_left"><?php echo distanceOfTimeInWords($post->getCreatedAt()) ?></span>
                </div>

                <div class="alignnone"></div>
            </div>

        </div>
    <?php endforeach ?>
    <br/>
    <div align="right"><?php include_partial('global/ajax_pagination', array('pager' => $pagerFeature, 'module' => 'user')) ?></div>

<?php 
endif; 

if (count($objPager)) :
    ?>
    <div align="right"><?php include_partial('global/ajax_pagination', array('pager' => $pager, 'module' => 'user')) ?></div><br />
    <?php
    foreach ($objPager as $post):
        ?>
        <div class="auc_list_single" > 

            <div class="pad">
                <div class="img alignleft">
                    <?php
                    $name = is_file(sfConfig::get('sf_upload_dir') . '/posts/' . $post->getId() . '/s/' . $post->getImage()) ? $post->getId() . '/s/' . $post->getImage() : 'noimage.jpg';
                    echo link_to(image_tag('/uploads/posts/' . $name, array('alt' => $name)), "@postdetail?sub_cat_slug=$sub_cat_slug&post_slug=" . slugify($post->getTitle() . "-" . $post->getId()));
                    ?>
                </div>
                <div class="info alignleft">
                    <h2><?php echo link_to(strtoupper($post->getTitle()), "@postdetail?sub_cat_slug=$sub_cat_slug&post_slug=" . slugify($post->getTitle() . "-" . $post->getId())); ?></h2>
                    <p><?php echo truncate_text(strip_tags($post->getDescription(ESC_RAW)), 130, '...'); ?></p>

                    <!-- AddThis Button BEGIN -->
                    <div class="addthis_toolbox addthis_default_style ">
                        <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                        <a class="addthis_button_tweet"></a>
                        <a class="addthis_button_pinterest_pinit"></a>
                        <a class="addthis_counter addthis_pill_style"></a>
                    </div>
                    <script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=xa-508bc1fe4715af49"></script>
                    <!-- AddThis Button END -->

                </div>

                <div class="list-price-date alignright">
                    <span class="price"><?php echo $post->getPrice() != '' ? $post->getPrice() == 0.00 ? 'Free' : format_currency($post->getPrice(), $post->getCitys()->getCountries()->getCurrency())  : ''; ?></span><br /><span class="time_left"><?php echo distanceOfTimeInWords($post->getCreatedAt()) ?></span>
                </div>

                <div class="alignnone"></div>
            </div>

        </div>
    <?php endforeach ?>
    <br/>
    <div align="right"><?php include_partial('global/ajax_pagination', array('pager' => $pager, 'module' => 'user')) ?></div>
<?php //else : ?><!-- br />
    <br />
    <br />
    <br />

    <h3 align="center" class="error"> <?php echo __('msg_record_not_found') ?></h3 -->
<?php endif; ?>