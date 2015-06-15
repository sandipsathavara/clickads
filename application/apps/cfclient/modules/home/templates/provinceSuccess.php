<?php if (!cache('province')): ?>
    <div class="widecolumn alignleft">
        <div class="country_main_title">
            <h2><?php echo __('cap_select_province', array('%country%' => ucfirst($sf_request->getCookie('name')))) ?></h2>
        </div>
        <div class="alignnone"></div>
        <div class="country_main_title"><h3><?php echo link_to(__('select_country'), '@change_city_province', array('rel' => 'nofollow')) ?> | <?php echo link_to(__('cap_more_states_cities'), '@more_states_cities', array('rel' => 'nofollow')) ?></h3></div>
        <div class="spcr"></div>    
        <div class="content">
            <div>
                <div class="country_list alignleft">
                    <div class="pad">
                        <h3><?php echo __('cap_popular_city') ?></h3>
                        <div class="info">
                            <ul>
                                <?php foreach ($oCities as $oCity) : ?> 
                                    <li> <?php echo link_to($oCity->getName(), '@change_city_province?name=' . $oCity->getName() . "&id=" . $oCity->getId() . "&flag=city", array('rel' => 'nofollow')) ?> &nbsp;&nbsp;<span>( <?php echo $oCity->getPosts()->count() ?> )</span></li>
                                <?php endforeach; ?>

                            </ul>     
                        </div>
                    </div>
                </div>
                <div class="alignnone"></div>
                <div class="spcr"></div>


                <div class="country_list alignleft">
                    <div class="pad">
                        <h3><?php echo __('cap_popular_states') ?></h3>
                        <div class="info">
                            <ul>
                                <?php foreach ($oStates as $oState) : ?> 
                                    <li> <?php echo link_to($oState->getName(), '@change_city_province?name=' . $oState->getName() . "&id=" . $oState->getId() . "&flag=state", array('rel' => 'nofollow')) ?> &nbsp;&nbsp;<span>( <?php echo $oState->getPosts()->count() ?> )</span></li>
                                <?php endforeach; ?>
                            </ul>     
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php cache_save() ?>
<?php endif; ?>
