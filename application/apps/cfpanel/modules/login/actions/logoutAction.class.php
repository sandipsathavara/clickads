<?php 
/**
 * login actions.
 *
 * @package    Logout
 * @subpackage Login
 * @author     Sandip Sathavara
 * @version    SVN: $Id: logoutAction.class.php,v 1.2 2009/02/23 11:41:45 sandips Exp $
 */
 sfProjectConfiguration::getActive()->loadHelpers('I18N'); 
class logoutAction extends sfAction 
{
	public function execute($request)
	{  
		if($this->getUser()->isAuthenticated()) 
		{
			$this->getUser()->logoutUser();
			$this->getUser()->setFlash('error', 'Logout Successfully' );
		}
		$this->redirect('login/index');
	}	
}
