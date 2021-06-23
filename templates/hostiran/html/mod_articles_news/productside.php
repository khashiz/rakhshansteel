<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_news
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<div class="uk-child-width-1-1 uk-grid-small sideProducts" data-uk-grid>
	<?php foreach ($list as $item) : ?>
		<?php require JModuleHelper::getLayoutPath('mod_articles_news', '_productsideitem'); ?>
	<?php endforeach; ?>
</div>