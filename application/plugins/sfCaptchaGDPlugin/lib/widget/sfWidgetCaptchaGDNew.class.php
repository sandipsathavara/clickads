<?php
class sfWidgetCaptchaGDNew extends sfWidgetForm
{
  protected function configure($options = array(), $attributes = array())
  {
  }
  
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $context = sfContext::getInstance();
    $url = $context->getRouting()->generate("sf_captchagd");
    $value = $context->getRequest()->getPostParameter('captcha');
    $attributes = array_merge($attributes, array('class' => 'captcha'));
    return $this->renderTag('input', array_merge(array('type' => 'text', 'name' => $name, 'value' => $value), $attributes)) ;
  }
}
