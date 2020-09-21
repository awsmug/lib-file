<?php

use PHPUnit\Framework\TestCase;

use AWSM\LibFile\File;

final class FileTest extends TestCase {
	public function testCreate(): void {
		$testfile = 'testfile.txt';

		$file = File::create( $testfile );
		$this->assertInstanceOf('AWSM\LibFile\File', $file);
		$this->assertTrue( file_exists( $testfile ) );
		File::delete( $testfile );
	}

	public function testPath() {
		$testfile = 'testfile.txt';

		File::create( $testfile );
		$value = File::load( $testfile )->path();
		File::delete( $testfile );

		$this->assertEquals( $value, dirname( dirname( __FILE__ ) ) . '/' . $testfile );
	}

	public function testDir() {
		$testfile = 'testfile.txt';

		File::create( $testfile );
		$value = File::load( $testfile )->dir();
		File::delete( $testfile );

		$this->assertEquals( $value, dirname( dirname( __FILE__ ) ) );
	}

	public function testName() {
		$testfile = 'testfile.txt';

		File::create( $testfile );
		$path = File::load( $testfile )->name();
		File::delete( $testfile );

		$this->assertEquals( $path, $testfile );
	}
}