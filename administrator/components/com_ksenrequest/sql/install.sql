CREATE TABLE IF NOT EXISTS `#__ksenrequest_files` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `owner_id` int(10) NOT NULL,
  `media_type` varchar(15) NOT NULL,
  `owner_type` varchar(256) NOT NULL,
  `folder` varchar(32) NOT NULL,
  `filename` varchar(256) NOT NULL,
  `mime_type` varchar(32) NOT NULL,
  `title` varchar(256) NOT NULL,
  `ordering` int(10) NOT NULL,
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `owner_id` (`owner_id`),
  KEY `media_type` (`media_type`),
  KEY `owner_type` (`owner_type`),
  KEY `folder` (`folder`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `#__ksenrequest_forms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `layout` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text_before` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `text_after` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `thanks_message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `thanks_mail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `thanks_modal` int(11) NOT NULL,
  `ordering` int(11) NOT NULL,
  `published` int(1) NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=23 ;

CREATE TABLE IF NOT EXISTS `#__ksenrequest_forms_steps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `hide_title` int(1) NOT NULL,
  `layout` varchar(256) NOT NULL,
  `button_text` varchar(256) NOT NULL,
  `ordering` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `#__ksenrequest_forms_steps_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `step_id` int(11) NOT NULL,
  `type` varchar(256) NOT NULL,
  `title` varchar(256) NOT NULL,
  `params` text NOT NULL,
  `class` varchar(256) NOT NULL,
  `required` int(1) NOT NULL,
  `published` int(1) NOT NULL,
  `requests_list` int(1) NOT NULL,
  `ordering` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `#__ksenrequest_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_id` int(11) NOT NULL,
  `fields` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(700) COLLATE utf8mb4_unicode_ci NOT NULL,
  `utm` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `referer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

INSERT INTO `#__ksen_widgets` (`extension`, `group`, `class`, `href`, `image`, `name`, `view`) VALUES
('com_ksenrequest', 0, 'double,main', 'index.php?option=com_ksenrequest&view=forms', 'forms.png', 'forms', 'forms'),
('com_ksenrequest', 0, 'double,main', 'index.php?option=com_ksenrequest&view=requests', 'requests.png', 'requests', 'requests');