<?php
// $listitems is a 2D array. Use it like $listitems[$category][$faqid].

//$listitems = array();
//foreach ($faqxml -> category as $c) {
//    $listitems[trim($c.name)] = array();
//    foreach ($c -> faq as $f) {
//        $listitems[trim($c.name)][$f.id] = array(
//            "id" => trim($f.sid),
//            "q" => trim($f.q),
//            "a" => trim($f.a)
//        );
//    }
//}
//unset($faqxml);
//var_dump($listitems);

$faqxml = simplexml_load_file(dirname(__FILE__) . "/../data/faq_list.xml");
