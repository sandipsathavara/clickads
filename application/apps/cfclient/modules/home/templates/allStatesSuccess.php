<div class="widecolumn alignleft">
    <div class="country_main_title">
    </div>
    <div class="content">
        <div>
            <?php
            $i = 1;
            foreach ($oStates as $oState) :
                ?> 
                <div class="country_list alignleft">
                    <div class="pad">
                        <h3>
                            <?php echo link_to($oState->getName(), '@change_city_province?name=' . $oState->getName() . "&id=" . $oState->getId() . "&flag=state&isall=1", array('rel' => 'nofollow')) ?>
                            &nbsp;&nbsp;(<?php echo $oState->getPosts()->count() ?>)        
                        </h3>

                        <div class="info">
                            <ul>
                                <?php foreach ($oState->getCitys() as $oCity) : ?> 
                                    <li><?php echo link_to($oCity->getName(), '@change_city_province?name=' . $oCity->getName() . "&id=" . $oCity->getId() . "&flag=city&isall=1", array('rel' => 'nofollow')) ?>&nbsp;&nbsp;<span>(<?php echo $oCity->getPosts()->count() ?>)</span></li>
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