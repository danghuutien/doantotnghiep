<?php

namespace Sudo\Sitemap\Http\Controllers;

use App\Http\Controllers\Controller;
use Barryvdh\Debugbar\Facade as Debugbar;

class SitemapController extends Controller
{
    public $domain;
    public $sitemap = '';
    public $page_size;
    public $lastmod;

    public function __construct()
    {
        Debugbar::disable();
        $this->domain = config('SudoSitemap.domain');
        $this->page_size = config('SudoSitemap.page_size');
        $this->lastmod = date('Y-m-d');
    }

    public function build($template) {
        $content = '<?xml-stylesheet type="text/xsl" href="/assets/sitemap/sudo-sitemap.xsl"?>';
        $content .= '<'.$template.' xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
        '.$this->sitemap.'
        </'.$template.'>';
        return response($content, '200')->header('Content-Type', 'text/xml');
    }

    public function index() {
        //Link sitemap tổng hợp misc
        $this->sitemap .= '<sitemap>
    		<loc>'.$this->domain.'/sitemap-misc.xml</loc>
    		<lastmod>'.$this->lastmod.'</lastmod>
    	</sitemap>';

        foreach (config('SudoSitemap.sitemap') as $value) {
            $data = new $value['model'];
            $data = $data->where('status',1);
            $total = $data->count();
            if($total < $this->page_size) {
                $this->sitemap .= '<sitemap>
                    <loc>'.$this->domain.'/sitemap-'.$value['table'].'.xml</loc>
                    <lastmod>'.$this->lastmod.'</lastmod>
                </sitemap>';
            }else {
                if($total%($this->page_size) == 0) {
                    $page_total = $total/($this->page_size);
                }else {
                    $page_total = (int)($total/($this->page_size)) + 1;
                }
                for($i=1;$i<=$page_total;$i++) {
                    $this->sitemap .= '<sitemap>
                        <loc>'.$this->domain.'/sitemap-'.$value['table'].'-page-'.$i.'.xml</loc>
                        <lastmod>'.$this->lastmod.'</lastmod>
                    </sitemap>';
                }
            }
        }

        return $this->build('sitemapindex');
    }

    public function misc() {
        $this->sitemap .= '<url>
                            <loc>'.$this->domain.'</loc>
                            <lastmod>'.$this->lastmod.'</lastmod>
                            <changefreq>daily</changefreq>
                            <priority>1.0</priority>
                          </url>';
        $this->sitemap .= '<url>
                            <loc>'.$this->domain.'/sitemap.xml</loc>
                            <lastmod>'.$this->lastmod.'</lastmod>
                            <changefreq>monthly</changefreq>
                            <priority>0.5</priority>
                          </url>';

        return $this->build('urlset');
    }

    public function show($slug) {
        foreach (config('SudoSitemap.sitemap') as $value) {
            if($slug == $value['table']) {
                $data = new $value['model'];
                $data = $data->where('status',1)->orderBy('updated_at','DESC')->get();
                foreach ($data as $v) {
                    $this->sitemap .= '<url>';
                    $this->sitemap .= '<loc>'.$v->getUrl().'</loc>';
                    $this->sitemap .= '<lastmod>'.date('Y-m-d', strtotime($v->updated_at)).'</lastmod>';
                    $this->sitemap .= '<changefreq>'.$value['changefreq'].'</changefreq>';
                    $this->sitemap .= '<priority>'.$value['priority'].'</priority>';
                    $this->sitemap .= '</url>';
                }
                break;
            }
        }
        return $this->build('urlset');
    }

    public function showPaginate($slug,$page) {
        $page_start = ($page - 1)*$this->page_size;
        foreach (config('SudoSitemap.sitemap') as $value) {
            if($slug == $value['table']) {
                $data = new $value['model'];
                $data = $data->where('status',1)->orderBy('updated_at','DESC')->limit($this->page_size)->offset($page_start)->get();
                foreach ($data as $v) {
                    $this->sitemap .= '<url>';
                    $this->sitemap .= '<loc>'.$v->getUrl().'</loc>';
                    $this->sitemap .= '<lastmod>'.date('Y-m-d', strtotime($v->updated_at)).'</lastmod>';
                    $this->sitemap .= '<changefreq>'.$value['changefreq'].'</changefreq>';
                    $this->sitemap .= '<priority>'.$value['priority'].'</priority>';
                    $this->sitemap .= '</url>';
                }
                break;
            }
        }
        return $this->build('urlset');
    }
}
