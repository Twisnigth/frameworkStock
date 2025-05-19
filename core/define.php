<?php 

define("DS", DIRECTORY_SEPARATOR);
define("CORE", dirname(__FILE__));
define("ROOT", dirname(CORE));
define("PUBLIQUE", ROOT.DS."public");

const HELPER = CORE.DS."helpers";

const SRC = ROOT.DS."src";
const CONTROLLER = SRC.DS."controllers";
const MODEL = SRC.DS."models";
const VIEW = SRC.DS."views";
const TEMPLATE = SRC.DS."templates";

