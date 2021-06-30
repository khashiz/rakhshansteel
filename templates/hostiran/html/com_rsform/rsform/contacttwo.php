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
<section id="map" class="pageHeader uk-position-relative <?php if ($pageparams->get('map')) { echo 'tall'; }?> <?php echo $pageparams->get('headerstyle', 'normal'); if ($pageparams->get('headerbgattachment') == 'fixed') { echo ' uk-background-fixed'; } ?> uk-flex uk-flex-center uk-flex-middle" style="<?php if (!empty($pageparams->get('headerbgcolor'))) {echo 'background-color:'.$pageparams->get('headerbgcolor').'; ';}  if (!empty($pageparams->get('headerbgimage'))) {echo 'background-image:url('.$pageparams->get('headerbgimage').');';}  ?>">
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
                    <div class="uk-width-1-1 uk-width-3-5@m contactForm">
                        <div class="uk-padding-large uk-height-1-1"><?php echo RSFormProHelper::displayForm($this->formId); ?></div>
                    </div>
                    <div class="uk-width-1-1 uk-width-2-5@m contactInfo background">
                        <div class="uk-padding-large">
                            <h2 class="font uk-margin-medium-bottom"><?php echo JTEXT::_('CONTACTINFO'); ?></h2>
                            <div class="contact uk-margin-large-bottom">
                                <div class="uk-grid-small" data-uk-grid>
                                    <?php if (!empty($params->get('phone'))) { ?>
                                        <div class="uk-width-1-1">
                                            <div class="uk-grid-small" data-uk-grid>
                                                <div class="uk-width-auto"><i class="fas fa-fw fa-phone"></i></div>
                                                <div class="uk-width-expand"><a href="tel:<?php echo $params->get('phone'); ?>" class="font uk-text-right@m"><span class="uk-display-inline-block ltr"><?php echo nl2br($params->get('phone')); ?></span></a></div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if (!empty($params->get('cellphone'))) { ?>
                                        <div class="uk-width-1-1">
                                            <div class="uk-grid-small" data-uk-grid>
                                                <div class="uk-width-auto"><i class="fas fa-fw fa-mobile"></i></div>
                                                <div class="uk-width-expand"><a href="tel:<?php echo $params->get('cellphone'); ?>" class="font uk-text-right@m"><span class="uk-display-inline-block ltr"><?php echo nl2br($params->get('cellphone')); ?></span></a></div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if (!empty($params->get('email'))) { ?>
                                        <div class="uk-width-1-1">
                                            <div class="uk-grid-small" data-uk-grid>
                                                <div class="uk-width-auto"><i class="fas fa-fw fa-envelope"></i></div>
                                                <div class="uk-width-expand"><a href="mailto:<?php echo $params->get('email'); ?>" class="font"><?php echo $params->get('email'); ?></a></div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if (!empty($params->get('address'.$languageCode))) { ?>
                                        <div class="uk-width-1-1">
                                            <div class="uk-grid-small" data-uk-grid>
                                                <div class="uk-width-auto"><i class="fas fa-fw fa-map"></i></div>
                                                <div class="uk-width-expand"><address class="font"><?php echo $params->get('address'.$languageCode); ?></address></div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="uk-margin-large-bottom">
                                <ul class="socials uk-grid-small uk-flex-center uk-flex-<?php echo $languageCode == 'fa' ? 'right' : 'left'; ?>@m" data-uk-grid>
                                    <?php for($i=0;$i<$total;$i++) { ?>
                                        <?php if ($socialsicons['link'][$i] != '') { ?>
                                            <li class="<?php echo $socialsicons['code'][$i]; ?>">
                                                <a href="<?php echo $socialsicons['link'][$i]; ?>" target="_blank" class="hasDrop uk-flex uk-flex-middle uk-flex-center uk-border-circle"><i class="<?php echo $socialsicons['icon'][$i]; ?>"></i></a>
                                                <div data-uk-drop="pos: top-center; offset: 12; delay-hide: 0; animation: uk-animation-slide-top-small;" class="top">
                                                    <div class="uk-card uk-card-default uk-box-shadow-small uk-text-small uk-border-rounded uk-position-relative uk-text-center uk-text-nowrap tooltip favTooltipText"><?php echo $socialsicons['title'][$i]; ?></div>
                                                </div>
                                            </li>
                                        <?php } ?>
                                    <?php } ?>
                                </ul>
                            </div>
                            <div>
                                <div data-uk-lightbox>
                                    <a class="font map uk-flex uk-flex-middle" href="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d810.2710083470595!2d51.29955342924263!3d35.674932788193665!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3f8dffbdee53ef3b%3A0x9a7e538b36d6c9e5!2z2YXYsdqp2LIg2b7Yrti0INin2YbZiNin2Lkg2YjYsdmCINin2LPYqtuM2YQg2K_YsSDYs9ix2KfYs9ixINin24zYsdin2YY!5e0!3m2!1sen!2s!4v1625012997235!5m2!1sen!2s" data-caption="" data-type="iframe"><?php echo JTEXT::_('SEELOCATIONONMAP'); ?><i class="fas fa-arrow-left uk-margin-small-<?php echo $languageCode == 'fa' ? 'right' : 'left'; ?> uk-visible@m"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if ($pageparams->get('map')) { ?>
<script>
    // Initialize and add the map
    function initMap() {
        // The location of Uluru
        const uluru = { lat: -25.344, lng: 131.036 };
        // The map, centered at Uluru
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 4,
            center: uluru,
        });
        // The marker, positioned at Uluru
        const marker = new google.maps.Marker({
            position: uluru,
            map: map,
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&callback=initMap&libraries=&v=weekly" async></script>
<?php } ?>