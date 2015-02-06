<?php

defined('_JEXEC') or die;


class ModCallbackHelper
{
	public static function getAjax()
	{
		jimport('joomla.application.module.helper');
		$module = JModuleHelper::getModule('mod_callback');
		$params = new JRegistry();
		$params->loadString($module->params);

		$app   = JFactory::getApplication();
		$input = JFactory::getApplication()->input;
		$data  = $input->post->getArray();

		// Load language
		$app->getLanguage()->load('mod_callback');

		// Set Email params
		$mailsender = $params->get('mailsender');
		$recipient  = $params->get('recipient');
		$fromname   = $params->get('emailfrom');
		$subject    = $params->get('emailsubject');
		$sitename   = $app->get('sitename');

		$phonenumber = $data['phonenumber'];
		$fullname    = $data['fullname'];
		$message     = $data['message'];

		$body = "\n Name: " . $fullname . "\nNummer: " . $phonenumber . "\nNachricht: " . $message;

		// Prepare and send Email
		$mail = JFactory::getMailer();
		$mail->addRecipient($recipient);
		$mail->setSender(array($mailsender, $fromname));
		$mail->setSubject($sitename . ': ' . $subject);
		$mail->setBody($body);
		$sent = $mail->Send();

		if (true == $sent)
		{
			http_response_code(200);
			echo json_encode(array('success' => true, 'error' => false, 'messages' => array(JText::_('MOD_CALLBACK_AJAX_MSG_SUCCESS'))));
			die();
		}
		else
		{
			echo json_encode(array('success' => false, 'error' => true, 'messages' => array(JText::_('MOD_CALLBACK_AJAX_MSG_ERROR'))));
			die();
		}
	}
}
