<script language="javascript">

    var supportFlash = !!(swfobject.getFlashPlayerVersion().major >= 10)
    var useFileApi = (typeof FileReader !== "undefined");

    if (!useFileApi && !supportFlash) {
        $("#warn-message-noflash").show();
    }


    $(document).ready(function() {


        $("#image").change(function(evt) {

            var files = evt.target.files; // FileList object

            // Loop through the FileList and render image files as thumbnails.
            for (var i = 0, f; f = files[i]; i++) {

                // Only process image files.
                if (!f.type.match('image.*')) {
                    continue;
                }

                var reader = new FileReader();

                // Closure to capture the file information.
                reader.onload = (function(theFile) {
                    return function(e) {

                        var span = document.createElement('li');
                        span.className = 'photo';
                        span.innerHTML = ['<img class="thumb" src="', e.target.result,
                            '" title="', escape(theFile.name), '"/> <p id="rm_', i, '">Remove</p>'].join('');
                        $('#list').append(span);


                        $("p[id^='rm_']").click(function() {
                            $(this).parents('li').remove();
                        });
                    };
                })(f);
                // Read in the image file as a data URL.
                reader.readAsDataURL(f);
            }

        });

        $("p[id^='dbrm_']").click(function() {

            if (confirm('<?php echo __('cap_are_you_sure') ?>'))
            {
                $.ajax({
                    type: "POST",
                    url: "<?php echo url_for('user/deleteimage') ?>",
                    data: {img_id: $(this).attr('id')}

                })

                $(this).parents('li').remove();
            }

        });


    });

</script>