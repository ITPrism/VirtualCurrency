<?php
/**
 * @package      Virtual Currency
 * @subpackage   Components
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2010 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * Virtual Currency is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

// no direct access
defined('_JEXEC') or die;
?>
<tr>
    <th width="1%" class="nowrap center hidden-phone">
        <?php echo JHtml::_('grid.checkall'); ?>
    </th>
	<th class="title" >
	     <?php echo JHtml::_('grid.sort',  'COM_VIRTUALCURRENCY_USER', 'b.name', $this->listDirn, $this->listOrder); ?>
	</th>
	<th width="10%" class="nowrap center hidden-phone">
		<?php echo JText::_("COM_VIRTUALCURRENCY_AMOUNT"); ?>
	</th>
	<th width="10%" class="nowrap center hidden-phone">
	     <?php echo JText::_("COM_VIRTUALCURRENCY_CURRENCY"); ?>
	</th>
    <th width="1%" class="nowrap center hidden-phone">
        <?php echo JHtml::_('grid.sort',  'JGRID_HEADING_ID', 'a.id', $this->listDirn, $this->listOrder); ?>
    </th>
</tr>
	  