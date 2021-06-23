<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_custom
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$items = json_decode( $params->get('items'),true);
$total = count($items['logo']);
?>
<section class="<?php echo $moduleclass_sfx; ?>" style="<?php echo 'padding-top:'.$params->get('paddingtop').'px;'.' padding-bottom:'.$params->get('paddingbottom').'px;'; ?> <?php if (!empty($params->get('bgcolor'))) {echo 'background-color:'.$params->get('bgcolor').';"';} ?>">
    <div class="<?php echo $params->get('gridwidth', 'uk-container') ?>">
        <?php if(!empty($params->get('title'))) { ?>
            <div class="uk-margin-bottom"><h3 class="sectionTitle border-color"><?php echo $params->get('title'); ?></h3></div>
        <?php } ?>
        <div>
            <div data-uk-slider="autoplay: true; autoplay-interval: 2000; easing: cubic;">
                <div class="uk-position-relative">
                    <ul class="uk-slider-items uk-child-width-1-2 uk-child-width-1-6@m uk-grid uk-grid-large">
                        <?php for ($i=0;$i<$total;$i++) { ?>
                            <li class="uk-flex uk-flex-middle uk-flex-center"><a href="<?php echo $items['url'][$i]; ?>" title="<?php echo $items['caption'][$i]; ?>" class="uk-flex uk-flex-middle uk-flex-center"><img src="<?php echo $items['logo'][$i]; ?>" alt="<?php echo $items['caption'][$i]; ?>"></a></li>
                        <?php } ?>
                    </ul>
                </div>
                <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin-medium-top"></ul>
            </div>
        </div>
    </div>
</section>