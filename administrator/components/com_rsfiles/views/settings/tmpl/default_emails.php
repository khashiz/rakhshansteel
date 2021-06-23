<?php
/**
* @package RSFiles!
* @copyright (C) 2010-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

defined( '_JEXEC' ) or die( 'Restricted access' ); ?>

<div class="row-fluid">
	<div class="span4 rslft rsspan4">
		<?php 
			$fieldsets = array('emails'); 
			foreach ($fieldsets as $fieldset) {
				echo JHtml::_('rsfieldset.start', 'adminform', JText::_($this->fieldsets[$fieldset]->label));
				foreach ($this->form->getFieldset($fieldset) as $field) {
					echo JHtml::_('rsfieldset.element', $field->label, $field->input);
				}
				echo JHtml::_('rsfieldset.end');
			}
			?>
	</div>
	<div class="span8 rsrgt rsspan8">
		<table class="adminlist table table-striped">
		<tbody>
			<tr>
				<td><a class="<?php echo rsfilesHelper::tooltipClass(); ?>" onclick="jQuery('#rsfAdminEmailModal').modal('show');" title="<?php echo rsfilesHelper::tooltipText(JText::_('COM_RSFILES_CONF_ADMIN_EMAIL_DESC')); ?>" href="javascript:void(0);"><?php echo JText::_('COM_RSFILES_CONF_ADMIN_EMAIL'); ?></a></td>
			</tr>
			<tr>
				<td><a class="<?php echo rsfilesHelper::tooltipClass(); ?>" onclick="jQuery('#rsfDownloadEmailModal').modal('show');" title="<?php echo rsfilesHelper::tooltipText(JText::_('COM_RSFILES_CONF_DOWNLOAD_EMAIL_DESC')); ?>" href="javascript:void(0);"><?php echo JText::_('COM_RSFILES_CONF_DOWNLOAD_EMAIL'); ?></a></td>
			</tr>
			<tr>
				<td><a class="<?php echo rsfilesHelper::tooltipClass(); ?>" onclick="jQuery('#rsfUploadEmailModal').modal('show');" title="<?php echo rsfilesHelper::tooltipText(JText::_('COM_RSFILES_CONF_UPLOAD_EMAIL_DESC')); ?>" href="javascript:void(0);"><?php echo JText::_('COM_RSFILES_CONF_UPLOAD_EMAIL'); ?></a></td>
			</tr>
			<tr>
				<td><a class="<?php echo rsfilesHelper::tooltipClass(); ?>" onclick="jQuery('#rsfReportEmailModal').modal('show');" title="<?php echo rsfilesHelper::tooltipText(JText::_('COM_RSFILES_CONF_REPORT_EMAIL_DESC')); ?>" href="javascript:void(0);"><?php echo JText::_('COM_RSFILES_CONF_REPORT_EMAIL'); ?></a></td>
			</tr>
			<tr>
				<td><a class="<?php echo rsfilesHelper::tooltipClass(); ?>" onclick="jQuery('#rsfBriefcaseuploadEmailModal').modal('show');" title="<?php echo rsfilesHelper::tooltipText(JText::_('COM_RSFILES_CONF_BRIEFCASE_UPLOAD_EMAIL_DESC')); ?>" href="javascript:void(0);"><?php echo JText::_('COM_RSFILES_CONF_BRIEFCASE_UPLOAD_EMAIL'); ?></a></td>
			</tr>
			<tr>
				<td><a class="<?php echo rsfilesHelper::tooltipClass(); ?>" onclick="jQuery('#rsfModerateEmailModal').modal('show');" title="<?php echo rsfilesHelper::tooltipText(JText::_('COM_RSFILES_CONF_MODERATE_EMAIL_DESC')); ?>" href="javascript:void(0);"><?php echo JText::_('COM_RSFILES_CONF_MODERATE_EMAIL'); ?></a></td>
			</tr>
		</tbody>
	</table>
	</div>
</div>
<div class="clr"></div>