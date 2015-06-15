<?php 
/**
 * home Components.
 *
 * @package    classifieds
 * @subpackage home
 * @author     Sandip Sathavara <sandip.sathavara@gmail.com> 
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class homeComponents extends sfComponents
{

  public function getPage($action)
  {
	 switch ($action)
	 {
	 	case 'state':
	 	case 'listPosts':
	 	case 'postdetail':
                    $this->page = 'INNER_PAGE'; 
		break;
                case 'category':
                    $this->page = 'HOME_PAGE'; 
		default:
		  $this->page = 'HOME_PAGE';
		break;
	 }
	 
  	 return $this->page;
	 	
  }
  
  public function executeAdsSidebare(sfWebRequest $request)
  {
	 $this->objAds = AdsTable::getActiveAds(array($this->getPage($this->action),'BOTH') , 'SIDEBAR125');
         $this->freeAds = PostsTable::getNewestFreePosts();
         $this->featuredAds = PostsTable::getNewestFeaturedPosts();
  }

  public function executeAdsSinglecolumn(sfWebRequest $request)
  {
	 $this->objAds = AdsTable::getActiveAds(array($this->getPage($this->action),'BOTH') , 'SIDEBAR200');
  }
  
  public function executeAdsLeaderboard(sfWebRequest $request)
  {
  	 $this->objAds = AdsTable::getActiveAds(array($this->getPage($this->action),'BOTH')  , 'LEADERBOARD');
  }  

  public function executeAdsLeaderboard350(sfWebRequest $request)
  {
  	 $this->objAds = AdsTable::getActiveAds(array($this->getPage($this->action),'BOTH')  , 'LEADERBOARD350');
  }  


  public function executeCatDropdown(sfWebRequest $request)
  {
	  $this->objRs = CategoriesTable::getCategoryGroupForSearch();
  }   

  public function executeLanguage(sfWebRequest $request)
  {
	  $this->objRs = LanguagesTable::getAllActiveLanguageFullName();
  }   

  public function executeFeatureads(sfWebRequest $request)
  {
	  $this->featuredAds = PostsTable::getNewestFeaturedPosts();
  }
  
  
  
}