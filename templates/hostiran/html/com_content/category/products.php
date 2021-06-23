<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

JHtml::_('behavior.caption');

$dispatcher = JEventDispatcher::getInstance();

$this->category->text = $this->category->description;
$dispatcher->trigger('onContentPrepare', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$this->category->description = $this->category->text;

$results = $dispatcher->trigger('onContentAfterTitle', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$afterDisplayTitle = trim(implode("\n", $results));

$results = $dispatcher->trigger('onContentBeforeDisplay', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$beforeDisplayContent = trim(implode("\n", $results));

$results = $dispatcher->trigger('onContentAfterDisplay', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$afterDisplayContent = trim(implode("\n", $results));

$app  = JFactory::getApplication();
$params = $app->getTemplate(true)->params;
$menu = $app->getMenu();
$active = $menu->getActive();
$pageparams = $menu->getParams( $active->id );
$pageclass = $pageparams->get( 'pageclass_sfx' );

?>
<section class="pageHeader uk-position-relative <?php echo $pageparams->get('headerstyle', 'normal'); if ($pageparams->get('headerbgattachment') == 'fixed') { echo ' uk-background-fixed'; } ?> uk-flex uk-flex-center uk-flex-middle" style="<?php if (!empty($pageparams->get('headerbgcolor'))) {echo 'background-color:'.$pageparams->get('headerbgcolor').';';} if (!empty($pageparams->get('headerbgimage'))) {echo 'background-image:url('.$pageparams->get('headerbgimage').');';}  ?>">
    <?php if ($pageparams->get('cover')) { ?><div class="uk-position-absolute uk-position-cover" style="background-color: <?php echo $pageparams->get('coverbgcolor', 'rgba(0, 0, 0, .6)'); ?>;"></div><?php } ?>
    <div class="uk-position-relative uk-container">
        <h1 class="uk-text-center uk-margin-remove font" style="color: <?php echo $pageparams->get('pagetitlecolor', '#fff') ?>"><?php echo $pageparams->get('pagetitle', $active->title); ?></h1>
        <?php if (!empty($pageparams->get('pagedescription'))) { ?>
            <p class="uk-text-center uk-margin-remove-bottom font" style="color: <?php echo $pageparams->get('pagedescriptioncolor', '#ccc') ?>"><?php echo $pageparams->get('pagedescription'); ?></p>
        <?php } ?>
    </div>
</section>
<section class="pageWrapper <?php echo $pageparams->get('headerstyle', 'normal'); ?> uk-position-relative <?php echo $pageparams->get('headerstyle', 'normal'); ?>" itemscope itemtype="https://schema.org/Blog">
    <div class="<?php echo $pageparams->get('gridwidth', 'uk-container') ?>" itemscope itemtype="https://schema.org/Blog">
        <div class="uk-child-width-1-1 uk-grid-large uk-margin-large-bottom" data-uk-grid>
            <?php if ($this->params->get('show_description', 1)) { ?>
            <div>
                <div class="uk-box-shadow-small uk-border-rounded wrapper uk-position-relative uk-overflow-hidden">
                    <div class="uk-padding">
                        <div data-uk-grid>
                            <div class="uk-width-1-1">
                                <?php if ($this->params->get('show_category_title', 1) or $this->params->get('page_subheading')) : ?>
                                    <div>
                                        <h2 class="sectionTitle uk-margin-remove border-color"><?php echo $this->escape($this->params->get('page_subheading')); ?>
                                            <?php if ($this->params->get('show_category_title')) : ?>
                                                <span class="subheading-category"><?php echo $this->category->title; ?></span>
                                            <?php endif; ?>
                                        </h2>
                                    </div>
                                <?php endif; ?>
                                <?php if ($this->params->def('show_description_image', 1) && !empty($this->category->description)) : ?>
                                    <div class="productCategoryDesc uk-text-justify uk-margin-top font">
                                        <?php if ($this->params->get('show_description') && $this->category->description) : ?>
                                            <?php echo JHtml::_('content.prepare', $this->category->description, '', 'com_content.category'); ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <?php if ($this->maxLevel != 0 && !empty($this->children[$this->category->id])) : ?>
                <div class="productCategorySubcat">
                    <div class="uk-child-width-1-1 uk-child-width-1-3@m uk-grid-match" data-uk-grid><?php echo $this->loadTemplate('children'); ?></div>
                </div>
            <?php endif; ?>

            <div>
                <?php if (empty($this->lead_items) && $this->category->level > 1 && empty($this->children[$this->category->id])) : ?>
                    <?php if ($this->params->get('show_no_articles', 1)) : ?>
                    <div class="uk-text-center uk-margin-large-top uk-margin-large-bottom emptyCat">
                        <div class="uk-margin-bottom"><i class="fas fa-5x fa-box-open"></i></div>
                        <p class="font uk-margin-remove"><?php echo JText::_('NOPRODUCTSYET'); ?></p>
                    </div>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if (!empty($this->lead_items) && $this->category->level > 1) : ?>
                <div class="uk-grid-divider" data-uk-grid>
                    <?php if (!empty(JHTML::_('content.prepare','{loadposition productside}'))) { ?>
                    <div class="uk-width-1-4">
                        <aside>
                            <div class="uk-child-width-1-1" data-uk-grid><?php echo JHTML::_('content.prepare','{loadposition productside}'); ?></div>
                        </aside>
                    </div>
                    <?php } ?>
                    <div class="uk-width-expand">
                        <div>
                            <div class="uk-child-width-1-1 uk-child-width-1-3@m uk-grid-match" data-uk-grid>
                                <?php foreach ($this->lead_items as &$item) : ?>
                                    <div class="<?php echo $item->state == 0 ? ' system-unpublished' : null; ?>" itemprop="blogPost" itemscope itemtype="https://schema.org/BlogPosting">
                                        <?php $this->item = &$item; echo $this->loadTemplate('item'); ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <?php if (($this->params->def('show_pagination', 1) == 1 || ($this->params->get('show_pagination') == 2)) && ($this->pagination->get('pages.total') > 1)) : ?>
                                <div class="pagination">
                                    <?php if ($this->params->def('show_pagination_results', 1)) : ?>
                                        <p> <?php echo $this->pagination->getPagesCounter(); ?> </p>
                                    <?php endif; ?>
                                    <?php echo $this->pagination->getPagesLinks(); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>