<?php

namespace AWSM\Lib_File_Loader;

/**
 * Class File_Loader
 *
 * @package AWSM\Lib_File_Loader
 *
 * @since 1.0.0
 */
class File_Loader {
	/**
	 * Basename of file.
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	private $basename;

	/**
	 * Possible paths to file.
	 *
	 * @var array
	 */
	private $paths = array();

	/**
	 * File_Loader constructor.
	 *
	 * @param string $file Complete path to file.
	 *
	 * @since 1.0.0
	 */
	public function __construct( string $file = null ) {
		if ( ! empty ( $file ) ) {
			$this->basename = basename( $file );
			$this->paths[]  = dirname( $file );
		}
	}

	/**
	 * Loads file.
	 *
	 * @param string $strategy How to load file (require, require_once, buffer)
	 *
	 * @throws File_Loader_Exception File not found.
	 *
	 * @return mixed Loaded content, depending on strategy.
	 *
	 * @since 1.0.0
	 */
	public function load ( string $strategy = 'require' ) {
		$file = $this->find_file();

		switch ( $strategy ) {
			case 'buffer':
				ob_start();
				require ( $file );
				return ob_get_clean();
				break;
			case 'require_once':
				require_once ( $file );
				break;
			default:
				require ( $file );
				break;
		}
	}

	/**
	 * Name of the file to load.
	 *
	 * @param string $filename File to load.
	 *
	 * @since 1.0.0
	 */
	public function set_file_name( string $filename ) {
		$this->basename = $filename;
	}

	/**
	 * Add path to search for.
	 *
	 * @param string $paths Path to search for.
	 *
	 * @since 1.0.0
	 */
	public function add_path( string $path ) {
		$this->paths[]  = $path;
	}

	/**
	 * Add paths to search for.
	 *
	 * @param array $paths Paths to search for.
	 *
	 * @since 1.0.0
	 */
	public function add_paths( array $paths ) {
		$this->paths = array_merge( $this->paths, $paths );
	}

	/**
	 * Find file.
	 *
	 * @return string Returns first found file absolute path and filename.
	 *
	 * @throws File_Loader_Exception File not found.
	 *
	 * @since 1.0.0
	 */
	public function find_file () {
		foreach ( $this->paths AS $path ) {
			$potential_file = $path . '/' . $this->basename;
			if( file_exists( $potential_file ) ) {
				return $potential_file;
			}
		}

		throw new File_Loader_Exception( 'File not found' );
	}
}