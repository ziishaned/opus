<?php

namespace App\Helpers;

/**
 * Convert HTML to MS Word file
 *
 * @author Zeeshan Ahmed
 * @version 1.0.0
 */
class HtmlToDocHelper
{
    private $docFile  = "";
    private $title    = "";
    private $htmlHead = "";
    private $htmlBody = "";
    
    
    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->title    = "Untitled Document";
        $this->htmlHead = "";
        $this->htmlBody = "";
    }
    
    /**
     * Set the document file name
     *
     * @param String $docfile
     */
    public function setDocFileName($docfile)
    {
        $this->docFile = $docfile;
        
        if (!preg_match("/\.doc$/i", $this->docFile)) {
            $this->docFile .= ".doc";
        }

        return;
    }
    
    public function setTitle($title)
    {
        $this->title = $title;
    }
    
    /**
     * Return header of MS Doc
     *
     * @return String
     */
    public function getHeader()
    {
        return file_get_contents(base_path('/resources/views/word/header.php'));
    }
    
    /**
     * Return Document footer
     *
     * @return String
     */
    public function getFotter()
    {
        return "</body></html>";
    }
    
    /**
     * Create The MS Word Document from given HTML
     *
     * @param String $html URL Name like http://www.example.com
     * @param String $file Document File Name
     * @param Boolean $download Wheather to download the file or save the file
     * @return boolean
     */
    public function createDocFromURL($url, $file, $download = false)
    {
        if (!preg_match("/^http:/", $url)) {
            $url="http://".$url;
        }

        $html=@file_get_contents($url);
        
        return $this->createDoc($html, $file, $download);
    }

    /**
     * Create The MS Word Document from given HTML
     *
     * @param String $html HTML Content or HTML File Name like path/to/html/file.html
     * @param String $file Document File Name
     * @param Boolean $download Wheather to download the file or save the file
     * @return boolean
     */
    public function createDoc($html, $file, $download = false)
    {
        if (is_file($html)) {
            $html=@file_get_contents($html);
        }
        
        $this->parseHtml($html);
        $this->setDocFileName($file);
        
        $doc  = $this->getHeader();
        $doc .= $this->htmlBody;
        $doc .= $this->getFotter();
                        
        if ($download) {
            @header("Cache-Control: "); // leave blank to avoid IE errors
            @header("Pragma: "); // leave blank to avoid IE errors
            @header("Content-type: application/octet-stream");
            @header("Content-Disposition: attachment; filename=\"$this->docFile\"");
            echo $doc;
            return true;
        } else {
            return $this->writeFile($this->docFile, $doc);
        }
    }
    
    /**
     * Parse the html and remove <head></head> part if present into html
     *
     * @param String $html
     * @return void
     */
    public function parseHtml($html)
    {
        $this->htmlBody = $html;
        return $html;
    }
    
    /**
     * Write the content int file
     *
     * @param string $file File name to be save
     * @param string $content Content to be write
     * @param [optional] String $mode Write Mode
     * @return void
     */
    private function writeFile($file, $content, $mode = "w")
    {
        $fp = @fopen($file, $mode);
        if (!is_resource($fp)) {
            return false;
        }

        fwrite($fp, $content);
        fclose($fp);

        return true;
    }
}
