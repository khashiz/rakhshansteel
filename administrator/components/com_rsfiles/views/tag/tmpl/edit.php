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
		if (task == 'tag.cancel' || document.formvalidator.isValid(document.getElementById('adminForm'))) {
			Joomla.submitform(task, document.getElementById('adminForm'));
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_rsfiles&view=tag&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="adminForm" class="form-validate form-horizontal">
	
	<div class="row-fluid">
		<div class="span12">
			<?php echo JHtml::_('rsfieldset.start', 'adminform'); ?>
			<?php echo JHtml::_('rsfieldset.element', $this->form->getLabel('published'), $this->form->getInput('published')); ?>
			<?php echo JHtml::_('rsfieldset.element', $this->form->getLabel('title'), $this->form->getInput('title')); ?>
			<?php echo JHtml::_('rsfieldset.element', $this->form->getLabel('created_by'), $this->form->getInput('created_by')); ?>
			<?php echo JHtml::_('rsfieldset.end'); ?>
		</div>
	</div>
	
	<input type="hidden" name="task" value="" />
	<?php echo $this->form->getInput('id'); ?>
	<?php echo JHtml::_('form.token'); ?>
</form>