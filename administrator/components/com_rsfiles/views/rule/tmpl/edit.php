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
		if (task == 'rule.cancel' || document.formvalidator.isValid(document.getElementById('adminForm'))) {
			Joomla.submitform(task, document.getElementById('adminForm'));
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_rsfiles&view=rule&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="adminForm" autocomplete="off" class="form-validate form-horizontal">
	<div class="row-fluid">
		<div class="span12">
			<?php echo JHtml::_('rsfieldset.start', 'adminform'); ?>
			<?php echo JHtml::_('rsfieldset.element', $this->form->getLabel('name'), $this->form->getInput('name')); ?>
			<?php echo JHtml::_('rsfieldset.element', $this->form->getLabel('folder'), $this->form->getInput('folder')); ?>
			<?php echo JHtml::_('rsfieldset.end'); ?>
		</div>
	</div>
	
	<div class="row-fluid">
		<div class="span6">
			<?php echo JHtml::_('rsfieldset.start', 'adminform', JText::_('COM_RSFILES_RULES_FOR_FOLDERS')); ?>
			<?php echo JHtml::_('rsfieldset.element', $this->form->getLabel('FolderCanView'), $this->form->getInput('FolderCanView')); ?>
			<?php echo JHtml::_('rsfieldset.element', $this->form->getLabel('FolderCanCreate'), $this->form->getInput('FolderCanCreate')); ?>
			<?php echo JHtml::_('rsfieldset.element', $this->form->getLabel('FolderCanUpload'), $this->form->getInput('FolderCanUpload')); ?>
			<?php echo JHtml::_('rsfieldset.element', $this->form->getLabel('FolderCanDelete'), $this->form->getInput('FolderCanDelete')); ?>
			<?php echo JHtml::_('rsfieldset.end'); ?>
			
			<?php echo JHtml::_('rsfieldset.start', 'adminform', JText::_('COM_RSFILES_RULES_FOR_FILES')); ?>
			<?php echo JHtml::_('rsfieldset.element', $this->form->getLabel('FileCanView'), $this->form->getInput('FileCanView')); ?>
			<?php echo JHtml::_('rsfieldset.element', $this->form->getLabel('FileCanDownload'), $this->form->getInput('FileCanDownload')); ?>
			<?php echo JHtml::_('rsfieldset.element', $this->form->getLabel('FileCanEdit'), $this->form->getInput('FileCanEdit')); ?>
			<?php echo JHtml::_('rsfieldset.element', $this->form->getLabel('FileCanDelete'), $this->form->getInput('FileCanDelete')); ?>
			<?php echo JHtml::_('rsfieldset.end'); ?>
		</div>
		<div class="span6">
			<?php echo JHtml::_('rsfieldset.start', 'adminform', JText::_('COM_RSFILES_RULES_FOR_FILES_INFO')); ?>
			<?php echo JHtml::_('rsfieldset.element', $this->form->getLabel('FileStatistics'), $this->form->getInput('FileStatistics')); ?>
			<?php echo JHtml::_('rsfieldset.element', $this->form->getLabel('IdLicense'), $this->form->getInput('IdLicense')); ?>
			<?php echo JHtml::_('rsfieldset.element', $this->form->getLabel('DownloadMethod'), $this->form->getInput('DownloadMethod')); ?>
			<?php echo JHtml::_('rsfieldset.element', $this->form->getLabel('DownloadLimit'), $this->form->getInput('DownloadLimit')); ?>
			<?php echo JHtml::_('rsfieldset.element', $this->form->getLabel('show_preview'), $this->form->getInput('show_preview')); ?>
			<?php echo JHtml::_('rsfieldset.end'); ?>
		</div>
	</div>

	<?php echo JHTML::_('form.token'); ?>
	<input type="hidden" name="task" value="" />
	<?php echo $this->form->getInput('id'); ?>
</form>