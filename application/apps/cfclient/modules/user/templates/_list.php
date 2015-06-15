<?php
use_helper('Text');
#--- Get Result ---#
$objPager = $pager->getResults();

if (count($objPager)) :
    ?>
    <div class="top_pagination clearfix">
        <?php include_partial('global/ajax_pagination', array('pager' => $pager, 'module' => 'user')) ?>
    </div><br />

    <?php foreach ($objPager as $post): ?>
        <div class="auction_list alignleft" >
            <div class="pad">
                <div class="img alignleft">
                    <?php
                    $name = is_file(sfConfig::get('sf_upload_dir') . '/posts/' . $post->getId() . '/s/' . $post->getImage()) ? $post->getId() . '/s/' . $post->getImage() : 'noimage.jpg';
                    echo link_to(image_tag('/uploads/posts/' . $name, array('alt' => $post->getImage(), 'align' => "center")), "@postdetail?sub_cat_slug=" . slugify($post->getCategories()->getName()) . "&post_slug=" . slugify($post->getTitle() . "-" . $post->getId()));
                    ?>	
                </div>
                <div class="alignleft">
                    <h3><?php echo link_to(strtoupper($post->getTitle()), "@postdetail?sub_cat_slug=" . slugify($post->getCategories()->getName()) . "&post_slug=" . slugify($post->getTitle() . "-" . $post->getId())) ?></h3>	
                    <p><?php echo truncate_text(strip_tags($post->getDescription(ESC_RAW)), 130, '...'); ?></p>
                    <p class="user-right"><?php echo link_to(__('cap_view'), "@postdetail?sub_cat_slug=" . slugify($post->getCategories()->getName()) . "&post_slug=" . slugify($post->getTitle() . "-" . $post->getId())) ?> - 
                        <?php echo link_to(__('cap_edit'), "@post_ads?post_id=" . $post->getId()) ?> - 
                        <?php echo link_to(__('cap_delete'), "@postdelete?id=" . $post->getId(), array('confirm' => __('msg_delete_record', '', 'myaccount'))) ?> 
                                
                        <?php echo ($post->getIsFeatured() == 0) ? ' - '.link_to(__('cap_feature_ad'), "user/payment?mc=1&id=" . $post->getId(), array('confirm' => __('msg_delete_record', '', 'myaccount'))) : '' ?> </p>
                    
                </div>
                <div class="list-price-date alignright">
                    <div ><h4><?php echo ($post->getIsFeatured() == 1) ? __('cap_featured_ads') : '' ?></h4></div>
                    <span class="price"><?php echo format_currency($post->getPrice(), $post->getCitys()->getCountries()->getCurrency()) ?></span>
                    <div><?php echo distanceOfTimeInWords($post->getCreatedAt()) ?></div>
                    <div><h3><?php echo ($post->getStatus() == 'publish') ? __('cap_publish') : __('cap_unpublish') ?></h3></div>
                </div>

                <div class="alignnone"></div>
            </div>
        </div>
    <?php endforeach ?>
    <br />
    <div class="bottom_pagination"><?php include_partial('global/ajax_pagination', array('pager' => $pager, 'module' => 'user')) ?></div>
<?php else : ?>
    <h3 align="center" class="error"> <?php echo __('msg_record_not_found'); ?> </h3>
<?php endif; ?>