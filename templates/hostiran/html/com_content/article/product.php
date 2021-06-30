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

$app  = JFactory::getApplication();
$sitename = $app->get('sitename');
foreach ($this->item->jcfields as $field) :
    $fieldsValue[$field->name] = $field->value;
    $fieldsLabel[$field->name] = $field->label;
    $fieldsRawValue[$field->name] = $field->rawvalue;
endforeach;

?>
<div class="uk-padding-large uk-padding-remove-horizontal">
    <div class="uk-container">
        <div class="uk-grid-large" data-uk-grid>
            <div class="uk-width-1-1 uk-width-2-5@m productGallery">
                <div class="galleryWrapper">
                    <?php if ( empty($fieldsValue['gallery']) ) { ?>
                        <div class="uk-cover-container uk-box-shadow-small uk-border-rounded uk-margin-bottom">
                            <canvas width="800" height="600"></canvas>
                            <div data-uk-cover>
                                <img class="uk-position-center uk-position-relative" src="<?php echo JURI::base().'/images/svg/sprite.svg#placeholder' ?>" alt="<?php echo $title; ?>" width="600" height="600" data-uk-svg />
                            </div>
                        </div>
                    <?php } else { ?>
                        <?php
                        $gallery = explode("<br>", $fieldsValue['gallery']);
                        ?>
                        <div>
                            <div data-uk-slideshow="ratio:4:3;">
                                <div class="uk-grid-small uk-child-width-1-1" data-uk-grid>
                                    <div>
                                        <div class="uk-position-relative">
                                            <div class="uk-slideshow-items uk-box-shadow-small uk-box-shadow-small uk-border-rounded" data-uk-lightbox="animation: slide">
                                                <?php for ($img=0;$img<count($gallery)-1;$img++) { ?>
                                                    <?php $image = explode(",", $gallery[$img]); ?>
                                                    <div>
                                                        <a class="uk-display-block" href="<?php echo $image[0]; ?>" data-uk-cover data-caption="<?php echo $image[1]; ?>">
                                                            <img src="<?php echo $image[0]; ?>" alt="<?php echo $image[1]; ?>" />
                                                        </a>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <ul class="uk-slideshow-nav uk-dotnav uk-flex-center uk-margin-top"></ul>
                                            <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" data-uk-slidenav-next data-uk-slideshow-item="next"></a>
                                            <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" data-uk-slidenav-previous data-uk-slideshow-item="previous"></a>
                                        </div>
                                    </div>
                                </div>
                                <ul class="uk-slideshow-nav uk-dotnav"></ul>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="uk-width-1-1 uk-width-3-5@m productDeatils">
                <div class="title">
                    <div><?php echo JHTML::_('content.prepare','{loadposition breadcrumbs}'); ?></div>
                    <div><h1 class="uk-margin-remove font"><?php echo $this->item->title; ?></h1></div>
                </div>
                <div class="description uk-margin-top">
                    <?php if (isset ($this->item->toc)) : echo $this->item->toc; endif; ?>
                    <div itemprop="articleBody" class="font uk-text-justify">
                        <div>
                            <?php echo $this->item->introtext; ?>
                        </div>
                        <?php if (!empty($this->item->fulltext)) { ?>
                        <div class="fulltext" hidden><?php echo $this->item->fulltext; ?></div>
                        <?php } ?>
                        <div class="uk-margin-top uk-hidden">
                            <ul class="uk-child-width-1-1 uk-grid-small uk-padding-remove" data-uk-grid>
                                <li>
                                    <span><?php echo $fieldsLabel['brand'].' : '; ?></span>
                                    <span><?php echo $fieldsValue['brand']; ?></span>
                                </li>
                                <li>
                                    <span>yhyyth</span>
                                    <span>yhyyth</span>
                                </li>
                            </ul>
                        </div>
                        <?php if (!empty($this->item->fulltext)) { ?>
                            <button class="uk-button uk-button-default uk-border-rounded uk-box-shadow-small uk-margin-top uk-width-small font" type="button" data-uk-toggle="target: .fulltext; animation: uk-animation-fade">
                                <span class="fulltext"><?php echo JTEXT::_('MOREINFO'); ?></span>
                                <span class="fulltext" hidden><?php echo JTEXT::_('CLOSE'); ?></span>
                            </button>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="uk-width-1-1">
                <div>
                    <div class="productTabsTitlesWrapper uk-position-relative uk-flex uk-flex-center uk-margin-medium-bottom">
                        <div class="uk-position-relative uk-padding uk-padding-remove-vertical productTabsHeadersWrapper">
                            <ul class="uk-subnav uk-subnav-pill uk-flex-center uk-margin-remove-bottom uk-child-width-1-3 uk-child-width-auto@m" data-uk-grid data-uk-switcher="connect: .uk-switcher; animation: uk-animation-fade productTabsTitles">
                                <li><a href="#" class="uk-button uk-width-small uk-button-default uk-border-rounded uk-width-1-1 uk-height-1-1 uk-box-shadow-small font"><?php echo JTEXT::_('PRODUCTDETAILS'); ?></a></li>
                                <li><a href="#" class="uk-button uk-width-small uk-button-default uk-border-rounded uk-width-1-1 uk-height-1-1 uk-box-shadow-small font"><?php echo JTEXT::_('DOWNLOADS'); ?></a></li>
                                <li><a href="#" class="uk-button uk-width-small uk-button-default uk-border-rounded uk-width-1-1 uk-height-1-1 uk-box-shadow-small font"><?php echo JTEXT::_('FAQ'); ?></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="uk-switcher">
                        <div class="productSpecifications">
                            <?php $specRows = explode('<br>', $fieldsValue['specifications']); ?>
                            <div class="uk-child-width-1-1 uk-grid-small" data-uk-grid>
                                <?php for ($s=0;$s<count($specRows)-1;$s++) { ?>
                                    <?php
                                    $specItem = explode(',', $specRows[$s]);
                                    ?>
                                    <div>
                                        <div>
                                            <div class="uk-grid-small" data-uk-grid>
                                                <div class="uk-width-small"><span class="uk-display-block uk-padding-small uk-background-muted uk-textse font uk-text-small title"><?php echo $specItem[0]; ?></span></div>
                                                <div class="uk-width-expand"><span class="uk-display-block uk-padding-small uk-background-muted uk-textse font uk-text-small value"><?php echo nl2br($specItem[1]); ?></span></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="productDownloads"><div class="uk-child-width-1-2 uk-child-width-1-5@m" data-uk-grid><?php echo $fieldsValue['downloads']; ?></div></div>
                        <div class="productFAQ">
                            <div data-uk-accordion>
                                <?php $faqItem = JTable::getInstance('content'); for ($f=0;$f<count($fieldsRawValue['faq']);$f++) { $faqItem->load($fieldsRawValue['faq'][$f]); ?>
                                    <div>
                                        <a class="uk-accordion-title uk-background-muted uk-padding-small uk-text-small font uk-border-rounded" href="#"><?php echo $faqItem->title; ?></a>
                                        <div class="uk-accordion-content"><?php echo $faqItem->introtext; ?></div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-width-1-1"><hr class="uk-margin-remove uk-divider-icon"></div>
            <div class="uk-width-1-1 productRelated"><?php echo JHTML::_('content.prepare','{loadposition relatedproducts}'); ?></div>
        </div>
    </div>
</div>









<div class="uk-hidden item-page<?php echo $this->pageclass_sfx; ?>" itemscope itemtype="https://schema.org/Article">
	<meta itemprop="inLanguage" content="<?php echo ($this->item->language === '*') ? JFactory::getConfig()->get('language') : $this->item->language; ?>" />
	<?php if ($this->params->get('show_page_heading')) : ?>
	<div class="page-header">
		<h1> <?php echo $this->escape($this->params->get('page_heading')); ?> </h1>
	</div>
	<?php endif;
	if (!empty($this->item->pagination) && $this->item->pagination && !$this->item->paginationposition && $this->item->paginationrelative)
	{
		echo $this->item->pagination;
	}
	?>

	<?php // Todo Not that elegant would be nice to group the params ?>
	<?php $useDefList = ($params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_create_date')
	|| $params->get('show_hits') || $params->get('show_category') || $params->get('show_parent_category') || $params->get('show_author') || $assocParam); ?>

	<?php if (!$useDefList && $this->print) : ?>
		<div id="pop-print" class="btn hidden-print">
			<?php echo JHtml::_('icon.print_screen', $this->item, $params); ?>
		</div>
		<div class="clearfix"> </div>
	<?php endif; ?>
	<?php if ($params->get('show_title') || $params->get('show_author')) : ?>
	<div class="page-header">
		<?php if ($params->get('show_title')) : ?>
			<h2 itemprop="headline">
				<?php echo $this->escape($this->item->title); ?>
			</h2>
		<?php endif; ?>
		<?php if ($this->item->state == 0) : ?>
			<span class="label label-warning"><?php echo JText::_('JUNPUBLISHED'); ?></span>
		<?php endif; ?>
		<?php if (strtotime($this->item->publish_up) > strtotime(JFactory::getDate())) : ?>
			<span class="label label-warning"><?php echo JText::_('JNOTPUBLISHEDYET'); ?></span>
		<?php endif; ?>
		<?php if ((strtotime($this->item->publish_down) < strtotime(JFactory::getDate())) && $this->item->publish_down != JFactory::getDbo()->getNullDate()) : ?>
			<span class="label label-warning"><?php echo JText::_('JEXPIRED'); ?></span>
		<?php endif; ?>
	</div>
	<?php endif; ?>
	<?php if (!$this->print) : ?>
		<?php if ($canEdit || $params->get('show_print_icon') || $params->get('show_email_icon')) : ?>
			<?php echo JLayoutHelper::render('joomla.content.icons', array('params' => $params, 'item' => $this->item, 'print' => false)); ?>
		<?php endif; ?>
	<?php else : ?>
		<?php if ($useDefList) : ?>
			<div id="pop-print" class="btn hidden-print">
				<?php echo JHtml::_('icon.print_screen', $this->item, $params); ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>

	<?php // Content is generated by content plugin event "onContentAfterTitle" ?>
	<?php echo $this->item->event->afterDisplayTitle; ?>

	<?php if ($useDefList && ($info == 0 || $info == 2)) : ?>
		<?php // Todo: for Joomla4 joomla.content.info_block.block can be changed to joomla.content.info_block ?>
		<?php echo JLayoutHelper::render('joomla.content.info_block.block', array('item' => $this->item, 'params' => $params, 'position' => 'above')); ?>
	<?php endif; ?>

	<?php if ($info == 0 && $params->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
		<?php $this->item->tagLayout = new JLayoutFile('joomla.content.tags'); ?>

		<?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
	<?php endif; ?>

	<?php // Content is generated by content plugin event "onContentBeforeDisplay" ?>
	<?php echo $this->item->event->beforeDisplayContent; ?>

	<?php if (isset($urls) && ((!empty($urls->urls_position) && ($urls->urls_position == '0')) || ($params->get('urls_position') == '0' && empty($urls->urls_position)))
		|| (empty($urls->urls_position) && (!$params->get('urls_position')))) : ?>
	<?php echo $this->loadTemplate('links'); ?>
	<?php endif; ?>
	<?php if ($params->get('access-view')) : ?>
	<?php echo JLayoutHelper::render('joomla.content.full_image', $this->item); ?>
	<?php
	if (!empty($this->item->pagination) && $this->item->pagination && !$this->item->paginationposition && !$this->item->paginationrelative) :
		echo $this->item->pagination;
	endif;
	?>


	<?php if ($info == 1 || $info == 2) : ?>
		<?php if ($useDefList) : ?>
				<?php // Todo: for Joomla4 joomla.content.info_block.block can be changed to joomla.content.info_block ?>
			<?php echo JLayoutHelper::render('joomla.content.info_block.block', array('item' => $this->item, 'params' => $params, 'position' => 'below')); ?>
		<?php endif; ?>
		<?php if ($params->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
			<?php $this->item->tagLayout = new JLayoutFile('joomla.content.tags'); ?>
			<?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
		<?php endif; ?>
	<?php endif; ?>

	<?php
	if (!empty($this->item->pagination) && $this->item->pagination && $this->item->paginationposition && !$this->item->paginationrelative) :
		echo $this->item->pagination;
	?>
	<?php endif; ?>
	<?php if (isset($urls) && ((!empty($urls->urls_position) && ($urls->urls_position == '1')) || ($params->get('urls_position') == '1'))) : ?>
	<?php echo $this->loadTemplate('links'); ?>
	<?php endif; ?>
	<?php // Optional teaser intro text for guests ?>
	<?php elseif ($params->get('show_noauth') == true && $user->get('guest')) : ?>
	<?php echo JLayoutHelper::render('joomla.content.intro_image', $this->item); ?>
	<?php echo JHtml::_('content.prepare', $this->item->introtext); ?>
	<?php // Optional link to let them register to see the whole article. ?>
	<?php if ($params->get('show_readmore') && $this->item->fulltext != null) : ?>
	<?php $menu = JFactory::getApplication()->getMenu(); ?>
	<?php $active = $menu->getActive(); ?>
	<?php $itemId = $active->id; ?>
	<?php $link = new JUri(JRoute::_('index.php?option=com_users&view=login&Itemid=' . $itemId, false)); ?>
	<?php $link->setVar('return', base64_encode(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language))); ?>
	<p class="readmore">
		<a href="<?php echo $link; ?>" class="register">
		<?php $attribs = json_decode($this->item->attribs); ?>
		<?php
		if ($attribs->alternative_readmore == null) :
			echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
		elseif ($readmore = $attribs->alternative_readmore) :
			echo $readmore;
			if ($params->get('show_readmore_title', 0) != 0) :
				echo JHtml::_('string.truncate', $this->item->title, $params->get('readmore_limit'));
			endif;
		elseif ($params->get('show_readmore_title', 0) == 0) :
			echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');
		else :
			echo JText::_('COM_CONTENT_READ_MORE');
			echo JHtml::_('string.truncate', $this->item->title, $params->get('readmore_limit'));
		endif; ?>
		</a>
	</p>
	<?php endif; ?>
	<?php endif; ?>
	<?php
	if (!empty($this->item->pagination) && $this->item->pagination && $this->item->paginationposition && $this->item->paginationrelative) :
		echo $this->item->pagination;
	?>
	<?php endif; ?>
	<?php // Content is generated by content plugin event "onContentAfterDisplay" ?>
	<?php echo $this->item->event->afterDisplayContent; ?>
</div>
