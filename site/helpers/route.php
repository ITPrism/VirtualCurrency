<?php
/**
 * @package      Virtual Currency
 * @subpackage   Components
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2014 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.helper');

// Load router
if (!class_exists("VirtualCurrencyHelperRoute")) {
    JLoader::register("VirtualCurrencyHelperRoute", JPATH_SITE . DIRECTORY_SEPARATOR . "components" . DIRECTORY_SEPARATOR . "com_virtualcurrency" . DIRECTORY_SEPARATOR . "helpers" . DIRECTORY_SEPARATOR . "route.php");
}

/**
 * Component Route Helper that help to find a menu item.
 * IMPORTANT: It help us to find right MENU ITEM.
 *
 * Use router ...BuildRoute to build a link
 *
 * @static
 * @package        Virtual Currency
 * @subpackage     Components
 * @since          1.5
 */
abstract class VirtualCurrencyHelperRoute
{
    protected static $lookup;

    /**
     * This method routes ordering.
     */
    public static function getOrderingRoute()
    {
        /**
         *
         * # category
         * We will check for view category first. If find a menu item with view "category" and "id" eqallity of the key,
         * we will get that menu item ( Itemid ).
         *
         * # categories view
         * If miss a menu item with view "category" we continue with searchin but now for view "categories".
         * It is assumed view "categories" will be in the first level of the menu.
         * The view "categories" won't contain category ID so it has to contain 0 for ID key.
         */
        $needles = array(
            'ordering' => array(0),
        );

        //Create the link
        $link = 'index.php?option=com_virtualcurrency&view=ordering';

        // Looking for menu item (Itemid)
        if ($item = self::findItem($needles)) {
            $link .= '&Itemid=' . $item;
        } elseif ($item = self::findItem()) { // Get the menu item (Itemid) from the active (current) item.
            $link .= '&Itemid=' . $item;
        }

        return $link;
    }

    /**
     * @param    string $layout
     *
     * @return string
     */
    public static function getPaymentRoute($layout = "default")
    {
        $needles = array(
            'payment' => array(0)
        );

        //Create the link
        $link = 'index.php?option=com_virtualcurrency&view=payment';

        if (!is_null($layout)) {
            $link .= '&layout=' . $layout;
        }

        // Looking for menu item (Itemid)
        if ($item = self::findItem($needles)) {
            $link .= '&Itemid=' . $item;
        } elseif ($item = self::findItem()) { // Get the menu item (Itemid) from the active (current) item.
            $link .= '&Itemid=' . $item;
        }

        return $link;
    }

    /**
     *
     * @return string
     */
    public static function getAccountsRoute()
    {
        $needles = array(
            'accounts' => array(0)
        );

        //Create the link
        $link = 'index.php?option=com_virtualcurrency&view=accounts';

        // Looking for menu item (Itemid)
        if ($item = self::findItem($needles)) {
            $link .= '&Itemid=' . $item;
        } elseif ($item = self::findItem()) { // Get the menu item (Itemid) from the active (current) item.
            $link .= '&Itemid=' . $item;
        }

        return $link;
    }

    protected static function findItem($needles = null)
    {
        $app   = JFactory::getApplication();
        $menus = $app->getMenu('site');

        // Prepare the reverse lookup array.
        // Collect all menu items and creat an array that contains
        // the ID from the query string of the menu item as a key,
        // and the menu item id (Itemid) as a value
        // Example:
        // array( "category" =>
        //     1(id) => 100 (Itemid),
        //     2(id) => 101 (Itemid)
        // );
        if (self::$lookup === null) {
            self::$lookup = array();

            $component = JComponentHelper::getComponent('com_virtualcurrency');
            $items     = $menus->getItems('component_id', $component->id);

            if ($items) {
                foreach ($items as $item) {
                    if (isset($item->query) && isset($item->query['view'])) {
                        $view = $item->query['view'];

                        if (!isset(self::$lookup[$view])) {
                            self::$lookup[$view] = array();
                        }

                        if (isset($item->query['id'])) {
                            self::$lookup[$view][$item->query['id']] = $item->id;
                        } else { // If it is a root element that have no a request parameter ID ( categories, authors ), we set 0 for an key
                            self::$lookup[$view][0] = $item->id;
                        }
                    }
                }
            }
        }

        if ($needles) {

            foreach ($needles as $view => $ids) {
                if (isset(self::$lookup[$view])) {

                    foreach ($ids as $id) {
                        if (isset(self::$lookup[$view][(int)$id])) {
                            return self::$lookup[$view][(int)$id];
                        }
                    }

                }
            }

        } else {
            $active = $menus->getActive();
            if ($active) {
                return $active->id;
            }
        }

        return null;
    }

}
