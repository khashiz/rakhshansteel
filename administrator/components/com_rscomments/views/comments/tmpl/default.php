<?php
/**
* @package RSComments!
* @copyright (C) 2015 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-2.0.html
*/

defined('_JEXEC') or die('Restricted access');

$listOrder	= $this->escape($this->state->get('list.ordering', 'date'));
$listDirn	= $this->escape($this->state->get('list.direction', 'DESC')); ?>

<form action="<?php echo JRoute::_('index.php?option=com_rscomments&view=comments'); ?>" method="post" name="adminForm" id="adminForm">
	<div class="row-fluid">
		<div id="j-sidebar-container" class="span2">
			<?php echo JHtmlSidebar::render(); ?>
		</div>
		<div id="j-main-container" class="span10 j-main-container">
			
			<?php echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this)); ?>
			
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th width="2%"><input type="checkbox" name="checkall-toggle" value="" onclick="Joomla.checkAll(this);"/></th>
						<th class="hidden-phone" width="1%"><?php echo JText::_('COM_RSCOMMENTS_COMMENT_ID'); ?></th>
						<th nowrap="nowrap"><?php echo JHtml::_('searchtools.sort', JText::_('COM_RSCOMMENTS_COMMENT_NAME'), 'comment', $listDirn, $listOrder); ?></th>
						<th width="5%" class="center" align="center"><?php echo JText::_('COM_RSCOMMENTS_REPORTS'); ?></th>
						<th width="10%" class="center" align="center"><?php echo JHtml::_('searchtools.sort', JText::_('COM_RSCOMMENTS_COMMENT_AUTHOR'), 'name', $listDirn, $listOrder); ?></th>
						<th class="hidden-phone center" width="8%" align="center"><?php echo JHtml::_('searchtools.sort', JText::_('COM_RSCOMMENTS_COMMENT_COMPONENT'), 'option', $listDirn, $listOrder); ?></th>
						<th width="10%" class="center" align="center"><?php echo JHtml::_('searchtools.sort', JText::_('COM_RSCOMMENTS_COMMENT_DATE'), 'date', $listDirn, $listOrder); ?></th>
						<th class="hidden-phone" width="5%"><?php echo JHtml::_('searchtools.sort', JText::_('COM_RSCOMMENTS_COMMENT_PUBLISHED'), 'published', $listDirn, $listOrder); ?></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($this->items as $i => $item) { ?>
				<?php $comment_length = mb_strlen(RSCommentsHelper::cleanComment(strip_tags($item->comment))); ?>
					<tr class="row<?php echo $i % 2; ?>">
						<td width="2%"><?php echo JHtml::_('grid.id', $i, $item->IdComment); ?></td>
						
						<td class="hidden-phone" ><?php echo $item->IdComment; ?></td>
						
						<td>
							<span class="rsc_subject">
								<a href="<?php echo JRoute::_('index.php?option=com_rscomments&task=comment.edit&IdComment='.$item->IdComment); ?>">
									<?php echo !empty($item->subject) ? $item->subject : '<i>'.JText::_('COM_RSCOMMENTS_NO_TITLE').'</i>';?>
								</a>
							</span>
							
							<br />
							
							<div class="rsc_comment">
								<?php echo RSCommentsHelper::cleanComment(strip_tags(mb_substr($item->comment,0,255))); ?>
								<?php echo ($comment_length > 255) ? '<span id="rsc_rest'.$i.'" style="display:none;">'.RSCommentsHelper::cleanComment(strip_tags(mb_substr($item->comment,255,$comment_length))).'</span>' : ''; ?>
							</div>
							
							<?php if (mb_strlen(RSCommentsHelper::cleanComment(strip_tags($item->comment))) > 255) echo '<a href="javascript:rsc_show_all('.$i.');" class="rsc_showall" id="show_btn'.$i.'">'.JText::_('COM_RSCOMMENTS_SHOW_ALL').'</a>';?>
						</td>
						
						<td align="center" class="center">
							<a href="<?php echo JRoute::_('index.php?option=com_rscomments&view=reports&id='.$item->IdComment); ?>">
								<?php echo $item->reports; ?>
							</a>
						</td>
						
						<td align="center" class="center">
							<?php $name = $item->anonymous ? ($item->name ? $item->name : JText::_('COM_RSCOMMENTS_ANONYMOUS')) : $item->name; ?>
							<span class="<?php echo RSTooltip::tooltipClass(); ?>" title="<?php echo RSTooltip::tooltipText($item->email.'<br />'.JText::sprintf('COM_RSCOMMENTS_AUTHOR_INFO_NAME',$name).'<br/>'.JText::sprintf('COM_RSCOMMENTS_AUTHOR_INFO_SITE',$item->website).'<br/>'.JText::sprintf('COM_RSCOMMENTS_AUTHOR_INFO_IP',str_replace(':','&#058;',$item->ip))); ?>">
								<?php if ($item->email) { ?><a href="mailto:<?php echo $item->email; ?>"><?php } ?>
									<i class="fa fa-info-circle"></i> <?php echo $name; ?>
								<?php if ($item->email) { ?></a><?php } ?>
							</span>
						</td>
						
						<td class="hidden-phone center" align="center"><?php echo RSCommentsHelper::component($item->option); ?></td>
						
						<td class="center" align="center"><?php echo RSCommentsHelper::showDate($item->date); ?></td>
						
						<td class="hidden-phone center" align="center">
							<?php echo JHtml::_('jgrid.published', $item->published, $i, 'comments.', true, 'cb'); ?>
						</td>
					</tr>
				<?php } ?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="8" align="center"><?php echo $this->pagination->getListFooter(); ?></td>
					</tr>
				</tfoot>
			</table>
			
			<?php echo JHtml::_( 'form.token' ); ?>
			<input type="hidden" name="boxchecked" value="0" />
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="filter[component_id]" id="rsc_filter_component_id" value="<?php echo $this->state->get('filter.component_id'); ?>" />
		</div>
	</div>
</form>

<script type="text/javascript">
function rsc_show_all(id) {
	var all_content = jQuery('#rsc_rest'+id);
	var toggle_btn	= jQuery('#show_btn'+id);
	
	if (all_content.css('display') == 'none') {
		all_content.css('display','block');
		toggle_btn.text('<?php echo JText::_('COM_RSCOMMENTS_HIDE_ALL',true); ?>');
	} else {
		all_content.css('display','none');
		toggle_btn.text('<?php echo JText::_('COM_RSCOMMENTS_SHOW_ALL',true); ?>');
	}
}
</script>