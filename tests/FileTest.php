<?php

use PHPUnit\Framework\TestCase;

use AWSM\LibFile\File;

final class FileTest extends TestCase {
	public function testCreateFile(): void {
		$testfile = 'testfile.txt';

		$file = File::create( $testfile );

		$this->assertInstanceOf('AWSM\LibFile\File', $file);
		$this->assertTrue( file_exists( $testfile ) );

		unlink( $testfile );
	}
}