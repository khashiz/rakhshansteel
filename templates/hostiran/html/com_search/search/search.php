<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_search
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

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
        <?php if (!empty($this->searchword)) : ?>
            <?php if ($this->total == 0) { ?>
                <p class="uk-text-center uk-margin-remove-bottom font" style="color: <?php echo $pageparams->get('pagedescriptioncolor', '#ccc') ?>"><?php echo JText::_('COM_SEARCH_SEARCH_KEYWORD_NO_RESULTS'); ?></p>
            <?php } else { ?>
                <p class="uk-text-center uk-margin-remove-bottom font fnum" style="color: <?php echo $pageparams->get('pagedescriptioncolor', '#ccc') ?>"><?php echo JText::plural('COM_SEARCH_SEARCH_KEYWORD_N_RESULTS', $this->total); ?></p>
            <?php } ?>
        <?php endif; ?>
    </div>
</section>
<section class="pageWrapper <?php echo $pageparams->get('headerstyle', 'normal'); ?> uk-position-relative <?php echo $pageparams->get('headerstyle', 'normal'); ?>">
    <div class="<?php echo $pageparams->get('gridwidth', 'uk-container') ?>" itemscope itemtype="https://schema.org/Blog">
        <div class="uk-box-shadow-small uk-border-rounded wrapper uk-margin-large-bottom">
            <div class="uk-padding">
                <?php echo $this->loadTemplate('form'); ?>
                <?php if ($this->error == null && count($this->results) > 0) : ?>
                    <?php echo $this->loadTemplate('results'); ?>
                <?php else : ?>
                    <?php echo $this->loadTemplate('error'); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>