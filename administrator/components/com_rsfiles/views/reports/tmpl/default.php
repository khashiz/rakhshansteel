<?php
/**
* @package RSFiles!
* @copyright (C) 2010-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.keepalive'); ?>

<script type="text/javascript">
function rsfiles_show_report(url) {
	jQuery('#rsfReportModal').data('modal', null);
	jQuery('#rsfReportModal').modal({
		remote: url
	});
}
</script>

<form method="post" action="<?php echo JRoute::_('index.php?option=com_rsfiles&view=reports'); ?>" name="adminForm" id="adminForm">
<div class="row-fluid">
	<div id="j-sidebar-container" class="span2">
		<?php echo JHtmlSidebar::render(); ?>
	</div>
	<div id="j-main-container" class="span10 j-main-container">
		<table class="table table-striped adminlist">
			<thead>
				<th width="1%" align="center" class="center hidden-phone"><input type="checkbox" name="checkall-toggle" id="rscheckbox" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this);"/></th>
				<th><?php echo JText::_('COM_RSFILES_REPORT'); ?></th>
			</thead>
			<tbody>
				<?php foreach ($this->data as $i => $item) { ?>
					<tr class="row<?php echo $i % 2; ?>">
						<td class="center hidden-phone">
							<?php echo JHtml::_('grid.id', $i, $item->IdReport); ?>
						</td>
						<td class="nowrap has-context">
							<a href="javascript:void(0)" onclick="rsfiles_show_report('<?php echo JRoute::_('index.php?option=com_rsfiles&view=reports&layout=view&tmpl=component&id='.$item->IdReport, false); ?>')"><?php echo $item->ReportMessage; ?></a>
						</td>
					</tr>
				<?php } ?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="2" align="center"><?php echo $this->pagination->getListFooter(); ?></td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>
	
	<?php echo JHTML::_( 'form.token' ); ?>
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="id" value="<?php echo JFactory::getApplication()->input->getString('id',''); ?>" />
</form>

<?php echo JHtml::_('bootstrap.renderModal', 'rsfReportModal', array('title' => JText::_('COM_RSFILES_VIEW_REPORT'), 'bodyHeight' => 70)); ?>