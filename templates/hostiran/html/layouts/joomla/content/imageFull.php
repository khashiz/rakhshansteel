<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;
$params = $displayData->params;
?>
<?php $images = json_decode($displayData->images); ?>
<?php if (!empty($images->image_fulltext)) : ?>
	<?php $imgfloat = empty($images->float_fulltext) ? $params->get('float_fulltext') : $images->float_fulltext; ?>
    <div>
        <section class="articleSection articleSectionImage">
            <div class="uk-container uk-container-small">
                <div class="uk-border-rounded uk-overflow-hidden uk-box-shadow-small">
                    <img <?php if ($images->image_fulltext_caption) : echo 'class="caption"' . ' title="' . htmlspecialchars($images->image_fulltext_caption) . '"'; endif; ?> src="<?php echo htmlspecialchars($images->image_fulltext); ?>" alt="<?php echo htmlspecialchars($images->image_fulltext_alt); ?>" itemprop="image"/>
                </div>
            </div>
        </section>
    </div>
<?php endif; ?>