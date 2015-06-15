<?php
$start = 0;
foreach ($sf_data->getRaw('objAds') as $ad) :

    if ($ad->getAdType() == 'BANNER') :
        if (is_file(sfConfig::get('sf_upload_dir') . '/ads/' . $ad->getBannerImage())) :

            if ($ad->getTargetUrl() != '') :
                echo link_to(image_tag('/uploads/ads/' . $ad->getBannerImage(), array('alt' => $ad->getName(), 'title' => $ad->getName())), $ad->getTargetUrl(), array('target' => '_blank'));
            else :
                echo image_tag('/uploads/ads/' . $ad->getBannerImage(), array('alt' => $ad->getName(), 'title' => $ad->getName()));
            endif;

            $start++;
        endif;
    else :
        if ($ad->getAdData(ESC_RAW) != '') :
            echo $ad->getAdData(ESC_RAW);
            $start++;
        endif;
    endif;
endforeach;
if ($start == 0):
    ?> 
    </br><?php echo __('cap_ad_here') ?> </br></br></br> <h4>728X90</h4>	

<?php endif; ?>
    
