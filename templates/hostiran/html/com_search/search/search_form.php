<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_search
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('bootstrap.tooltip');

$lang = JFactory::getLanguage();
$upper_limit = $lang->getUpperLimitSearchWord();

$app  = JFactory::getApplication();
$params = $app->getTemplate(true)->params;
$menu = $app->getMenu();
$active = $menu->getActive();
$pageparams = $menu->getParams( $active->id );
$pageclass = $pageparams->get( 'pageclass_sfx' );

?>
<form id="searchForm" action="<?php echo JRoute::_('index.php?option=com_search'); ?>" method="post">
    <fieldset>
        <div class="uk-grid-small uk-grid-match uk-grid" data-uk-grid="">
            <div class="uk-width-1-1 uk-width-3-4@m rsform-block rsform-block-fullname uk-first-column">
                <div class="formControls">
                    <div class="uk-position-relative">
                        <input class="uk-width-1-1 uk-border-rounded font rsform-input-box uk-input" type="text" name="searchword" title="<?php echo JText::_('COM_SEARCH_SEARCH_KEYWORD'); ?>" placeholder="<?php echo JText::_('COM_SEARCH_SEARCH_KEYWORD'); ?>" id="search-searchword" size="30" maxlength="<?php echo $upper_limit; ?>" value="<?php echo $this->escape($this->origkeyword); ?>" />
                    </div>
                </div>
            </div>
            <div class="uk-width-1-1 uk-width-expand@m">
                <div class="formControls">
                    <div class="uk-position-relative">
                        <button name="Search" onclick="this.form.submit()" class="font uk-button uk-border-rounded uk-box-shadow-small uk-width-1-1 uk-button-positive"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
                        <input type="hidden" name="task" value="search" />
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
    <?php if ($this->params->get('search_phrases', 1)) : ?>
        <fieldset class="phrases">
            <legend>
                <?php echo JText::_('COM_SEARCH_FOR'); ?>
            </legend>
            <div class="phrases-box">
                <?php echo $this->lists['searchphrase']; ?>
            </div>
            <div class="ordering-box">
                <label for="ordering" class="ordering">
                    <?php echo JText::_('COM_SEARCH_ORDERING'); ?>
                </label>
                <?php echo $this->lists['ordering']; ?>
            </div>
        </fieldset>
    <?php endif; ?>
    <?php if ($this->params->get('search_areas', 1)) : ?>
        <fieldset class="only">
            <legend>
                <?php echo JText::_('COM_SEARCH_SEARCH_ONLY'); ?>
            </legend>
            <?php foreach ($this->searchareas['search'] as $val => $txt) : ?>
                <?php $checked = is_array($this->searchareas['active']) && in_array($val, $this->searchareas['active']) ? 'checked="checked"' : ''; ?>
                <label for="area-<?php echo $val; ?>" class="checkbox">
                    <input type="checkbox" name="areas[]" value="<?php echo $val; ?>" id="area-<?php echo $val; ?>" <?php echo $checked; ?> />
                    <?php echo JText::_($txt); ?>
                </label>
            <?php endforeach; ?>
        </fieldset>
    <?php endif; ?>
    <?php if ($this->total > 0) : ?>
        <div class="form-limit uk-hidden">
            <label for="limit"><?php echo JText::_('JGLOBAL_DISPLAY_NUM'); ?></label>
            <?php echo $this->pagination->getLimitBox(); ?>
            <p class="counter"><?php echo $this->pagination->getPagesCounter(); ?></p>
        </div>
    <?php endif; ?>
</form>