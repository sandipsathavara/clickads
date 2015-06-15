<?php
class myUser extends sfBasicSecurityUser
{
	public function isFirstRequest($boolean = null)
	{
		  if (is_null($boolean))
			return $this->getAttribute('first_request', true);
		  else
			$this->setAttribute('first_request', $boolean);
	}

	/**
	 * Executes method login and set authenticate for login user, make credential, set attribute
	 * @param mix $user contain object of result set
	 */
	public function setSessionUser($oUser)
	{
		$this->setAuthenticated(true);
		$this->addCredential( $oUser->getUserType() );
		$this->setAttribute('id'       , $oUser->getId()       , 'oUserInfoClient');
		$this->setAttribute('email'    , $oUser->getEmail()    , 'oUserInfoClient');
		$this->setAttribute('nickname' , $oUser->getNickname() , 'oUserInfoClient');
		$this->setAttribute('type'     , $oUser->getUserType() , 'oUserInfoClient');
		$this->setAttribute('status'   , $oUser->getStatus()   , 'oUserInfoClient');
	}
	
	/**
	 * Executes method logout and unset authenticate for login user, remove credential, unset attribute
	 */
	public function logoutUser()
	{
		$this->getAttributeHolder()->removeNamespace('oUserInfoClient');
		$this->setAuthenticated(false);
		$this->clearCredentials();
	}

}