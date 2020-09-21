<?php

namespace AWSM\LibFile;

/**
 * Class File.
 * 
 * @since 1.0.0
 */
class File extends FileBase {
    /**
     * Constructor.
     * 
     * @since 1.0.0
     */
    protected function __construct( string $file ) {
        $this->file = $file;
    }

    /**
     * Set file.
     * 
     * @param string $file File to load.
     * 
     * @return File
     * 
     * @since 1.0.0
     */
    public static function set( string $file ) : File {
        return parent::set( $file );
    }
}