<?php
use_helper('General');
use_helper('Text');
?>
<div class="narrowcolumn alignleft">

    <?php if ($sf_params->get('module') == 'home' && $sf_params->get('action') != 'category') : ?>
        <div class="gry_rd_box rcnt_close_auctions">
            <div class="mid">
                <div ><div><h3><?php echo __('cap_latest_featured_ads') ?></h3></div></div>
                <?php foreach ($sf_data->getRaw('featuredAds') as $post) : ?> 
                    <div class="box">
                        <div class="img alignleft">
                            <?php
                            $name = is_file(sfConfig::get('sf_upload_dir') . '/posts/' . $post->getId() . '/s/' . $post->getImage()) ? $post->getId() . '/s/' . $post->getImage() : 'noimage.jpg';
                            echo link_to(image_tag('/uploads/posts/' . $name, array('alt' => $name, 'width' => '75', 'height' => '75')), "@postdetail?sub_cat_slug=" . slugify($post->getCategories()->getName()) . "&post_slug=" . slugify($post->getTitle() . "-" . $post->getId()));
                            ?>   
                        </div>
                        <div class="det alignright">
                            <p class='info'><?php echo $post->getCategories()->getNode()->getParent() . ' / ' . $post->getCategories()->getName(); ?></p>
                            <p><span class="name"><?php echo link_to(ucwords(truncate_text(strip_tags($post->getTitle(ESC_RAW)), 30, '...')), "@postdetail?sub_cat_slug=" . slugify($post->getCategories()->getName()) . "&post_slug=" . slugify($post->getTitle() . "-" . $post->getId())); ?></span><br /><?php echo distanceOfTimeInWords($post->getCreatedAt()) ?><br /><span class="prc"><?php echo $post->getPrice() != '' ? $post->getPrice() == 0.00 ? 'Free' : format_currency($post->getPrice(), $post->getCitys()->getCountries()->getCurrency())  : ''; ?></span></p>

                        </div>
                        <div class="alignnone"></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
       <br/> 
    <?php endif; ?>
    
    

    <div class="content clearfix">
        <?php
        $start = 0;
        foreach ($sf_data->getRaw('objAds') as $ad) :

            if ($ad->getAdType() == 'BANNER') :
                if (is_file(sfConfig::get('sf_upload_dir') . '/ads/' . $ad->getBannerImage())) :
                    ?>
                    <div class="adhere alignleft">
                        <?php
                        if ($ad->getTargetUrl() != '') :
                            echo link_to(image_tag('/uploads/ads/' . $ad->getBannerImage(), array('width' => '125px', 'height' => '125px', 'alt' => $ad->getName(), 'title' => $ad->getName())), $ad->getTargetUrl(), array('rel' => 'nofollow', 'target' => '_blank'));
                        else:
                            echo image_tag('/uploads/ads/' . $ad->getBannerImage(), array('width' => '125px', 'height' => '125px', 'alt' => $ad->getName(), 'title' => $ad->getName()));
                        endif;
                        $start++;
                        ?>
                    </div>

                    <?php
                endif;

            else :
                if ($ad->getAdData(ESC_RAW) != '') :
                    if ($ad->getPosition() == 'SIDEBAR125')
                        echo '<div class="adhere alignleft">';
                    echo $ad->getAdData(ESC_RAW);
                    if ($ad->getPosition() == 'SIDEBAR125')
                        echo '</div>';
                    $start++;
                endif;
            endif;


        endforeach;

        for ($i = $start; $i < (sfConfig::get('app_number_ads') + 1); $i++) :
            ?>
            <div class="adhere alignleft"></br><?php echo __('cap_ad_here') ?> </br></br></br> <h4>125X125</h4></div>
        <?php endfor;
        ?>

    </div>




    <div class="gry_rd_box rcnt_close_auctions">
        <div class="mid">
            <div ><div><h3><?php echo __('cap_latest_free_ads') ?></h3></div></div>
            <?php foreach ($sf_data->getRaw('freeAds') as $post) : ?> 
                <div class="box">
                    <div class="img alignleft">
                        <?php
                        $name = is_file(sfConfig::get('sf_upload_dir') . '/posts/' . $post->getId() . '/s/' . $post->getImage()) ? $post->getId() . '/s/' . $post->getImage() : 'noimage.jpg';
                        echo link_to(image_tag('/uploads/posts/' . $name, array('alt' => $name, 'width' => '75', 'height' => '75')), "@postdetail?sub_cat_slug=" . slugify($post->getCategories()->getName()) . "&post_slug=" . slugify($post->getTitle() . "-" . $post->getId()));
                        ?>   
                    </div>
                    <div class="det alignright">
                        <p class='info'><?php echo $post->getCategories()->getNode()->getParent() . ' / ' . $post->getCategories()->getName(); ?></p>
                        <p><span class="name"><?php echo link_to( ucwords(truncate_text(strip_tags($post->getTitle(ESC_RAW)), 30, '...')), "@postdetail?sub_cat_slug=" . slugify($post->getCategories()->getName()) . "&post_slug=" . slugify($post->getTitle() . "-" . $post->getId())); ?></span><br /><?php echo distanceOfTimeInWords($post->getCreatedAt()) ?><br /><span class="prc"><?php echo $post->getPrice() != '' ? $post->getPrice() == 0.00 ? 'Free' : format_currency($post->getPrice(), $post->getCitys()->getCountries()->getCurrency())  : ''; ?></span></p>

                    </div>
                    <div class="alignnone"></div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</div>



