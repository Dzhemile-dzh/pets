<?php

namespace RP\Util;

use RP\Util\FileReader;

/**
 * Class FileReaderTest
 * @package Test\Util\
 */
class FileReaderTest extends \PHPUnit\Framework\TestCase
{
    const RELATIVE_TO_PATH                                  = '../Stubs/FileReader/';
    const RELATIVE_FILE_PATH_TO_FILE_WITH_TOKENS            = '../Stubs/FileReader/file_with_tokens.txt';

    protected $_full_file_path_with_tokens;
    protected $_full_dir_path;

    /** @var FileReader */
    protected $_file_reader;

    function __construct($name_ = null, array $data_ = array(), $data_name_ = '')
    {
        parent::__construct($name_, $data_ , $data_name_);

        $this->_full_file_path_with_tokens  = __DIR__.'/'.FileReaderTest::RELATIVE_FILE_PATH_TO_FILE_WITH_TOKENS;
        $this->_full_dir_path               = __DIR__.'/'.FileReaderTest::RELATIVE_TO_PATH;
    }

    public function setUp()
    {
        $this->_file_reader = new FileReader(__DIR__.'/'.FileReaderTest::RELATIVE_TO_PATH);
    }

    public function testValidConstructor()
    {
       new FileReader('/dir/');
    }

    /**
     * @dataProvider invalidConstructorPaths
     * @expectedException Exception
     * @param $invalid_full_path_
     */
    public function testInvalidConstructorInvalidPath($invalid_full_path_)
    {
       new FileReader($invalid_full_path_);
    }

    public function testValidNoTokensReplacedNoIndentOnce()
    {
        $string_ = $this->_file_reader->setIndent(FileReader::DEFAULT_INDENTATION);

        $string_ = $this->_file_reader->noIndentOnNextRead()->getFileAsString($this->_full_file_path_with_tokens);

        $this->assertSame(
            file_get_contents($this->_full_file_path_with_tokens),
            $string_
        );

        $string_ = $this->_file_reader->getFileAsString($this->_full_file_path_with_tokens);

        $this->assertSame(
            file_get_contents($this->_full_dir_path.'file_with_tokens_and_indent.txt'),
            $string_
        );
    }

    public function testValidReadNoTokensReplacedIndentAlways()
    {
        $string_ = $this->_file_reader->setIndent(FileReader::DEFAULT_INDENTATION);

        $string_ = $this->_file_reader->getFileAsString($this->_full_file_path_with_tokens);

        $this->assertSame(
            file_get_contents($this->_full_dir_path.'file_with_tokens_and_indent.txt'),
            $string_
        );

        $string_ = $this->_file_reader->getFileAsString($this->_full_file_path_with_tokens);

        $this->assertSame(
            file_get_contents($this->_full_dir_path.'file_with_tokens_and_indent.txt'),
            $string_
        );
    }

    public function testValidWithTokensReplacedWithIndentOnce()
    {
        $string_ = $this->_file_reader->setTokensToReplaceOnNextRead([
            '{$here}'       => 'here',
            '{$something}'  => 'something',
        ])->setIndentOnNextRead(FileReader::DEFAULT_INDENTATION)->getFileAsString($this->_full_file_path_with_tokens);

        $this->assertSame(
            file_get_contents($this->_full_dir_path.'file_with_replaced_tokens_and_indent.txt'),
            $string_
        );

        $string_ = $this->_file_reader->getFileAsString($this->_full_file_path_with_tokens);

        $this->assertSame(
            file_get_contents($this->_full_file_path_with_tokens),
            $string_
        );
    }

    public function testValidWithTokensReplacedAlwaysNoIndent()
    {
        $string_ = $this->_file_reader->setTokensToReplace([
            '{$here}'       => 'here',
            '{$something}'  => 'something',
        ])->getFileAsString($this->_full_file_path_with_tokens);

        $this->assertSame(
            file_get_contents($this->_full_dir_path.'file_with_replaced_tokens.txt'),
            $string_
        );
    }

    public function testValidReadWithTokensReplacedNoIndent()
    {
        $string_ = $this->_file_reader->setTokensToReplaceOnNextRead([
            '{$here}'       => 'here',
            '{$something}'  => 'something',
        ])->getFileAsString($this->_full_file_path_with_tokens);

        $this->assertSame(
            file_get_contents($this->_full_dir_path.'file_with_replaced_tokens.txt'),
            $string_
        );
    }

    public function testValidFullFilePathReadNoTokensReplacedNoIndent()
    {
        $string_ = $this->_file_reader->getFileAsString($this->_full_file_path_with_tokens);

        $this->assertSame(
            file_get_contents($this->_full_file_path_with_tokens),
            $string_
        );
    }

    public function testValidRelativeFilePathReadNoTokensReplaceNoIndent()
    {
        $this->_file_reader->setRelativeToPath(__DIR__.'/');

        $string_ = $this->_file_reader->getFileAsString(FileReaderTest::RELATIVE_FILE_PATH_TO_FILE_WITH_TOKENS);

        $this->assertSame(
            file_get_contents($this->_full_file_path_with_tokens),
            $string_
        );
    }

