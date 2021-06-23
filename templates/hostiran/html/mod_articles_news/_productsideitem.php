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
<div>
    <div class="uk-grid-small" data-uk-grid>
        <div class="uk-width-1-3">
            <div>
                <div class="uk-border-rounded uk-overflow-hidden uk-box-shadow-small">
                    <div class="uk-cover-container">
                        <canvas width="400" height="400"></canvas>
                        <div class="<?php if (empty($item->imageSrc)) {echo 'uk-flex uk-flex-middle';} ?>" data-uk-cover>
                            <div>
                                <a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($displayData->slug, $displayData->catid, $displayData->language)); ?>" class="uk-inline-clip uk-transition-toggle uk-display-block">
                                    <img class="uk-transition-scale-up uk-transition-opaque" src="<?php echo !empty($item->imageSrc) ? htmlspecialchars($item->imageSrc, ENT_COMPAT, 'UTF-8') : 'images/sprite.svg#placeholdersquare'; ?>" alt="<?php echo htmlspecialchars($item->imageSrc_alt, ENT_COMPAT, 'UTF-8'); ?>" itemprop="thumbnailUrl" <?php if (empty($item->imageSrc)) {echo ' data-uk-svg';} ?>>
                                    <div class="uk-transition-fade uk-position-cover uk-overlay uk-overlay-primary uk-flex uk-flex-center uk-flex-middle"><i class="fas fa-link"></i></div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="uk-width-2-3 uk-flex uk-flex-middle">
            <div class="uk-flex-1">
                <?php if ($params->get('item_title')) : ?>
                <?php $item_heading = $params->get('item_heading', 'h4'); ?>
                <<?php echo $item_heading; ?> class="uk-margin-remove">
                <?php if ($item->link !== '' && $params->get('link_titles')) : ?>
                    <a href="<?php echo $item->link; ?>" class="font hovercolor"><?php echo $item->title; ?></a>
                <?php else : ?>
                    <?php echo $item->title; ?>
                <?php endif; ?>
                </<?php echo $item_heading; ?>><?php endif; ?>
                <div><a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($item->catslug)); ?>" class="uk-text-muted font meta"><?php echo $item->category_title; ?></a></div>
            </div>
        </div>
    </div>
</div>