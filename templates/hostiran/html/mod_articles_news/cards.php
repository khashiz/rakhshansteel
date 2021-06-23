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
<section class="articleSection blogCards uk-padding-large uk-padding-remove-horizontal uk-padding-remove-bottom">
    <div class="uk-container">
        <div>
            <div class="uk-position-relative uk-margin-medium-bottom" data-uk-slider>
                <div class="uk-slider-items uk-child-width-1-1 uk-child-width-1-3@m uk-grid uk-grid-match uk-padding uk-padding-remove-top">
                    <?php foreach ($list as $item) : ?>
                        <?php require JModuleHelper::getLayoutPath('mod_articles_news', '_cardsitem'); ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>