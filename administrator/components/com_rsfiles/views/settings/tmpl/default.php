<?php
/**
* @package RSFiles!
* @copyright (C) 2010-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/
defined( '_JEXEC' ) or die( 'Restricted access' );
JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidator'); ?>

<form action="<?php echo JRoute::_('index.php?option=com_rsfiles&view=settings'); ?>" method="post" name="adminForm" id="adminForm" class="form-validate form-horizontal" autocomplete="off">
	<div class="row-fluid">
		<div id="j-sidebar-container" class="span2">
			<?php echo JHtmlSidebar::render(); ?>
		</div>
		<div id="j-main-container" class="span10 j-main-container">
		<?php foreach ($this->layouts as $layout) {
			// add the tab title
			$this->tabs->title('COM_RSFILES_CONF_TAB_'.strtoupper($layout), $layout);
			
			// prepare the content
			$content = $this->loadTemplate($layout);
			
			// add the tab content
			$this->tabs->content($content);
		}
		
		// render tabs
		echo $this->tabs->render();
		?>
			<div>
			<?php echo JHtml::_('form.token'); ?>
			<input type="hidden" name="task" value="" />
			</div>
		</div>
	</div>
</form>
<script type="text/javascript">
<?php if (rsfilesHelper::isRsmail()) { ?>rsf_rsmail(jQuery('#jform_rsmail_list_id').val(), '<?php echo $this->config->rsmail_field_name; ?>');<?php } ?>
</script>

<?php echo JHtml::_('bootstrap.renderModal', 'rsfDownloadModal', array('title' => JText::_('COM_RSFILES_CONF_SET_DOWNLOAD_FOLDER'), 'url' => JRoute::_('index.php?option=com_rsfiles&view=settings&layout=select&type=download&tmpl=component', false), 'height' => 800, 'bodyHeight' => 70)); ?>
<?php echo JHtml::_('bootstrap.renderModal', 'rsfBriefcaseModal', array('title' => JText::_('COM_RSFILES_CONF_SET_BRIEFCASE_FOLDER'), 'url' => JRoute::_('index.php?option=com_rsfiles&view=settings&layout=select&type=briefcase&tmpl=component', false), 'height' => 800, 'bodyHeight' => 70)); ?>
<?php echo JHtml::_('bootstrap.renderModal', 'rsfAdminEmailModal', array('title' => JText::_('COM_RSFILES_CONF_MESSAGE_ADMIN'), 'url' => JRoute::_('index.php?option=com_rsfiles&view=email&type=admin&tmpl=component', false), 'height' => 800, 'bodyHeight' => 70)); ?>
<?php echo JHtml::_('bootstrap.renderModal', 'rsfDownloadEmailModal', array('title' => JText::_('COM_RSFILES_CONF_MESSAGE_DOWNLOAD'), 'url' => JRoute::_('index.php?option=com_rsfiles&view=email&type=download&tmpl=component', false), 'height' => 800, 'bodyHeight' => 70)); ?>
<?php echo JHtml::_('bootstrap.renderModal', 'rsfUploadEmailModal', array('title' => JText::_('COM_RSFILES_CONF_MESSAGE_UPLOAD'), 'url' => JRoute::_('index.php?option=com_rsfiles&view=email&type=upload&tmpl=component', false), 'height' => 800, 'bodyHeight' => 70)); ?>
<?php echo JHtml::_('bootstrap.renderModal', 'rsfReportEmailModal', array('title' => JText::_('COM_RSFILES_CONF_MESSAGE_REPORT'), 'url' => JRoute::_('index.php?option=com_rsfiles&view=email&type=report&tmpl=component', false), 'height' => 800, 'bodyHeight' => 70)); ?>
<?php echo JHtml::_('bootstrap.renderModal', 'rsfBriefcaseuploadEmailModal', array('title' => JText::_('COM_RSFILES_CONF_MESSAGE_BRIEFCASEUPLOAD'), 'url' => JRoute::_('index.php?option=com_rsfiles&view=email&type=briefcaseupload&tmpl=component', false), 'height' => 800, 'bodyHeight' => 70)); ?>
<?php echo JHtml::_('bootstrap.renderModal', 'rsfModerateEmailModal', array('title' => JText::_('COM_RSFILES_CONF_MESSAGE_MODERATE'), 'url' => JRoute::_('index.php?option=com_rsfiles&view=email&type=moderate&tmpl=component', false), 'height' => 800, 'bodyHeight' => 70)); ?>