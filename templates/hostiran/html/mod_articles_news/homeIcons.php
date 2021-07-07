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
<div class="uk-margin-bottom">
    <div class="uk-container">
        <ul class="uk-text-zero uk-flex-center uk-child-width-1-2 uk-child-width-1-5@m uk-margin-large-top uk-margin-large-bottom uk-text-center categories-module<?php echo $moduleclass_sfx; ?> mod-list" data-uk-grid  data-uk-scrollspy="cls: uk-animation-slide-bottom-small; target: > li; delay: 250;">
            <?php foreach ($list as $item) : ?>
                <?php require JModuleHelper::getLayoutPath('mod_articles_news', '_homeIconsItem'); ?>
            <?php endforeach; ?>
        </ul>
    </div>
</div>