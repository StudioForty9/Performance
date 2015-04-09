<?php

$config = Mage::app()->getConfig();

$path = 'system/fpc/miss_uri_params';
$missParms = Mage::getStoreConfig($path);
$missParms .= ',refresh_fpc=/^1$/,';

$config->saveConfig($path, $missParms, 'default', 0);
$config->reinit();