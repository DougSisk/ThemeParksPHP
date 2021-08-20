<?php

use ThemeParks\Disney\WaltDisneyWorld\MagicKingdom;

require_once dirname(__FILE__) . '/vendor/autoload.php';

$mk = new MagicKingdom();

dd($mk->getLiveChildren());
