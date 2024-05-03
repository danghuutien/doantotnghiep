========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->

                        @php
                            $menu = json_decode(json_encode( config('SudoMenu.menu') ));
                        @endphp
                        <ul class="metismenu list-unstyled" id="side-menu">
                            @if (isset($menu) && !empty($menu))
                            @foreach ($menu as $item)
                                @switch($item->type)
                                    @case('group')
                                        @php
                                            // Kiểm tra quyền
                                            $show = false;
                                            foreach ($item->role ?? [] as $role) {
                                                if (checkRole($role) == true) { $show = true; }
                                            }
                                        @endphp
                                        @if ($show == true)
                                            <li class="menu-title" key="t-menu">@lang($item->name ?? '')</li>
                                        @endif
                                    @break
                                    @case('single')
                                        @php
                                            // Kiểm tra active menu
                                            $active = activeMenu($item->route ?? '', $item->active ?? []);
                                            // echo $active;
                                        @endphp
                                        @if (checkRole($item->role))
                                            <li>
                                                <a href="{{ route($item->route) }}" class="waves-effect {!! $active !!}">
                                                    <i class="{!! $item->icon ?? '' !!}"></i>
                                                    <span key="t-dashboards">@lang($item->name ?? '')</span>
                                                </a>
                                            </li>
                                        @endif
                                    @break
                                    @case('multiple')
                                        @php
                                            // Kiểm tra quyền
                                            $show = false;
                                            $array_active = [];
                                            foreach ($item->childs ?? [] as $childs) {
                                                // Kiểm tra quyền
                                                if (checkRole($childs->role) == true) { $show = true; }
                                                // Kiểm tra active menu
                                                if (isset($childs->route) && !empty($childs->route)) {
                                                    $array_active[] = $childs->route;
                                                }
                                                if (isset($childs->active) && !empty($childs->active)) {
                                                    foreach ($childs->active as $v) {
                                                        $array_active[] = $v;
                                                    }
                                                }
                                            }
                                            $active_parent = '';
                                            // Nếu menu con được active thì mở menu cha
                                            if (in_array(\Route::currentRouteName(), $array_active)) {
                                                $active_parent = 'menu-open';
                                            }
                                        @endphp
                                        @if ($show == true)
                                        <li>
                                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                                <i class="{!! $item->icon ?? '' !!}"></i>
                                                <span key="t-ecommerce">@lang($item->name ?? '')</span>
                                            </a>
                                            <ul class="sub-menu" aria-expanded="false">
                                                @foreach ($item->childs ?? [] as $childs)
                                                @if (checkRole($childs->role))
                                                    @php
                                                        // Kiểm tra active menu
                                                        $active = activeMenu($childs->route ?? '', $childs->active ?? []);
                                                    @endphp
                                                    <li class="{!! $active !!}"><a href="{{ route($childs->route) }}" key="t-products">@lang($childs->name ?? '')</a></li>
                                                @endif
                                                @endforeach
                                            </ul>
                                        </li>
                                        @endif
                                    @break
                                @endswitch
                            @endforeach
                            @endif
                        </ul>
                    </div>
                    <!-- Sidebar -->

                    
                </div>
            </div>
            <!-- Left Sidebar End