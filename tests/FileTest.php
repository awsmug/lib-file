<?php

use PHPUnit\Framework\TestCase;

use AWSM\LibFile\File;

final class FileTest extends TestCase {
	public function testCreate(): void {
		$testfile = 'testfile.txt';

		$file = File::create( $testfile );

		$this->assertInstanceOf('AWSM\LibFile\File', $file);
		$this->assertTrue( file_exists( $testfile ) );

		unlink( $testfile );
	}

	public function testPath() {
		$testfile = 'testfile.txt';

		File::create( $testfile );
		$path = File::load( $testfile )->path();

		$this->assertEquals( $path, dirname( dirname( __FILE__ ) ) );
	}
}