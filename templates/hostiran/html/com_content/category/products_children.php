<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('bootstrap.tooltip');

$lang   = JFactory::getLanguage();
$user   = JFactory::getUser();
$groups = $user->getAuthorisedViewLevels();

if ($this->maxLevel != 0 && count($this->children[$this->category->id]) > 0) : ?>
	<?php foreach ($this->children[$this->category->id] as $id => $child) : $params = json_decode($child->params); ?>
        <?php if (in_array($child->access, $groups)) : ?>
            <?php if ($this->params->get('show_empty_categories') || $child->numitems || count($child->getChildren())) : ?>

            <div class="productSubCatWrapper">
                <div class="uk-border-rounded uk-box-shadow-small uk-overflow-hidden uk-position-relative uk-inline-clip uk-transition-toggle">
                    <div>
                        <a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($child->id)); ?>" title="<?php echo $this->escape($child->title); ?>" class="uk-cover-container uk-display-block">
                            <?php if ( $this->params->get('show_cat_num_articles', 1)) : ?>
                                <span class="uk-position-z-index uk-box-shadow-small uk-label uk-position-absolute uk-position-top-right uk-margin-small-right uk-margin-small-top uk-border-pill font fnum"><?php echo JTEXT::sprintf('SUBCATCOUNT', $child->getNumItems(true)); ?></span>
                            <?php endif; ?>
                            <canvas width="400" height="300"></canvas>
                            <div class="uk-flex uk-flex-middle uk-cover" data-uk-cover>
                                <div>
                                    <div class="uk-inline-clip uk-transition-toggle uk-display-block">
                                        <img class="uk-transition-scale-up uk-transition-opaque" src="<?php echo !empty($params->image) ? htmlspecialchars($params->image, ENT_COMPAT, 'UTF-8') : 'images/sprite.svg#placeholder'; ?>" alt="<?php echo $this->escape($child->title); ?>" itemprop="thumbnailUrl"<?php if (empty($params->image)) {echo ' data-uk-svg';} ?>>
                                    </div>
                                </div>
                            </div>
                            <div class="titleWrapper uk-overlay uk-overlay-primary uk-position-bottom uk-position-z-index">
                                <h3 itemprop="name" class="uk-margin-remove font"><?php echo $this->escape($child->title); ?></h3>
                            </div>
                            <div class="uk-transition-fade uk-position-cover uk-overlay uk-overlay-primary uk-flex uk-flex-center uk-flex-middle"><i class="fas fa-link fa-2x"></i></div>
                        </a>
                    </div>
                </div>
            </div>

            <?php endif; ?>
        <?php endif; ?>
	<?php endforeach; ?>
<?php endif; ?>