<?php

use PHPUnit\Framework\TestCase;

use AWSM\LibFile\PhpFile;

final class PhpFileTest extends TestCase {
        public function testRunAndBuffer(): void {
                $file = PhpFile::set( dirname(__FILE__) . '/assets/php-file.php' );

                $output = $file->runAndBufferOutput();
                $this->assertEquals( 'This is a test', $output );
        }


        public function testRunAndBufferVariables(): void {
                $file = PhpFile::set( dirname(__FILE__) . '/assets/php-variables.php' );

                $output = $file->runAndBufferOutput( [ 'name' => 'Peter' ] );
                $this->assertEquals( 'Hello Peter!', $output );
        }
}