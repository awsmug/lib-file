<?php

use PHPUnit\Framework\TestCase;

use AWSM\LibFile\File;

final class FileTest extends TestCase {
	public function testCreate(): void {
		$testfile = 'testfile.txt';

		File::create( $testfile );
		$this->assertTrue( file_exists( $testfile ) );
		File::use($testfile)->delete();
	}

	public function testPath() {
		$testfile = 'testfile.txt';

		File::create( $testfile );
		$value = File::use( $testfile )->path();
		File::use( $testfile )->delete();

		$this->assertEquals( $value, dirname( dirname( __FILE__ ) ) . '/' . $testfile );
	}

	public function testDir() {
		$testfile = 'testfile.txt';

		File::create( $testfile );
		$value = File::use( $testfile )->dir();
		File::use($testfile)->delete();

		$this->assertEquals( $value, dirname( dirname( __FILE__ ) ) );
	}

	public function testName() {
		$testfile = 'testfile.txt';

		File::create( $testfile );
		$path = File::use( $testfile )->name();
		File::use($testfile)->delete();

		$this->assertEquals( $path, $testfile );
	}
}