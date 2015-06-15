<div class="narrowcolumn-inner alignleft">
    <?php echo link_to(( $sf_request->getCookie('name') ) ? $sf_request->getCookie('name') : __('change_city_province'), '@location', array('class' => 'fancybox fancybox.ajax btn_change_city')); ?>

    <div class="single_add clearfix">

        <?php
        $start = 0;
        foreach ($sf_data->getRaw('objAds') as $ad) :

            if ($ad->getAdType() == 'BANNER') :
                if (is_file(sfConfig::get('sf_upload_dir') . '/ads/' . $ad->getBannerImage())) :
                    ?>
                    <div class="adhere200 alignleft">
                        <?php
                        echo link_to(image_tag('/uploads/ads/' . $ad->getBannerImage(), array('width' => '200', 'height' => '200', 'target' => '_blank', 'rel' => 'nofollow', 'alt' => $ad->getName(), 'title' => $ad->getName())), $ad->getTargetUrl(), array('target' => '_blank'));
                        $start++;
                        ?>
                    </div>
                    <?php
                endif;

            else :
                if ($ad->getAdData(ESC_RAW) != '') :
                    if ($ad->getPosition() == 'SIDEBAR200')
                        echo '<div class="adhere200 alignleft">';
                    echo $ad->getAdData(ESC_RAW);
                    if ($ad->getPosition() == 'SIDEBAR200')
                        echo '</div>';
                    $start++;
                endif;
            endif;

        endforeach;

        for ($i = $start; $i < sfConfig::get('app_number_ads'); $i++) :
            ?>
            <div class="adhere200 alignleft" ></br><?php echo __('cap_ad_here') ?></br></br></br></br></br></br> <h4>200X200</h4></div>
        <?php endfor; ?>

    </div>
</div>

