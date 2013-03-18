<?php
/**
 * @package      ITPrism Components
 * @subpackage   Virtual Currency
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

jimport('joomla.application.component.view');

class VirtualCurrencyViewDashboard extends JView {
    
    protected $option;
    
    public function __construct($config){
        parent::__construct($config);
        $this->option = JFactory::getApplication()->input->get("option");
    }
    
    public function display($tpl = null){
        
        $this->version = new VirtualCurrencyVersion();
        
        // Add submenu
        VirtualCurrencyHelper::addSubmenu($this->getName());
        
        $this->addToolbar();
        $this->setDocument();
        
        parent::display($tpl);
    }
    
    /**
     * Add the page title and toolbar.
     *
     * @since   1.6
     */
    protected function addToolbar(){
        JToolBarHelper::title(JText::_("COM_VIRTUALCURRENCY_DASHBOARD"), 'itp-dashboard');
        
        JToolBarHelper::preferences('com_virtualcurrency');
        JToolBarHelper::divider();
        
        // Help button
        $bar = JToolBar::getInstance('toolbar');
		$bar->appendButton('Link', 'help', JText::_('JHELP'), JText::_('COM_VIRTUALCURRENCY_HELP_URL'));
    }

	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function setDocument() {
	    
		$this->document->setTitle(JText::_('COM_VIRTUALCURRENCY_DASHBOARD'));
		
		// Header styles
		$this->document->addStyleSheet('../media/'.$this->option.'/css/admin/bootstrap.min.css');
		
		// Load scripts
//		JHtml::_('behavior.modal', 'a.modal');
	}
	
}