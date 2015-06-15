<div class="widecolumn alignleft">
    <div class="country_main_title">
        <h2><?php echo __('cap_select_country') ?></h2>
    </div>
    <div class="content">
        <div>
            <?php
            $i = 1;
            foreach ($oCountryStates as $oCountryState) :
                ?> 
                <div class="country_list alignleft">
                    <div class="pad">
                        <h3><?php echo strtoupper($oCountryState->getName()) ?>&nbsp;&nbsp;(<?php echo $oCountryState->getPosts()->count() ?>)</h3>
                        <div class="info">
                            <ul>
                                <?php foreach ($oCountryState->getStates() as $oState) : ?> 
                                    <li> <?php echo link_to($oState->getName(), 'state_show', $oState) ?> &nbsp;&nbsp;<span>(<?php echo $oState->getPosts()->count() ?>)</span></li>
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