<?php

/**
 * Post classified ads
 *
 * PHP version 5.2
 * 
 * @category PHP
 * @package  SfClassi
 * @author   Sandip Sathavara <sandip.sathavara@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.expertswebsolution.com/
 *
 */
sfProjectConfiguration::getActive()->loadHelpers('I18N');

/**
 * Post classified ads
 * 
 * PHP version 5.2
 * 
 * @category PHP
 * @package  SfClassi
 * @author   Sandip Sathavara <sandip.sathavara@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.expertswebsolution.com
 * Copyright (c) Experts Web Solution  2012-2013
 */
class postadsAction extends sfAction
{

    /**
     * Post Ads
     *
     * @param sfRequest $request request parameter
     *
     * @return void
     */
    public function execute($request)
    {
        //--- Get Post Object ---//
        $this->objPost = '';
        if ($request->getParameter('posts') || $request->getParameter('post_id')) {
            $arrPosts = $request->getParameter('posts');
            $this->objPost = PostsTable::getPostByPostId(isset($arrPosts['id']) ? $arrPosts['id'] : $request->getParameter('post_id'));

            //--- Create Form Object ---// 	
            $this->oForm = new ClientPostsForm($this->objPost);
        } else {
            //--- Create Form Object ---// 	
            $this->oForm = new ClientPostsForm();
        }

        if ($request->isMethod('post')) {

            $this->oForm->bind($request->getParameter($this->oForm->getName()), $request->getFiles($this->oForm->getName()));

            if ($this->oForm->isValid()) {

                $this->oForm->save();
                $post_id = $this->oForm->getObject()->getId();

                //--- Get All Images From ---//
                $arrImages = $this->oForm->getValues();

                $totImage = PostImages::getImageCount($post_id);

                foreach ($arrImages['image'] as $j => $image) {
                    if ($totImage <= sfConfig::get('app_file_limit')) {
                        $file_name = strtolower($image->getOriginalName());

                        //--- Targeted File Path ---//
                        $file_path = sfConfig::get('sf_upload_dir') .
                                DIRECTORY_SEPARATOR . 'posts' .
                                DIRECTORY_SEPARATOR . $post_id .
                                DIRECTORY_SEPARATOR;

                        //--- Original Tageted File Path ---//
                        $file_path_o = $file_path . 'o' . DIRECTORY_SEPARATOR . $file_name;

                        if (!file_exists($file_path_o)) {
                            //--- Save Origanle images ---//
                            $image->save($file_path_o, 0777, true, 0777);

                            //--- Create Differnt type of size ---//  
                            $arrImageType = sfConfig::get('app_image_size');

                            foreach ($arrImageType as $k => $imgAttr) {
                                //--- Create Directory  ---//
                                @mkdir($file_path . $k);

                                //--- Create Images  ---//
                                $img = new ImageResize($file_path_o);
                                
                               
                                $img->resizeImage($imgAttr['w'], $imgAttr['h']);
                                $img->saveImage($file_path . $k . DIRECTORY_SEPARATOR . $file_name, 100);
                            }

                            $this->oImg = new PostImages();
                            $this->oImg->setImage($file_name);
                            $this->oImg->setPostId($post_id);
                            $this->oImg->setIsCover(($totImage == 0 && $j == 0) ? true : false);
                            $this->oImg->save();
                        }
                    }
                }

                $arrPosts = $request->getParameter('posts');

                //--- Redirect 404 if this->objPosts not find ---//
                $this->forward404Unless($post_id);

                if ($arrImages['is_featured'] == true) {

                    if ($this->oForm->isNew() ||  ( $this->objPost != '' && $this->objPost->getIsFeatured() != 1)) {
                       $this->redirect('user/payment?id=' . $post_id);
                    } else {
                        $this->getUser()->setFlash('error', __('msg_post_edit_success'));
                        $this->redirect('@myads');
                    }
                    die('done');
                } else if (@$arrPosts['id'] || $request->getParameter('post_id')) {
                    $this->getUser()->setFlash('error', __('msg_post_edit_success'));
                    $this->redirect('@myads');
                } else {
                    $this->redirect('@cms_page?page=successpost');
                }
                //--- Redirect on base of action  ---//  
            }
        }


        //--- Set page title ---// 
        $this->getResponse()->setTitle(__('post_classifiled_title', '', 'postad'));

        //--- Set Breadcrumb url ---//	
        $obj = new Breadcrumb();
        $obj->add(__('cap_post_ad', '', 'postad'), $request->getUri(), 1);
    }

}