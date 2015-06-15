<?php
/**
 * login actions.
 *
 * @package    login
 * @subpackage login
 * @author     Sandip Sathavara <sandip.sathavara@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class loginActions extends sfActions
{

 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
	 #--- If User is already Authenticated than ---#  
	 if($this->getUser()->isAuthenticated() && $this->getUser()->hasCredential('admin')) 
		  $this->redirect('login/welcome');

     #--- Email ---#
  	 $this->frmLogin = new AdminLoginForm();
	 
	 if ( $request->isMethod('post') )
	 {
	    $this->frmLogin->bind( $request->getParameter('login') );
		
		 		
		if ( $this->frmLogin->isValid() )
		{	
		  $oUser = UsersTable::checkUserExist($this->frmLogin );

		
		  if($oUser)
		  {
			  $this->getUser()->setSessionUser($oUser);
                          $this->redirect('login/welcome');
		  } 	  
		  else
		  {
		  	$this->getUser()->setFlash('error' , 'Username or Password worng' );
		  	$this->redirect('login/index');
		  }
		}
	 }
   }
	
  /**
   *  WelCome Action 	
   * 	
   * 	      
   */	
  public function executeWelcome(sfWebRequest $request)
  {
  	 	#--- Get Current month Register ---#
		$oCurrUsers =  UsersTable::getNumberOfUsers();
		
        $this->arrCurrUsers = array();
		foreach($oCurrUsers as $k => $v)
		{
			$this->arrCurrUsers[$v['day']] = $v['currUser'];
		}

		#--- Get Current month Register ---#
		$oMonthsByUsers =  UsersTable::getNumberOfUsersByMonths();
		
        $this->arrMonthUsers = array();
		foreach($oMonthsByUsers as $k => $v)
		{
			$this->arrMonthUsers[$v['month']] = $v['numberUsers'];
		}

  	 	#--- Get Current month Post ---#
		$oCurrPosts =  PostsTable::getNumberOfPosts();
		
        $this->arrCurrPosts = array();
		foreach($oCurrPosts as $k => $v)
		{
			$this->arrCurrPosts[$v['day']] = $v['currPost'];
		}
		
		#--- Get Current Year Post ---#
		$oMonthsByPosts =  PostsTable::getNumberOfPostsByMonths();
		
        $this->arrMonthPosts = array();
		foreach($oMonthsByPosts as $k => $v)
		{
			$this->arrMonthPosts[$v['month']] = $v['numberPosts'];
		}		
		
		#--- Get Total Users ---#
		$this->totalUsers = UsersTable::getInstance()->count();
		
		#--- Get Total Posts ---#
		$this->totalPosts = PostsTable::getInstance()->count();

		#--- Get 10 Users ---#
		$this->newest10Users = UsersTable::getNewest10Users();

		#--- Get 10 Posts ---#
		$this->newest10Posts = PostsTable::getNewest10Posts();

  }
  
  
  
  
  
}
