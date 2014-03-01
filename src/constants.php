<?php
$faqxml = simplexml_load_file(dirname(__FILE__) . "/../data/faq_list.xml");
$sitexml = simplexml_load_file(dirname(__FILE__) . "/../data/site.xml");
date_default_timezone_set($sitexml->timezone);
