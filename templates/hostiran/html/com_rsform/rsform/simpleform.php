<?php
/**
* @package RSForm! Pro
* @copyright (C) 2007-2019 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

defined('_JEXEC') or die('Restricted access');

$lang = JFactory::getLanguage();
$languages = JLanguageHelper::getLanguages('lang_code');
$languageCode = $languages[ $lang->getTag() ]->sef;

$app  = JFactory::getApplication();
$params = $app->getTemplate(true)->params;
$menu = $app->getMenu();
$active = $menu->getActive();
$pageparams = $menu->getParams( $active->id );
$pageclass = $pageparams->get( 'pageclass_sfx' );

$socialsicons = json_decode( $params->get('socials'),true);
$total = count($socialsicons['icon']);
?>
<section id="mapWrapper" class="pageHeader <?php if ($pageparams->get('map')) { echo 'tall'; }?> uk-position-relative <?php echo $pageparams->get('headerstyle', 'normal'); if ($pageparams->get('headerbgattachment') == 'fixed') { echo ' uk-background-fixed'; } ?> uk-flex uk-flex-center uk-flex-middle" style="<?php if (!empty($pageparams->get('headerbgcolor'))) {echo 'background-color:'.$pageparams->get('headerbgcolor').';';} if (!empty($pageparams->get('headerbgimage'))) {echo 'background-image:url('.$pageparams->get('headerbgimage').');';}  ?>">
    <?php if ($pageparams->get('cover')) { ?><div class="uk-position-absolute uk-position-cover" style="background-color: <?php echo $pageparams->get('coverbgcolor', 'rgba(0, 0, 0, .6)'); ?>;"></div><?php } ?>
    <?php if ($pageparams->get('map') == 0) { ?>
    <div class="uk-position-relative uk-container">
        <h1 class="uk-text-center uk-margin-remove font" style="color: <?php echo $pageparams->get('pagetitlecolor', '#fff') ?>"><?php echo $pageparams->get('pagetitle', $active->title); ?></h1>
        <?php if (!empty($pageparams->get('pagedescription'))) { ?>
            <p class="uk-text-center uk-margin-remove-bottom font" style="color: <?php echo $pageparams->get('pagedescriptioncolor', '#ccc') ?>"><?php echo $pageparams->get('pagedescription'); ?></p>
        <?php } ?>
    </div>
    <?php } ?>
</section>
<section class="pageWrapper <?php echo $pageparams->get('headerstyle', 'normal'); ?> uk-position-relative <?php echo $pageparams->get('headerstyle', 'normal'); ?>">
    <div class="<?php echo $pageparams->get('gridwidth', 'uk-container') ?>" itemscope itemtype="https://schema.org/Blog">
        <div class="uk-box-shadow-small uk-border-rounded wrapper uk-overflow-hidden uk-margin-large-bottom">
            <div>
                <div class="uk-grid-collapse contactus" data-uk-grid>
                    <div class="uk-width-1-1 contactForm">
                        <div class="uk-padding-large uk-height-1-1"><?php echo RSFormProHelper::displayForm($this->formId); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>