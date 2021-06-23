<?php
/**
* @package RSSeo!
* @copyright (C) 2016 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/
defined('_JEXEC') or die('Restricted access'); 
$url = JURI::root().'index.php?option=com_rsseo&task=report'; ?>

<form action="<?php echo JRoute::_('index.php?option=com_rsseo&view=report'); ?>" method="post" name="adminForm" id="adminForm" class="form-horizontal">
	<div class="row-fluid">
		<div id="j-sidebar-container" class="span2">
			<?php echo JHtmlSidebar::render(); ?>
		</div>
		<div id="j-main-container" class="span10 j-main-container">
			<?php echo JHtml::_('bootstrap.startTabSet', 'report', array('active' => 'cron')); ?>
			
			<?php echo JHtml::_('bootstrap.addTab', 'report', 'cron', JText::_('COM_RSSEO_REPORT_CRON_OPTIONS')); ?>
			<div class="alert alert-info"><span class="icon-info" aria-hidden="true"></span> <?php echo JText::sprintf('COM_RSSEO_REPORT_CRON_INFO', $url); ?></div>
			<?php echo $this->form->renderField('email_report'); ?>
			<?php echo $this->form->renderField('mode'); ?>
			<?php echo $this->form->renderField('mode_days'); ?>
			<?php echo $this->form->renderField('mode_day'); ?>
			<?php echo JHtml::_('bootstrap.endTab'); ?>
			
			<?php echo JHtml::_('bootstrap.addTab', 'report', 'email', JText::_('COM_RSSEO_REPORT_EMAIL_OPTIONS')); ?>
			<?php echo $this->form->renderField('email'); ?>
			<?php echo $this->form->renderField('subject'); ?>
			<?php echo $this->form->renderField('message'); ?>
			<?php echo JHtml::_('bootstrap.endTab'); ?>
			
			<?php echo JHtml::_('bootstrap.addTab', 'report', 'pdf', JText::_('COM_RSSEO_REPORT_PDF_OPTIONS')); ?>
			<?php echo $this->form->renderField('font'); ?>
			<?php echo $this->form->renderField('orientation'); ?>
			<?php echo $this->form->renderField('paper'); ?>
			<?php echo JHtml::_('bootstrap.endTab'); ?>
			
			<?php echo JHtml::_('bootstrap.addTab', 'report', 'seo', JText::_('COM_RSSEO_REPORT_SEO_REPORTS')); ?>
			<?php echo $this->form->renderField('statistics'); ?>
			<?php echo $this->form->renderField('last_crawled'); ?>
			<?php echo $this->form->renderField('most_visited'); ?>
			<?php echo $this->form->renderField('error_links'); ?>
			<?php echo $this->form->renderField('no_title'); ?>
			<?php echo $this->form->renderField('no_desc'); ?>
			<?php echo $this->form->renderField('limit'); ?>
			<?php echo JHtml::_('bootstrap.endTab'); ?>
			
			<?php echo JHtml::_('bootstrap.addTab', 'report', 'competitors', JText::_('COM_RSSEO_REPORT_COMPETITORS')); ?>
			<?php echo $this->form->renderField('enable_competitors'); ?>
			<?php echo $this->form->renderField('competitors'); ?>
			<?php echo JHtml::_('bootstrap.endTab'); ?>
			
			<?php echo JHtml::_('bootstrap.addTab', 'report', 'gkeywords', JText::_('COM_RSSEO_REPORT_GKEYWORDS')); ?>
			<?php echo $this->form->renderField('enable_gkeywords'); ?>
			<div class="control-group">
				<div class="control-label">
					<label id="jform_keywords-lbl" for="jform_keywords"><?php echo JText::_('COM_RSSEO_REPORT_G_KEYWORDS'); ?></label>
				</div>
				<div class="controls">
					<?php echo JHtml::_('select.groupedlist', $this->keywords, 'jform[keywords][]', array('list.attr' => 'multiple="multiple"', 'id' => 'jform_keywords', 'list.select' => $this->selectedKeywords, 'group.items' => null, 'option.key.toHtml' => false, 'option.text.toHtml' => false)); ?>
				</div>
			</div>
			<?php echo JHtml::_('bootstrap.endTab'); ?>
			
			<?php echo JHtml::_('bootstrap.endTabSet'); ?>
		</div>
	</div>
	
	<?php echo JHTML::_( 'form.token' ); ?>
	<input type="hidden" name="task" value="" />
</form>