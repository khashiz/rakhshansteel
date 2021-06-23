<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;
/** @var JDocumentHtml $this */
$app  = JFactory::getApplication();
$user = JFactory::getUser();
// Output as HTML5
$this->setHtml5(true);
// Getting params from template
$params = $app->getTemplate(true)->params;
$menu = $app->getMenu();
$active = $menu->getActive();
$pageparams = $menu->getParams( $active->id );
$pageclass = $pageparams->get( 'pageclass_sfx' );
// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->get('sitename');

$netparsi = '<a href="https://netparsi.com" target="_blank" title="'.JText::sprintf('NETPARSI').'">&ensp;'.JText::sprintf('NETPARSI').'</a>';

$lang = JFactory::getLanguage();
$languages = JLanguageHelper::getLanguages('lang_code');
$languageCode = $languages[ $lang->getTag() ]->sef;

// Add Stylesheets
JHtml::_('stylesheet', $params->get('font').'.css', array('version' => 'auto', 'relative' => true));
JHtml::_('stylesheet', 'all.min.css', array('version' => 'auto', 'relative' => true));
$this->direction == 'rtl' ? JHtml::_('stylesheet', 'uikit-rtl.min.css', array('version' => 'auto', 'relative' => true)) : JHtml::_('stylesheet', 'ltr/uikit.min.css', array('version' => 'auto', 'relative' => true));
JHtml::_('stylesheet', 'hostiran-'.$this->direction.'.css', array('version' => 'auto', 'relative' => true));

// Add js
/*if ($pageclass == 'contact') { JHtml::_('jquery.framework'); } else { JHtml::_('script', 'bootstrap.min.js', array('version' => 'auto', 'relative' => true)); } */
JHtml::_('script', 'uikit.min.js', array('version' => 'auto', 'relative' => true));
if ($languageCode == 'fa') {JHtml::_('script', 'persianumber.min.js', array('version' => 'auto', 'relative' => true));}

$socialsicons = json_decode( $params->get('socials'),true);
$total = count($socialsicons['icon']);

