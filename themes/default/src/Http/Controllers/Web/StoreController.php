<?php

namespace Sudo\Theme\Http\Controllers\Web;

use Illuminate\Http\Request;
use Sudo\Theme\Models\Store;
use DB;

class StoreController extends Controller
{
    public function index(Request $request) {
        \Asset::addStyle(['page'])
            ->addScript(['page']);
        $config_general = getOption('general');
        $meta_seo = metaSeo('', '', [
            'title' => $config_general['store_meta_title'] ?? 'Danh sách cửa hàng',
            'description' => $config_general['store_meta_description'] ?? 'Danh sách cửa hàng',
            'image' => getImage($config_general['store_meta_image'] ?? ''),
            'url' => route('app.stores.index'),
        ]);
        $breadcrumb = [
            [
                'link' => route('app.stores.index'),
                'name' => 'Danh sách cửa hàng'
            ],
        ];
        $stores = Store::active();
        if($request->area) {
            $stores = $stores->where('area', intval($request->area));
        } else {
            $stores = $stores->where('area', Store::MB);
        }
        $stores = $stores->paginate(12);

        if($request->ajax()) {
            $html =view('Default::web.store.item', compact('stores'))->render();
            $pagination = $stores->appends(Request()->all())->links('Default::general.components.pagination')->toHtml();
            return [
                'html' => $html,
                'pagination' => $pagination,
            ];
        }
        $countStores = Store::active()
            ->select(\DB::raw('COUNT(*) as total'), 'area')
            ->groupBy('area')->pluck('total', 'area')->toArray();

        $admin_bar = route('admin.settings.general'). '#store_meta_title';
        return view('Default::web.store.index',compact('stores', 'meta_seo','breadcrumb', 'admin_bar', 'countStores'));
    }

    public function show($slug) {
        \Asset::addStyle(['slick', 'page'])
            ->addScript(['slick', 'page']);
        $store = Store::active()->where('slug', $slug)->firstOrFail();
        $meta_seo = metaSeo('stores', $store->id, [
            'title' => $setting_system['meta_title'] ?? $store->getName(),
            'description' => $setting_system['meta_description'] ?? $store->getName(),
            'image' => $store->getImage()
        ]);
        $breadcrumb = [
            [
                'link' => route('app.stores.index'),
                'name' => 'Danh sách cửa hàng'
            ],
            [
                'link' => $store->getUrl(),
                'name' => $store->getName()
            ],
        ];
        if($store->related_store != '') {
            $array_related = explode(',', $store->related_store);
            $related_stores = Store::whereIn('id', $array_related)
                ->where('status', 1)
                ->limit(4)
                ->get();
        }else {
            $related_stores = Store::where('status', 1)->orderBy('id', 'desc')->where('id', '<>', $store->id)->limit(4)->get();
            
        }
        $config_general = getOption('general');
        $products = $config_general['hotProducts'] ?? [];
        $ids_ordered = implode(',', $products);
        $hotProducts = \Sudo\Ecommerce\Models\Product::active()->whereIn('id', $products);
        if(count($products)) {
            $hotProducts = $hotProducts->orderByRaw("FIELD(id, $ids_ordered)");
        }
        $hotProducts = $hotProducts->get();
        $admin_bar = route('admin.stores.edit', $store->id);
        return view('Default::web.store.show',compact('meta_seo','breadcrumb', 'store', 'hotProducts', 'admin_bar', 'related_stores'));
    }

}
