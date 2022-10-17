<?php
namespace RP\Util;

class FileReader
{
    //STATIC

    const DEFAULT_INDENTATION = '    ';

    /** indents each new line in the input string, by a certain amount
    * @param string        $string_to_indent_  input string to indent
    * @param string|int    $indent_amount_     Optioanl can be string of spaces or int - times to indent by 4 spaces
    *                                          default value 4 spaces
    * @return string       indented version of the input
    */
   public static function indentStringWithAmount($string_to_indent_, $indent_amount_ = FileReader::DEFAULT_INDENTATION)
   {
       $indent_ = $indent_amount_;

       if (is_int($indent_amount_))
       {
           $indent_ ='';

           for($index_ = 0; $index_ < $indent_amount_; $index_++) $indent_.= FileReader::DEFAULT_INDENTATION;
       }

       $indented_string_ = implode(PHP_EOL.$indent_, explode(PHP_EOL, $string_to_indent_));

       return $indented_string_;
   }

    /** retunrs true if the path ends with /
     * @param $dir_path_ file system path
     * @return bool if the path ends with /
     */
    public static function isDirPath($dir_path_)
    {
        if (!is_string($dir_path_)) throw new \InvalidArgumentException('Invalid $dir_path_ parameter passed, must be string but is '.print_r($dir_path_, true));

        if ($dir_path_ === '') return $is_dir_path_ = TRUE;

        $is_dir_path_ = $dir_path_[strlen($dir_path_) - 1] === DIRECTORY_SEPARATOR;

        return $is_dir_path_;
    }

    /** retunrs true if the path does not start with /
     * @param $path_ file system path
     * @return bool if the path starts with /
     */
    public static function isRelativePath($path_)
    {
        if (!is_string($path_)) throw new \InvalidArgumentException('Invalid $path_ parameter passed, must be string but is '.print_r($path_, true));

        if ($path_ === '') return $is_relative_path_ = TRUE;

        $is_relative_path_ = $path_[0] !== DIRECTORY_SEPARATOR;

        return $is_relative_path_;
    }

    /** retunrs true if the path starts and ends with /
     * @param $full_dir_path_ file system path
     * @return bool if the path starts and ends with /
     */
    public static function isFullDirPath($full_dir_path_)
    {
        $is_full_dir_path_ = FileREader::isDirPath($full_dir_path_) && !FileREader::isRelativePath($full_dir_path_);

        return $is_full_dir_path_;
    }

    // INSTANCE

    protected $_relative_to_dir_path;
    protected $_tokens_to_replace;
    protected $_tokens_to_replace_once;
    protected $_indent_amount;
    protected $_indent_amount_once;

    /** creates new file reader, it can read files contents as a string, replace tokes in the string, and add indentation to new lines in the string
     * @param string|null   $relative_to_path_     optional path which will be prepended to releative file paths, must end with /
     * @param array|null    $tokens_to_replace_    optional array of key=> value, keys are the names of the tokes to replace in the read file string, 
     *                                             defauls is NULL - no tokes will be replaced
     * @param string|null   $indent_amount_        optional indentation to add to the read file string, default is NULL - no indentation wil lbe added
     */
    public function __construct($relative_to_dir_path_, $tokens_to_replace_ = null, $indent_amount_ = null)
    {
        if (!FileReader::isFullDirPath($relative_to_dir_path_))
        {
            throw new \InvalidArgumentException('Invalid $relative_to_dir_path_ parameter passed, must start with '.DIRECTORY_SEPARATOR.' and end with '.DIRECTORY_SEPARATOR.' but is '.print_r($relative_to_dir_path_, true));
        }

        $this->_relative_to_dir_path    = $relative_to_dir_path_;

        $this->_tokens_to_replace       = $tokens_to_replace_;
        $this->_indent_amount           = $indent_amount_;
    }

    /** sets the path relative to which, relative file paths will be read
     * @param string $relative_to_path_ path which will be prepended to releative file paths, must end with /
     * @return this
     */
    public function setRelativeToPath($relative_to_dir_path_)
    {
        if (!FileReader::isFullDirPath($relative_to_dir_path_))
        {
            throw new \InvalidArgumentException('Invalid $relative_to_dir_path_ parameter passed, must start with '.DIRECTORY_SEPARATOR.' and end with '.DIRECTORY_SEPARATOR.' but is '.print_r($relative_to_dir_path_, true));
        }

        $this->_relative_to_dir_path = $relative_to_dir_path_;

        return $this;
    }

    /**
     * sets the tokens to replace for all file reads
     * @param array $tokens_to_replace_ array of key => value pairs, keys are the name of the tokens to replace in the string
     * @return this
     */
    public function setTokensToReplace($tokens_to_replace_)
    {
        $this->_tokens_to_replace = $tokens_to_replace_;

        return $this;
    }

    /**
     * sets the tokens to replace only for the next file read
     * @param array $tokens_to_replace_once_ array of key => value pairs, keys are the name of the tokens to replace in the string
     * @return this
     */
    public function setTokensToReplaceOnNextRead($tokens_to_replace_once_)
    {
        $this->_tokens_to_replace_once = $tokens_to_replace_once_;

        return $this;
    }

