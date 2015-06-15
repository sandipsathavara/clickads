<p class="left" ><img src="/images/bq_logo_footer.png" alt="powered by ExpertsWebSolution" /></p>
<p class="right" >Powered by <a href="http://www.ExpertsWebSolution.com"> ExpertsWebSolution <a/></p>

<?php
#--- The main application script ---#
echo javascript_include_tag('/sfPanelThemePlugin/js/jquery.img.preload.js');
echo javascript_include_tag('/sfPanelThemePlugin/js/jquery.filestyle.mini.js');
echo javascript_include_tag('/sfPanelThemePlugin/js/jquery-ui.js');

echo javascript_include_tag('/sfPanelThemePlugin/js/jquery.wysiwyg.js');
echo javascript_include_tag('/sfPanelThemePlugin/js/jquery.date_input.pack.js');
echo javascript_include_tag('/sfPanelThemePlugin/js/facebox.js');
echo javascript_include_tag('/sfPanelThemePlugin/js/jquery.visualize.js');

echo javascript_include_tag('/sfPanelThemePlugin/js/jquery.visualize.tooltip.js');
echo javascript_include_tag('/sfPanelThemePlugin/js/jquery.select_skin.js');
echo javascript_include_tag('/sfPanelThemePlugin/js/jquery.tablesorter.min.js');
echo javascript_include_tag('/sfPanelThemePlugin/js/ajaxupload.js');
echo javascript_include_tag('/sfPanelThemePlugin/js/jquery.pngfix.js');
echo javascript_include_tag('/sfPanelThemePlugin/js/jquery.nestable.js');

echo javascript_include_tag('/sfPanelThemePlugin/js/custom.js');
?>

<script>


<?php
$lang = LanguagesTable::getAllActiveLanguage();
foreach ($lang as $k => $v):
    ?>
        $('#<?php echo $v ?>').addClass('lang_label');

<?php endforeach; ?>

</script>
