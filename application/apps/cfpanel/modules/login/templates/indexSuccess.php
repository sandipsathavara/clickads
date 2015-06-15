<div class="block small center login">
	<div class="block_head">
		<div class="bheadl"></div>
		<div class="bheadr"></div>
		<h2>Login</h2>
	</div>		<!-- .block_head ends -->

	<div class="block_content">
	<?php if( $sf_user->hasFlash('error') ) : ?>
		<div class="message errormsg"><p><?php echo $sf_user->getFlash('error') ; ?></p></div>
	<?php endif; 
		  echo form_tag('login/index', array('name' => 'frmLogin', 'multipart' => true,'class' => 'uniForm focusFirstField' , 'id' => 'system_form_2' )); 
		  echo $frmLogin->renderHiddenFields();
	?>	
			<p>
				<label for="email">Email :</label> <br />
				<?php echo $frmLogin['email']->renderError( array('class' => 'errorField') ); ?>
				<?php echo $frmLogin['email']->render(array( 'id' => 'email' , 'tabindex' => 1 , 'class' => 'text')) ; ?>
			</p>
			<p>
				<label for="password">Password :</label><br />
				<?php echo $frmLogin['password']->renderError() ?>
				<?php echo $frmLogin['password']->render(array( 'id' => 'password' , 'tabindex' => 2 , 'class' => 'text' )) ; ?>							
			</p>
			<p>
				<input type="submit" class="submit" value="Login" />
			</p>
		</form>
	</div>		<!-- .block_content ends -->
	<div class="bendl"></div>
	<div class="bendr"></div>
</div>		<!-- .login ends -->			
