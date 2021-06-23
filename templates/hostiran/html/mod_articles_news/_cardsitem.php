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
    <div class="uk-card uk-card-default uk-box-shadow-hover-large uk-border-rounded uk-overflow-hidden articleCard">
        <div class="uk-card-media-top">
            <?php $images = json_decode($item->images); ?>
            <?php if (!empty($images->image_intro)) { ?>
                <div class="uk-cover-container">
                    <canvas width="400" height="300"></canvas>
                    <div data-uk-cover>
                        <div>
                            <a href="<?php echo $item->link; ?>" class="uk-inline-clip uk-transition-toggle uk-display-block" title="<?php echo $item->title; ?>">
                                <img class="uk-transition-scale-up uk-transition-opaque" src="<?php echo $images->image_intro; ?>" alt="<?php echo $item->title; ?>" width="" height="" itemprop="thumbnailUrl">
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
                            <a href="<?php echo $item->link; ?>" class="uk-inline-clip uk-transition-toggle uk-display-block">
                                <img class="uk-transition-scale-up uk-transition-opaque" src="images/sprite.svg#placeholder" width="" height="" alt="" itemprop="thumbnailUrl" data-uk-svg>
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
                    <dd class="published">
                        <time datetime="<?php echo $item->created; ?>" itemprop="datePublished"><?php echo JHTML::_('date', $item->created, 'D ، m M Y'); ?></time>
                    </dd>
                    <dd class="category-name"><a class="hovercolor transition" href="#" itemprop="genre">بلاگ</a></dd>
                </dl>
            </div>
            <h3 class="uk-card-title uk-margin-remove">
                <a class="hovercolor" href="<?php echo $item->link; ?>"><?php echo $item->title; ?></a>
            </h3>
            <?php if (!empty($item->introtext)) {echo $item->introtext;} ?>
        </div>
    </div>
</div>