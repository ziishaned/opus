<?php 

namespace App\Helpers;

/**
 * Convert HTML to MS Word file
 * @author Harish Chauhan
 * @version 1.0.0
 * @name HTML_TO_DOC
 */

class HtmlToDocHelper
{
	var $docFile="";
	var $title="";
	var $htmlHead="";
	var $htmlBody="";
	
	
	/**
	 * Constructor
	 *
	 * @return void
	 */
	function HTML_TO_DOC()
	{
		$this->title="Untitled Document";
		$this->htmlHead="";
		$this->htmlBody="";
	}
	
	/**
	 * Set the document file name
	 *
	 * @param String $docfile 
	 */
	
	function setDocFileName($docfile)
	{
		$this->docFile=$docfile;
		if(!preg_match("/\.doc$/i",$this->docFile))
			$this->docFile.=".doc";
		return;		
	}
	
	function setTitle($title)
	{
		$this->title=$title;
	}
	
	/**
	 * Return header of MS Doc
	 *
	 * @return String
	 */
	function getHeader()
	{
		$return  = <<<EOH
		 <html xmlns:v="urn:schemas-microsoft-com:vml"
		xmlns:o="urn:schemas-microsoft-com:office:office"
		xmlns:w="urn:schemas-microsoft-com:office:word"
		xmlns="http://www.w3.org/TR/REC-html40">
		
		<head>
		<meta http-equiv=Content-Type content="text/html; charset=utf-8">
		<meta name=ProgId content=Word.Document>
		<meta name=Generator content="Microsoft Word 9">
		<meta name=Originator content="Microsoft Word 9">
		<!--[if !mso]>
		<style>
		v\:* {behavior:url(#default#VML);}
		o\:* {behavior:url(#default#VML);}
		w\:* {behavior:url(#default#VML);}
		.shape {behavior:url(#default#VML);}
		</style>
		<![endif]-->
		<title>$this->title</title>
		<!--[if gte mso 9]><xml>
		 <w:WordDocument>
		  <w:View>Print</w:View>
		  <w:DoNotHyphenateCaps/>
		  <w:PunctuationKerning/>
		  <w:DrawingGridHorizontalSpacing>9.35 pt</w:DrawingGridHorizontalSpacing>
		  <w:DrawingGridVerticalSpacing>9.35 pt</w:DrawingGridVerticalSpacing>
		 </w:WordDocument>
		</xml><![endif]-->
		<style>
		<!--
		 /* Font Definitions */
		@font-face
			{font-family:Verdana;
			panose-1:2 11 6 4 3 5 4 4 2 4;
			mso-font-charset:0;
			mso-generic-font-family:swiss;
			mso-font-pitch:variable;
			mso-font-signature:536871559 0 0 0 415 0;}
		 /* Style Definitions */
		p.MsoNormal, li.MsoNormal, div.MsoNormal
			{mso-style-parent:"";
			margin:0in;
			margin-bottom:.0001pt;
			mso-pagination:widow-orphan;
			font-size:7.5pt;
		        mso-bidi-font-size:8.0pt;
			font-family:"Verdana";
			mso-fareast-font-family:"Verdana";}
		p.small
			{mso-style-parent:"";
			margin:0in;
			margin-bottom:.0001pt;
			mso-pagination:widow-orphan;
			font-size:1.0pt;
		        mso-bidi-font-size:1.0pt;
			font-family:"Verdana";
			mso-fareast-font-family:"Verdana";}
		@page Section1
			{size:8.5in 11.0in;
			margin:1.0in 1.25in 1.0in 1.25in;
			mso-header-margin:.5in;
			mso-footer-margin:.5in;
			mso-paper-source:0;}
		div.Section1
			{page:Section1;}
		-->
		</style>
		<!--[if gte mso 9]><xml>
		 <o:shapedefaults v:ext="edit" spidmax="1032">
		  <o:colormenu v:ext="edit" strokecolor="none"/>
		 </o:shapedefaults></xml><![endif]--><!--[if gte mso 9]><xml>
		 <o:shapelayout v:ext="edit">
		  <o:idmap v:ext="edit" data="1"/>
		 </o:shapelayout></xml><![endif]-->
		 $this->htmlHead
			<style>
				body {
					font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
				    word-wrap: break-word;
				    font-size: 16px;
				}

				body>*:first-child {
				    margin-top: 0 !important;
				}

				h1 {
				    font-size: 2em;
				}

				h2 {
				    font-size: 1.5em;
				}

				h3 {
				    font-size: 1.25em;
				}

				hr {
				    border: none;
					border-bottom: 1px solid #eaecef;
					margin: 8px 0px 8px 0px;
				}

				h1, h2, h3, h4, h5, h6 {
				    margin-top: 24px;
				    margin-bottom: 12px;
				    font-weight: 600;
				    line-height: 1.25;
				}

				p, blockquote, ul, ol, dl, table, pre {
				    margin-top: 0;
				    margin-bottom: 16px;
				}

				blockquote {
				    padding: 0 1em;
				    color: #6a737d;
				    border-left: 0.25em solid #dfe2e5;
				}

				p, blockquote, ul, ol, dl, table, pre {
				    margin-top: 0;
				    margin-bottom: 16px;
				}

				blockquote {
				    margin: 0;
				}

				b, strong {
					font-weight: 500;
				}

				pre {
				    font-size: 85%;
				}

				pre, code {
					font-size: 14px;
					font-family: "Consolas", "Monaco", "SFMono-Regular", "Liberation Mono", Menlo, Courier, monospace;
				}

				ul, ol {
				    padding-left: 2em;
				}

				body::after {
				    display: table;
				    clear: both;
				    content: "";
				}

				a {
				    color: #0366d6;
				    text-decoration: none;
				}

				a:hover {
				    text-decoration: underline;
				}
			</style>
		</head>
		<body>
EOH;
		return $return;
	}
	
	/**
	 * Return Document footer
	 *
	 * @return String
	 */
	function getFotter()
	{
		return "</body></html>";
	}
	
	/**
	 * Create The MS Word Document from given HTML
	 *
	 * @param String $html :: URL Name like http://www.example.com
	 * @param String $file :: Document File Name
	 * @param Boolean $download :: Wheather to download the file or save the file
	 * @return boolean 
	 */
	
	function createDocFromURL($url,$file,$download=false)
	{
		if(!preg_match("/^http:/",$url))
			$url="http://".$url;
		$html=@file_get_contents($url);
		return $this->createDoc($html,$file,$download);	
	}

	/**
	 * Create The MS Word Document from given HTML
	 *
	 * @param String $html :: HTML Content or HTML File Name like path/to/html/file.html
	 * @param String $file :: Document File Name
	 * @param Boolean $download :: Wheather to download the file or save the file
	 * @return boolean 
	 */
	
	function createDoc($html,$file,$download=false)
	{
		if(is_file($html))
			$html=@file_get_contents($html);
		
		$this->_parseHtml($html);
		$this->setDocFileName($file);
		$doc=$this->getHeader();
		$doc.=$this->htmlBody;
		$doc.=$this->getFotter();
						
		if($download)
		{
			@header("Cache-Control: ");// leave blank to avoid IE errors
			@header("Pragma: ");// leave blank to avoid IE errors
			@header("Content-type: application/octet-stream");
			@header("Content-Disposition: attachment; filename=\"$this->docFile\"");
			echo $doc;
			return true;
		}
		else 
		{
			return $this->write_file($this->docFile,$doc);
		}
	}
	
	/**
	 * Parse the html and remove <head></head> part if present into html
	 *
	 * @param String $html
	 * @return void
	 * @access Private
	 */
	
	function _parseHtml($html)
	{
		$this->htmlBody=$html;
		return $html;
	}
	
	/**
	 * Write the content int file
	 *
	 * @param String $file :: File name to be save
	 * @param String $content :: Content to be write
	 * @param [Optional] String $mode :: Write Mode
	 * @return void
	 * @access boolean True on success else false
	 */
	
	function write_file($file,$content,$mode="w")
	{
		$fp=@fopen($file,$mode);
		if(!is_resource($fp))
			return false;
		fwrite($fp,$content);
		fclose($fp);
		return true;
	}

}