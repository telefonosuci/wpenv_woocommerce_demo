<?php
/**
 * Boutique_Template Class
 *
 * @author   WooThemes
 * @since    1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Boutique_Template' ) ) {
	class Boutique_Template {

		/**
		 * Setup class.
		 *
		 * @since 1.0
		 */
		public function __construct() {
			add_action( 'storefront_header',                     array( $this, 'primary_navigation_wrapper' ),       45 );
			add_action( 'storefront_header',                     array( $this, 'primary_navigation_wrapper_close' ), 65 );

			add_action( 'init',                                  array( $this, 'remove_homepage_templates' )         );
			add_action( 'wp',                                    array( $this, 'move_homepage_sections' ),           1000 );
			add_action( 'init',                                  array( $this, 'custom_storefront_markup' )          );

			add_filter( 'storefront_recent_products_args',       array( $this, 'product_columns_three' ),            99 );
			add_filter( 'storefront_popular_products_args',      array( $this, 'product_columns_three' ),            99 );
			add_filter( 'storefront_on_sale_products_args',      array( $this, 'product_columns_three' ),            99 );
			add_filter( 'storefront_best_selling_products_args', array( $this, 'product_columns_three' ),            99 );

			add_action( 'wp_enqueue_scripts', array( $this, 'netar_load_cart_js' ), 99 );
			add_action( 'init', array($this, 'netar_register_products_by_attribute_style'), 1);
		}


		public function netar_register_products_by_attribute_style(){

			// Checkout Page
			// wp_deregister_script('wc-cart');
/*
			wp_register_style(
				'wp-block-products-by-attribute',
				get_template_directory_uri() . '/assets/css/blocks/products-by-attribute.css'
			);
*/

/*
			register_block_style('woocommerce/products-by-attribute', [
				'name' => 'my-pba',
				'label' => __('My custom pba', 'netar'),
				'style' => get_template_directory_uri() . '/assets/css/blocks/products-by-attribute.css'

				'inline_style' => '.wc-block-grid__product {
					display: flex;
					flex-direction: column;
					justify-content: space-between;
				}',


			]);

			*/


			add_theme_support( 'editor-styles' );

			// Enqueues editor styles.
			add_editor_style( '/assets/css/blocks/products-by-attribute/editor.css' );
		}


		public function netar_load_cart_js(){

			// Checkout Page
			// wp_deregister_script('wc-cart');
			wp_register_script(
				'netar-custom-cart',
				get_template_directory_uri() . "/assets/js/frontend/custom-cart.js",
				array( 'jquery', 'woocommerce'),
				WC_VERSION, TRUE
			);

			wp_enqueue_script('netar-custom-cart');

		}


		/**
		 * Remove homepage sections from default location
		 * Remove the breadcrumb delimiter
		 * @param  array $defaults The breadcrumb defaults
		 * @return array           The breadcrumb defaults
		 */
		public function change_breadcrumb_delimiter( $defaults ) {
			$defaults['wrap_before'] = '<nav class="woocommerce-breadcrumb">';
			$defaults['wrap_after']  = '</nav>';
			return $defaults;
		}

		/**
		 * Custom markup tweaks
		 * @return void
		 */
		public function custom_storefront_markup() {
			global $storefront_version;

			if ( version_compare( $storefront_version, '2.3.0', '>=' ) ) {
				if ( storefront_is_woocommerce_activated() ) {
					add_filter( 'woocommerce_breadcrumb_defaults', array( $this, 'change_breadcrumb_delimiter' ), 15 );
					remove_action( 'storefront_before_content', 'woocommerce_breadcrumb', 10 );
					add_action( 'storefront_content_top', 'woocommerce_breadcrumb', 10 );
				}
			}
		}

		/**
		 * Remove homepage sections from default location
		 *
		 * @return void
		 */
		public function remove_homepage_templates() {
			remove_action( 'homepage', 'storefront_featured_products', 40 );
			remove_action( 'homepage', 'storefront_homepage_content',  10 );
		}

		/**
		 * Add homepage sections to new location
		 *
		 * @return void
		 */
		public function move_homepage_sections() {
			$homepage_content  = true;
			$homepage_featured = true;

			// Compatibility with Storefront Powerpack
			if ( class_exists( 'Storefront_Powerpack' ) ) {
				$homepage_content  = get_theme_mod( 'sp_homepage_content', true );
				$homepage_featured = get_theme_mod( 'sp_homepage_featured', true );
			}

			if ( false !== $homepage_content ) {
				add_action( 'boutique_before_homepage_content', 'storefront_homepage_content', 10 );
			}

			if ( false !== $homepage_featured ) {
				add_action( 'boutique_before_homepage_content', 'storefront_featured_products',	20 );
			}
		}

		/**
		 * Primary navigation wrapper
		 * @return void
		 */
		public function primary_navigation_wrapper() {
			echo '<section class="boutique-primary-navigation">';
		}

		/**
		 * Primary navigation wrapper close
		 * @return void
		 */
		public function primary_navigation_wrapper_close() {
			echo '</section>';
		}

		/**
		 * Return args to set product display limit and column amount to 3
		 * @param  array $args args passed to the filter
		 * @return array       the modified args
		 */
		public function product_columns_three( $args ) {
			$args['limit'] 		= 3;
			$args['columns'] 	= 3;

			return $args;
		}
	}
}

return new Boutique_Template();
