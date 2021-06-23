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

// Create shortcuts to some parameters.
$params  = $this->item->params;
$images  = json_decode($this->item->images);
$urls    = json_decode($this->item->urls);
$canEdit = $params->get('access-edit');
$user    = JFactory::getUser();
$info    = $params->get('info_block_position', 0);

// Check if associations are implemented. If they are, define the parameter.
$assocParam = (JLanguageAssociations::isEnabled() && $params->get('show_associations'));
JHtml::_('behavior.caption');


$lang = JFactory::getLanguage();
$languages = JLanguageHelper::getLanguages('lang_code');
$languageCode = $languages[ $lang->getTag() ]->sef;

?>
<?php if ($params->get('access-view')) : ?>
<?php $useDefList = ($params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_create_date') || $params->get('show_hits') || $params->get('show_category') || $params->get('show_parent_category') || $params->get('show_author') || $assocParam); ?>
<meta itemprop="inLanguage" content="<?php echo ($this->item->language === '*') ? JFactory::getConfig()->get('language') : $this->item->language; ?>" />
<div class="itemPage uk-padding-large uk-padding-remove-horizontal" itemscope itemtype="https://schema.org/Article">
    <div class="uk-child-width-1-1" data-uk-grid>
        <div>
            <section class="articleSection articleSectionTitle uk-text-center">
                <div class="uk-container uk-container-small">
                    <div class="meta uk-margin-bottom"><?php echo JLayoutHelper::render('joomla.content.info_block.block', array('item' => $this->item, 'params' => $params, 'position' => 'above')); ?></div>
                    <?php if ($params->get('show_title')) : ?>
                        <div>
                            <h1 class="font uk-margin-remove" itemprop="headline">
                                <?php echo $this->escape($this->item->title); ?>
                                <?php if ($this->item->state == 0) : ?>
                                    <span class="label label-warning"><?php echo JText::_('JUNPUBLISHED'); ?></span>
                                <?php endif; ?>
                                <?php if (strtotime($this->item->publish_up) > strtotime(JFactory::getDate())) : ?>
                                    <span class="label label-warning"><?php echo JText::_('JNOTPUBLISHEDYET'); ?></span>
                                <?php endif; ?>
                                <?php if ((strtotime($this->item->publish_down) < strtotime(JFactory::getDate())) && $this->item->publish_down != JFactory::getDbo()->getNullDate()) : ?>
                                    <span class="label label-warning"><?php echo JText::_('JEXPIRED'); ?></span>
                                <?php endif; ?>
                            </h1>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
        </div>
        <?php echo JLayoutHelper::render('joomla.content.imageFull', $this->item); ?>
        <?php if (!empty($this->item->text)) { ?>
        <div>
            <section class="articleSection articleSectionText">
                <div class="uk-container uk-container-xsmall">
                    <?php if (isset ($this->item->toc)) : echo $this->item->toc; endif; ?>
                    <div itemprop="articleBody" class="font uk-text-justify"><?php echo $this->item->text; ?></div>
                </div>
            </section>
        </div>
        <?php } ?>
        <?php if ($params->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
        <div>
            <section class="articleSection articleSectionTags">
                <div class="uk-container uk-container-xsmall">
                    <?php $this->item->tagLayout = new JLayoutFile('joomla.content.articletags'); ?>
                    <?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
                    <div data-uk-grid>
                        <div class="uk-width-auto uk-flex uk-flex-middle uk-visible@m"><span class="font"><?php echo JTEXT::_('SHARE'); ?></span></div>
                        <div class="uk-width-expand uk-flex uk-flex-middle">
                            <div class="socials uk-flex-1">
                                <ul class="uk-grid-small uk-flex-center uk-flex-<?php echo $languageCode == 'fa' ? 'right' : 'left'; ?>@m" data-uk-grid>
                                    <li class="">
                                        <a href="#" target="_blank" class="hasDrop uk-flex uk-flex-middle uk-flex-center fb"><i class="fab fa-facebook"></i></a>
                                        <div data-uk-drop="pos: top-center; offset: 12; delay-hide: 0; animation: uk-animation-slide-top-small;" class="top">
                                            <div class="uk-card uk-card-default uk-box-shadow-small uk-text-small uk-border-rounded uk-position-relative uk-text-center uk-text-nowrap tooltip favTooltipText">aaaaaaaa</div>
                                        </div>
                                    </li>
                                    <li class="">
                                        <a href="#" target="_blank" class="hasDrop uk-flex uk-flex-middle uk-flex-center tw"><i class="fab fa-twitter"></i></a>
                                        <div data-uk-drop="pos: top-center; offset: 12; delay-hide: 0; animation: uk-animation-slide-top-small;" class="top">
                                            <div class="uk-card uk-card-default uk-box-shadow-small uk-text-small uk-border-rounded uk-position-relative uk-text-center uk-text-nowrap tooltip favTooltipText">aaaaaaaa</div>
                                        </div>
                                    </li>
                                    <li class="">
                                        <a href="#" target="_blank" class="hasDrop uk-flex uk-flex-middle uk-flex-center tl"><i class="fab fa-telegram-plane"></i></a>
                                        <div data-uk-drop="pos: top-center; offset: 12; delay-hide: 0; animation: uk-animation-slide-top-small;" class="top">
                                            <div class="uk-card uk-card-default uk-box-shadow-small uk-text-small uk-border-rounded uk-position-relative uk-text-center uk-text-nowrap tooltip favTooltipText">aaaaaaaa</div>
                                        </div>
                                    </li>
                                    <li class="">
                                        <a href="#" target="_blank" class="hasDrop uk-flex uk-flex-middle uk-flex-center lk"><i class="fab fa-linkedin-in"></i></a>
                                        <div data-uk-drop="pos: top-center; offset: 12; delay-hide: 0; animation: uk-animation-slide-top-small;" class="top">
                                            <div class="uk-card uk-card-default uk-box-shadow-small uk-text-small uk-border-rounded uk-position-relative uk-text-center uk-text-nowrap tooltip favTooltipText">aaaaaaaa</div>
                                        </div>
                                    </li>
                                    <li class="uk-hidden@m">
                                        <a href="#" target="_blank" class="hasDrop uk-flex uk-flex-middle uk-flex-center wa"><i class="fab fa-whatsapp"></i></a>
                                        <div data-uk-drop="pos: top-center; offset: 12; delay-hide: 0; animation: uk-animation-slide-top-small;" class="top">
                                            <div class="uk-card uk-card-default uk-box-shadow-small uk-text-small uk-border-rounded uk-position-relative uk-text-center uk-text-nowrap tooltip favTooltipText">aaaaaaaa</div>
                                        </div>
                                    </li>
                                    <li class="uk-hidden@m">
                                        <a href="#" target="_blank" class="hasDrop uk-flex uk-flex-middle uk-flex-center sms"><i class="fas fa-envelope"></i></a>
                                        <div data-uk-drop="pos: top-center; offset: 12; delay-hide: 0; animation: uk-animation-slide-top-small;" class="top">
                                            <div class="uk-card uk-card-default uk-box-shadow-small uk-text-small uk-border-rounded uk-position-relative uk-text-center uk-text-nowrap tooltip favTooltipText">aaaaaaaa</div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php endif; ?>
        <?php if (!empty(JHTML::_('content.prepare', '{loadposition related}'))) { ?>
            <div>
                <section class="articleSection articleSectionRelated">
                    <div class="uk-container">
                        <div class="title uk-margin-medium-bottom"><h3 class="uk-margin-remove uk-text-center font"><?php echo JTEXT::_('RELATEDITEMS'); ?></h3></div>
                        <?php echo JHTML::_('content.prepare', '{loadposition related}'); ?>
                    </div>
                </section>
            </div>
        <?php } ?>
        <div>
            <section class="articleSection articleSectionComments">
                <div class="uk-container uk-container-xsmall">
                    <div class="title uk-margin-medium-bottom"><h3 class="uk-margin-remove uk-text-center font"><?php echo JTEXT::_('COMMENTS'); ?></h3></div>
                    <?php echo $this->item->event->afterDisplayContent; ?>
                </div>
            </section>
        </div>
    </div>
</div>
<?php endif; ?>
<?php /* echo $this->item->event->afterDisplayTitle; ?>
<?php echo $this->item->event->beforeDisplayContent; */ ?>
