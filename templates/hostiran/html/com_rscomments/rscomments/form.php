<?php
/**
* @package RSComments!
* @copyright (C) 2015 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-2.0.html
*/

defined('_JEXEC') or die('Restricted access'); 
$clength	= (int) $this->config->max_comm_len;
$icons		= RSCommentsHelper::showIcons($this->permissions); 
$emoticons	= RSCommentsEmoticons::createEmoticons();
$upload		= (int) $this->config->enable_upload;
$required	= $this->config->anonymous ? '' : ' *'; ?>

<hr class="uk-divider-icon uk-margin-medium">
<?php /* ?><div class="title uk-margin-medium-bottom"><h3 class="uk-margin-remove uk-text-center font"><?php echo JTEXT::_('TPL_RSCOMMENTS_WHTAS_YOUR_COMMENT'); ?></h3></div><?php */ ?>
<div class="rscomment-form well<?php if (isset($this->config->comment_form_position) && $this->config->comment_form_position) { ?> rscomment-form-top<?php } ?>">
	<form action="javascript:void(0)" data-rsc-task="form" class="simpleForm">

		<div class="rscomments-form-message alert" style="display: none;"></div>

            <div class="uk-grid-medium uk-grid-match" data-uk-grid>
                <div class="uk-width-1-1 uk-width-1-3@m">
                    <?php if ($this->config->enable_name_field == 1 || $this->config->enable_email_field == 1 || !$this->config->anonymous) { ?>
                        <div class="row-fluid uk-child-width-1-1 uk-grid-small" data-uk-grid>
                            <?php if ($this->config->enable_name_field == 1 || !$this->config->anonymous) { ?>
                                <div class="control-group span6">
                                    <?php if ($this->config->show_labels) { ?>
                                        <label for="rsc_name<?php echo $this->hash; ?>"><?php echo JText::_('TPL_RSCOMMENTS_COMMENT_NAME').$required; ?></label>
                                    <?php } ?>
                                    <div class="controls">
                                        <input <?php echo $this->disable; ?> type="text" class="span11 required uk-input uk-border-rounded font uk-width-1-1" id="rsc_name<?php echo $this->hash; ?>" name="jform[name]" value="<?php echo $this->user->get('name'); ?>" size="45" <?php if (!$this->config->show_labels) { ?>placeholder="<?php echo JText::_('TPL_RSCOMMENTS_COMMENT_NAME').$required; ?>"<?php } ?> />
                                    </div>
                                </div>
                            <?php } ?>

                            <?php if ($this->config->enable_email_field == 1 || !$this->config->anonymous) { ?>
                                <div class="control-group span6">
                                    <?php if ($this->config->show_labels) { ?>
                                        <label for="rsc_email<?php echo $this->hash; ?>"><?php echo JText::_('TPL_RSCOMMENTS_COMMENT_EMAIL').$required; ?></label>
                                    <?php } ?>
                                    <div class="controls">
                                        <input <?php echo $this->disable; ?> type="email" class="span11 required uk-input uk-border-rounded font uk-width-1-1" id="rsc_email<?php echo $this->hash; ?>" name="jform[email]" value="<?php echo $this->user->get('email'); ?>" size="45" <?php if (!$this->config->show_labels) { ?>placeholder="<?php echo JText::_('TPL_RSCOMMENTS_COMMENT_EMAIL').$required; ?>"<?php } ?> />
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="uk-width-1-1 uk-width-expand@m">
                    <div class="row-fluid">
                        <?php if ($this->config->show_counter == 1) { ?>
                            <div class="control-group pull-right">
                                <p class="char-left muted"><span class="comment_length"><?php echo $clength; ?></span> <?php echo JText::_('TPL_RSCOMMENTS_CHARS_LEFT'); ?></p>
                            </div>
                        <?php } ?>
                        <label for="rsc_email<?php echo $this->hash; ?>"><?php echo JText::_('TPL_RSCOMMENTS_COMMENT_MESSAGE').$required; ?></label>
                        <div class="rscomments-comment-area control-group">
                            <div class="controls">
                                <textarea data-rsc-task="commentform" class="input-block-level required uk-textarea uk-border-rounded font" name="jform[comment]" rows="5" maxlength="<?php echo $clength; ?>"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-width-1-1">
                    <div>
                        <div data-uk-grid>
                            <?php if (isset($this->permissions['captcha']) && $this->permissions['captcha']) { ?>
                                <div class="row-fluid uk-width-auto">
                                    <div class="control-group">
                                        <div class="controls rsc-captcha-container">
                                            <?php if ($this->config->captcha == 0) { ?>
                                                <img src="<?php echo RSCommentsHelper::route('index.php?option=com_rscomments&task=captcha&type=form'.$this->hash.'&sid='.uniqid('')); ?>" alt="" height="80" />
                                                <span class="<?php echo RSTooltip::tooltipClass(); ?>" title="<?php echo RSTooltip::tooltipText(JText::_('TPL_RSCOMMENTS_REFRESH_CAPTCHA_DESC')); ?>">
                                                    <a class="rscomments-refresh-captcha" style="border-style: none" href="javascript:void(0)" onclick="RSComments.captcha(this, '<?php echo $this->root.RSCommentsHelper::route('index.php?option=com_rscomments&task=captcha&type=form'.$this->hash); ?>');">
                                                        <i class="fas fa-home"></i>
                                                    </a>
                                                </span> <br />
                                                <input type="text" name="jform[captcha]" size="40" value="" class="span5 <?php echo RSTooltip::tooltipClass(); ?> required" title="<?php echo RSTooltip::tooltipText($this->config->captcha_cases ? JText::_('TPL_RSCOMMENTS_CAPTCHA_CASE_SENSITIVE') : JText::_('TPL_RSCOMMENTS_CAPTCHA_CASE_INSENSITIVE')); ?>" />
                                            <?php } else { ?>
                                                <div id="rsc-g-recaptcha-<?php echo $this->hash; ?>"></div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="row-fluid uk-width-expand uk-text-left">
                                <span class="rsc_loading_form" style="display:none;">
                                    <?php echo JHtml::image('com_rscomments/loader.gif', '', array(), true); ?>
                                </span>
                                <?php /* ?>
                                <button type="button" class="uk-button uk-button-default uk-box-shadow-small uk-border-rounded font" data-rsc-task="reset"><?php echo JText::_('TPL_RSCOMMENTS_RESET'); ?></button>
                                <?php */ ?>
                                <button type="button" class="btn rsc_cancel_btn uk-button uk-button-default uk-box-shadow-small uk-border-rounded font" style="display:none;"><?php echo JText::_('TPL_RSCOMMENTS_CANCEL'); ?></button>
                                <button type="button" class="uk-button uk-button-positive uk-box-shadow-small uk-border-rounded font" data-rsc-task="validate" data-rsc-upload="<?php echo $upload; ?>" data-rsc-captcha="<?php echo RSCommentsHelper::route('index.php?option=com_rscomments&task=captcha'); ?>"><?php echo JText::_('TPL_RSCOMMENTS_SEND'); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		
		<?php /* if ($this->config->enable_title_field == 1 || $this->config->enable_website_field == 1) { ?>
		<div class="row-fluid">
			<?php if ($this->config->enable_title_field == 1) { ?>
			<div class="control-group span6">
				<?php if ($this->config->show_labels) { ?>
				<label class="control-label <?php echo RSTooltip::tooltipClass(); ?>" for="rsc_subject<?php echo $this->hash; ?>" title="<?php echo RSTooltip::tooltipText(JText::_('COM_RSCOMMENTS_COMMENT_SUBJECT_DESC')); ?>">
					<?php echo JText::_('COM_RSCOMMENTS_COMMENT_SUBJECT'); ?>
				</label>
				<?php } ?>
				<div class="controls">
					<input type="text" class="span11" id="rsc_subject<?php echo $this->hash; ?>" name="jform[subject]" value="" size="45" <?php if (!$this->config->show_labels) { ?>placeholder="<?php echo JText::_('COM_RSCOMMENTS_COMMENT_SUBJECT'); ?>"<?php } ?> />
				</div>
			</div>
			<?php } ?>
			
			<?php if ($this->config->enable_website_field == 1) { ?>
			<div class="control-group span6">
				<?php if ($this->config->show_labels) { ?>
				<label class="control-label <?php echo RSTooltip::tooltipClass(); ?>" for="rsc_website<?php echo $this->hash; ?>" title="<?php echo RSTooltip::tooltipText(JText::_('COM_RSCOMMENTS_COMMENT_WEBSITE_DESC')); ?>">
					<?php echo JText::_('COM_RSCOMMENTS_COMMENT_WEBSITE'); ?>
				</label>
				<?php } ?>
				<div class="controls">
					<input type="text" class="span11" id="rsc_website<?php echo $this->hash; ?>" name="jform[website]" value="" size="45" <?php if (!$this->config->show_labels) { ?>placeholder="<?php echo JText::_('COM_RSCOMMENTS_COMMENT_WEBSITE'); ?>"<?php } ?> />
				</div>
			</div>
			<?php } ?>
		</div>
		<?php } ?>
		
		<?php if ($this->config->enable_location) { ?>
		<div class="row-fluid">
			<div class="control-group rsc_location_container">
				<?php if ($this->config->show_labels) { ?>
				<label class="control-label <?php echo RSTooltip::tooltipClass(); ?>" for="rsc_location<?php echo $this->hash; ?>" title="<?php echo RSTooltip::tooltipText(JText::_('COM_RSCOMMENTS_COMMENT_LOCATION_DESC')); ?>">
					<?php echo JText::_('COM_RSCOMMENTS_COMMENT_LOCATION'); ?>
				</label>
				<?php } ?>
				<a data-rsc-task="detectaddress" href="javascript:void(0)" class="badge badge-info rsc_detect hidden-phone"><?php echo JText::_('COM_RSCOMMENTS_COMMENT_DETECT_LOCATION'); ?></a>
				<input data-rsc-task="searchaddress" type="text" class="span12" id="rsc_location<?php echo $this->hash; ?>" name="jform[location]" value="" size="45" <?php if (!$this->config->show_labels) { ?>placeholder="<?php echo JText::_('COM_RSCOMMENTS_COMMENT_LOCATION'); ?>"<?php } ?> />
			</div>
		</div>
		<?php } */ ?>
		
		<div class="row-fluid">
			<?php if (!empty($icons) || !empty($emoticons)) { ?>
			<div class="control-group span12">
				<div class="rscomm-editor-buttons">
					<div class="btn-toolbar">						
					<?php 
					if (!empty($icons)) {
						if ($iconchunks = array_chunk($icons,4)) {
							foreach ($iconchunks as $iconchunk) {
								echo '<div class="btn-group">';
								foreach ($iconchunk as $i => $icon) {
									echo $icon."\n";
								}
								echo '</div>';
							}
						}
					}
					?>
					</div>
					
					<?php if ($this->config->enable_smiles == 1 && !empty($emoticons)) { ?>
					<div class="btn-toolbar rsc_emoticons" style="display: none;">
					<?php 
					if ($emoticonschuncks = array_chunk($emoticons,4)) {
						foreach ($emoticonschuncks as $emoticonschunck) {
							echo '<div class="btn-group">';
							foreach ($emoticonschunck as $emoticon) { 
								echo $emoticon."\n";
							}
							echo '</div>';
						}
					}
					?>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php } ?>
		</div>
		
		<?php /* if ($this->config->enable_upload) { ?>
		<iframe src="<?php echo RSCommentsHelper::route('index.php?option=com_rscomments&task=upload&tmpl=component'); ?>" name="rsc_frame" frameborder="0" scrolling="no" width="90%" height="40"></iframe>
		<?php } */ ?>
		
		<?php /* if (($this->config->show_subcription_checkbox && !$this->permissions['auto_subscribe_thread']) || $this->config->terms) { ?>
		<div class="row-fluid">
			
			<?php if ($this->config->enable_email_field == 1 || !$this->config->anonymous) { ?>
			<?php if ($this->config->show_subcription_checkbox && !$this->permissions['auto_subscribe_thread']) { ?>
			<div class="control-group span3">
				<div class="controls">
					<label class="checkbox <?php echo RSTooltip::tooltipClass(); ?>" title="<?php echo RSTooltip::tooltipText(JText::_('COM_RSCOMMENTS_SUBSCRIBE_DESC')); ?>">
						<input type="checkbox" data-rsc-task="subscribethread" class="rsc_chk rsc_subscribe_thread" name="jform[subscribe_thread]" value="1" /> <?php echo JText::_('COM_RSCOMMENTS_SUBSCRIBE'); ?>
					</label>
				</div>
			</div>
			<?php } ?>
			<?php } ?>
			
			<?php if ($this->config->terms) { ?>
			<div class="control-group span9 rsc-terms-container">
				<div class="controls">
					<label class="checkbox">
						<input type="checkbox" class="rsc_chk rsc_terms required" name="jform[rsc_terms]" value="1" /> 
						<a href="javascript:void(0)" data-rsc-task="terms">
							<?php echo JText::_('COM_RSCOMMENTS_TERMS'); ?>
						</a>
					</label>
				</div>
			</div>
			<?php } ?>
		</div>
		<?php } */ ?>
		
		<?php /* if ($this->config->consent) { ?>
		<div class="row-fluid">
			<div class="control-group span9">
				<div class="controls">
					<label class="checkbox">
						<input type="checkbox" class="rsc_chk rsc_consent required" name="jform[rsc_consent]" value="1" /> 
						<?php echo JText::_('COM_RSCOMMENTS_CONSENT'); ?>
					</label>
				</div>
			</div>
		</div>
		<?php } */ ?>

		
		<input type="hidden" name="jform[IdParent]" value="0" />
		<input type="hidden" name="jform[obj_option]" value="<?php echo $this->theoption; ?>" />
		<input type="hidden" name="jform[url]" value="<?php echo RSCommentsHelper::getUrl(); ?>" />
		<input type="hidden" name="jform[obj_id]" value="<?php echo $this->id; ?>" />
		<input type="hidden" name="jform[IdComment]" value="" />
		<input type="hidden" name="jform[override]" value="<?php echo (int) $this->override; ?>" />
		<input type="hidden" name="jform[coordinates]" value="" />
	</form>
</div>