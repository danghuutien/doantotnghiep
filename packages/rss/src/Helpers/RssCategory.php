<?php
namespace Sudo\Rss\Helpers;


class RssCategory
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

        $header ='<rss version="2.0" xmlns:g="http://base.google.com/ns/1.0">' . "\n" .
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
    function addItem($id, $title, $description, $link, $image_link, $price, $product_type, $guid = '' , $pubdate){
        $item = '<item>' . "\n" .
                    '             <g:id>'.htmlspecialchars($id).'</g:id>' . "\n" .
                    '             <g:title>'.htmlspecialchars($title) .'</g:title>' . "\n" .
                    '             <g:description><![CDATA[' . $description . ']]></g:description>' . "\n" .
                    '             <g:link>'.htmlspecialchars($link) .'</g:link>' . "\n" .
                    '             <g:guid isPermaLink="false">' . htmlspecialchars($guid) . '</g:guid>' . "\n" .
                    '             <g:image_link>'.htmlspecialchars($image_link).'</g:image_link>' . "\n" .
                    '             <g:price>'.htmlspecialchars($image_link).'</g:price>' . "\n" .
                    '             <g:product_type>'.htmlspecialchars($product_type).'</g:product_type>'."\n".
                '</item>';
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
