<?php
use_helper('General');
use_helper('Text');

if ( $sf_data->getRaw('featuredAds')->count() ) :
    ?>
    <style>
        .image_carousel {
            padding: 15px 0 15px 40px;
            position: relative;
        }
        .image_carousel .featurebox div {
            border: 1px solid #ccc;
            background-color: white;
            padding: 9px;
            margin: 7px;
            display: block;
            float: left;
        }

        .image_carousel img {
            border: 1px solid #ccc;
            background-color: white;
        }

        .image_carousel a.prev, a.next {
            background: url(../images/miscellaneous_sprite.png) no-repeat transparent;
            width: 45px;
            height: 50px;
            display: block;
            position: absolute;
            top: 50px;
        }
        a.prev {   left: -22px;
                   background-position: 0 0; }
        a.prev:hover {		background-position: 0 -50px; }
        a.prev.disabled {	background-position: 0 -100px !important;  }
        a.next {			right: -22px;
                   background-position: -50px 0; }
        a.next:hover {		background-position: -50px -50px; }
        a.next.disabled {	background-position: -50px -100px !important;  }
        a.prev.disabled, a.next.disabled {
            cursor: default;
        }

        a.prev span, a.next span {
            display: none;
        }
        .pagination {
            text-align: center;
        }
        .pagination a {
            background: url(../images/miscellaneous_sprite.png) 0 -300px no-repeat transparent;
            width: 15px;
            height: 15px;
            margin: 0 5px 0 0;
            display: inline-block;
        }
        .pagination a.selected {
            background-position: -25px -300px;
            cursor: default;
        }
        .pagination a span {
            display: none;
        }

    </style>

    <div class="breadcrumb clearfix">
        <div class="image_carousel">

            <div id="foo2">
                <?php foreach ($sf_data->getRaw('featuredAds') as $post) : ?> 

                    <div class='featurebox'>
                        <div>
                            <?php
                            $name = is_file(sfConfig::get('sf_upload_dir') . '/posts/' . $post->getId() . '/s/' . $post->getImage()) ? $post->getId() . '/s/' . $post->getImage() : 'noimage.jpg';
                            echo link_to(image_tag('/uploads/posts/' . $name, array('alt' => $name)), "@postdetail?sub_cat_slug=" . slugify($post->getCategories()->getName()) . "&post_slug=" . slugify($post->getTitle() . "-" . $post->getId()));
                            ?>   
                        </div>
                        <div>
                            <p><?php echo $post->getCategories()->getNode()->getParent() . ' / ' . $post->getCategories()->getName(); ?></p>
                            <p><span ><?php echo ucwords(truncate_text(strip_tags($post->getTitle(ESC_RAW)), 30, '...')); ?></span><br /><?php echo distanceOfTimeInWords($post->getCreatedAt()) ?><br /><span class="prc"><?php echo $post->getPrice() != '' ? $post->getPrice() == 0.00 ? 'Free' : format_currency($post->getPrice(), $post->getCitys()->getCountries()->getCurrency())  : ''; ?></span></p>

                        </div>
                    </div>
                <?php endforeach; ?>    

            </div>
            <div class="clearfix"></div>
            <a class="prev" id="foo2_prev" href="#"><span>prev</span></a>
            <a class="next" id="foo2_next" href="#"><span>next</span></a>
            <div class="pagination" id="foo2_pag"></div>
        </div>
    </div>


    <script type="text/javascript">
        $("#foo2").carouFredSel({
            circular: false,
            infinite: false,
            auto: false,
            prev: {
                button: "#foo2_prev",
                key: "left"
            },
            next: {
                button: "#foo2_next",
                key: "right"
            },
            pagination: "#foo2_pag"
        });
    </script>
<?php endif; ?>    