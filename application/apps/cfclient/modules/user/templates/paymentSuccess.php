
<form id="paypal" name="paypal" action="<?php echo (!sfConfig::get('is_paypal_testmode') ) ? 'https://www.paypal.com/cgi-bin/webscr' : 'https://sandbox.paypal.com/cgi-bin/webscr'; ?>" method="post">  

    <input type="hidden" name="cmd" value="_xclick">  
    <input type="hidden" name="rm" value="2"/>
    <input type="hidden" name="business" value="<?php echo sfConfig::get('paypal_seller_account') ?>">  
    <input type="hidden" name="item_name" value="<?php echo $objPost->getTitle(); ?>">  
    <input type="hidden" name="item_number" value="POST<?php echo $objPost->getId(); ?>">  
    <input type="hidden" name="amount" value="<?php echo sfConfig::get('feature_monthly_price') ?>">  
    
    
    <input type="hidden" name="return" value="<?php echo $sf_params->get('mc')==1 ? url_for('@cms_page?page=renewsuccesspost', true) : url_for('@cms_page?page=successpost', true)  ?>" />
    <input type="hidden" name="cancel_return" value="<?php echo url_for('@cms_page?page=cancelledpost', true) ?>"/>
    <input type="hidden" name="notify_url" value="<?php echo url_for('user/ipn', true) ?>"/>

    <input type="hidden" name="custom" value="<?php echo $objPost->getId(); ?>"/>
    <!--input type="hidden" name="tax" value="0" -->  
    <input type="hidden" name="quantity" value="1">  
    <input type="hidden" name="no_note" value="1">  
    <input type="hidden" name="currency_code" value="<?php echo sfConfig::get('currency_code'); ?>">  

         <center><br/><br/>If you are not automatically redirected to paypal within 5 seconds...<br/><br/>
        <input type="image" name="submit"  src="https://www.paypal.com/en_US/i/btn/btn_buynow_LG.gif"   alt="PayPal - The safer, easier way to pay online">  
        </center>
    
        </form>

        <script type="text/javascript">
            setTimeout(document.paypal.submit(), 6000);
        </script>


        
        
        