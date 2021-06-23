<?php
/**
* @package RSFiles!
* @copyright (C) 2010-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/
defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
    <div>
        <div class="rsfiles-layout">
            <?php if (!empty($this->items)) { ?>
                <?php foreach ($this->items as $i => $item) { ?>
                    <?php $canDownload = rsfilesHelper::permissions('CanDownload',$item->fullpath); ?>
                    <?php if (!empty($item->DownloadLimit) && $item->Downloads >= $item->DownloadLimit) $canDownload = false; ?>
                    <div>
                        <div class="uk-box-shadow-small uk-border-rounded uk-padding-small uk-text-center">
                            <div></div>
                            <i class="uk-margin-small-top uk-margin-small-bottom uk-display-block rsfiles-file-icon <?php echo $item->icon; ?>"></i>
                            <?php if ($item->isnew) { ?>
                                <span class="badge badge-info"><?php echo JText::_('COM_RSFILES_NEW'); ?></span>
                            <?php } ?>

                            <?php if ($item->popular) { ?>
                                <span class="badge badge-success"><?php echo JText::_('COM_RSFILES_POPULAR'); ?></span>
                            <?php } ?>
                            <div class="uk-text-muted uk-text-meta uk-hidden">
                                <?php if ($this->params->get('date')) { ?>

                                    <?php if ($item->type != 'folder') echo $item->dateadded; ?>

                                <?php } ?>
                            </div>
                            <?php // echo $item->downloads; ?>
                            <div>
                                <?php if ($item->type != 'folder') { ?>
                                <?php $download = rsfilesHelper::downloadlink($item,$item->fullpath); ?>
                                <?php if ($canDownload && $this->config->direct_download) { ?>
                                <?php if ($download->ismodal) { ?>
                                <a class="font uk-text-bold uk-text-small uk-link-reset rsfiles-file" href="javascript:void(0)" onclick="rsfiles_show_modal('<?php echo $download->dlink; ?>', '<?php echo JText::_('COM_RSFILES_DOWNLOAD'); ?>', 600)">
                                    <?php } else { ?>
                                    <a class="font uk-text-bold uk-text-small uk-link-reset rsfiles-file" href="<?php echo $download->dlink; ?>">
                                        <?php } ?>
                                        <?php } else { ?>
                                        <a href="<?php echo JRoute::_('index.php?option=com_rsfiles&layout=download&path='.rsfilesHelper::encode($item->fullpath).$this->itemid); ?>" class="rsfiles-file">
                                            <?php } ?>
                                            <?php echo (!empty($item->filename) ? $item->filename : $item->name); ?>
                                        </a>
                                        <?php if ($this->params->get('version') && !empty($item->fileversion)) { ?><span class="badge " title="<?php echo rsfilesHelper::tooltipText(JText::_('COM_RSFILES_FILE_VERSION')); ?>"><i class="fa fa-code-branch"></i> <?php echo $item->fileversion; ?></span><?php } ?>
                                        <?php if ($this->params->get('license') && !empty($item->filelicense)) { ?><span class="badge  badge-license" title="<?php echo rsfilesHelper::tooltipText(JText::_('COM_RSFILES_FILE_LICENSE')); ?>"><i class="fa fa-flag"></i> <?php echo $item->filelicense; ?></span><?php } ?>
                                        <?php if ($this->params->get('size') && !empty($item->size)) { ?><span class="badge " title="<?php echo rsfilesHelper::tooltipText(JText::_('COM_RSFILES_FILE_SIZE')); ?>"><i class="fa fa-file"></i> <?php echo $item->size; ?></span><?php } ?>
                                        <?php } else { ?>
                                            <a href="<?php echo JRoute::_('index.php?option=com_rsfiles&folder='.rsfilesHelper::encode($item->fullpath).$this->itemid); ?>">
                                                <i class="rsfiles-file-icon fa fa-folder"></i> <?php echo (!empty($item->filename) ? $item->filename : $item->name); ?>
                                            </a>
                                        <?php } ?>
                            </div>
                        </div>
                    </div>





                    <div class="uk-hidden row<?php echo $i % 2; ?>">
                        <td>



                            <?php if ($item->type != 'folder') { ?>
                            <?php if ($canDownload && $this->config->direct_download) { ?>
                            <?php if ($download->ismodal) { ?>
                            <a href="javascript:void(0)" onclick="rsfiles_show_modal('<?php echo $download->dlink; ?>', '<?php echo JText::_('COM_RSFILES_DOWNLOAD'); ?>', 600);">
                                <?php } else { ?>
                                <a href="<?php echo $download->dlink; ?>">
                                    <?php } ?>
                                    <?php } else { ?>
                                    <a href="<?php echo JRoute::_('index.php?option=com_rsfiles&layout=download&path='.rsfilesHelper::encode($item->fullpath).$this->itemid); ?>" class="" title="<?php echo rsfilesHelper::tooltipText(JText::_('COM_RSFILES_DOWNLOAD')); ?>">
                                        <?php } ?>
                                        <i class="fa fa-download fa-fw"></i>
                                    </a>

                                    <?php if ($this->config->show_details) { ?>
                                        <a href="<?php echo JRoute::_('index.php?option=com_rsfiles&layout=details&path='.rsfilesHelper::encode($item->fullpath).$this->itemid); ?>" class="" title="<?php echo rsfilesHelper::tooltipText(JText::_('COM_RSFILES_DETAILS')); ?>">
                                            <i class="fa fa-list fa-fw"></i>
                                        </a>
                                    <?php } ?>

                                    <?php if ($canDownload) { ?>
                                        <?php $properties	= rsfilesHelper::previewProperties($item->id, $item->fullpath); ?>
                                        <?php $extension	= $properties['extension']; ?>
                                        <?php $size			= $properties['size']; ?>

                                        <?php if (in_array($extension, rsfilesHelper::previewExtensions()) && $item->show_preview) { ?>
                                            <a href="javascript:void(0)" onclick="rsfiles_show_modal('<?php echo JRoute::_('index.php?option=com_rsfiles&layout=preview&tmpl=component&path='.rsfilesHelper::encode($item->fullpath).$this->itemid); ?>', '<?php echo JText::_('COM_RSFILES_PREVIEW'); ?>', <?php echo $size['height']; ?>, '<?php echo $properties['handler']; ?>');" class="" title="<?php echo rsfilesHelper::tooltipText(JText::_('COM_RSFILES_PREVIEW')); ?>">
                                                <i class="fa fa-search fa-fw"></i>
                                            </a>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php } ?>

                    </div>







                <?php } ?>
            <?php } ?>
        </div>
    </div>

<?php /* if ($this->config->modal == 1) echo JHtml::_('bootstrap.renderModal', 'rsfRsfilesModal', array('title' => '', 'bodyHeight' => 70)); */ ?>