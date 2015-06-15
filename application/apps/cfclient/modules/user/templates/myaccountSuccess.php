<div class="widecolumn alignleft widecolumn-inner">
    <div class="country_main_title padding-top"><h2><?php echo __('cap_my_ads', '', 'myaccount') ?></h2></div>
    <div class="content">
        <div id="loading"></div>
        <?php if ($sf_user->hasFlash('error')) : ?>
            <div class="error" align="left"> <?php echo $sf_user->getFlash('error') ?> </div>
        <?php endif; ?>

        <div id='post_list'>
            <?php include_partial('list', array('pager' => $pager)) ?>
            <div class="alignnone"></div>
            <div class="spcr"></div>

        </div>
    </div>
</div>

<script type="text/javascript">
    // as we have the <div id="data"> we'll completely reload it's contents
    var container = $("#post_list");
    var loading = $("#loading");
    loading.hide();
    // note that you'll need a routing for the offers index to point to module: offers, action: index..
    var url = "<?php echo url_for("@myaccount", true); ?>";

    function loadPage(page)
    {
        $.ajax({
            url: url + "?page=" + page,
            type: 'POST',
            dataType: 'html',
            timeout: 4000,
            beforeSend: function() {
                container.hide();
                loading.show();
            },
            complete: function() {
                loading.hide();
                container.show();
            },
            error: function(xhr, textStatus, errorThrown) {
                msg = "Error " + errorThrown;
                alert(msg);
            },
            success: function(data) {
                container.html(data);
            }
        });
    }
</script>