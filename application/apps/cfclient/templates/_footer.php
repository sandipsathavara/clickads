<div class="foot_nav">
	<div>
		 <?php echo link_to( __('cap_home') ,"@homepage"); ?> |
		 <?php echo link_to( __('cap_condition') ,"@cms_page?page=condition"); ?> |
		 <?php echo link_to( __('cap_advertise') ,"@cms_page?page=advertise"); ?> |
		 <?php echo link_to( __('cap_about_us') ,"@cms_page?page=about-us"); ?> 
	</div>
</div>

<div>
    <div><p class="copyright">&copy; 2010-<?php echo date('Y') .'&nbsp;'.__('copy_rights',array('%website_title%'=>sfConfig::get('website_title'))) ?></p></div>
	<div><p class="developed_by"><?php echo __('power_by') .'&nbsp;&nbsp;'.link_to('ExpertsWebSolution.com',"http://www.expertswebsolution.com",array('target'=>'_blank')); ?></p></div>
    <div class="alignnone"></div>
</div>

<script type="text/javascript">
			
			function DropDown(el) {
				this.dd = el;
				this.opts = this.dd.find('ul.dropdown > li');
				this.index = -1;
				this.initEvents();
			}
			DropDown.prototype = {
				initEvents : function() {
					var obj = this;

					obj.dd.on('click', function(event){
						$('.dropdown').toggleClass('active');
						return false;
					});
					
				}
			}

			$(function() {

				var dd = new DropDown( $('#dd') );
				
				$(document).click(function() {
					$('.dropdown').removeClass('active');
				});

			});




		$(document).ready(function() {
                        $(".fancybox").colorbox();
		});


  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-37799658-1']);
  _gaq.push(['_setDomainName', 'sfclassi.com']);
  _gaq.push(['_trackPageview']);

  /*(function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
*/

<!--Start of Zopim Live Chat Script-->
/*
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
$.src='//cdn.zopim.com/?133RNoCFYEpckx0rFntNWnU6BRykBDYh';z.t=+new Date;$.
type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
*/
<!--End of Zopim Live Chat Script-->

		</script>