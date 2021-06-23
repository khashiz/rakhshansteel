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

<div class="uk-position-relative" data-uk-slider>
    <div class="uk-slider-items uk-child-width-1-1 uk-child-width-1-3@m uk-grid uk-grid-match uk-padding uk-padding-remove-top">
        <?php foreach ($list as $item) : ?>
            <div>
                <div class="uk-card uk-card-default uk-box-shadow-hover-large uk-border-rounded uk-overflow-hidden articleCard">
                    <div class="uk-card-media-top">
                        <?php $images = json_decode($item->images); ?>
                        <?php if (!empty($images->image_intro)) { ?>
                            <div class="uk-cover-container">
                                <canvas width="400" height="300"></canvas>
                                <div data-uk-cover>
                                    <div>
                                        <a href="<?php echo $item->route; ?>" class="uk-inline-clip uk-transition-toggle uk-display-block">
                                            <img class="uk-transition-scale-up uk-transition-opaque" src="<?php echo $images->image_intro; ?>" alt="" itemprop="thumbnailUrl">
                                            <div class="uk-transition-fade uk-position-cover uk-overlay uk-overlay-primary uk-flex uk-flex-center uk-flex-middle"><i class="fas fa-link fa-2x"></i></div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="uk-cover-container">
                                <canvas width="400" height="300"></canvas>
                                <div class="uk-flex uk-flex-middle" data-uk-cover>
                                    <div>
                                        <a href="<?php echo $item->route; ?>" class="uk-inline-clip uk-transition-toggle uk-display-block">
                                            <img class="uk-transition-scale-up uk-transition-opaque" src="images/sprite.svg#placeholder" alt="" itemprop="thumbnailUrl" data-uk-svg>
                                            <div class="uk-transition-fade uk-position-cover uk-overlay uk-overlay-primary uk-flex uk-flex-center uk-flex-middle"><i class="fas fa-link fa-2x"></i></div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="uk-card-body">
                        <div class="meta uk-margin-small-bottom">
                            <dl class="uk-child-width-auto uk-grid-small fnum" data-uk-grid>
                                <?php if ($showDate) { ?>
                                    <dd class="published">
                                        <time datetime="<?php echo $item->created; ?>" itemprop="datePublished"><?php echo JHTML::_('date', $item->created, 'D ، m M Y'); ?></time>
                                    </dd>
                                <?php } ?>
                                <dd class="category-name"><a class="hovercolor transition" href="#" itemprop="genre">بلاگ</a></dd>
                            </dl>
                        </div>
                        <h3 class="uk-card-title uk-margin-remove">
                            <a class="hovercolor" href="<?php echo $item->route; ?>"><?php echo $item->title; ?></a>
                        </h3>
                        <?php if (!empty($item->introtext)) {echo $item->introtext;} ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>