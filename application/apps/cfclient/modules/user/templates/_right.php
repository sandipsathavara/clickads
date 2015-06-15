<?php if ($sf_user->isAuthenticated()) : ?>
    <div class="narrowcolumn myaccount_right alignleft"> 
        <div class="gry_rd_box rcnt_close_auctions">
            <div class="mid">
                <h3><?php echo __('cap_user', '', 'myaccount'); ?></h3>
                <ul class="member_menu">
                    <li><?php echo link_to(__('cap_my_ads', '', 'myaccount'), '@myads'); ?></li>
                    <li><?php echo link_to(__('cap_change_password', '', 'myaccount'), '@reset_password'); ?></li>
                    <li><?php echo link_to(__('cap_logout', '', 'myaccount'), '@logout'); ?></li>
                </ul>
            </div>
        </div>
    </div>
<?php endif; ?>



