<?php

defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once __DIR__ . '/helper.php';

$doc = JFactory::getDocument();
$doc->addScript('media/mod_callback/js/callbackform.js');
//$doc->addScript('media/mod_callback/js/formvalidation/formValidation.min.js');
//$doc->addScript('media/mod_callback/js/formvalidation/framework/bootstrap.js');
//$doc->addScript('http://formvalidation.io/vendor/formvalidation/js/addons/reCaptcha1.js');
//$doc->addScript('media/mod_callback/js/formvalidation/addons/reCaptcha1-joomla.js');
//$doc->addScript('http://www.google.com/recaptcha/api/js/recaptcha_ajax.js');

// Params
$modalid            = $params->get('modalid');
$linktext           = $params->get('linktext');
$modaltitle         = $params->get('modaltitle');
$buttontext         = $params->get('buttontext');
$labelname          = $params->get('labelname');
$placeholdername    = $params->get('placeholdername');
$labelnumber        = $params->get('labelnumber');
$placeholdernumber  = $params->get('placeholdernumber');
$labelmessage       = $params->get('labelmessage');
$placeholdermessage = $params->get('placeholdermessage');
//$enabledCaptcha     = $params->get('recaptcha_enabled');
$enabledCaptcha     = 0;


$captcha = JFactory::getConfig()->get('captcha');

$captchaField = JCaptcha::getInstance($captcha);

//if (true == $enabledCaptcha)
//{
//	ModCallbackHelper::initCaptcha();
//}

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require JModuleHelper::getLayoutPath('mod_callback', $params->get('layout', 'default'));
