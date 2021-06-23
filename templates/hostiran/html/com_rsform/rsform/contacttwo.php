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
<section id="map_rc0cxe" class="pageHeader <?php if ($pageparams->get('map')) { echo 'tall'; }?> uk-position-relative <?php echo $pageparams->get('headerstyle', 'normal'); if ($pageparams->get('headerbgattachment') == 'fixed') { echo ' uk-background-fixed'; } ?> uk-flex uk-flex-center uk-flex-middle" style="<?php if (!empty($pageparams->get('headerbgcolor'))) {echo 'background-color:'.$pageparams->get('headerbgcolor').';';}  ?>">
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
                                    <a class="font map uk-flex uk-flex-middle" href="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d481.465955990377!2d51.424407646701866!3d35.72858013600734!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3f8e015a366e3341%3A0xab0431d39d295be4!2sHostiran!5e0!3m2!1sen!2suk!4v1565423124188!5m2!1sen!2suk" data-caption="" data-type="iframe"><?php echo JTEXT::_('SEELOCATIONONMAP'); ?><i class="fas fa-arrow-left uk-margin-small-<?php echo $languageCode == 'fa' ? 'right' : 'left'; ?> uk-visible@m"></i></a>
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
    function myMap() {
        var mapProp= {
            center:new google.maps.LatLng(51.508742,-0.120850),
            zoom:5,
        };
        var map = new google.maps.Map(document.getElementById("mapWrapper"),mapProp);
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY&callback=myMap"></script>
<?php } ?>








<!-- CedarMap CSS SDK -->
<link href='https://api.cedarmaps.com/cedarmaps.js/v1.8.1/cedarmaps.css' rel='stylesheet' />

<script>
    function contactMap() {
        // Map options
        var cm_options = {"center":{"lat":37.4467056,"lng":49.6037977},"maptype":"light","scrollWheelZoom":false,"zoomControl":true,"zoom":13,"minZoom":6,"maxZoom":17,"legendControl":false,"attributionControl":false}
        // Initialized CedarMap
        var map = window.L.cedarmaps.map('map_rc0cxe', 'https://api.cedarmaps.com/v1/tiles/cedarmaps.streets.json?access_token=5256866fe5dbe63006370d837dc4e5554d6ec7f9', cm_options);
        // Markers options
        var markers = [{"popupContent":"موقعیت مکانی شما","center":{"lat":37.4467056,"lng":49.6037977},"iconOpts":{"iconUrl":"https://api.cedarmaps.com/v1/markers/marker-default.png","iconRetinaUrl":"https://api.cedarmaps.com/v1/markers/marker-default@2x.png","iconSize":[82,98]}}];
        var markersLeaflet = [];
        var _marker = null;

        map.setView(cm_options.center, cm_options.zoom);
        // Add Markers on Map
        if (markers.length === 0) return;
        markers.map(function(marker) {
            var iconOpts = {
                iconUrl: marker.iconOpts.iconUrl,
                iconRetinaUrl: marker.iconOpts.iconRetinaUrl,
                iconSize: marker.iconOpts.iconSize,
                popupAnchor: [0, -49]
            };

            const markerIcon = {
                icon: window.L.icon(iconOpts)
            };

            _marker = new window.L.marker(marker.center, markerIcon);
            markersLeaflet.push(_marker);
            if (marker.popupContent) {
                _marker.bindPopup(marker.popupContent);
            }
            _marker.addTo(map);
        });
        // Bounding Map to Markers
        if (markers.length > 1) {
            var group = new window.L.featureGroup(markersLeaflet);
            map.fitBounds(group.getBounds(), { padding: [30, 30] });
        }
    };

    (function(c,e,d,a){
        var p = c.createElement(e);
        p.async = 1; p.src = d;
        p.onload = a;
        c.body.appendChild(p);
    })(document, 'script', 'https://api.cedarmaps.com/cedarmaps.js/v1.8.1/cedarmaps.js', contactMap);
</script>
