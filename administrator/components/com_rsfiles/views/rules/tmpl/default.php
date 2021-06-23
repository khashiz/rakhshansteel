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
$listDirn	= $this->escape($this->state->get('list.direction')); 
$saveOrder	= $listOrder == 'ordering';

if ($saveOrder) {
	$saveOrderingUrl = 'index.php?option=com_rsfiles&task=rules.saveOrderAjax&tmpl=component';
	JHtml::_('sortablelist.sortable', 'rulesList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
} ?>

<form method="post" action="<?php echo JRoute::_('index.php?option=com_rsfiles&view=rules'); ?>" name="adminForm" id="adminForm">
	<div class="row-fluid">
		<div id="j-sidebar-container" class="span2">
			<?php echo JHtmlSidebar::render(); ?>
		</div>
		<div id="j-main-container" class="span10 j-main-container">
			<?php echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this)); ?>
			<table class="table table-striped adminlist" id="rulesList">
				<thead>
					<th width="1%" class="nowrap center hidden-phone">
						<?php echo JHtml::_('searchtools.sort', '', 'ordering', $listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING', 'icon-menu-2'); ?>
					</th>
					<th width="1%" align="center" class="hidden-phone center"><input type="checkbox" name="checkall-toggle" id="rscheckbox" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this);"/></th>
					<th><?php echo JHtml::_('searchtools.sort', 'COM_RSFILES_RULE_NAME', 'name', $listDirn, $listOrder); ?></th>
					<th width="1%" class="nowrap hidden-phone"><?php echo JHtml::_('searchtools.sort', 'JGRID_HEADING_ID', 'id', $listDirn, $listOrder); ?></th>
				</thead>
				<tbody>
					<?php foreach ($this->items as $i => $item) { ?>
						<tr class="row<?php echo $i % 2; ?>" sortable-group-id="1">
							<td class="order nowrap center hidden-phone">
								<?php $iconClass = !$saveOrder ? ' inactive tip-top hasTooltip" title="' . JHtml::_('tooltipText', 'JORDERINGDISABLED') : ''; ?>
								<span class="sortable-handler<?php echo $iconClass ?>">
									<span class="icon-menu" aria-hidden="true"></span>
								</span>
								<?php if ($saveOrder) : ?>
									<input type="text" style="display:none" name="order[]" size="5" value="<?php echo $item->ordering; ?>" class="width-20 text-area-order" />
								<?php endif; ?>
							</td>
							
							<td class="center hidden-phone">
								<?php echo JHtml::_('grid.id', $i, $item->id); ?>
							</td>
							<td class="nowrap has-context">
								<a href="<?php echo JRoute::_('index.php?option=com_rsfiles&task=rule.edit&id='.$item->id); ?>"><?php echo $item->name; ?></a>
							</td>
							<td class="center hidden-phone">
								<?php echo (int) $item->id; ?>
							</td>
						</tr>
					<?php } ?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="4" align="center"><?php echo $this->pagination->getListFooter(); ?></td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
	
	<?php echo JHTML::_( 'form.token' ); ?>
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="task" value="" />
</form>
	