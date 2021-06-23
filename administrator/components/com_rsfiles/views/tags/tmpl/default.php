<?php
/**
* @package RSFiles!
* @copyright (C) 2010-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/
defined('_JEXEC') or die('Restricted access');

$listOrder	= $this->escape($this->state->get('list.ordering','t.title'));
$listDirn	= $this->escape($this->state->get('list.direction','asc')); ?>

<form action="<?php echo JRoute::_('index.php?option=com_rsfiles&view=tags'); ?>" method="post" name="adminForm" id="adminForm">
	<div class="row-fluid">
		<div id="j-sidebar-container" class="span2">
			<?php echo JHtmlSidebar::render(); ?>
		</div>
		<div id="j-main-container" class="span10 j-main-container">
			<?php echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this)); ?>
		
			<table class="table table-striped">
				<thead>
					<th width="1%" class="hidden-phone center"><input type="checkbox" name="checkall-toggle" value="" onclick="Joomla.checkAll(this);"/></th>
					<th width="1%" class="hidden-phone center"><?php echo JHtml::_('searchtools.sort', 'JSTATUS', 't.published', $listDirn, $listOrder); ?></th>
					<th><?php echo JHtml::_('searchtools.sort', 'JGLOBAL_TITLE', 't.title', $listDirn, $listOrder); ?></th>
					<th width="5%" class="center hidden-phone"><?php echo JText::_('COM_RSFILES_TAG_CREATED_BY'); ?></th>
				</thead>
				<tbody>
					<?php foreach ($this->items as $i => $item) { ?>
					<tr class="row<?php echo $i % 2; ?>">
						<td class="center small hidden-phone"><?php echo JHTML::_('grid.id', $i, $item->id); ?></td>
						<td class="center small hidden-phone"><?php echo JHtml::_('jgrid.published', $item->published, $i, 'tags.'); ?></td>
						<td class="nowrap has-context">
							<a href="<?php echo JRoute::_('index.php?option=com_rsfiles&task=tag.edit&id='.$item->id); ?>">
								<?php echo $this->escape($item->title); ?>
							</a>
						</td>
						<td align="center" class="center small hidden-phone"><?php echo isset($item->username) ? $this->escape($item->username) : JText::_('COM_RSFILES_GUEST'); ?></td>
					</tr>
					<?php } ?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="4">
							<?php echo $this->pagination->getListFooter(); ?>
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
	
	<?php echo JHTML::_( 'form.token' ); ?>
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="task" value="" />
</form>