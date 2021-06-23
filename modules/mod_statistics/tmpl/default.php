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
$total = count($items['number']);
?>
<section class="<?php echo $moduleclass_sfx; ?>" style="<?php echo 'padding-top:'.$params->get('paddingtop').'px;'.' padding-bottom:'.$params->get('paddingbottom').'px;'; ?> <?php if (!empty($params->get('bgcolor'))) {echo 'background-color:'.$params->get('bgcolor').';"';} ?>">
    <div class="<?php echo $params->get('gridwidth', 'uk-container') ?>">
        <?php if(!empty($params->get('title'))) { ?>
            <div class="uk-margin-bottom"><h3 class="sectionTitle border-color"><?php echo $params->get('title'); ?></h3></div>
        <?php } ?>
        <div>
            <div>
                <div class="uk-position-relative">
                    <ul class="uk-child-width-1-4@m uk-grid-large uk-grid-divider" data-uk-grid>
                        <?php for ($i=0;$i<$total;$i++) { ?>
                            <li>
                                <div class="uk-light">
                                    <span class="uk-display-block uk-text-center uk-text-white number font ltr"><?php echo $items['number'][$i]; ?></span>
                                    <span class="uk-display-block uk-text-center uk-margin-small-top uk-text-bold text font"><?php echo $items['title'][$i]; ?></span>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
