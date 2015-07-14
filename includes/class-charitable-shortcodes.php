<?php
/**
 * Class responsible for registering the shortcodes that are part of Charitable.
 *
 * @package     Charitable/Classes/Charitable_Shortcodes
 * @version     1.0.0
 * @author      Eric Daams
 * @copyright   Copyright (c) 2014, Studio 164a
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License  
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Charitable_Shortcodes' ) ) : 

/**
 * Charitable_Shortcodes
 *
 * @since       1.0.0
 */
class Charitable_Shortcodes extends Charitable_Start_Object  {

    /**
     * Set up the class. 
     * 
     * Note that the only way to instantiate an object is with the charitable_start method, 
     * which can only be called during the start phase. In other words, don't try 
     * to instantiate this object. 
     *
     * @access  protected
     * @since   1.0.0
     */
    protected function __construct() {
        $this->load_shortcode_classes();
        $this->register_shortcodes();
    }

    /**
     * Include shortcodes files. 
     *
     * @return  void
     * @access  private
     * @since   1.0.0
     */
    private function load_shortcode_classes() {
        require_once( charitable()->get_path( 'includes' ) . 'shortcodes/class-charitable-campaigns-shortcode.php' );
    }

    /**
     * Set up hooks and filters. 
     *
     * @return  void
     * @access  private
     * @since   1.0.0
     */
    private function register_shortcodes() {
        add_shortcode( 'campaigns', array( 'Charitable_Campaigns_Shortcode', 'display' ) );
    }
}

endif; // End class_exists check