<?php
/**
 * My Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-address.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

defined( 'ABSPATH' ) || exit;

$customer_id = get_current_user_id();

if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) {
    $get_addresses = apply_filters(
        'woocommerce_my_account_get_addresses',
        array(
            'billing'  => esc_html__( 'Billing address', 'bookworm' ),
            'shipping' => esc_html__( 'Shipping address', 'bookworm' ),
        ),
        $customer_id
    );
} else {
    $get_addresses = apply_filters(
        'woocommerce_my_account_get_addresses',
        array(
            'billing' => esc_html__( 'Billing address', 'bookworm' ),
        ),
        $customer_id
    );
}

$oldcol = 1;
$col    = 1;
?>

<p>
    <?php echo apply_filters( 'woocommerce_my_account_my_address_description', esc_html__( 'The following addresses will be used on the checkout page by default.', 'bookworm' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
</p>

<?php if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) : ?>
    <div class="u-columns woocommerce-Addresses row row-cols-1 row-cols-md-2 addresses">
<?php endif; ?>

<?php foreach ( $get_addresses as $name => $address_title ) : ?>
    <?php
        $address = wc_get_account_formatted_address( $name );
        $col     = $col * -1;
        $oldcol  = $oldcol * -1;
    ?>

    <div class="u-column col woocommerce-Address">
        <div class="mb-6 mb-md-0">
            <header class="woocommerce-Address-title title">
                <h3 class="font-weight-medium font-size-22 mb-3"><?php echo esc_html( $address_title ); ?></h3>
            </header>
            <address class="d-flex flex-column mb-4 text-gray-600">
                <?php

                    echo ! empty( $address ) ? wp_kses_post( $address ) : esc_html_e( 'You have not set up this type of address yet.', 'bookworm' );
                ?>
            </address>
            <a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', $name ) ); ?>" class="btn btn-dark width-150 rounded-0 btn-wide font-weight-medium edit"><?php echo ! empty( $address )  ? esc_html__( 'Edit', 'bookworm' ) : esc_html__( 'Add', 'bookworm' ); ?></a>
        </div>
    </div>



<?php endforeach; ?>

<?php if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) : ?>
    </div>
    <?php
endif;
