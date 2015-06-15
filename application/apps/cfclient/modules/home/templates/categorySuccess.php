<div class="widecolumn alignleft">
    <div class="country_main_title padding-top">
        <h2><?php
            echo __('cap_find_in');
            echo "&nbsp;";
            echo $sf_request->getCookie('name') ? $sf_request->getCookie('name') : @$arrLocation['name']
            ?> </h2>
        <?php echo link_to(__('change_city_province'), '@location', array('class' => 'fancybox fancybox.ajax choose-state')); ?> </div>
    <?php
    $id = $sf_request->getCookie('id') ? $sf_request->getCookie('id') : @$arrLocation['id'];

   // if (!cache('category_' . $id)):
        ?>
        <div class="content cf">
            <div class="column alignleft">
                <?php
                $i = 1;
                $catRootObj = $objRs->fetchRoots(array(), Doctrine_Core::HYDRATE_ARRAY);
                $columnCount = ceil(count($catRootObj)/3);
                
                
                foreach ($catRootObj as $oCategory) :
                    ?>
                    <ul class="category_list">
                        <li>
                            <div class="category_list alignleft">
                                <div class="info">
                                    <h3><?php echo $oCategory->getName() ?> </h3>
                                    <ul>
                                        <?php
                                        foreach ($objRs->fetchTree(array('root_id' => $oCategory->getRootId())) as $obSubCat) :
                                            if ($obSubCat->getLevel() != 0) :
                                                ?>
                                                <li>
                                                    <?php
                                                    echo str_repeat('&nbsp;', $obSubCat->getLevel()) . link_to($obSubCat->getName(), '@category?cat_slug=' . slugify(utf8_decode($oCategory->getName())) . '&sub_cat_slug=' . slugify(utf8_decode($obSubCat->getName()) . '-' . $obSubCat->getId()));
                                                    ?>
                                                    &nbsp;&nbsp;<span>(
                                                        <?php echo $obSubCat->getPostsCount()->count(); ?>
                                                        )</span> </li>
                                                <?php
                                            endif;
                                        endforeach;
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <?php if ($i % $columnCount == 0): ?>
                    </div>
                    <div class="column alignleft">
                        <?php
                    endif;
                    $i++;
                endforeach;
                ?>
            </div>
        </div>
        <?php //cache_save() ?>
    <?php //endif; ?>
    <div>&nbsp;</div>	
</div>
