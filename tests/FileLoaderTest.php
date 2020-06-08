<?php

use PHPUnit\Framework\TestCase;

use AWSM\Lib_File_Loader\File_Loader;
use AWSM\Lib_File_Loader\File_Loader_Exception;

final class FileLoaderTest extends TestCase {
	public function testLoadFile(): void {
		$testfile = 'testfile.php';

		touch( $testfile );

		$file_loader = new File_Loader( 'testfile.php' );
		$this->assertEquals( './' . $testfile, $file_loader->find_file() );

		unlink( $testfile );
	}

	public function testLoadPathFile(): void {
		$testdir  = 'testdir';
		$testfile = 'testfile.php';
		$testfile_full = $testdir . '/' . $testfile;

		mkdir( $testdir );
		touch( $testfile_full );

		$file_loader = new File_Loader( $testfile_full );
		$this->assertEquals( $testfile_full, $file_loader->find_file() );

		unlink( $testfile_full );
		rmdir( $testdir );
	}

	public function testAddPathFile(): void {
		$testdir1  = 'testdir1';
		$testdir2  = 'testdir2';
		$testdir3  = 'testdir3';
		$testfile = 'testfile.php';
		$testfile_full = $testdir3 . '/' . $testfile;

		mkdir( $testdir1 );
		mkdir( $testdir2 );
		mkdir( $testdir3 );

		touch( $testfile_full );

		$file_loader = new File_Loader();
		$file_loader->set_file_name( $testfile );

		$file_loader->add_path( $testdir1 );
		$file_loader->add_path( $testdir2 );
		$file_loader->add_path( $testdir3 );

		$this->assertEquals( $testfile_full, $file_loader->find_file() );

		unlink( $testfile_full );

		rmdir( $testdir1 );
		rmdir( $testdir2 );
		rmdir( $testdir3 );
	}

	public function testAddPathsFile(): void {
		$testdir1  = 'testdir1';
		$testdir2  = 'testdir2';
		$testdir3  = 'testdir3';
		$testfile = 'testfile.php';
		$testfile_full = $testdir3 . '/' . $testfile;

		mkdir( $testdir1 );
		mkdir( $testdir2 );
		mkdir( $testdir3 );

		touch( $testfile_full );

		$file_loader = new File_Loader();
		$file_loader->set_file_name( $testfile );

		$paths = array( $testdir1, $testdir2, $testdir3 );

		$file_loader->add_paths( $paths );

		$this->assertEquals( $testfile_full, $file_loader->find_file() );

		unlink( $testfile_full );

		rmdir( $testdir1 );
		rmdir( $testdir2 );
		rmdir( $testdir3 );
	}

	public function testAddPathsNoFile(): void {
		$testdir1  = 'testdir1';
		$testdir2  = 'testdir2';
		$testdir3  = 'testdir3';
		$testfile = 'testfile.php';
		$testfile_full = $testdir3 . '/' . $testfile;

		mkdir( $testdir1 );
		mkdir( $testdir2 );
		mkdir( $testdir3 );

		$file_loader = new File_Loader();
		$file_loader->set_file_name( $testfile );

		$paths = array( $testdir1, $testdir2, $testdir3 );

		$file_loader->add_paths( $paths );

		$this->expectException( 'AWSM\Lib_File_Loader\File_Loader_Exception' );
		$file_loader->find_file();

		$this->expectException( 'AWSM\Lib_File_Loader\File_Loader_Exception' );
		$file_loader->load();

		rmdir( $testdir1 );
		rmdir( $testdir2 );
		rmdir( $testdir3 );
	}

	public function testExceptionLoadFile(): void {
		$file_loader = new File_Loader( 'testfile.php' );

		$this->expectException( 'AWSM\Lib_File_Loader\File_Loader_Exception' );
		$file_loader->find_file();
	}
}