$phones = explode("\n", $params->get('phone'));
$cells = explode("\n", $params->get('cellphone'));
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    <meta name="theme-color" content="<?php echo $params->get('presetcolor'); ?>">
    <jdoc:include type="head" />
    <style type="text/css">
        .border-color{border-color:<?php echo $params->get('templatecolor').';'; ?>}
        .color{color:<?php echo $params->get('templatecolor').';'; ?>}
        .hovercolor:hover{color:<?php echo $params->get('templatecolor').' !important;'; ?>}
        .background,.uk-subnav-pill>.uk-active>a{background-color:<?php echo $params->get('templatecolor').';'; ?>}
        .uk-subnav-pill>.uk-active>a{box-shadow: 0 0 20px 0 #ccc;border-color: transparent;}
        .after-color:after{background-color:<?php echo $params->get('templatecolor').';'; ?>}
        .fill{fill:<?php echo $params->get('templatecolor').';'; ?>}
        .lightbg{background-color:<?php echo $params->get('templatecolor').'30;'; ?>}
        blockquote:before{color:<?php echo $params->get('templatecolor').';'; ?>;}
    </style>
</head>
<body>
<header class="uk-text-zero <?php echo $pageparams->get('headerstyle') == 'transparent' ? 'uk-position-absolute uk-width-1-1' : 'uk-position-relative'; ?> uk-position-z-index <?php echo $pageparams->get('headerstyle', 'normal'); ?> <?php if ($pageclass == 'home') echo 'uk-box-shadow-medium'; ?>">
    <div class="headerWrapper">
        <div class="topBar uk-position-relative uk-position-z-index uk-visible@m">
            <div class="uk-container">
                <div data-uk-grid>
                    <div class="uk-width-expand">
                        <div class="contact">
                            <div class="uk-grid-small uk-child-width-auto uk-grid-divider" data-uk-grid>
                                <?php if (!empty($params->get('phone')) && in_array('phone', $params->get('headercontact'))) { ?>
                                    <div>
                                        <div class="uk-flex uk-flex-middle">
                                            <i class="color fas fa-fw fa-phone"></i>
                                            <span class="uk-display-inline-block ltr"><?php echo $phones[0]; ?></span>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if (!empty($params->get('cellphone')) && in_array('cellphone', $params->get('headercontact'))) { ?>
                                    <div>
                                        <div class="uk-flex uk-flex-middle">
                                            <i class="color fas fa-fw fa-mobile"></i>
                                            <span class="uk-display-inline-block ltr"><?php echo $cells[0]; ?></span>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if (!empty($params->get('email')) && in_array('email', $params->get('headercontact'))) { ?>
                                    <div>
                                        <div class="uk-flex uk-flex-middle">
                                            <i class="color fas fa-fw fa-envelope"></i>
                                            <span class="uk-display-inline-block ltr"><?php echo $params->get('email'); ?></span>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if (!empty($params->get('address'.$languageCode)) && in_array('address', $params->get('headercontact'))) { ?>
                                    <div>
                                        <div class="uk-flex uk-flex-middle">
                                            <i class="color fas fa-fw fa-map"></i>
                                            <address class="font uk-display-inline-block uk-margin-remove"><?php echo $params->get('address'.$languageCode); ?></address>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-auto">
                        <div class="socials uk-height-1-1 uk-grid-small uk-flex uk-flex-middle">
                            <ul class="uk-grid-small" data-uk-grid>
                                <?php for($i=0;$i<$total;$i++) { ?>
                                    <?php if ($socialsicons['link'][$i] != '') { ?>
                                        <li class="<?php echo $socialsicons['code'][$i]; ?>">
                                            <a href="<?php echo $socialsicons['link'][$i]; ?>" target="_blank" class="uk-flex uk-flex-middle uk-flex-center uk-border-circle"><i class="hovercolor transition <?php echo $socialsicons['icon'][$i]; ?>"></i></a>
                                        </li>
                                    <?php } ?>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="logoNav<?php if ($pageparams->get('headerstyle') == 'normal') {echo ' uk-box-shadow-small';} ?>"<?php if ($params->get('stickyHeader')) echo ' data-uk-sticky'; ?>>
            <div class="uk-container">
                <div data-uk-grid>
                    <div class="uk-width-expand uk-hidden@m icon mobileIcon uk-flex uk-flex-middle uk-flex-center"><a href="#"><i class="fas fa-bars"></i></a></div>
                    <div class="uk-width-auto logo">
                        <h1 class="uk-margin-remove">
                            <a href="<?php echo JURI::base(); ?>" title="<?php echo $sitename; ?>" class="uk-flex uk-flex-center uk-flex-middle">
                                <span class="shape"><img src="<?php echo JURI::base().'images/logo.svg'; ?>" width="105" height="60" alt="<?php echo $sitename; ?>"></span>
                                <span class="color"><?php echo $sitename; ?></span>
                            </a>
                        </h1>
                    </div>
                    <jdoc:include type="modules" name="nav" style="none" />
                    <?php if ($this->countModules( 'search' )) { ?>
                        <jdoc:include type="modules" name="search" style="none" />
                        <div class="navToggle uk-width-auto uk-visible@m icon uk-flex uk-flex-middle">
                            <a class="uk-text-zero" data-uk-toggle="target: .navToggle; animation: uk-animation-fade" href="#"><i class="fas fa-fw fa-search"></i></a>
                        </div>
                        <div class="navToggle uk-width-auto uk-visible@m icon uk-flex uk-flex-middle" hidden>
                            <a class="uk-text-zero" data-uk-toggle="target: .navToggle; animation: uk-animation-fade" href="#"><i class="fas fa-fw fa-times"></i></a>
                        </div>
                    <?php } ?>
                    <?php if ($this->countModules( 'mobilesearch' )) { ?>
                        <div class="mobToggle uk-width-expand uk-hidden@m icon mobileIcon uk-flex uk-flex-middle uk-flex-center">
                            <a class="uk-text-zero" data-uk-toggle="target: .mobToggle; animation: uk-animation-fade" href="#"><i class="fas fa-fw fa-search"></i></a>
                        </div>
                        <div class="mobToggle uk-width-expand uk-hidden@m icon mobileIcon uk-flex uk-flex-middle uk-flex-center" hidden>
                            <a class="uk-text-zero" data-uk-toggle="target: .mobToggle; animation: uk-animation-fade" href="#"><i class="fas fa-fw fa-times"></i></a>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <jdoc:include type="modules" name="mobilesearch" style="none" />
        </div>
    </div>
</header>
<main class="site <?php echo $option . ' view-' . $view . ($layout ? ' layout-' . $layout : ' no-layout') . ($task ? ' task-' . $task : ' no-task') . ($itemid ? ' itemid-' . $itemid : '') . (' '.$pageclass) . ($this->direction === 'rtl' ? ' rtl' : ' ltr'); ?>" style="background-color: <?php echo $pageparams->get('bgcolor', '#fbfbfb'); ?>;">
    <jdoc:include type="modules" name="top" style="none" />
    <jdoc:include type="message" />
    <jdoc:include type="component" />
    <jdoc:include type="modules" name="bottom" style="none" />
</main>
<footer class="border-color uk-text-zero"<?php if (!empty($params->get('footerbgcolor'))) echo ' style="background-color:'.$params->get("footerbgcolor").';"'; ?>>
    <div class="footerWrapper">
        <div class="modules">
            <div class="uk-container">
                <div class="uk-grid-large" data-uk-grid>
                    <div class="uk-width-1-1 uk-width-1-3@m">
                        <h4 class="color font uk-text-center uk-text-right@m"><?php echo JTEXT::_('CONTACTUS'); ?></h4>
                        <div class="modulebody contact">
                            <div class="uk-grid-small" data-uk-grid>
                                <?php if (!empty($params->get('phone'))) { ?>
                                    <div class="uk-width-1-2 uk-width-1-2@m">
                                        <div class="uk-grid-small" data-uk-grid>
                                            <div class="uk-width-1-1 uk-width-auto@m"><i class="fas fa-fw fa-phone"></i></div>
                                            <div class="uk-width-expand"><a href="tel:<?php echo $phones[0]; ?>" class="font"><span class="uk-display-inline-block ltr fnu"><?php echo nl2br($params->get('phone')); ?></span></a></div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if (!empty($params->get('cellphone'))) { ?>
                                    <div class="uk-width-1-2 uk-width-1-2@m">
                                        <div class="uk-grid-small" data-uk-grid>
                                            <div class="uk-width-1-1 uk-width-auto@m"><i class="fas fa-fw fa-mobile"></i></div>
                                            <div class="uk-width-expand"><a href="tel:<?php echo $cells[0]; ?>" class="font"><span class="uk-display-inline-block ltr"><?php echo nl2br($params->get('cellphone')); ?></span></a></div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if (!empty($params->get('fax'))) { ?>
                                    <div class="uk-width-1-2">
                                        <div class="uk-grid-small" data-uk-grid>
                                            <div class="uk-width-1-1 uk-width-auto@m"><i class="fas fa-fw fa-fax"></i></div>
                                            <div class="uk-width-expand"><a href="#" class="font"><span class="uk-display-inline-block ltr"><?php echo $params->get('fax'); ?></span></a></div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if (!empty($params->get('email'))) { ?>
                                    <div class="uk-width-1-2">
                                        <div class="uk-grid-small" data-uk-grid>
                                            <div class="uk-width-1-1 uk-width-auto@m"><i class="fas fa-fw fa-envelope"></i></div>
                                            <div class="uk-width-expand"><a href="mailto:<?php echo $params->get('email'); ?>" class="font"><?php echo $params->get('email'); ?></a></div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if (!empty($params->get('address'.$languageCode))) { ?>
                                    <div class="uk-width-1-1">
                                        <div class="uk-grid-small" data-uk-grid>
                                            <div class="uk-width-1-1 uk-width-auto@m"><i class="fas fa-fw fa-map"></i></div>
                                            <div class="uk-width-expand"><address class="font"><?php echo $params->get('address'.$languageCode); ?></address></div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <jdoc:include type="modules" name="footer" style="hostiran" />
                    <div class="uk-width-1-1 uk-width-expand@m">
                        <h4 class="color font uk-text-center uk-text-right@m"><?php echo JTEXT::_('KEEPUPTODATE'); ?></h4>
                        <jdoc:include type="modules" name="newsletter" style="hostiran" />
                        <div class="modulebody socials">
                            <ul class="socials uk-grid-small uk-flex-center uk-flex-<?php echo $languageCode == 'fa' ? 'right' : 'left'; ?>@m" data-uk-grid>
                                <?php for($i=0;$i<$total;$i++) { ?>
                                    <?php if ($socialsicons['link'][$i] != '') { ?>
                                        <li class="<?php echo $socialsicons['code'][$i]; ?>">
                                            <a href="<?php echo $socialsicons['link'][$i]; ?>" target="_blank" class="hasDrop uk-flex uk-flex-middle uk-flex-center uk-border-circle" title="<?php echo $socialsicons['title'][$i]; ?>"><i class="<?php echo $socialsicons['icon'][$i]; ?>"></i></a>
                                            <div data-uk-drop="pos: top-center; offset: 12; delay-hide: 0; animation: uk-animation-slide-top-small;" class="top">
                                                <div class="uk-card uk-card-default uk-box-shadow-small uk-text-small uk-border-rounded uk-position-relative uk-text-center uk-text-nowrap tooltip favTooltipText"><?php echo $socialsicons['title'][$i]; ?></div>
                                            </div>
                                        </li>
                                    <?php } ?>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyrightWrapper">
            <div class="uk-container">
                <div class="copyright">
                    <div class="uk-grid-small uk-flex-center" data-uk-grid>
                        <div class="uk-width-1-1 uk-width-auto@m"><p class="font uk-text-center uk-text-right@m"><i class="far fa-copyright uk-margin-small-left"></i><?php echo JText::sprintf('COPYRIGHT', $sitename); ?></p></div>
                        <div class="uk-width-1-1 uk-width-expand@m"><p class="font uk-flex uk-flex-center uk-flex-middle uk-flex-left@m"><i class="fa fa-code uk-margin-small-left"></i><?php echo JText::sprintf('DEVELOPER', $netparsi); ?></p></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php if ($this->direction == 'rtl') { ?>
    <script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery('.fnum').persiaNumber('fa');
        });
    </script>
<?php } ?>

</body>
</html>