<?php
/**
 * Display the donations widget on the dashboard. 
 *
 * @author  Studio 164a
 * @package Charitable/Admin View/Dashboard Widgets
 * @since   1.2.0
 */

$statuses = charitable_get_valid_donation_statuses();

$donations = get_posts( array( 
    'post_type' => Charitable::DONATION_POST_TYPE,
    'posts_per_page' => 5, 
    'post_status' => array_keys( $statuses ),
    'fields' => 'ids'
) );

$table = charitable_get_table( 'campaign_donations' );

$today = $table->get_donations_summary_by_period( date( 'Y-m-d%' ) );
$this_month = $table->get_donations_summary_by_period( date( 'Y-m%' ) );
$last_month = $table->get_donations_summary_by_period( date( 'Y-m%', strtotime( '-1 month' ) ) );
$this_year = $table->get_donations_summary_by_period( date( 'Y-%' ) );

?>
<div class="charitable-donation-statistics">
    <div class="cell">
        <h3 class="amount"><?php echo charitable_format_money( $today->amount ) ?></h3>
        <p class="summary"><?php printf( _n( '%d donation %stoday%s', '%d donations %stoday%s', $today->count, 'charitable' ), $today->count, '<span class="time-period">', '</span>' ) ?></p>
    </div>
    <div class="cell">
        <h3 class="amount"><?php echo charitable_format_money( $this_month->amount ) ?></h3>
        <p class="summary"><?php printf( _n( '%d donation %sthis month%s', '%d donations %sthis month%s', $this_month->count, 'charitable' ), $this_month->count, '<span class="time-period">', '</span>' ) ?></p>
    </div>
    <div class="cell">
        <h3 class="amount"><?php echo charitable_format_money( $last_month->amount ) ?></h3>
        <p class="summary"><?php printf( _n( '%d donation %slast month%s', '%d donations %slast month%s', $last_month->count, 'charitable' ), $last_month->count, '<span class="time-period">', '</span>' ) ?></p>
    </div>
    <div class="cell">
        <h3 class="amount"><?php echo charitable_format_money( $this_year->amount ) ?></h3>
        <p class="summary"><?php printf( _n( '%d donation %sthis year%s', '%d donations %sthis year%s', $this_year->count, 'charitable' ), $this_year->count, '<span class="time-period">', '</span>' ) ?></p>
    </div>
</div>
<?php if ( count( $donations ) ) : ?>
    <div class="recent-donations">
        <table>
            <caption><h3><?php _e( 'Recent Donations', 'charitable' ) ?></h3></caption>
            <?php 
            foreach ( $donations as $donation_id ) :
                $donation = charitable_get_donation( $donation_id );
            ?>
            <tr>
                <td class="donation-date"><?php echo $donation->get_date() ?></td>
                <td class="donation-id">#<?php echo $donation->get_number() ?></td>
                <td class="donation-status"><?php echo $donation->get_status( true ) ?></td>
                <td class="donation-total"><?php echo charitable_format_money( $donation->get_total_donation_amount() ) ?></td>
            </tr>
            <?php 
            endforeach;
            ?>
        </table>
    </div>
<?php endif ?>