<?php
/**
* @package RSFiles!
* @copyright (C) 2010-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.keepalive'); ?>

<form method="post" action="<?php echo JRoute::_('index.php?option=com_rsfiles&view=statistics&layout=view'); ?>" name="adminForm" id="adminForm">
<div class="row-fluid">
	<div id="j-sidebar-container" class="span2">
		<?php echo JHtmlSidebar::render(); ?>
	</div>
	<div id="j-main-container" class="span10 j-main-container">
		<table class="table table-striped adminlist">
			<thead>
				<th width="1%">#</th>
				<th><?php echo JText::_('COM_RSFILES_STATITICS_DATE'); ?></th>
				<th width="80%"><?php echo JText::_('COM_RSFILES_STATITICS_DETAILS'); ?></th>
			</thead>
			<tbody>
				<?php foreach ($this->items as $i => $item) { ?>
					<tr class="row<?php echo $i % 2; ?>">
						<td><?php echo $this->pagination->getRowOffset($i); ?></td>
						<td><?php echo rsfilesHelper::showDate($item->Date); ?></td>
						<td>
							<?php echo JText::_('COM_RSFILES_STATITICS_IP'); ?>: <?php echo $item->Ip; ?> <br />
							<?php echo JText::_('COM_RSFILES_STATITICS_USERNAME'); ?>: <?php echo !empty($item->username) ? $item->username : JText::_('COM_RSFILES_GUEST'); ?> <br />
							<?php if ($item->referer) { ?>
							<?php echo JText::_('COM_RSFILES_STATITICS_REFERER'); ?>: <?php echo $item->referer == 'email' ? JText::_('COM_RSFILES_STATITICS_REFERER_EMAIL') : $item->referer; ?>
							<?php } ?>
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
	<input type="hidden" name="boxchecked" value="1" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="cid" value="<?php echo JFactory::getApplication()->input->getInt('id',0); ?>" />
	<input type="hidden" name="return" value="<?php echo $this->return; ?>" />
</form>