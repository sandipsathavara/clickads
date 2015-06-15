    <style type="text/css">
		.dd { position: relative; display: block; margin: 0; padding: 0; max-width: 100%; list-style: none; font-size: 13px; line-height: 20px; }
		
		.dd-list { display: block; position: relative; margin: 0; padding: 0; list-style: none; }
		.dd-list .dd-list { padding-left: 30px; }
		.dd-collapsed .dd-list { display: none; }
		
		.dd-item,
		.dd-empty,
		.dd-placeholder { display: block; position: relative; margin: 0; padding: 0; min-height: 20px; font-size: 13px; line-height: 20px; }
		
		.dd-handle { display: block; height: 30px; margin: 5px 0; padding: 5px 10px; color: #333; text-decoration: none; font-weight: bold; border: 1px solid #ccc;
			background: #fafafa;
			background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
			background:    -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
			background:         linear-gradient(top, #fafafa 0%, #eee 100%);
			-webkit-border-radius: 3px;
					border-radius: 3px;
			box-sizing: border-box; -moz-box-sizing: border-box;
		}
		.dd-handle:hover { color: #2ea8e5; background: #fff; }
		
		.dd-item > button { display: block; position: relative; cursor: pointer; float: left; width: 25px; height: 20px; margin: 5px 0; padding: 0; text-indent: 100%; white-space: nowrap; overflow: hidden; border: 0; background: transparent; font-size: 12px; line-height: 1; text-align: center; font-weight: bold; }
		.dd-item > button:before { content: '+'; display: block; position: absolute; width: 100%; text-align: center; text-indent: 0; }
		.dd-item > button[data-action="collapse"]:before { content: '-'; }
		
		.dd-placeholder,
		.dd-empty { margin: 5px 0; padding: 0; min-height: 30px; background: #f2fbff; border: 1px dashed #b6bcbf; box-sizing: border-box; -moz-box-sizing: border-box; }
		.dd-empty { border: 1px dashed #bbb; min-height: 100px; background-color: #e5e5e5;
			background-image: -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff), 
							  -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
			background-image:    -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff), 
								 -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
			background-image:         linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff), 
									  linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
			background-size: 60px 60px;
			background-position: 0 0, 30px 30px;
		}
		
		.dd-dragel { position: absolute; pointer-events: none; z-index: 9999; }
		.dd-dragel > .dd-item .dd-handle { margin-top: 0; }
		.dd-dragel .dd-handle {
			-webkit-box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
					box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
		}
		
		/**
		 * Nestable Extras
		 */
		
		.nestable-lists { display: block; clear: both; padding: 30px 0; width: 100%; border: 0; border-top: 2px solid #ddd; border-bottom: 2px solid #ddd; }
		
		#nestable-menu { padding: 0; margin: 20px 0; }
		
		#nestable-output,
		#nestable2-output { width: 100%; height: 7em; font-size: 0.75em; line-height: 1.333333em; font-family: Consolas, monospace; padding: 5px; box-sizing: border-box; -moz-box-sizing: border-box; }
		
		#nestable2 .dd-handle {
			color: #fff;
			border: 1px solid #999;
			background: #bbb;
			background: -webkit-linear-gradient(top, #bbb 0%, #999 100%);
			background:    -moz-linear-gradient(top, #bbb 0%, #999 100%);
			background:         linear-gradient(top, #bbb 0%, #999 100%);
		}
		#nestable2 .dd-handle:hover { background: #bbb; }
		#nestable2 .dd-item > button:before { color: #fff; }
		
		@media only screen and (min-width: 980px) { 
		
			.dd { float: left; width: 100%; }
			.dd + .dd { margin-left: 2%; }
		
		}
		
		.dd-hover > .dd-handle { background: #2ea8e5 !important; }
		
		/**
		 * Nestable Draggable Handles
		 */
		
		.dd3-content { display: block; height: 30px; margin: 5px 0; padding: 5px 10px 5px 40px; color: #333; text-decoration: none; font-weight: bold; border: 1px solid #ccc;
			background: #fafafa;
			background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
			background:    -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
			background:         linear-gradient(top, #fafafa 0%, #eee 100%);
			-webkit-border-radius: 3px;
					border-radius: 3px;
			box-sizing: border-box; -moz-box-sizing: border-box;
		}
		.dd3-content:hover { color: #2ea8e5; background: #fff; }
		
		.dd-dragel > .dd3-item > .dd3-content { margin: 0; }
		
		.dd3-item > button { margin-left: 30px; }
		
		.dd3-handle { position: absolute; margin: 0; left: 0; top: 0; cursor: pointer; width: 30px; text-indent: 100%; white-space: nowrap; overflow: hidden;
			border: 1px solid #aaa;
			background: #ddd;
			background: -webkit-linear-gradient(top, #ddd 0%, #bbb 100%);
			background:    -moz-linear-gradient(top, #ddd 0%, #bbb 100%);
			background:         linear-gradient(top, #ddd 0%, #bbb 100%);
			border-top-right-radius: 0;
			border-bottom-right-radius: 0;
		}
		.dd3-handle:before { content: '='; display: block; position: absolute; left: 0; top: 3px; width: 100%; text-align: center; text-indent: 0; color: #fff; font-size: 20px; font-weight: normal; }
		.dd3-handle:hover { background: #ddd; }

    </style>

<a href="javascript:void(0);" id="expand-all">Expand All</a> | <a href="javascript:void(0);" id="collapse-all">Collapse All</a>
<div class="dd"  id="categories_sort">
	<ol class="dd-list">
	<?php foreach ($pager->getResults() as $i => $categories): ?>

		<li class="dd-item dd3-item" data-id="<?php echo $categories->getId() ?>">
		<div class="dd-handle dd3-handle"></div><div class="dd3-content">
			<?php include_partial('categories/list_td_tabular', array('categories' => $categories)) ?>
			<?php include_partial('categories/list_td_actions', array('categories' => $categories, 'helper' => $helper)) ?>
		</div>
		
		<?php 
		if($categories->getNode()->hasChildren() ) : 
			echo '<ol class="dd-list">';
			
		foreach($categories->getNode()->getDescendants() as $objChid ) : 
		?>
		<li class="dd-item dd3-item" data-id="<?php echo $objChid->getId() ?>">
		<div class="dd-handle dd3-handle"></div><div class="dd3-content">
			<?php include_partial('categories/list_td_tabular', array('categories' => $objChid)) ?>
			<?php include_partial('categories/list_td_actions', array('categories' => $objChid, 'helper' => $helper)) ?>
		</div>
		</li>
		<?php 
			endforeach; 
			
			echo '</ol>';
		  endif; 	
		?>
		</li>
		<?php  
       endforeach; 
    ?>
</ol>
</div>

    <!-- div class="dd">
        <ol class="dd-list">
            <li class="dd-item" data-id="1">
                <div class="dd-handle">Item 1</div>
            </li>
            <li class="dd-item" data-id="2">
                <div class="dd-handle">Item 2</div>
            </li>
            <li class="dd-item" data-id="3">
                <div class="dd-handle">Item 3</div>
                <ol class="dd-list">
                    <li class="dd-item" data-id="4">
                        <div class="dd-handle">Item 4</div>
                    </li>
                    <li class="dd-item" data-id="5">
                        <div class="dd-handle">Item 5</div>
                    </li>
                </ol>
            </li>
        </ol>
    </div -->

<script type="text/javascript">

$(document).ready(function(){
    $('#categories_sort').nestable({
        maxDepth: 2
    });
	

	$('.dd').on('change', function() {

		$.ajax({
			url: "<?php echo url_for('categories/saveorder')?>",
			cache: false,
                        type: 'POST',
			data: {'order' : $('.dd').nestable('serialize')},
		}).done(function( html ) {
			$("#results").append(html);
		});
	
		
});

	$('#expand-all').on('click', function(e)
    {
       $('.dd').nestable('expandAll');
    });

	$('#collapse-all').on('click', function(e)
    {
            $('.dd').nestable('collapseAll');
    });
	
	$('.dd').nestable('collapseAll');
});

function checkAll()
{
  var boxes = document.getElementsByTagName('input'); for(var index = 0; index < boxes.length; index++) { box = boxes[index]; if (box.type == 'checkbox' && box.className == 'sf_admin_batch_checkbox') box.checked = document.getElementById('sf_admin_list_batch_checkbox').checked } return true;
}
</script>