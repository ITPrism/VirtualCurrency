<?php
/**
 * @package      Virtual Currency
 * @subpackage   Components
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2014 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */
defined('JPATH_BASE') or die;

jimport('joomla.html.html');
jimport('joomla.form.formfield');
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');

/**
 * Form Field class for the Joomla Framework.
 *
 * @package      Virtual Currency
 * @subpackage   Fields
 * @since        1.6
 */
class JFormFieldVcCurrencies extends JFormFieldList
{
    /**
     * The form field type.
     *
     * @var     string
     * @since   1.6
     */
    protected $type = 'vccurrencies';

    /**
     * Method to get the field options.
     *
     * @return  array   The field option objects.
     * @since   1.6
     */
    protected function getOptions()
    {
        // Initialize variables.
        $options = array();

        $db    = JFactory::getDbo();
        $query = $db->getQuery(true);

        $query
            ->select('a.id AS value, CONCAT(a.title, " [", a.code, "] ") AS text')
            ->from($db->quoteName('#__vc_currencies', 'a'))
            ->order("a.title ASC");

        // Get the options.
        $db->setQuery($query);
        $options = $db->loadObjectList();

        // Merge any additional options in the XML definition.
        $options = array_merge(parent::getOptions(), $options);

        return $options;
    }
}
