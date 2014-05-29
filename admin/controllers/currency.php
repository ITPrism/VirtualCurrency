<?php
/**
 * @package      Virtual Currency
 * @subpackage   Components
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2014 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

// No direct access
defined('_JEXEC') or die;

jimport('itprism.controller.form.backend');

/**
 * VirtualCurrency Currency controller class.
 *
 * @package        VirtualCurrency
 * @subpackage     Components
 * @since          1.6
 */
class VirtualCurrencyControllerCurrency extends ITPrismControllerFormBackend
{
    /**
     * Proxy for getModel.
     * @since   1.6
     */
    public function getModel($name = 'Currency', $prefix = 'VirtualCurrencyModel', $config = array('ignore_request' => true))
    {
        $model = parent::getModel($name, $prefix, $config);

        return $model;
    }

    /**
     * Save an item
     */
    public function save($key = null, $urlVar = null)
    {
        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        $data   = $this->input->post->get('jform', array(), 'array');
        $itemId = JArrayHelper::getValue($data, "id");

        $redirectOptions = array(
            "task" => $this->getTask(),
            "id"   => $itemId
        );

        $model = $this->getModel();
        /** @var $model VirtualCurrencyModelCurrency * */

        $form = $model->getForm($data, false);
        /** @var $form JForm * */

        if (!$form) {
            throw new Exception(JText::_("COM_VIRTUALCURRENCY_ERROR_FORM_CANNOT_BE_LOADED"), 500);
        }

        // Validate the form
        $validData = $model->validate($form, $data);

        // Check for errors.
        if ($validData === false) {
            $this->displayNotice($form->getErrors(), $redirectOptions);

            return;
        }

        try {

            $itemId = $model->save($validData);

            $redirectOptions["id"] = $itemId;

        } catch (Exception $e) {

            JLog::add($e->getMessage());
            throw new Exception(JText::_('COM_VIRTUALCURRENCY_ERROR_SYSTEM'));

        }

        $this->displayMessage(JText::_('COM_VIRTUALCURRENCY_CURRENCY_SAVED'), $redirectOptions);

    }
}
