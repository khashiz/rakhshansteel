<?php
/**
* @package RSFiles!
* @copyright (C) 2010-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/
defined('_JEXEC') or die('Restricted access'); ?>

<div class="pull-left">
	<label class="checkbox inline modalTooltip" title="<?php echo JText::_('COM_RSFILES_BATCH_RECURSIVE_DESC'); ?>">
		<input type="checkbox" name="recursive" id="rscursive" /> <?php echo JText::_('COM_RSFILES_BATCH_RECURSIVE'); ?>
	</label>
</div>


<button onclick="Joomla.submitbutton('files.batch');" type="button" class="btn btn-primary" id="rsfiles-batch-btn">
	<?php echo JHtml::image('com_rsfiles/loading.gif', '', array('id' => 'rsfile-batch-loader', 'style' => 'display:none;'), true); ?> <?php echo JText::_('COM_RSFILES_PROCESS'); ?>
</button>
<button type="button" data-dismiss="modal" class="btn"><?php echo JText::_('COM_RSFILES_CANCEL'); ?></button>