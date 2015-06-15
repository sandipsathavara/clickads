<div class="top_lnk alignright">
    <?php
    if ($sf_user->isAuthenticated()) :
        echo __('welcome') . "&nbsp;" . ucfirst($sf_user->getAttribute('nickname', '', 'oUserInfoClient')) . "&nbsp;&nbsp;|";
        echo link_to(__('cap_user', '', 'myaccount'), '@myads') . "|";
        echo link_to(__('cap_logout', '', 'myaccount'), '@logout');
    else :
        echo link_to(__('cap_register'), "@register") . "|";
        echo link_to(__('cap_sign_in'), "@signin");
    endif;

    /* --- Language Drop Down --- */
    include_component('home', 'language');
    ?>
</div>
<?php if (!cache('top')) : ?>
    <div id="header">
        <div class="alignnone"></div>
        <div class="logo_wrap clearfix">
            <h1 id="logo" class="alignleft"><?php echo link_to('CF', "http://www." . getDomain($sf_request->getHost()), true) ?></h1>
            <div class="btn_post_free alignright">
                <?php echo link_to(__('cap_post_ad'), '@post_ads') ?>
            </div>
            <div class="search_area alignright clearfix">
                <?php echo form_tag('@search_post',array('method'=>'get')); ?>
                <input name="q" type="text" class="input search_wrap"  value="<?php echo $sf_request->getParameter('q') ?>" placeholder="<?php echo __('cap_search_sfclassi') ?>" />
                <?php include_component('home', 'catDropdown', array('action' => $sf_request->getParameter('cat'))); ?>
                <input name="" type="submit" value="<?php echo strtoupper(__('cap_search_btn')) ?>" class="go alignleft" />
                </form>
            </div>
            <div class="alignnone"></div>
        </div>
    </div>
    <?php
    cache_save();
endif;
?>


