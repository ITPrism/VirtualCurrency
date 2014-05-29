<?php
/**
 * @package      VirtualCurrency
 * @subpackage   Components
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2014 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class VirtualCurrencyViewImport extends JViewLegacy
{
    /**
     * @var JDocumentHtml
     */
    public $document;

    /**
     * @var Joomla\Registry\Registry
     */
    protected $state;

    protected $form;

    protected $legend;

    protected $option;

    public function __construct($config)
    {
        parent::__construct($config);
        $this->option = JFactory::getApplication()->input->get("option");
    }

    /**
     * Display the view
     */
    public function display($tpl = null)
    {
        $this->state = $this->get('State');
        $this->form  = $this->get('Form');

        // Add submenu
        VirtualCurrencyHelper::addSubmenu("realcurrencies");

        // Prepare actions
        $this->addToolbar();
        $this->setDocument();

        parent::display($tpl);
    }

    /**
     * Add the page title and toolbar.
     *
     * @since   1.6
     */
    protected function addToolbar()
    {
        // Set toolbar items for the page
        JToolbarHelper::title(JText::_('COM_VIRTUALCURRENCY_IMPORT_MANAGER'));

        // Upload
        JToolbarHelper::custom("import.realCurrencies", "upload", "", JText::_("COM_VIRTUALCURRENCY_UPLOAD"), false);

        JToolbarHelper::divider();
        JToolbarHelper::cancel('import.cancel', 'JTOOLBAR_CANCEL');
    }

    /**
     * Method to set up the document properties
     *
     * @return void
     */
    protected function setDocument()
    {
        $this->document->setTitle(JText::_('COM_VIRTUALCURRENCY_IMPORT_MANAGER'));

        $this->legend     = JText::_("COM_VIRTUALCURRENCY_IMPORT_REAL_CURRENCY_DATA");

        // Scripts
        JHtml::_('behavior.formvalidation');

        JHtml::_('bootstrap.tooltip');
        JHtml::_('itprism.ui.bootstrap_fileuploadstyle');

        $this->document->addScript('../media/' . $this->option . '/js/admin/' . JString::strtolower($this->getName()) . '.js');
    }
}
