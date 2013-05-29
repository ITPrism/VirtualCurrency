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

jimport('joomla.application.component.modeladmin');

class VirtualCurrencyModelAccount extends JModelAdmin {
    
    /**
     * @var     string  The prefix to use with controller messages.
     * @since   1.6
     */
    protected $text_prefix = 'COM_VIRTUALCURRENCY';
    
    /**
     * Returns a reference to the a Table object, always creating it.
     *
     * @param   type    The table type to instantiate
     * @param   string  A prefix for the table class name. Optional.
     * @param   array   Configuration array for model. Optional.
     * @return  JTable  A database object
     * @since   1.6
     */
    public function getTable($type = 'Account', $prefix = 'VirtualCurrencyTable', $config = array()){
        return JTable::getInstance($type, $prefix, $config);
    }
    
    /**
     * Method to get the record form.
     *
     * @param   array   $data       An optional array of data for the form to interogate.
     * @param   boolean $loadData   True if the form is to load its own data (default case), false if not.
     * @return  JForm   A JForm object on success, false on failure
     * @since   1.6
     */
    public function getForm($data = array(), $loadData = true){
        
        // Get the form.
        $form = $this->loadForm($this->option.'.account', 'account', array('control' => 'jform', 'load_data' => $loadData));
        if(empty($form)){
            return false;
        }
        
        return $form;
    }
    
    /**
     * Method to get the data that should be injected in the form.
     *
     * @return  mixed   The data for the form.
     * @since   1.6
     */
    protected function loadFormData(){
        // Check the session for previously entered form data.
        $data = JFactory::getApplication()->getUserState($this->option.'.edit.account.data', array());
        if(empty($data)){
            $data = $this->getItem();
        }
        
        return $data;
    }
    
    /**
     * Save data into the DB
     * 
     * @param $data   The data about item
     * @return mixed  Item ID or null
     */
    public function save($data){
        
        $id           = JArrayHelper::getValue($data, "id");
        $amount       = JArrayHelper::getValue($data, "amount");
        $currencyId   = JArrayHelper::getValue($data, "currency_id");
        $userId       = JArrayHelper::getValue($data, "user_id");
        $note         = JArrayHelper::getValue($data, "note");
        
        // Load a record from the database
        $row = $this->getTable();
        $row->load($id);
        
        $row->set("amount",         $amount);
        $row->set("currency_id",    $currencyId);
        $row->set("user_id",        $userId);
        $row->set("note",           $note);
        
        $row->store();
        
        return $row->id;
    
    }
    
    /**
     * This method checks for available account.
     * 
     * @param integer $userId
     * @param integer $currencyId
     * @return boolean
     */
    public function isExist($userId, $currencyId) {
        
        $db    = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query
            ->select("COUNT(*) AS number")
            ->from($db->quoteName("#__vc_accounts") . " AS a")
            ->where("a.user_id = " . (int)$userId)
            ->where("a.currency_id = " . (int)$currencyId);
        
        $db->setQuery($query, 0, 1);
        $result = $db->loadResult();
        
        return (!$result) ? false : true;
    }
    
}