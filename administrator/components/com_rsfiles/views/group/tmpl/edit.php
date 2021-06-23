<?php
/**
* @package RSFiles!
* @copyright (C) 2010-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.formvalidator');
JHtml::_('behavior.keepalive'); ?>

<script type="text/javascript">
	Joomla.submitbutton = function(task) {
		if (task == 'group.cancel' || document.formvalidator.isValid(document.getElementById('adminForm'))) {
			Joomla.submitform(task, document.getElementById('adminForm'));
		}
	}
	
	function jSelectUser(what) {
		var id	 = jQuery(what).data('user-value');
		var name = jQuery(what).data('user-name');
		
		if (id == '') {
			jQuery('#rsfUsersModal').modal('hide');
			return;
		}
		
		if (jQuery('#jform_jusers option[value="'+id+'"]').length) {
			alert('<?php echo JText::_('COM_RSFILES_USER_ALREADY_EXISTS',true); ?>');
			return;
		}
		
		jQuery('#jform_jusers').append(jQuery('<option>', { 'text': name, 'value': id, selected : true }));
		jQuery('#jform_jusers').trigger("liszt:updated");
		jQuery('#rsfUsersModal').modal('hide');
	}

	function removeusers() {
		jQuery('#jform_jusers option').remove();
		jQuery('#jform_jusers').trigger("liszt:updated");
	}
	
	<?php if ($this->used) { ?>
	jQuery(document).ready(function() {
		var used = new String('<?php echo implode(',',$this->used); ?>');
		var array = used.split(','); 
		
		jQuery('#jform_jgroups option').each(function() {
			if (array.includes(jQuery(this).val())) {
				jQuery(this).prop('disabled', true);
			}
		});
		
		if (typeof jQuery.fn.chosen == 'function') {
			jQuery('#jform_jgroups').trigger('liszt:updated');
		}
	});
	<?php } ?>
</script>

<form action="<?php echo JRoute::_('index.php?option=com_rsfiles&view=group&layout=edit&IdGroup='.(int) $this->item->IdGroup); ?>" method="post" name="adminForm" id="adminForm" autocomplete="off" class="form-validate form-horizontal">
	<div class="row-fluid">
		<div class="span6 rsspan6 rslft">
			<?php $extra = '<span class="rs_extra"><a href="javascript:void(0)" onclick="jQuery(\'#rsfUsersModal\').modal(\'show\');">'.JText::_('COM_RSFILES_GROUP_ADD_USERS').'</a>'; ?>
			<?php $extra .= ' / <a href="javascript:void(0);" onclick="removeusers();">'.JText::_('COM_RSFILES_GROUP_REMOVE_USERS').'</a></span>'; ?>
			
			<?php echo JHtml::_('rsfieldset.start', 'adminform', JText::_('COM_RSFILES_GROUP_GENERAL')); ?>
			<?php echo JHtml::_('rsfieldset.element', $this->form->getLabel('GroupName'), $this->form->getInput('GroupName')); ?>
			<?php echo JHtml::_('rsfieldset.element', $this->form->getLabel('jgroups'), $this->form->getInput('jgroups')); ?>
			<?php echo JHtml::_('rsfieldset.element', $this->form->getLabel('jusers'), $this->form->getInput('jusers').$extra); ?>
			<?php echo JHtml::_('rsfieldset.element', $this->form->getLabel('moderate'), $this->form->getInput('moderate')); ?>
			<?php echo JHtml::_('rsfieldset.element', $this->form->getLabel('editown'), $this->form->getInput('editown')); ?>
			<?php echo JHtml::_('rsfieldset.element', $this->form->getLabel('deleteown'), $this->form->getInput('deleteown')); ?>
			<?php echo JHtml::_('rsfieldset.end'); ?>
		</div>
		
		<div class="span6 rsspan6 rslft">
			<?php echo JHtml::_('rsfieldset.start', 'adminform', JText::_('COM_RSFILES_GROUP_BRIEFCASE')); ?>
			<?php echo JHtml::_('rsfieldset.element', $this->form->getLabel('CanDownloadBriefcase'), $this->form->getInput('CanDownloadBriefcase')); ?>
			<?php echo JHtml::_('rsfieldset.element', $this->form->getLabel('CanUploadBriefcase'), $this->form->getInput('CanUploadBriefcase')); ?>
			<?php echo JHtml::_('rsfieldset.element', $this->form->getLabel('CanDeleteBriefcase'), $this->form->getInput('CanDeleteBriefcase')); ?>
			<?php echo JHtml::_('rsfieldset.element', $this->form->getLabel('CanMaintainBriefcase'), $this->form->getInput('CanMaintainBriefcase')); ?>
			<?php echo JHtml::_('rsfieldset.element', $this->form->getLabel('MaxFilesNo'), $this->form->getInput('MaxFilesNo')); ?>
			<?php echo JHtml::_('rsfieldset.element', $this->form->getLabel('MaxFileSize'), $this->form->getInput('MaxFileSize').' <span class="rs_extra">Mb ('.JText::sprintf('COM_RSFILES_MAX_IN_PHP',ini_get('upload_max_filesize')).')</span>'); ?>
			<?php echo JHtml::_('rsfieldset.element', $this->form->getLabel('MaxFilesSize'), $this->form->getInput('MaxFilesSize').' <span class="rs_extra">Mb</span>'); ?>
			<?php echo JHtml::_('rsfieldset.end'); ?>
		</div>
	</div>

	<?php echo JHTML::_('form.token'); ?>
	<input type="hidden" name="task" value="" />
	<?php echo $this->form->getInput('IdGroup'); ?>
</form>

<?php $url = 'index.php?option=com_users&view=users&layout=modal&tmpl=component&field=jform_jusers'.(!empty($this->excludes) ? '&excluded=' . base64_encode(json_encode($this->excludes)) : ''); ?>
<?php echo JHtml::_('bootstrap.renderModal', 'rsfUsersModal', array('title' => '&nbsp;', 'url' => JRoute::_($url, false), 'height' => 800, 'bodyHeight' => 70)); ?>