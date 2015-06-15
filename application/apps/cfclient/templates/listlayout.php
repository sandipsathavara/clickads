<!DOCTYPE html>
<head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>

    <!--[if lte IE 7]>
    <script type="text/javascript">
    var ieUpMsg="Your browser is out of date. Upgrade for free for a richer SFCLASSI experience.",ieCookieName="ieupgradereminder",ieCookieValue="oldIeDetected",ieCookieTime=2592000,ieCookieDomain=".sfclassi.com",ieCookiePath="\/";
    </script>
    <script type="text/javascript" src="/js/ieupdatebanner-895.js"></script>
    <![endif]-->

    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css' />
    <link rel="shortcut icon" href="/favicon.png" />

</head>
<body>

    <div id="wrapper">
        <div class="wrapper_pad">
            <!-- Top --->
            <?php include_partial('global/top') ?>
            <!-- End Top--->
            <!-- Middle--->
            <div id="content">	
                <div>
                    <!-- Banner --->
                    <div class="add_banner">
                        <div class="adhere728 alignleft">
                            <?php include_component('home', 'adsLeaderboard', array('action' => $sf_request->getParameter('action'), 'position' => 'LEADERBOARD')); ?>
                        </div>
                        <div class="adhere350 alignright">
                            <?php include_component('home', 'adsLeaderboard350', array('action' => $sf_request->getParameter('action'), 'position' => 'LEADERBOARD350')); ?>
                        </div>	                        
                    </div>

                    <?php
                        if ($sf_params->get('module') == 'home' && $sf_params->get('action') == 'category') {
                            include_component('home', 'featureads');
                        }
                        ?>

                    <!-- End Banner --->
                    <div class="breadcrumb clearfix">
                        <?php
                        $obj = new Breadcrumb();
                        echo @$obj->output();
                        ?>
                    </div>

                    <?php echo $sf_content ?>

                    <div class="narrowcolumn-inner alignleft"> 
                        <?php
                        if ($sf_user->isAuthenticated() && $sf_params->get('module') == 'user' && $sf_params->get('action') != 'images' && $sf_params->get('action') != 'myaccount' && $sf_params->get('action') != 'postads')
                            include_partial('user/right');
                        else {
                            if ($sf_params->get('action') != 'images' && $sf_params->get('action') != 'postads' && $sf_params->get('action') != 'myaccount' && $sf_params->get('action') != 'postads') {
                                if ($sf_params->get('action') == 'listPosts' || $sf_params->get('action') == 'search') {
                                    include_component('home', 'adsSinglecolumn', array('action' => $sf_request->getParameter('action')));
                                }
                            }
                        }
                        ?>
                    </div>
                    <div class="alignnone"></div>
                </div>  
            </div>
            <!-- End Middle--->

            <!-- Footer--->
            <div id="footer"><?php include_partial('global/footer') ?></div>
            <!-- End Footer--->
        </div>
    </div>	
</body>
</html>
