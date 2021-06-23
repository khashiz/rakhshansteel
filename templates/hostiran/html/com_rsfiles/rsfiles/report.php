<?php
/**
* @package RSFiles!
* @copyright (C) 2010-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/
defined( '_JEXEC' ) or die( 'Restricted access' ); 
JText::script('COM_RSFILES_REPORT_MESSAGE_ERROR');
JText::script('COM_RSFILES_CONSENT_ERROR'); ?>

<div class="rsfiles-layout rsfiles-modal">
	<form action="<?php echo JRoute::_('index.php?option=com_rsfiles'); ?>" method="post" name="adminForm" id="adminForm">
		<div class="alert" id="rsf_alert" style="display:none;">
			<button type="button" class="close" onclick="jQuery('#rsf_alert').css('display','none');">&times;</button>
			<span id="rsf_message"></span>
		</div>
		<div class="well">
			<div class="row-fluid">
				<div class="control-group">
					<div class="control-label">
						<label><?php echo JText::_('COM_RSFILES_REPORT_MESSAGE'); ?></label>
					</div>
					<div class="controls">
						<textarea name="jform[report]" id="report" class="input-xxlarge" rows="7" cols="40"></textarea>
					</div>
				</div>
				
				<?php if ($this->config->consent) { ?>
				<div class="control-group">
					<div class="controls">
						<label class="checkbox">
							<input type="checkbox" id="consent" class="required" name="consent" value="1" /> 
							<?php echo JText::_('COM_RSFILES_CONSENT'); ?>
						</label>
					</div>
				</div>
				<?php } ?>
			
				<div class="clearfix"></div>
				<div style="text-align: right;">
					<button type="submit" class="btn btn-primary" onclick="return validate_report();"><?php echo JText::_('COM_RSFILES_SEND'); ?></button> 
					<button type="button" class="btn" onclick="<?php echo rsfilesHelper::modalClose(false, true); ?>"><?php echo JText::_('COM_RSFILES_CANCEL'); ?></button>
				</div>
			</div>
		</div>
		
		<?php echo JHTML::_( 'form.token' ); ?>
		<input type="hidden" name="task" value="rsfiles.report" />
		<input type="hidden" name="jform[path]" value="<?php echo urldecode($this->app->input->getString('path','')); ?>" />
	</form>
</div>