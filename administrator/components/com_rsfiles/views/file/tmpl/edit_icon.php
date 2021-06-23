<?php
/**
* @package RSFiles!
* @copyright (C) 2010-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/
defined('_JEXEC') or die('Restricted access'); ?>

<div class="container-fluid" id="rsf-icons">
	<button type="button" class="btn btn-block" onclick="rsf_select_icon('none');"><i class="fa fa-file fa-2x"></i></button> <br />
	<?php if ($extensions = rsfilesHelper::fileExtensions()) { ?>
	<?php foreach ($extensions as $extension) { ?>
	<button type="button" class="btn rsf-icon-btn" onclick="rsf_select_icon('<?php echo $extension; ?>');">
		<i class="flaticon-<?php echo $extension; ?>-file"></i>
	</button>
	<?php } ?>
	<?php } ?>
</div>