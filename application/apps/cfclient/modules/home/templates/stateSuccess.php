<div class="widecolumn alignleft">
    <div class="country_main_title padding-top"><h2><?php echo __('cap_select_city') ?></h2></div>
    <div class="content">
        <div>
            <?php foreach ($objRs as $oStates) : ?> 
                <div class="country_list alignleft">
                    <div class="pad">
                        <h3><?php echo strtoupper($oStates->getName()) ?>&nbsp;&nbsp;(<?php echo $oStates->getPosts()->count() ?>)</h3>
                        <div class="info">
                            <ul>
                                <?php foreach ($oStates->getCitys() as $oCitys) : ?> 
                                    <li><?php
                                        //echo link_to($oCitys->getName(), '@city_category?subdomain='.str_replace(" ",'',  strtolower($oCitys->getName())) )
                                        echo link_to($oCitys->getName(), '@city_category?city=' . str_replace(" ", '', strtolower($oCitys->getName())));
                                        ?>&nbsp;&nbsp;<span>(<?php echo $oCitys->getPosts()->count(); ?>)</span></li>
                                <?php endforeach; ?>     
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="alignnone"></div>
            <div class="spcr"></div>
        </div>
    </div>
</div>
