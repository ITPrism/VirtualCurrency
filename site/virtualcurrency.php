<?php
/**
 * @package      ITPrism Components
 * @subpackage   VirtualCurrency
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2010 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * VirtualCurrency is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

// No direct access.
defined('_JEXEC') or die;

jimport("virtualcurrency.init");

jimport('joomla.application.component.controller');

$controller = JControllerLegacy::getInstance('VirtualCurrency');
$controller->execute(JFactory::getApplication()->input->getCmd('task'));
$controller->redirect();