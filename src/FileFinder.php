<?php

namespace AWSM\LibFile;

/**
 * Class File.
 * 
 * @since 1.0.0
 */
class FileFinder {
    /**
     * Paths to search in.
     * 
     * @since 1.0.0
     */
    protected $paths = [];

    /**
     * File to search for.
     * 
     * @since 1.0.0
     */
    protected $filename;

    /**
     * Constructor.
     * 
     * @param array  $paths Paths to search in.
     * @param string $filename File to search for.
     * 
     * @since 1.0.0
     */
    private function __construct( array $paths, string $filename ) {
        $this->filename = $filename;
        $this->paths    = $paths;
    }

    /**
     * Load file.
     * 
     * @param array  $paths Paths to search in.
     * @param string $filename File to search for.
     * 
     * @return Filefinder
     * 
     * @since 1.0.0
     */
    public static function search( array $paths, string $filename ) : FileFinder {
        return new self( $paths, $filename );
    }

    /**
     * First found file.
     * 
     * @return File First found file.
     * 
     * @since 1.0.0
     */
    public function first() {
        foreach( $this->paths AS $path ) {
            $file = $path . '/' . $this->filename;

            if( file_exists( $file ) ) {
                return File::use( $file );
            }
        }
    }

    /**
     * All files found.
     * 
     * @return File[] All files found.
     * 
     * @since 1.0.0
     */
    public function all() {
        $foundFiles = [];

        foreach( $this->paths AS $path ) {
            $file = $path . '/' . $this->filename;

            if( file_exists( $file ) ) {
                $foundFiles[] = File::use( $file ) ;
            }
        }

        return $foundFiles;
    }
}