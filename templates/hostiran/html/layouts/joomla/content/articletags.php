<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

use Joomla\Registry\Registry;

JLoader::register('TagsHelperRoute', JPATH_BASE . '/components/com_tags/helpers/route.php');

$authorised = JFactory::getUser()->getAuthorisedViewLevels();

$lang = JFactory::getLanguage();
$languages = JLanguageHelper::getLanguages('lang_code');
$languageCode = $languages[ $lang->getTag() ]->sef;

?>
<?php if (!empty($displayData)) : ?>
<div data-uk-grid>
    <div class="uk-width-auto uk-flex uk-flex-middle uk-visible@m"><span class="font"><?php echo JTEXT::_('TAGS'); ?></span></div>
    <div class="uk-width-expand uk-flex uk-flex-middle">
        <div>
            <ul class="uk-grid-small uk-flex-center uk-flex-<?php echo $languageCode == 'fa' ? 'right' : 'left'; ?>@m" data-uk-grid>
                <?php foreach ($displayData as $i => $tag) : ?>
                    <?php if (in_array($tag->access, $authorised)) : ?>
                        <?php $tagParams = new Registry($tag->params); ?>
                        <?php $link_class = $tagParams->get('tag_link_class', 'label label-info'); ?>
                        <li class="tag-<?php echo $tag->tag_id; ?> tag-list<?php echo $i; ?>" itemprop="keywords">
                            <a href="<?php echo JRoute::_(TagsHelperRoute::getTagRoute($tag->tag_id . ':' . $tag->alias)); ?>" class="<?php echo $link_class; ?> font uk-button uk-button-default uk-button-small uk-box-shadow-small uk-border-rounded">
                                <?php echo $this->escape($tag->title); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
<hr class="">
<?php endif; ?>