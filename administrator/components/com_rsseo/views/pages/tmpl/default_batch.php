<?php
/**
* @package RSSeo!
* @copyright (C) 2016 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/
defined('_JEXEC') or die('Restricted access'); ?>

<div class="container-fluid">
	<div class="row-fluid form-horizontal">
		<div class="span6">
			<?php echo JHtml::_('rsfieldset.start', 'adminform', JText::_('COM_RSSEO_GENERAL')); ?>
			<?php echo JHtml::_('rsfieldset.element', $this->batch->getLabel('published'), $this->batch->getInput('published')); ?>
			<?php echo JHtml::_('rsfieldset.element', $this->batch->getLabel('insitemap'), $this->batch->getInput('insitemap')); ?>
			<?php echo JHtml::_('rsfieldset.element', $this->batch->getLabel('keywords'), $this->batch->getInput('keywords')); ?>
			<?php echo JHtml::_('rsfieldset.element', $this->batch->getLabel('description'), $this->batch->getInput('description')); ?>
			<?php echo JHtml::_('rsfieldset.element', $this->batch->getLabel('canonical'), $this->batch->getInput('canonical')); ?>
			<?php echo JHtml::_('rsfieldset.element', $this->batch->getLabel('frequency'), $this->batch->getInput('frequency')); ?>
			<?php echo JHtml::_('rsfieldset.element', $this->batch->getLabel('priority'), $this->batch->getInput('priority')); ?>
			<?php echo JHtml::_('rsfieldset.end'); ?>
			
			<?php echo JHtml::_('rsfieldset.start', 'adminform', JText::_('COM_RSSEO_PAGE_ROBOTS')); ?>
			<div class="row-fluid">
				<div class="span6">
					<?php echo JHtml::_('rsfieldset.element', $this->batch->getLabel('index', 'robots'), $this->batch->getInput('index', 'robots')); ?>
					<?php echo JHtml::_('rsfieldset.element', $this->batch->getLabel('follow', 'robots'), $this->batch->getInput('follow', 'robots')); ?>
				</div>
				<div class="span6">
					<?php echo JHtml::_('rsfieldset.element', $this->batch->getLabel('archive', 'robots'), $this->batch->getInput('archive', 'robots')); ?>
					<?php echo JHtml::_('rsfieldset.element', $this->batch->getLabel('snippet', 'robots'), $this->batch->getInput('snippet', 'robots')); ?>
				</div>
			</div>
			
			<?php /* foreach($this->batch->getGroup('robots') as $field) { ?>
			<?php echo JHtml::_('rsfieldset.element', $field->label, $field->input); ?>
			<?php } */ ?>
			<?php echo JHtml::_('rsfieldset.end'); ?>
		</div>
		<div class="span6">
			<?php echo JHtml::_('rsfieldset.start', 'adminform', JText::_('COM_RSSEO_CONFIGURATION_CUSTOM_HEAD_SCRIPTS')); ?>
			<?php echo JHtml::_('rsfieldset.element', '', $this->batch->getInput('customhead'), array(), false); ?>
			<?php echo JHtml::_('rsfieldset.end'); ?>
			
			<?php echo JHtml::_('rsfieldset.start', 'adminform', JText::_('COM_RSSEO_PAGE_REMOVE_SCRIPTS')); ?>
			<?php echo JHtml::_('rsfieldset.element', '', $this->batch->getInput('scripts'), array(), false); ?>
			<?php echo JHtml::_('rsfieldset.end'); ?>
			
			<?php echo JHtml::_('rsfieldset.start', 'adminform', JText::_('COM_RSSEO_PAGE_REMOVE_CSS')); ?>
			<?php echo JHtml::_('rsfieldset.element', '', $this->batch->getInput('css'), array(), false); ?>
			<?php echo JHtml::_('rsfieldset.end'); ?>
		</div>
	</div>
</div>