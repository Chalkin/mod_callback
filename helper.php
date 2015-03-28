<?php

defined('_JEXEC') or die;

JPluginHelper::importPlugin('captcha');

class ModCallbackHelper
{
	/**
	 * Handling the Ajax response coming from com_ajax
	 *
	 * @author <kontakt@patrick-klostermeier.de> Patrick Klostermeier
	 */
	public function getAjax()
	{
		jimport('joomla.application.module.helper');
		$module = JModuleHelper::getModule('mod_callback');
		$params = new JRegistry();
		$params->loadString($module->params);

		$app   = JFactory::getApplication();
		$data  = $app->input->post->getArray();

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
			echo json_encode(array('success' => true, 'error' => false, 'message' => JText::_('MOD_CALLBACK_AJAX_MSG_SUCCESS')));
			die();
		}
		else
		{
			echo json_encode(array('success' => false, 'error' => true, 'message' => JText::_('MOD_CALLBACK_AJAX_MSG_ERROR')));
			die();
		}
	}

	public function validateCaptchaAjax()
	{
		// Validate captcha code
		$dispatcher = JEventDispatcher::getInstance();
		$isValid    = $dispatcher->trigger('onCheckAnswer', 'irgendwas is egal');

		// Return ajax response
		http_response_code(200);
		echo json_encode(array(
			'valid'   => $isValid[0],
			'message' => $isValid[0] ? null : 'Hey, the captcha is wrong!',
		));
		die();
	}

	/**
	 * Init the Captcha Module if required
	 *
	 * @author <kontakt@patrick-klostermeier.de> Patrick Klostermeier
	 */
	public static function initCaptcha()
	{
		$dispatcher = JEventDispatcher::getInstance();
		$dispatcher->trigger('onInit', 'callback_recaptcha');
	}
}