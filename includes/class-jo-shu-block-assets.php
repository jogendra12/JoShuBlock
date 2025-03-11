<?php
/**
 * Load assets for our blocks.
 *
 * @package Jo Shu Block
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Load general assets for our blocks.
 *
 * @since 1.0.0
 */
class JoShuBlock_Assets {
	/**
	 * Plugin's instance.
	 *
	 * @var JoShuBlock_Assets
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
		add_filter( 'render_block', array( $this, 'blocks_scripts' ), 10, 2 );
	}

    /**
	* Loads the asset file for the given script or style.
	* Returns a default if the asset file is not found.
	*
	* @param string $filepath The name of the file without the extension.
	*
	* @return array The asset file contents.
	*/
	public function get_asset_file( $filepath ) {
		$asset_path = WP_BLOCK_DEV_PLUGIN_DIR . $filepath . '.asset.php';

		return file_exists( $asset_path )
			? include $asset_path
			: array(
				'dependencies' => array(),
				'version'      => WP_BLOCK_DEV_PLUGIN_VERSION,
			);
	}


	/**
	 * Blocks scripts
	 */
    public function blocks_scripts( $block_content, $block ) {
        
        return $block_content;
    }

}

$JoShuBlock_Assets = JoShuBlock_Assets::get_instance();