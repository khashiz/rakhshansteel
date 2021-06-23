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
$params = $app->getTemplate(true)->params;
$menu = $app->getMenu();
$active = $menu->getActive();
$pageparams = $menu->getParams( $active->id );
$pageclass = $pageparams->get( 'pageclass_sfx' );

$lang = JFactory::getLanguage();
$languages = JLanguageHelper::getLanguages('lang_code');
$languageCode = $languages[ $lang->getTag() ]->sef;

foreach ($this->item->jcfields as $field) :
    $fieldsValue[$field->name] = $field->value;
endforeach;

$sections = explode('<br>', $fieldsValue['sections']);
$totalSections = count($sections);

$numbers = explode('<br>', $fieldsValue['numbers']);
$totalNumbers = count($numbers);

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
<section class="pageWrapper normal uk-position-relative normal">
    <div class="<?php echo $pageparams->get('gridwidth', 'uk-container') ?>" itemscope="" itemtype="https://schema.org/Blog">
        <div class="uk-box-shadow-small uk-border-rounded wrapper uk-overflow-hidden uk-margin-large-bottom">
            <div>
                <div class="itemPage" itemscope itemtype="https://schema.org/Article">
                    <div class="uk-padding-large aboutSections">
                        <div class="uk-grid-divider uk-child-width-1-1" data-uk-grid>
                            <?php for ($i=0;$i<$totalSections-1;$i++) { $section = explode(',', $sections[$i]); ?>
                            <div>
                                <div>
                                    <div data-uk-grid>
                                        <div class="uk-width-1-1 uk-width-1-4@m uk-flex uk-flex-middle uk-flex-center"><img src="<?php echo $section[0]; ?>" alt="<?php echo $section[1]; ?>"></div>
                                        <div class="uk-width-1-1 uk-width-3-4@m">
                                            <div class="uk-margin-bottom"><h2 class="sectionTitle border-color"><?php echo $section[1]; ?></h2></div>
                                            <div>
                                                <div class="font uk-text-justify"><?php echo $section[2]; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="uk-padding-large uk-background-muted aboutStatistics">
                        <div class="uk-grid-large">
                            <div class="uk-width-1-1">
                                <div class="uk-child-width-1-4" data-uk-grid>
                                    <?php for ($i=0;$i<$totalNumbers-1;$i++) { $number = explode(',', $numbers[$i]); ?>
                                    <div>
                                        <span class="uk-text-center uk-display-block font number"><?php echo $number[0]; ?></span>
                                        <span class="uk-text-center uk-display-block font title"><?php echo $number[1] ?></span>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php echo JHTML::_('content.prepare', '{loadposition customers}'); ?>
<?php /* echo $this->item->event->afterDisplayTitle; ?>
<?php echo $this->item->event->beforeDisplayContent; */ ?>
