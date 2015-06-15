<script type="text/javascript">

    $(document).ready(function() {
        var loading = $("#loading");
        var container = $("#post_list");

        loading.hide();

        container.on('click', 'a[id^="page"]', function() {
            url = $(this).attr('href');

            $.ajax({
                url: url + '<?php echo '?c=' . $sf_params->get('c') . "&q=" . $sf_params->get('q') ?>',
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

            return false;

        });

    });

</script>
<div class="widecolumn widecolumn-inner alignleft">
    <div class="country_main_title padding-top"><h2><?php echo __('cap_search'); ?></h2></div>
    <div class="content">
        <div id="loading" ></div>
        <div id='post_list'><?php include_partial('searchResult', array('pager' => $pager)) ?></div>
    </div>
</div>
