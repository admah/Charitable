<?php
/**
 * Class that models the donation receipt email.
 *
 * @version     1.0.0
 * @package     Charitable/Classes/Charitable_Email_Donation_Receipt
 * @author      Eric Daams
 * @copyright   Copyright (c) 2014, Studio 164a
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License  
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Charitable_Email_Donation_Receipt' ) ) : 

/**
 * Donation Receipt Email 
 *
 * @since       1.0.0
 */
class Charitable_Email_Donation_Receipt extends Charitable_Email {

    /**
     * @var     string
     */
    CONST ID = 'donation_receipt';

    /**
     * @var     string[] Array of supported object types (campaigns, donations, donors, etc).
     * @access  protected
     * @since   1.0.0
     */
    protected $object_types = array( 'donation' );

    /**
     * Instantiate the email class, defining its key values.
     *
     * @param   array   $objects
     * @access  public
     * @since   1.0.0
     */
    public function __construct( $objects = array() ) {
        parent::__construct( $objects );
        
        $this->name = apply_filters( 'charitable_email_donation_receipt_name', __( 'Donation Receipt', 'charitable' ) );        
    }

    /**
     * Return the default recipient for the email.
     *
     * @return  string
     * @access  protected
     * @since   1.0.0
     */
    protected function get_recipient() {
        if ( ! $this->has_valid_donation() ) {
            return '';
        }
        
        return $this->donation->get_donor()->user_email;
    }

    /**
     * Return the default subject line for the email.
     *
     * @return  string
     * @access  protected
     * @since   1.0.0
     */
    protected function get_default_subject() {
        return apply_filters( 'charitable_email_donation_receipt_default_subject', __( 'Thank you for your donation', 'charitable' ), $this );   
    }

    /**
     * Return the default headline for the email.
     *
     * @return  string
     * @access  protected
     * @since   1.0.0
     */
    protected function get_default_headline() {
        return apply_filters( 'charitable_email_donation_receipt_default_headline', __( 'Your Donation Receipt', 'charitable' ), $this );    
    }

    /**
     * Return the default body for the email.
     *
     * @return  string
     * @access  protected
     * @since   1.0.0
     */
    protected function get_default_body() {
        ob_start();
?>
        <p>Dear [charitable_email show=donor_first_name],</p>
        <p>Thank you so much for your generous donation.</p>
        <p>[charitable_email show=site_name]
<?php
        $body = ob_get_clean();

        return apply_filters( 'charitable_email_donation_receipt_default_body', $body, $this );
    }
}

endif; // End class_exists check