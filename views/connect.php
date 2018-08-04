<?php
/**
 * @var array $options
 * @var array $plugin
 */

define('ELFINDER_IMG_PARENT_URL', \balitrip\elfinder\Assets::getPathUrl());

// run elFinder
$connector = new elFinderConnector(new \balitrip\elfinder\elFinderApi($options, $plugin));
$connector->run();