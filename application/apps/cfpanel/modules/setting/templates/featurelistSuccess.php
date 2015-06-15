<?php 
	$oFrmSetting = $oForm['setting']
?>
		<div class="block">

				<div class="block_head">
					<div class="bheadl"></div>
					<div class="bheadr"></div>
					<h2>Featured List Setting</h2>
				</div>		<!-- .block_head ends -->

				<div class="block_content">
				
				<?php 
				    echo form_tag('@featurelist', array('name' => 'frmUser', 'multipart' => true , 'onSubmit' => 'this.submit()' ));
		  			echo $oFrmSetting->renderHiddenFields(); 
				 if ($sf_user->hasFlash('notice')):  ?>
		 			 <div class="message success"><?php echo $sf_user->getFlash('notice') ?></div>
                                  <?php endif; ?>
                                         
                                         
                                                <p>
						      <label for="is_paypal_testmode">Paypal Test Mode:</label><br />
						      <?php echo $oFrmSetting['is_paypal_testmode']['value']->render(array( 'id' => 'is_paypal_testmode' , 'class' => ''   )) ; ?>
                                                      <span>Checked for enable PayPal test mode ,UnChecked for make it live</span><br />
						      <span class="error"><?php echo $oFrmSetting['is_paypal_testmode']['value']->renderError(); ?></span>
						</p>
                                                
						<p>
						      <label for="paypal_seller_account">Paypal Seller Account:</label><br />
						      <?php echo $oFrmSetting['paypal_seller_account']['value']->render(array( 'id' => 'paypal_seller_account' , 'class' => 'text small'   )) ; ?>
                                                      <br /><span>Paypal AccountId, Money Where you want to receive</span><br />
						      <span class="error"><?php echo $oFrmSetting['paypal_seller_account']['value']->renderError(); ?></span>
						</p>

                                                <p>
						    <label for="currency_code">Currency:</label><br />
						    <?php echo $oFrmSetting['currency_code']['value']->render(array( 'id' => 'currency_code' , 'class' => 'styled'   )) ; ?>
                                                    <span>Currency format that you to money in PayPal account </span><br />
						    <span class="error"><?php echo $oFrmSetting['currency_code']['value']->renderError(); ?></span>
						</p>
                                                
                                                <p>
						    <label for="feature_monthly_price">Monthly Price:</label><br />
						    <?php echo $oFrmSetting['feature_monthly_price']['value']->render(array( 'id' => 'feature_monthly_price' , 'class' => 'text small'   )) ; ?>
                                                    <br /><span>Amount for monthly featured list</span><br />        
						    <span class="error"><?php echo $oFrmSetting['feature_monthly_price']['value']->renderError(); ?></span>
						</p>
                                                
						<hr/>
                                                
						<p>
						    <?php echo tag('input',array('type'=>'submit' , 'value'=> 'submit','class'=>'submit mid')); ?>
						</p>
					</form>
					
					
				</div>		<!-- .block_content ends -->
				
				<div class="bendl"></div>
				<div class="bendr"></div>
					
			</div>