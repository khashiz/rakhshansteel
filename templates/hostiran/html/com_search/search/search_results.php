<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_search
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

?>
<hr class="uk-divider-icon uk-margin-medium uk-margin-remove-left uk-margin-remove-right">
<div class="uk-child-width-1-1 uk-grid-small uk-grid-divider" data-uk-grid>
    <?php foreach ($this->results as $result) : ?>
        <div class="blogItem uk-text-zero">
            <div data-uk-grid>
                <div class="uk-width-1-1">
                    <div class="uk-height-1-1">
                        <div>
                            <div class="blogItemHeading">
                                <div class="meta uk-margin-small-bottom">
                                    <dl class="uk-child-width-auto uk-grid-small fnum" data-uk-grid>
                                        <?php if ($result->section) : ?>
                                            <dd class="category-name">
                                                <i class="fas fa-folder-open"></i>
                                                <a class="hovercolor transition" href="#"><?php echo $this->escape($result->section); ?></a>
                                            </dd>
                                        <?php endif; ?>
                                        <?php if ($this->params->get('show_date')) : ?>
                                            <dd class="published">
                                                <i class="fas fa-calendar-alt"></i>
                                                <span class="icon-calendar" aria-hidden="true"></span>
                                                <time datetime="<?php echo $result->created; ?>" itemprop="datePublished"><?php echo JText::sprintf('JGLOBAL_CREATED_DATE_ON', $result->created); ?></time>
                                            </dd>
                                        <?php endif; ?>
                                    </dl>
                                </div>
                                <div class="title">
                                    <h2 itemprop="name">
                                        <a class="hovercolor transition" href="<?php echo JRoute::_($result->href); ?>" itemprop="url"><?php echo $result->title; ?></a>
                                    </h2>
                                </div>
                            </div>
                            <div class="blogItemBody uk-hidden">
                                <div class="font uk-text-justify"><p><?php echo $result->text; ?></p></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<div class="pagination"><?php echo $this->pagination->getPagesLinks(); ?></div>
