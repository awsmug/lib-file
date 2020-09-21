<?php

use PHPUnit\Framework\TestCase;

use AWSM\LibFile\File;
use AWSM\LibFile\FileFinder;

final class FileFinderTest extends TestCase {
	public function testSearchFirst(): void {
        $testfile = 'testfile.txt';
        $searchDirs = [ dirname(dirname(__FILE__)) ];

        $file = File::create( $testfile );
        $file = FileFinder::search( $searchDirs, $testfile )->first();
        $this->assertInstanceOf('AWSM\LibFile\File', $file);

        $deleted = FileFinder::search($searchDirs, $testfile )->first()->delete();
        $this->assertTrue( $deleted );
    }

	public function testSearchAll(): void {
        $testfile = 'testfile.txt';
        $searchDirs = [ dirname(dirname(__FILE__)) ];

        $file = File::create( $testfile );
        $files = FileFinder::search( $searchDirs, $testfile )->all();
        $this->assertIsArray( $files );

        $this->assertInstanceOf( 'AWSM\LibFile\File', $files[0] );
        $file->delete();
    }
}