<?php

namespace AWSM\LibFile;

/**
 * Class File.
 * 
 * @since 1.0.0
 */
class File {

    /**
     * File location.
     * 
     * @since 1.0.0
     */
    protected $file;

    /**
     * Constructor.
     * 
     * @since 1.0.0
     */
    private function __construct( string $file ) {
        $this->file = $file;
    }

    /**
     * Load file.
     * 
     * @param string $file File to load.
     * 
     * @return File
     * 
     * @since 1.0.0
     */
    public static function set( string $file ) : File {
        if( ! file_exists( $file ) ) {
            throw new FileException( 'File does not exist' );
        }

        return new self( $file );
    }

    /**
     * Creates new file.
     * 
     * @param string $file File to create.
     * 
     * @return File
     * 
     * @since 1.0.0
     */
    public static function create( string $file ) : File {
        if ( ! touch( $file ) ) {
            throw new FileException( 'Could not create file' );
        }

        return new self( $file );
    }

    /**
     * Deletes file.
     * 
     * @param string $file File to delete.
     * 
     * @return bool True if file was deleted, false if not.
     * 
     * @since 1.0.0
     */
    public function delete() {
        return unlink( $this->file );
    }

    /**
     * Get file content.
     * 
     * @return string File content.
     * 
     * @since 1.0.0 
     */
    public function content() : string {
        return file_get_contents( $this->file );
    }

    /**
     * Write to file.
     * 
     * @param string $content Content to write.
     * @param string $mode    Mode for writing (see https://www.php.net/manual/de/function.fopen.php)
     * 
     * @return int $bytes The number of bytes written.
     * 
     * @since 1.0.0
     */
    public function write( string $content, string $mode = 'a' ) {
        $handle = fopen( $this->file, $mode );
        $bytes = fwrite( $handle, $content );
        fclose( $handle );

        return $bytes;
    }

    /**
     * Path of file.
     * 
     * @return string File path.
     * 
     * @since 1.0.0
     */
    public function path() {
        return realpath( $this->file );
    }

    /**
     * Directory of file.
     * 
     * @return string File directory.
     * 
     * @since 1.0.0
     */
    public function dir() {
        return dirname( realpath( $this->file ) );
    }

    /**
     * Name of file.
     * 
     * @return string File name.
     * 
     * @since 1.0.0
     */
    public function name() {
        return basename( $this->file );
    }

    /**
     * Mime type.
     * 
     * @return string Mime type.
     * 
     * @since 1.0.0
     */
    public function mimeType() : string {
        return mime_content_type( $this->file );
    }

    /**
     * Extension.
     * 
     * @return string Extension.
     * 
     * @since 1.0.0
     */
    public function extension() : string {
        return pathinfo( $this->file, PATHINFO_EXTENSION );
    }
}