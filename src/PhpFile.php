<?php

namespace AWSM\LibFile;

/**
 * Class File.
 * 
 * @since 1.0.0
 */
class PhpFile extends FileBase {
    /**
     * Set file.
     * 
     * @return PhpFile 
     * 
     * @since 1.0.0
     */
    public static function set( string $file ) : PhpFile {
        if( ! file_exists( $file ) ) {
            throw new FileException( 'File does not exist' );
        }

        $file = new self( $file );

        if( $file->extension() !== 'php' ) {
            throw new FileException( 'File is no PHP file' );
        }

        return $file;
    }

    /**
     * Running php script.
     * 
     * @param array $variables Variables to pass to script.
     * 
     * @since 1.0.0
     */
    public function run( array $variables = [] ) {
        require( $this->file );
    }

    /**
     * Running php sripte once.
     * 
     * @param array $variables Variables to pass to script.
     * 
     * @since 1.0.0
     */
    public function runOnce( array $variables = [] ) {
        require_once( $this->file );
    }

    /**
     * Runs php and buffers output.
     * 
     * @param array $variables Variables to pass to script.
     * 
     * @return string Php script output.
     * 
     * @since 1.0.0
     */
    public function runAndBufferOutput( array $variables = []  ) : string {
        ob_start();
        $this->run( $variables );
        return ob_get_clean();
    }
}