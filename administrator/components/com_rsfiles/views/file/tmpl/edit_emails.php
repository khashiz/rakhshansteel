<?php
/**
* @package RSFiles!
* @copyright (C) 2010-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/
defined('_JEXEC') or die('Restricted access'); ?>

<script type="text/javascript">
	function delete_downloads() {
		if (jQuery('#boxchecked').val() == 0) {
			alert('<?php echo JText::_('COM_RSFILES_FILE_DOWNLOADED_SELECT',true); ?>');
			return;
		}
		
		jQuery.ajax({
			type: 'POST',
			url: 'index.php?option=com_rsfiles',
			data: 'task=file.deletedownloads&' + jQuery('input[name="cid[]"]:checked').serialize(),
			dataType: 'html',
			success: function(response) {
				jQuery('input[name="cid[]"]:checked').each(function() {
					jQuery('#dld' + jQuery(this).val()).remove();
				});
			}
		});
	}
</script>

<?php if (!empty($this->downloads)) { ?>
	<button type="button" class="btn btn-danger" onclick="delete_downloads()"><?php echo JText::_('COM_RSFILES_DELETE'); ?></button>
	<a href="<?php echo JRoute::_('index.php?option=com_rsfiles&task=file.export&id='.$this->item->IdFile, false); ?>" class="btn"><?php echo JText::_('COM_RSFILES_FILE_DOWNLOADED_EXPORT'); ?></a>
<?php } ?>

<table class="table table-striped">
	<thead>
		<tr>
			<th width="1%"><input type="checkbox" name="checkall-toggle" id="rscheckbox" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this);"/></th>
			<th width="30%"><?php echo JText::_('COM_RSFILES_FILE_DOWNLOADER_NAME'); ?></th>
			<th class="center" align="center" width="10%"><?php echo JText::_('COM_RSFILES_FILE_DOWNLOADER_DATE'); ?></th>
			<th class="center" align="center" width="10%"><?php echo JText::_('COM_RSFILES_FILE_DOWNLOADED_ON'); ?></th>
		</tr>
	</thead>
	<tbody>
	<?php if (!empty($this->downloads)) { ?>
	<?php foreach ($this->downloads as $i => $download) { ?>
		<tr class="row<?php echo $i % 2; ?>" id="dld<?php echo $download->id; ?>">
			<td><?php echo JHtml::_('grid.id', $i, $download->id); ?></td>
			<td><?php echo $download->name; ?> (<?php echo $download->email; ?>)</td>
			<td class="center" align="center"><?php echo rsfilesHelper::showDate($download->date); ?></td>
			<td class="center" align="center"><?php echo !empty($download->downloaded) && $download->downloaded != JFactory::getDbo()->getNullDate() ? rsfilesHelper::showDate($download->downloaded) : ' - '; ?></td>
		</tr>
	<?php } ?>
	<?php } ?>
	</tbody>
</table>
<input id="boxchecked" type="hidden" name="boxchecked" value="0" />