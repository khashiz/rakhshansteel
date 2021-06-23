CREATE TABLE IF NOT EXISTS `#__rsfiles_bookmarks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__rsfiles_config` (
  `IdConfig` int(11) NOT NULL AUTO_INCREMENT,
  `ConfigName` varchar(255) NOT NULL DEFAULT '',
  `ConfigValue` text NOT NULL,
  PRIMARY KEY (`IdConfig`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__rsfiles_emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL DEFAULT '',
  `lang` varchar(255) NOT NULL DEFAULT '',
  `enable` tinyint(1) NOT NULL DEFAULT '0',
  `mode` tinyint(1) NOT NULL DEFAULT '0',
  `to` varchar(255) NOT NULL DEFAULT '',
  `subject` varchar(255) NOT NULL DEFAULT '',
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__rsfiles_email_downloads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hash` varchar(32) NOT NULL DEFAULT '',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `email` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `IdFile` int(11) NOT NULL DEFAULT '0',
  `downloaded` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `IdFile` (`IdFile`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__rsfiles_files` (
  `IdFile` int(11) NOT NULL AUTO_INCREMENT,
  `FileName` varchar(255) NOT NULL DEFAULT '',
  `DownloadName` varchar(255) NOT NULL DEFAULT '',
  `FilePath` varchar(255) NOT NULL DEFAULT '',
  `briefcase` tinyint(1) NOT NULL DEFAULT '0',
  `FileSize` varchar(255) NOT NULL DEFAULT '',
  `FileVersion` varchar(255) NOT NULL DEFAULT '',
  `FileStatistics` int(2) NOT NULL DEFAULT '0',
  `FileDescription` text NOT NULL,
  `DateAdded` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ModifiedDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `IdLicense` int(11) NOT NULL DEFAULT '0',
  `IdUser` int(3) NOT NULL DEFAULT '0',
  `DownloadMethod` int(2) NOT NULL DEFAULT '0',
  `DownloadLimit` int(11) NOT NULL DEFAULT '0',
  `Downloads` int(11) NOT NULL DEFAULT '0',
  `FileThumb` varchar(255) NOT NULL DEFAULT '',
  `CanDownload` varchar(255) NOT NULL DEFAULT '',
  `CanView` varchar(255) NOT NULL DEFAULT '',
  `metatitle` varchar(255) NOT NULL DEFAULT '',
  `metadescription` text NOT NULL,
  `metakeywords` text NOT NULL,
  `hash` varchar(255) NOT NULL DEFAULT '',
  `hits` int(15) NOT NULL DEFAULT '0',
  `published` int(2) NOT NULL DEFAULT '1',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `FileType` tinyint(1) NOT NULL DEFAULT '0',
  `FileParent` text NOT NULL,
  `ScreenshotsTags` varchar(255) NOT NULL DEFAULT '',
  `CanCreate` varchar(225) NOT NULL DEFAULT '',
  `CanUpload` varchar(225) NOT NULL DEFAULT '',
  `CanDelete` varchar(225) NOT NULL DEFAULT '',
  `CanEdit` varchar(255) NOT NULL DEFAULT '',
  `preview` varchar(255) NOT NULL DEFAULT '',
  `show_preview` tinyint(2) NOT NULL DEFAULT '0',
  `poster` varchar(255) NOT NULL DEFAULT '',
  `icon` varchar(10) NOT NULL DEFAULT '',
  PRIMARY KEY (`IdFile`),
  UNIQUE KEY `FilePath` (`FilePath`,`briefcase`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__rsfiles_groups` (
  `IdGroup` int(3) NOT NULL AUTO_INCREMENT,
  `GroupName` varchar(255) NOT NULL DEFAULT '',
  `jgroups` text NOT NULL,
  `jusers` text NOT NULL,
  `CanDownloadBriefcase` tinyint(4) NOT NULL DEFAULT '0',
  `CanUploadBriefcase` tinyint(4) NOT NULL DEFAULT '0',
  `CanDeleteBriefcase` tinyint(4) NOT NULL DEFAULT '0',
  `CanMaintainBriefcase` tinyint(4) NOT NULL DEFAULT '0',
  `MaxFilesNo` int(11) NOT NULL DEFAULT '0',
  `MaxFilesSize` int(11) NOT NULL DEFAULT '0',
  `MaxFileSize` int(11) NOT NULL DEFAULT '0',
  `moderate` tinyint(2) NOT NULL DEFAULT '0',
  `editown` tinyint(2) NOT NULL DEFAULT '0',
  `deleteown` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`IdGroup`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__rsfiles_licenses` (
  `IdLicense` int(3) NOT NULL AUTO_INCREMENT,
  `LicenseName` varchar(255) NOT NULL DEFAULT '',
  `LicenseText` text NOT NULL,
  `published` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`IdLicense`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__rsfiles_mirrors` (
  `IdMirror` int(3) NOT NULL AUTO_INCREMENT,
  `IdFile` int(3) NOT NULL DEFAULT '0',
  `MirrorName` varchar(255) NOT NULL DEFAULT '',
  `MirrorURL` text NOT NULL,
  PRIMARY KEY (`IdMirror`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `#__rsfiles_reports` (
  `IdReport` int(5) NOT NULL AUTO_INCREMENT,
  `IdFile` int(5) NOT NULL DEFAULT '0',
  `ReportMessage` text NOT NULL,
  `uid` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(15) NOT NULL DEFAULT '',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`IdReport`),
  KEY `IdFile` (`IdFile`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__rsfiles_rules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `folder` varchar(255) NOT NULL DEFAULT '',
  `FileCanView` varchar(255) NOT NULL DEFAULT '',
  `FileCanDownload` varchar(255) NOT NULL DEFAULT '',
  `FileCanEdit` varchar(255) NOT NULL DEFAULT '',
  `FileCanDelete` varchar(255) NOT NULL DEFAULT '',
  `FolderCanView` varchar(255) NOT NULL DEFAULT '',
  `FolderCanCreate` varchar(255) NOT NULL DEFAULT '',
  `FolderCanUpload` varchar(255) NOT NULL DEFAULT '',
  `FolderCanDelete` varchar(255) NOT NULL DEFAULT '',
  `FileStatistics` TINYINT(2) NOT NULL DEFAULT '0',
  `IdLicense` TINYINT(2) NOT NULL DEFAULT '0',
  `DownloadMethod` TINYINT(2) NOT NULL DEFAULT '0',
  `DownloadLimit` INT NOT NULL DEFAULT '0',
  `show_preview` TINYINT(2) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__rsfiles_screenshots` (
  `IdScreenshot` int(3) NOT NULL AUTO_INCREMENT,
  `IdFile` int(3) NOT NULL DEFAULT '0',
  `Path` text NOT NULL,
  PRIMARY KEY (`IdScreenshot`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `#__rsfiles_statistics` (
  `IdStatistic` int(3) NOT NULL AUTO_INCREMENT,
  `IdFile` int(5) NOT NULL DEFAULT '0',
  `Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Ip` varchar(255) NOT NULL DEFAULT '',
  `UserId` int(5) NOT NULL DEFAULT '0',
  `referer` varchar(500) NOT NULL DEFAULT '',
  PRIMARY KEY (`IdStatistic`),
  KEY `IdFile` (`IdFile`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__rsfiles_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `created_by` int(10) NOT NULL DEFAULT '0',
  `published` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__rsfiles_tag_relation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` int(11) NOT NULL DEFAULT '0',
  `tag` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT IGNORE INTO `#__rsfiles_emails` (`id`, `type`, `lang`, `enable`, `mode`, `to`, `subject`, `message`) VALUES(1, 'admin', 'en-GB', 1, 1, '', 'Admin Email', '<p>Hello ,</p>\r\n<p>Someone has downloaded the file {filename}.</p>\r\n<p><strong>Details :</strong></p>\r\n<p>Ip: {ip}</p>\r\n<p>Username : {username}</p>');
INSERT IGNORE INTO `#__rsfiles_emails` (`id`, `type`, `lang`, `enable`, `mode`, `to`, `subject`, `message`) VALUES(2, 'download', 'en-GB', 1, 1, '', 'Download email', '<p>Hello {email},</p>\r\n<p>You can download the file from here : {downloadurl}</p>');
INSERT IGNORE INTO `#__rsfiles_emails` (`id`, `type`, `lang`, `enable`, `mode`, `to`, `subject`, `message`) VALUES(3, 'upload', 'en-GB', 1, 1, '', 'A new user has uploaded a file.', '<p>The user {username} has uploaded a new file.</p>\r\n<p>{file}</p>');
INSERT IGNORE INTO `#__rsfiles_emails` (`id`, `type`, `lang`, `enable`, `mode`, `to`, `subject`, `message`) VALUES(4, 'report', 'en-GB', 0, 1, '', 'Someone submitted a new file report.', '<p>A new report for {filename} was added. Here are the details :</p>\r\n<p>Username : {username}</p>\r\n<p>IP: {ip}</p>\r\n<p>Report: {report}</p>');


INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(1, 'download_folder', '');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(2, 'license_code', '');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(3, 'global_date', 'd/m/Y H:i:s');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(4, 'preview_files', 'jpg,txt,png,pdf,gif');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(5, 'nr_per_page', '5');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(76, 'download_description', '');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(9, 'show_pagination_position', '1');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(10, 'show_descriptions', '1');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(11, 'allowed_files', 'jpg\r\ntxt\r\npdf\r\ngif\r\npng');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(13, 'show_search', '1');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(15, 'enable_upload', '1');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(16, 'max_upl_size', '10240');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(17, 'email_from', 'from@site.com');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(18, 'email_from_name', 'From Site');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(19, 'email_reply', 'reply@site.com');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(20, 'email_reply_name', 'Reply Site');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(21, 'email_cc', 'cc@site.com');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(22, 'email_bcc', 'bcc@site.com');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(35, 'thumb_width', '200');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(41, 'file_path', '1');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(42, 'enable_rss', '1');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(49, 'show_details', '1');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(50, 'show_report', '1');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(51, 'show_bookmark', '1');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(52, 'show_email', '1');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(53, 'rsmail_integration', '0');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(54, 'rsmail_list_id', '0');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(55, 'rsmail_field_name', '');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(56, 'briefcase_folder', '');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(57, 'enable_briefcase', '1');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(59, 'show_folder_desc', '1');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(60, 'popular', '10');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(61, 'new', '5');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(62, 'captcha_enabled', '0');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(63, 'captcha_characters', '5');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(64, 'captcha_lines', '1');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(65, 'captcha_case_sensitive', '0');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(66, 'recaptcha_public_key', '');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(67, 'recaptcha_private_key', '');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(68, 'recaptcha_theme', 'white');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(69, 'show_file_size', '1');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(70, 'show_date_added', '1');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(71, 'show_date_updated', '1');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(72, 'show_license', '1');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(73, 'show_file_version', '1');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(74, 'show_number_of_downloads', '1');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(77, 'error_handling', '0');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(78, 'direct_download', '0');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(79, 'load_icons', '1');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(80, 'load_bootstrap', '1');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(81, 'remove_days', '1');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(82, 'download_cancreate', '');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(83, 'download_canupload', '');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(84, 'load_backend_jquery', '1');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(85, 'load_frontend_jquery', '1');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(86, 'recaptcha_new_site_key', '');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(87, 'recaptcha_new_secret_key', '');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(88, 'recaptcha_new_theme', 'light');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(89, 'recaptcha_new_type', 'image');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(90, 'briefcase_allowed_files', 'jpg\r\ntxt\r\npdf\r\ngif\r\npng');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(91, 'list_show_version', '1');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(92, 'list_show_license', '1');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(93, 'list_show_size', '1');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(94, 'list_show_date', '1');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(95, 'show_hits', '1');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(96, 'chunk_size', '10240');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(97, 'enable_remove_days', '0');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(98, 'list_show_downloads', '1');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(99, 'briefcase_name', '0');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(100,'modal', '1');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(101,'load_fa', '1');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(102, 'store_ip', '1');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(103, 'consent', '1');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(104, 'batch_limit', '100');
INSERT IGNORE INTO `#__rsfiles_config` (`IdConfig`, `ConfigName`, `ConfigValue`) VALUES(105, 'load_frontend_fa', '1'); 