<?php

namespace Sudo\Theme\Http\Controllers\Web;

use Illuminate\Http\Request;
use Sudo\Page\Models\Page;

class PageController extends Controller
{
	
	public function show($id,$slug) {
		\Asset::addStyle(['page'])
			->addScript(['general']);
		$page = Page::where('id', $id)->firstOrFail();
		// $language = getLanguageLink(Page::class, $page->id);

        $meta_seo = metaSeo('pages', $page->id, [
			'title' => $page->name ?? '',
			'description' => cutString(removeHTML($page->detail),200) ?? '',
			'image' => getImage(),
		]);
		$list_page = Page::where('status', 1)->get();
		$admin_bar = route('admin.pages.edit',$page->id);
		$breadcrumbs = [
			[
				'name' => $page->name ?? '',
				'link' => $page->getUrl()
			]
		];
		return view('Default::web.pages.show',compact('page','meta_seo','admin_bar','breadcrumbs','list_page'));
	}
	public function contact() {
		\Asset::addStyle(['contact']);
		$setting_contact = getOption('contact');
		$meta_seo = metaSeo('', '', [
			'title' => $setting_contact['meta_title'] ?? 'Liên hệ',
			'description' => $setting_contact['meta_description'] ?? 'Mô tả trang liên hệ',
			'image' => $setting_contact['meta_image'] ?? getImage(),
		]);
		$breadcrumbs = [
			[
				'name' => 'Liên hệ',
				'link' => route('app.contact.show')
			]
		];
		$admin_bar = route('admin.settings.contact');

		return view('Default::web.pages.contact', compact(
			'meta_seo', 'admin_bar','setting_contact','breadcrumbs'
		));
	}

}
