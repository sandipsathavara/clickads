<?php

require_once dirname(__FILE__) . '/../lib/postsGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/postsGeneratorHelper.class.php';

/**
 * posts actions.
 *
 * @package    classifieds
 * @subpackage posts
 * @author     Sandip Sathavara <sandip.sathavara@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
sfContext::getInstance()->getConfiguration()->loadHelpers(array('jQuery', 'Url'));

class postsActions extends autoPostsActions
{

    public function executeStatus(sfWebRequest $request)
    {
        if ($request->getParameter('id')) {
            Doctrine_Query::create()
                    ->update('Posts')
                    ->set('status', '?', $request->getParameter('status'))
                    ->where('id = ?', $request->getParameter('id'))
                    ->execute();

            $this->getUser()->setflash('notice', 'Post status has been updated successfully');
            $this->redirect('@posts');
        }
        $this->forward404Unless($request->getParameter('id'));
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

            try {
                $posts = $form->save();


                $post_id = $form->getObject()->getId();

                //--- Get All Images From ---//
                $arrImages = $form->getValues();

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
              
                
            } catch (Doctrine_Validator_Exception $e) {

                $errorStack = $form->getObject()->getErrorStack();

                $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ? 's' : null) . " with validation errors: ";
                foreach ($errorStack as $field => $errors) {
                    $message .= "$field (" . implode(", ", $errors) . "), ";
                }
                $message = trim($message, ', ');

                $this->getUser()->setFlash('error', $message);
                return sfView::SUCCESS;
            }

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $posts)));

            if ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');

                $this->redirect('@posts_new');
            } else {
                $this->getUser()->setFlash('notice', $notice);

                $this->redirect(array('sf_route' => 'posts_edit', 'sf_subject' => $posts));
            }
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }

}
