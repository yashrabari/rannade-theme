<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
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

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

do_action( 'woocommerce_before_account_navigation' );
?>

<nav class="woocommerce-MyAccount-navigation">
    <ul class="my__account-nav nav flex-column mb-0">
        <?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
            <li class="nav-item mx-0 <?php echo esc_attr( $menu_classes = wc_get_account_menu_item_classes( $endpoint ) ); ?>">
                <a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>" class="nav-link d-flex align-items-center px-0">
                    <span class="font-weight-normal <?php if ( strpos( $menu_classes, 'is-active' ) !== false ): ?>text-primary<?php else: ?>text-gray-600<?php endif; ?>"><?php echo esc_html( $label ); ?></span>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>

<?php do_action( 'woocommerce_after_account_navigation' ); ?>
