<?php

defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once __DIR__ . '/helper.php';

$doc = JFactory::getDocument();
$doc->addScript('media/mod_callback/js/callbackform.js');
$doc->addScript('media/mod_callback/js/formvalidation/formValidation.min.js');
$doc->addScript('media/mod_callback/js/formvalidation/bootstrap.js');

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

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require JModuleHelper::getLayoutPath('mod_callback', $params->get('layout', 'default'));
