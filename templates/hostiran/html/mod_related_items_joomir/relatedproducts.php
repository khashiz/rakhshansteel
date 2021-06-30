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
<h4 class="uk-text-center uk-text-bold uk-margin-medium color font"><?php echo JText::sprintf('OTHERPRODUCTS'); ?></h4>
<div>
    <div class="uk-child-width-1-1 uk-child-width-1-4@m" data-uk-grid>
        <?php foreach ($list as $item) : ?>
            <div>
                <?php $images = json_decode($item->images); ?>
                <div class="productWrapper">
                    <div class="uk-border-rounded uk-box-shadow-small uk-box-shadow-hover-medium uk-overflow-hidden uk-position-relative uk-inline-clip uk-transition-toggle">
                        <div>
                            <a href="#" title="<?php echo $item->title; ?>" class="uk-display-block">
                                <div class="uk-cover-container">
                                    <canvas width="400" height="400"></canvas>
                                    <div class="uk-flex uk-flex-middle uk-cover" data-uk-cover>
                                        <div>
                                            <div class="uk-inline-clip uk-transition-toggle uk-display-block">
                                                <img class="uk-transition-scale-up uk-transition-opaque" src="<?php echo !empty($images->image_intro) ? htmlspecialchars($images->image_intro, ENT_COMPAT, 'UTF-8') : 'images/sprite.svg#placeholdersquare'; ?>" alt="<?php echo $item->title; ?>" itemprop="thumbnailUrl"<?php if (empty($images->image_intro)) {echo ' data-uk-svg';} ?>>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <h3 itemprop="name" class="uk-margin-remove font uk-text-center uk-display-block uk-position-relative after-color"><?php echo $item->title; ?></h3>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>