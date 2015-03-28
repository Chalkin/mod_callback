<?php

defined('_JEXEC') or die;

JHtml::_('bootstrap.tooltip');
JHtmlBehavior::core();

?>

<div class="callbackform<?php echo $moduleclass_sfx; ?>">

	<a href="#" data-target="#<?php echo $modalid; ?>"><?php echo $linktext; ?></a>

	<div class="modal" id="<?php echo $modalid; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title"><?php echo $modaltitle; ?></h4>
				</div>

				<div class="modal-body"> <!-- action="index.php?option=com_ajax&module=callback&format=json" -->
					<form id="callbackForm" class="callbackform-horizontal" method="post" role="form" action="index.php?option=com_ajax&module=callback&format=json">
						<div class="form-group">
							<label for="callback-fullname"><?php echo $labelname; ?></label>
							<input type="text" id="callback-fullname" class="form-control fullname" name="fullname" placeholder="<?php echo $placeholdername; ?>">
						</div>
						<div class="form-group">
							<label for="callback-number"><?php echo $labelnumber; ?></label>
							<input type="text" id="callback-number" class="form-control phonenumber" name="phonenumber" placeholder="<?php echo $placeholdernumber; ?>">
						</div>
						<div class="form-group">
							<label for="callback-message"><?php echo $labelmessage; ?></label>
							<textarea id="callback-message" class="form-control message" rows="3" name="message" placeholder="<?php echo $placeholdermessage; ?>"></textarea>
						</div>
						<?php if ($enabledCaptcha = 1) : ?>
							<div class="form-group">
								<?php echo $captchaField->display('irgendwas', 'replace-captcha'); ?>
							</div>
						<?php endif; ?>
						<div>
							<small>* Pflichtfelder</small>
						</div>
						<div class="clearfix">
							<button type="submit" class="btn btn-primary pull-right"><?php echo $buttontext; ?></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>