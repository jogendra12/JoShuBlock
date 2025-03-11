<?php
/**
 * Plugin Name:       Jo Shu Block
 * Plugin URI:         https://github.com/jogendra12/JoShuBlock.git
 * Description:       Gutenberg Blocks for WordPress.
 * Version:           0.1
 * Requires at least: 6.7
 * Requires PHP:      7.4
 * Author:            Jogendra Singh 
 * License: GPL-2.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       jo-shu-block
 *
 * @package JoShuBlock
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'JO_SHU_BLOCK_VERSION', '0.1' );
define( 'JO_SHU_BLOCK_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'JO_SHU_BLOCK_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'JO_SHU_BLOCK_PLUGIN_BASE', plugin_basename( __FILE__ ) );

if ( ! class_exists( 'WPBlockDev' ) ) :
	/**
	 * Main JoShuBlock class
	 *
	 * @since 1.0.0
	 */
	final class JoShuBlock {
			/**
		 * This plugin's instance.
		 *
		 * @var JoShuBlock
		 * @since 1.0.0
		 */
		private static $instance;

		/**
		* Main JoShuBlock Instance.
		*
		* Insures that only one instance of JoShuBlock exists in memory at any one
		* time. Also prevents needing to define globals all over the place.
		*
		* @since 1.0.0
		* @static
		* @return object|JoShuBlock The one true JoShuBlock
		*/
		public static function instance() {
			if (! isset( self::$instance ) && ! ( self::$instance instanceof JoShuBlock ) ) {
				self::$instance = new JoShuBlock();
				self::$instance->init();
				self::$instance->includes();
			}
			return self::$instance;
		}

		/**
		 * Load actions
		 *
		 * @return void
		 */
		private function init() {
			add_filter( 'block_categories_all', array( $this, 'register_block_categories' ), 10, 2 );
			// add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			// add_action( 'enqueue_block_editor_assets',  array( $this, 'enqueue_editor_scripts' ) );
		}

		/**
		 * Register blocks categories
		 */
		public function register_block_categories( $categories ) {
			return array_merge(
				$categories,
					array(
						array(
							'slug' => 'jo-shu-block-category',
							'title' => __( 'Jo Shu Block', 'jo-shu-block' )
						)
					)
				);
		}


		/**
		 * Include required files.
		 *
		 * @access private
		 * @since 1.0.0
		 * @return void
		 */
		private function includes() {
			require_once JO_SHU_BLOCK_PLUGIN_DIR . 'includes/class-jo-shu-block-assets.php';
			require_once JO_SHU_BLOCK_PLUGIN_DIR . 'includes/class-jo-shu-block-register-blocks.php';
		}
	}
endif;

/**
 * The main function for that returns JoShuBlock
 *
 * The main function responsible for returning the one true JoShuBlock
 * Instance to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $JoShuBlock = JoShuBlock(); ?>
 *
 * @since 1.0.0
 * @return object|JoShuBlock The one true JoShuBlock Instance.
 */
function JoShuBlock() {
	return JoShuBlock::instance();
}

// Get the plugin running. Load on plugins_loaded action to avoid issue on multisite.
if ( function_exists( 'is_multisite' ) && is_multisite() ) {
	add_action( 'plugins_loaded', 'JoShuBlock', 90 );
} else {
	JoShuBlock();
}

