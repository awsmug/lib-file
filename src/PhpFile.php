<?php

namespace AWSM\LibFile;

/**
 * Class File.
 * 
 * @since 1.0.0
 */
class PhpFile extends File {
    /**
     * Load file.
     * 
     * @return PhpFile 
     * 
     * @since 1.0.0
     */
    public static function load( string $file ) : PhpFile {
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
     * @since 1.0.0
     */
    public function run() {
        require( $this->file );
    }

    /**
     * Running php sripte once.
     * 
     * @since 1.0.0
     */
    public function runOnce() {
        require_once( $this->file );
    }

    /**
     * Runs php and buffers output.
     * 
     * @return string Php script output.
     * 
     * @since 1.0.0
     */
    public function runAndBufferOutput() : string {
        ob_start();
        $this->run();
        return ob_get_clean();
    }
}