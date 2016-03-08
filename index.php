<?php

    /*
     * https://www.artlebedev.ru/tools/technogrette/xslt/entity-1/
     * https://m.habrahabr.ru/post/61501/
     */

    session_set_cookie_params( "0", dirname( $_SERVER["SCRIPT_NAME"] ) );
    session_name( "PHPSESSID".sha1( dirname( $_SERVER["SCRIPT_NAME"] ) ) );
    session_start();

    $ls = array( "en", "ru" );

    if(isset( $_GET["lang"] ) && in_array( trim( $_GET["lang"] ), $ls ) ) {
        $_SESSION["LANG"] = trim($_GET["lang"]);
    }
    
    stream_wrapper_register("lang", "\LangStream");

    $xslDoc = new DOMDocument();
    $xslDoc->resolveExternals = TRUE;
    $xslDoc->substituteEntities = TRUE;
    $xslDoc->load("stylesheets/localize.xsl");

    $xmlDoc = new DOMDocument();
    $xmlDoc->loadXML("<?xml version='1.0' encoding='utf-8'?><localize xmlns='urn:tmp' />");
    
    $proc = new XSLTProcessor();
    $proc->importStylesheet($xslDoc);
    echo $proc->transformToXML($xmlDoc);
    
    stream_wrapper_unregister("lang") or die(__FILE__.__LINE__);

    class LangStream 
    {
        const LOCALE_PATH = "xml/locale/";
        
        public $dtd;
        public $lang;
        public $handle;
        public $ls = array( "en", "ru" );

        public function stream_open($path, $mode, $options, &$opened_path)
        {
            $this->lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
            if( isset( $_SESSION["LANG"] ) ) {
                $this->lang = $_SESSION["LANG"];
            } else {
                $_SESSION["LANG"] = $this->lang;
            }
            
            if(!in_array($this->lang,$this->ls)) $this->lang="en";
        
            $url = parse_url( $path );
            $this->dtd = dirname(__FILE__)."/".self::LOCALE_PATH.$this->lang."/".$url["host"];
            
            $this->handle=fopen($this->dtd,$mode);
            return true;
        }

        public function stream_close() 
        {
            return fclose($this->handle);
        }

        public function stream_read($count) 
        {
            return fread($this->handle,$count);
        }

        public function stream_write($data) 
        {
            return fwrite($this->handle, $data);
        }

        public function stream_tell() 
        {
            return ftell($this->handle);
        }

        public function stream_eof() 
        {
            return feof($this->handle);
        }

        public function stream_seek($offset, $whence) 
        {
            return fseek($this->handle, $offset, $whence);
        }

        public function stream_stat() 
        {
            return fstat($this->handle);
        }
        
        public function url_stat()
        {
            return array();
        }
    }
