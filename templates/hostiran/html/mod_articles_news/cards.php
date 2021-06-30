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
<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_related_items_joomir
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<div class="uk-container">
    <div>
        <div class="uk-slider-container-offset" data-uk-slider>
            <div class="uk-position-relative uk-visible-toggle">
                <div class="uk-slider-items uk-child-width-1-1 uk-child-width-1-3@m uk-grid uk-grid-match">
                    <?php foreach ($list as $item) : ?>
                        <?php require JModuleHelper::getLayoutPath('mod_articles_news', '_cardsitem'); ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin-remove-bottom uk-margin-medium-top"></ul>
        </div>
    </div>
</div>