    /**
     * @dataProvider invalidPathsParams
     * @expectedException Exception
     */
    public function testInvalidFilePathParams($invalid_file_path_)
    {
        $this->_file_reader->setRelativeToPath(__DIR__.'/'.FileReaderTest::RELATIVE_TO_PATH);

        $string_ = $this->_file_reader->getFileAsString($invalid_file_path_);
    }
    
    /**
     * @expectedException Exception
     */
    public function testInvalidFileRelativePathParam()
    {
        $this->_file_reader->setRelativeToPath(FileReaderTest::RELATIVE_TO_PATH);
    }

    /**
     * @expectedException Exception
     */
    public function testInvalidFilePath()
    {
        $this->_file_reader->setRelativeToPath(__DIR__.'/'.FileReaderTest::RELATIVE_TO_PATH);

        $string_ = $this->_file_reader->getFileAsString('file_with_tokens.txt_not_valid');
    }

    public function testValidIndentString()
    {
        $this->assertSame(
            file_get_contents($this->_full_dir_path.'file_with_tokens_and_indent.txt'),
            FileReader::indentStringWithAmount(
                file_get_contents($this->_full_file_path_with_tokens)
            )
        );

        $this->assertSame(
            file_get_contents($this->_full_dir_path.'file_with_tokens_and_indent.txt'),
            FileReader::indentStringWithAmount(
                file_get_contents($this->_full_file_path_with_tokens),
                1
            )
        );

        $this->assertSame(
            file_get_contents($this->_full_dir_path.'file_with_tokens_and_indent.txt'),
            FileReader::indentStringWithAmount(
                file_get_contents($this->_full_file_path_with_tokens), 
                FileReader::DEFAULT_INDENTATION
            )
        );
    }

    /**
     * @dataProvider validDirPaths
     * @param string $valid_dir_path_
     */
    public function testValidIsDirPath($valid_dir_path_)
    {
        $this->assertSame(
            true,
            FileReader::isDirPath($valid_dir_path_)
        );
    }

    /**
     * @dataProvider validNotDirPaths
     * @param string $valid_not_dir_path_
     */
    public function testValidIsNotDirPath($valid_not_dir_path_)
    {
        $this->assertSame(
            false,
            FileReader::isDirPath($valid_not_dir_path_)
        );
    }

    /**
     * @dataProvider invalidPathsParams
     * @expectedException Exception
     * @param string $invalid_dir_path_
     */
    public function testInvalidIsNotDirPath($invalid_dir_path_)
    {
        FileReader::isDirPath($invalid_dir_path_);
    }

    /**
     * @dataProvider validRelativePaths
     * @param string $valid_relative_path_
     */
    public function testValidIsRelativePath($valid_relative_path_)
    {
        $this->assertSame(
            true,
            FileReader::isRelativePath($valid_relative_path_)
        );
    }

    /**
     * @dataProvider validNotRelativePaths
     * @param string $valid_not_relative_path_
     */
    public function testValidIsNotRelativePath($valid_not_relative_path_)
    {
        $this->assertSame(
            false,
            FileReader::isRelativePath($valid_not_relative_path_)
        );
    }

    /**
     * @dataProvider invalidPathsParams
     * @expectedException Exception
     * @param string $invalid_relative_path_
     */
    public function testInvalidIsRelativePath($invalid_relative_path_)
    {
        FileReader::isRelativePath($invalid_relative_path_);
    }

    public function validDirPaths()
    {
        return [
            [''],
            ['/'],
            ['dir/'],
            ['/dir/'],
            ['./dir/'],
            ['../dir/'],
            ['dir/dir/'],
            ['/dir/dir/'],
            ['./dir/dir/'],
            ['../dir/dir/']
        ];
    }

    public function validNotDirPaths()
    {
        return [
            ['dir'],
            ['/dir'],
            ['./dir'],
            ['../dir'],
            ['dir/dir'],
            ['/dir/dir'],
            ['./dir/dir'],
            ['../dir/dir']
        ];
    }

    public function validRelativePaths()
    {
        return [
            [''],
            ['dir'],
            ['dir/'],
            ['./dir'],
            ['./dir/'],
            ['../dir/'],
            ['dir/dir'],
            ['dir/dir/'],
            ['./dir/dir/'],
            ['./dir/dir'],
            ['../dir/dir/'],
            ['../dir/dir']
        ];
    }

    public function validNotRelativePaths()
    {
        return [
            ['/'],
            ['/dir/'],
            ['/dir/dir/']
        ];
    }

    public function invalidConstructorPaths()
    {
        return [
            [''],
            ['dir'],
            ['/dir'],
            ['dir/']
        ];
    }

    public function invalidPathsParams()
    {
        return [
            [NULL],
            [true],
            [false],
            [[]]
        ];
    }
}
