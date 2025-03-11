<?php
/**
 * Register blocks.
 *
 * @package JO SHU BLOCK
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Load registration for our blocks.
 *
 * @since 1.0.0
 */
class JoShuBlock_Register_Blocks {

	/**
	* This plugin's instance.
	*
	* @var JoShuBlock_Register_Blocks
	*/
	private static $instance;

	/**
	* Initiator
	*
	* @return object initialized object of class.
	*/
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	/**
	 * The Constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_blocks' ), 99 );
	}

	/**
	* Register block type
	*/
	public function register_block_type( $block, $options = array() ) {
		if ( ! function_exists( 'register_block_type' ) ) {
			return;
		}

		register_block_type(
			JO_SHU_BLOCK_PLUGIN_DIR . '/build/blocks/' . $block,
			$options
		);
	}

	/**
	* Register blocks.
	*
	* @access public
	*/
	public function register_blocks() {
		// Get all block directories from the build/blocks directory
		$blocks_dir = JO_SHU_BLOCK_PLUGIN_DIR . '/build/blocks';
		$block_folders = glob( $blocks_dir . '/*', GLOB_ONLYDIR );

		if ( ! empty( $block_folders ) ) {
			foreach ( $block_folders as $block_folder ) {
				// Get the block name from the directory name
				$block_name = basename( $block_folder );
				$this->register_block_type( $block_name );
			}
		}
	}

}

$JoShuBlock_Register_Blocks = JoShuBlock_Register_Blocks::get_instance();