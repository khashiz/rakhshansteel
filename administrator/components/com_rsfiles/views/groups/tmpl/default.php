<?php
/**
* @package RSFiles!
* @copyright (C) 2010-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.formvalidator');
JHtml::_('behavior.keepalive');

$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction')); ?>

<form method="post" action="<?php echo JRoute::_('index.php?option=com_rsfiles&view=groups'); ?>" name="adminForm" id="adminForm">
<div class="row-fluid">
	<div id="j-sidebar-container" class="span2">
		<?php echo JHtmlSidebar::render(); ?>
	</div>
	<div id="j-main-container" class="span10 j-main-container">
		<?php echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this)); ?>
		<table class="table table-striped adminlist">
			<thead>
				<th width="1%" align="center" class="hidden-phone"><input type="checkbox" name="checkall-toggle" id="rscheckbox" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this);"/></th>
				<th><?php echo JHtml::_('searchtools.sort', 'COM_RSFILES_GROUP_NAME', 'GroupName', $listDirn, $listOrder); ?></th>
				<th width="12%" class="center nowrap hidden-phone" align="center"><?php echo JText::_('COM_RSFILES_CAN_DOWNLOAD_BRIEFCASE'); ?></th>
				<th width="12%" class="center nowrap hidden-phone" align="center"><?php echo JText::_('COM_RSFILES_CAN_UPLOAD_BRIEFCASE'); ?></th>
				<th width="12%" class="center nowrap hidden-phone" align="center"><?php echo JText::_('COM_RSFILES_CAN_DELETE_BRIEFCASE'); ?></th>
				<th width="12%" class="center nowrap hidden-phone" align="center"><?php echo JText::_('COM_RSFILES_CAN_MAINTAIN_BRIEFCASE'); ?></th>
				<th width="1%" class="nowrap hidden-phone"><?php echo JHtml::_('searchtools.sort', 'JGRID_HEADING_ID', 'IdGroup', $listDirn, $listOrder); ?></th>
			</thead>
			<tbody>
				<?php foreach ($this->items as $i => $item) { ?>
					<tr class="row<?php echo $i % 2; ?>">
						<td class="center hidden-phone">
							<?php echo JHtml::_('grid.id', $i, $item->IdGroup); ?>
						</td>
						<td class="nowrap has-context">
							<a href="<?php echo JRoute::_('index.php?option=com_rsfiles&task=group.edit&IdGroup='.$item->IdGroup); ?>"><?php echo $item->GroupName; ?></a>
						</td>
						<td class="center hidden-phone" align="center">
							<i class="fa fa-<?php echo $item->CanDownloadBriefcase ? 'check rsfiles-icon-green' : 'times rsfiles-icon-red'; ?>"></i>
						</td>
						<td class="center hidden-phone" align="center">
							<i class="fa fa-<?php echo $item->CanUploadBriefcase ? 'check rsfiles-icon-green' : 'times rsfiles-icon-red'; ?>"></i>
						</td>
						<td class="center hidden-phone" align="center">
							<i class="fa fa-<?php echo $item->CanDeleteBriefcase ? 'check rsfiles-icon-green' : 'times rsfiles-icon-red'; ?>"></i>
						</td>
						<td class="center hidden-phone" align="center">
							<i class="fa fa-<?php echo $item->CanMaintainBriefcase ? 'check rsfiles-icon-green' : 'times rsfiles-icon-red'; ?>"></i>
						</td>
						<td class="center hidden-phone">
							<?php echo (int) $item->IdGroup; ?>
						</td>
					</tr>
				<?php } ?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="7" align="center"><?php echo $this->pagination->getListFooter(); ?></td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>
	
	<?php echo JHTML::_( 'form.token' ); ?>
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="task" value="" />
</form>
	