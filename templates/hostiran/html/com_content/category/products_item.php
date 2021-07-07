<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Create a shortcut for params.
$params = $this->item->params;
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
$canEdit = $this->item->params->get('access-edit');
$info    = $params->get('info_block_position', 0);

// Check if associations are implemented. If they are, define the parameter.
$assocParam = (JLanguageAssociations::isEnabled() && $params->get('show_associations'));

$images = json_decode($this->item->images);
?>

<div class="productWrapper">
    <div class="uk-border-rounded uk-box-shadow-small uk-box-shadow-hover-medium uk-overflow-hidden uk-position-relative uk-inline-clip uk-transition-toggle">
        <div>
            <a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language)); ?>" title="<?php echo $this->item->title; ?>" class="uk-display-block">
                <div class="uk-cover-container">
                    <canvas width="400" height="400"></canvas>
                    <div class="uk-flex uk-flex-middle uk-cover" data-uk-cover>
                        <div>
                            <div class="uk-inline-clip uk-transition-toggle uk-display-block">
                                <img class="uk-transition-scale-up uk-transition-opaque" src="<?php echo !empty($images->image_intro) ? htmlspecialchars($images->image_intro, ENT_COMPAT, 'UTF-8') : 'images/sprite.svg#placeholdersquare'; ?>" width="600" height="600" alt="<?php echo $this->item->title; ?>" itemprop="thumbnailUrl"<?php if (empty($images->image_intro)) {echo ' data-uk-svg';} ?>>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <h3 itemprop="name" class="uk-margin-remove font uk-text-center uk-display-block uk-position-relative after-color"><?php echo $this->item->title; ?></h3>
                </div>
            </a>
        </div>
    </div>
</div>