    /** 
     * sets the default indentation amount for all file reads
     * @param string|int $indent_amount_ can be string of whitespace characters or int (times to indent by 4 spaces)
     * @return this
     */
    public function setIndent($indent_amount_)
    {
        $this->_indent_amount = $indent_amount_;

        return $this;
    }

    /** 
     * sets the indentation amount only for the next file read
     * @param string|int $indent_amount_once_ can be string of whitespace characters or int (times to indent by 4 spaces)
     * @return this
     */
    public function setIndentOnNextRead($indent_amount_once_)
    {
        $this->_indent_amount_once = $indent_amount_once_;

        return $this;
    }

    /**
     * causes the next file read to not have its content indented
     * @return this
     */
    public function noIndentOnNextRead()
    {
        $this->_indent_amount_once = '';

        return $this;
    }

    /**
     * replaces the tokens in the input sring with their actual values
     * @param   string  $string_with_tokens_    string with tokens to be repaced with actual values
     * @param   array   $tokens_to_replace_     array of key => value pairs, keys are the name of the tokens to replace in the string
     * @return  string  new string with the tokens replaced with their values
     */
    protected function replaceTokens($string_with_tokens_, $tokens_to_replace_)
    {
        if (!$string_with_tokens_)  return $string_with_tokens_;
        if (!$tokens_to_replace_)   return $string_with_tokens_;

        $string_with_replaced_tokens_ = $string_with_tokens_;

        foreach($tokens_to_replace_ as $token_name_ => $value_)
        {
            $string_with_replaced_tokens_ = implode($value_, explode($token_name_, $string_with_replaced_tokens_));
        }

        return $string_with_replaced_tokens_;
    }

    /**
     * replaces all tokens in the input string - those form the constructor, and those set only for the next file read
     * @param   string  $string_with_tokens_ string with tokens to be repaced with actual values
     * @return  string  new string with the tokens replaced with their values
     */
    protected function replaceAllTokens($string_with_tokens_)
    {
        if (!$this->_tokens_to_replace && !$this->_tokens_to_replace_once) return $string_with_tokens_;

        $string_with_replaced_tokens_ = $string_with_tokens_;

        if ($this->_tokens_to_replace)
        {
            $string_with_replaced_tokens_ = $this->replaceTokens($string_with_tokens_, $this->_tokens_to_replace);
        }

        if ($this->_tokens_to_replace_once)
        {
            $string_with_replaced_tokens_ = $this->replaceTokens($string_with_tokens_, $this->_tokens_to_replace_once);

            $this->_tokens_to_replace_once = null;
        }

        return $string_with_replaced_tokens_;
    }

    /**
     * returns indented version of the input string, using the indentation set only for the next file read (if present), or that set for all file reads
     * @param  string $string_ string where each new line will be indented
     * @return string indented version of the input string, each new line is indented
     */
    protected function indent($string_to_indent_)
    {
        $indent_amount_ = $this->_indent_amount;

        if ($this->_indent_amount_once !== null)
        {
            $indent_amount_ = $this->_indent_amount_once;

            $this->_indent_amount_once = null;
        }

        if ($indent_amount_ === null) return $string_to_indent_;

        $indented_string_ = FileReader::indentStringWithAmount($string_to_indent_, $indent_amount_);

        return $indented_string_;
    }

    /**
     * replaces tokens and adds indentation in the input string
     * @param   string $string_ the tokens in the string will be replaced with actual values, and new lines in the string will be indened
     * @return  string string with replaces tokens and added indentation
     */
    protected function process($string_)
    {
        $processed_string_  = $string_;

        $processed_string_  = $this->replaceAllTokens($processed_string_);
        $processed_string_  = $this->indent($processed_string_);

        return $processed_string_;
    }

    /** reads a file, and retunrs it as a string
     * @param string        $file_path_ path to file whose content to read, can be full path, or relative to the dir $from_path_ passed in the constructor
     * @return string|null  file contents as a string, or NULL if $file_path_ is empty, or file does not exist
     */
    public function getFileAsString($file_path_)
    {
        if (!is_string($file_path_)) throw new \InvalidArgumentException('Invalid $file_path_ parameter passed, must be string but is '.print_r($file_path_, true));

        $real_path_             = $file_path_;

        $is_file_path_relative_ = FileReader::isRelativePath($file_path_);

        if ($is_file_path_relative_)
        {
            $real_path_ = $this->_relative_to_dir_path.$file_path_;
        }

        $real_path_         = realpath($real_path_);

        if ($real_path_ === FALSE)
        {
            throw new \InvalidArgumentException('Invalid $file_path_ parameter passed, evaluates to $real_path_'.$real_path_.' but file does not exist');
        }

        $file_as_string_    = file_get_contents($real_path_);

        $file_as_string_    = $this->process($file_as_string_);

        return $file_as_string_;
    }
}