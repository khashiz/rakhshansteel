<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_news
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<li>
    <h3 class="uk-text-zero">
        <a class="uk-padding-small uk-border-rounded uk-box-shadow-small uk-h5 uk-margin-remove uk-display-block uk-link-reset uk-text-bold hovercolor font" href="<?php echo $item->link; ?>">
            <span class="uk-display-block uk-margin-small-top uk-margin-bottom">
                <img src="<?php echo JURI::base().'images/sprite.svg#'.$item->alias; ?>" width="48" height="48" alt="<?php echo $item->title; ?>" data-uk-svg>
            </span>
            <?php echo $item->title; ?>
        </a>
    </h3>
</li>