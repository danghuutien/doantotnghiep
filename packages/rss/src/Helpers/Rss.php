<?php
namespace Sudo\Rss\Helpers;


class Rss
{
    public $title;
    public $content = '';
    public $domain = '';
    public $generator = 'Sudo Ecommerce';

    /*
    Khởi tạo class
    */
    function __construct($title, $domain, $generator){
        $this->title 		= $title;
        $this->domain 	    = $domain;
        $this->generator 	= $generator;
    }

    /*
    Print header
    */
    function rssHeader(){
        $today = getdate();

        $header ='<rss version="2.0">' . "\n" .
            '	<channel>'  . "\n" .
            '		<title>' . htmlspecialchars($this->title) . '</title>' . "\n" .
            '		<copyright>' . htmlspecialchars($this->domain) . '</copyright>' . "\n" .
            '		<generator>' . htmlspecialchars($this->generator) . '</generator>' . "\n" .
            '		<link>' . htmlspecialchars($this->domain) . '</link>' . "\n" .
            '		<pubDate>' . date("D, d M Y H:i:s ",$today[0]) . "GMT+7" . '</pubDate>' . "\n" .
            '		<lastBuildDate>' . date("D, d M Y H:i:s ",$today[0]) . "GMT+7" . '</lastBuildDate>' . "\n";

        return $header;
    }

    /*
    Add item
    */
    function addItem($title, $description, $link, $guid = '' , $pubdate){
        $item = '			<item>' . "\n" .
            '				<title>' . htmlspecialchars($title) . '</title>' . "\n" .
            '				<description><![CDATA[' . $description . ']]></description>' . "\n" .
            '				<link>' . htmlspecialchars($link) . '</link>' . "\n" .
            '				<guid isPermaLink="false">' . htmlspecialchars($guid) . '</guid>' . "\n" .
            '				<pubDate>' . htmlspecialchars($pubdate) . '</pubDate>' . "\n" .
            '			</item>' . "\n";

        //return $item;
        $this->content .= $item;
    }

    /*
    Print header
    */
    function rssFooter(){
        $footer = '	</channel>' . "\n" .
            '</rss>';

        return $footer;
    }

    /*
    lấy nội dung rss
    */
    function getRSSContent(){
        return $this->rssHeader() .
            $this->content .
            $this->rssFooter();
    }

    /*
    Save RSS to file
    */
    function saveRSS($filename){
        $handle = fopen($filename, 'w');
        fwrite($handle, $this->getRSSContent());
        fclose($handle);
    }
}
