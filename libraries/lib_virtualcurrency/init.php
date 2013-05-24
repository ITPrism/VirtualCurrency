<?php
/**
* @package      ITPrism Components
* @subpackage   Virtual Currency
* @author       Todor Iliev
* @copyright    Copyright (C) 2010 Todor Iliev <todor@itprism.com>. All rights reserved.
* @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Virtual Currency is free software. This vpversion may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
*/

defined('JPATH_PLATFORM') or die;

if(!defined("VIRTUALCURRENCY_PATH_COMPONENT_ADMINISTRATOR")) {
    define("VIRTUALCURRENCY_PATH_COMPONENT_ADMINISTRATOR", JPATH_ADMINISTRATOR . DIRECTORY_SEPARATOR. "components" . DIRECTORY_SEPARATOR ."com_virtualcurrency");
}

if(!defined("VIRTUALCURRENCY_PATH_COMPONENT_SITE")) {
    define("VIRTUALCURRENCY_PATH_COMPONENT_SITE", JPATH_SITE . DIRECTORY_SEPARATOR. "components" . DIRECTORY_SEPARATOR ."com_virtualcurrency");
}

if(!defined("VIRTUALCURRENCY_PATH_LIBRARY")) {
    define("VIRTUALCURRENCY_PATH_LIBRARY", JPATH_LIBRARIES . DIRECTORY_SEPARATOR. "virtualcurrency");
}

if(!defined("ITPRISM_PATH_LIBRARY")) {
    define("ITPRISM_PATH_LIBRARY", JPATH_LIBRARIES . DIRECTORY_SEPARATOR. "itprism");
}

jimport('joomla.utilities.arrayhelper');

// Register classes and helpers
JLoader::register("VirtualCurrencyHelper",  VIRTUALCURRENCY_PATH_COMPONENT_ADMINISTRATOR . DIRECTORY_SEPARATOR . "helpers" . DIRECTORY_SEPARATOR . "virtualcurrency.php");
JLoader::register("VirtualCurrencyVersion", VIRTUALCURRENCY_PATH_LIBRARY . DIRECTORY_SEPARATOR . "version.php");

// ITPrism classes
JLoader::register("ITPrismErrors", ITPRISM_PATH_LIBRARY . DIRECTORY_SEPARATOR . "errors.php");