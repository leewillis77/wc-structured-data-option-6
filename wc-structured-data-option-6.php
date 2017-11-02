<?php

/**
 * Plugin Name: WooCommerce Variation Structured Data - Option 6
 * Plugin URI: https://github.com/woocommerce/woocommerce/issues/17471
 * Description: Implements alternative structured data for variations as per the discussions on https://github.com/woocommerce/woocommerce/issues/17471.
 * Author: Lee Willis
 * Version: 0.1
 * WC requires at least: 3.2.0
 * WC tested up to: 3.2.0
 * Author URI: http://www.leewillis.co.uk/
 * License: GPLv3
 */

add_filter( 'woocommerce_structured_data_product', function( $markup, $product ) {
	if ( ! $product->is_type( 'variable' ) ) {
		return $markup;
	}
	// Get the structured data instance so we can add another product element.
	$wc =  WC();
	$sd = $wc->structured_data;

	// See if we've pre-selected a specific variation with query arguments.
	$data_store   = WC_Data_Store::load( 'product' );
	$variation_id = $data_store->find_matching_product_variation( $product, wp_unslash( $_GET ) );
	$variation    = $variation_id ? wc_get_product( $variation_id ) : false;
	if ( ! empty( $variation ) ) {
		// Use the existing product as the starting point.
		$variation_product = $markup;
		$variation_product['@id'] = $variation->get_permalink();
		$variation_product['sku'] = $variation->get_sku();
		unset( $variation_product['offers'][0]['lowPrice'] );
		unset( $variation_product['offers'][0]['highPrice'] );
		$variation_product['offers'][0]['@type'] = 'Offer';
		$variation_product['offers'][0]['price'] = wc_format_decimal( $variation->get_price(), wc_get_price_decimals() );
		$variation_product['offers'][0]['url'] = $variation->get_permalink();
		$sd->set_data( apply_filters( 'woocommerce_structured_data_product_offer', $variation_product, $product ) );
	}
	return $markup;
}, 99, 2);