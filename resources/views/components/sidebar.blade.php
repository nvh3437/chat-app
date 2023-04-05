<div class="leftside-menu">
    @php
        $logo = App\Http\Controllers\Controller::getSetting('logo')->value;
        use App\Http\Controllers\RoleController;
        use Nwidart\Modules\Facades\Module;
        $menus = App\Http\Controllers\Controller::getMenu();
    @endphp
    <a href="{{ route('dashboard-week') }}" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="{{ $logo ? asset('/storage/app/AvnGeneralSettings/' . $logo) : asset('/resources/assets/images/logo.png') }}"
                alt="image" class="img-fluid" width="50">
        </span>
        <span class="logo-sm">
            <img src="{{ $logo ? asset('/storage/app/AvnGeneralSettings/' . $logo) : asset('/resources/assets/images/logo.png') }}"
                alt="image" class="img-fluid" width="50">
        </span>
    </a>
    <a href="{{ route('dashboard-week') }}" class="logo text-center logo-dark">
        <span class="logo-lg">
            <img src="{{ $logo ? asset('/storage/app/AvnGeneralSettings/' . $logo) : asset('/resources/assets/images/logo.png') }}"
                alt="image" class="img-fluid" width="50">
        </span>
        <span class="logo-sm">
            <img src="{{ $logo ? asset('/storage/app/AvnGeneralSettings/' . $logo) : asset('/resources/assets/images/logo.png') }}"
                alt="image" class="img-fluid" width="50">
        </span>
    </a>
    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <ul class="side-nav">
            <li class="side-nav-item no-child">
                <a href="{{ route('dashboard-week') }}" class="side-nav-link">
                    <i class="uil-tachometer-fast"></i>
                        <span>Trang chủ </span>
                </a>
            </li>
            @foreach ($menus as $menu)
                @if (($menu->module == null || ($menu->module != null && Module::find($menu->module)->isEnabled() == 1)) && RoleController::isNotBlock($menu)  && $menu->route_name != 'dashboard')
                    @if ($menu->parent == 0 && count($menu->childrens) > 0)
                        <li class="side-nav-item parent">
                            <a data-bs-toggle="collapse" href="#sidebar-{{ $menu->id }}"
                                aria-controls="sidebar-{{ $menu->id }}" class="side-nav-link">
                                <i class="{{ $menu->icon }}"></i>
                                <span> {{ $menu->label }} </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebar-{{ $menu->id }}" style="">
                                <ul class="side-nav-second-level">
                                    @foreach ($menu->childrens as $children)
                                        @if (($children->menu == null ||
                                            ($children->menu != null && Module::find($children->module)->isEnabled() == 1)) &&
                                            RoleController::isNotBlock($children))
                                            @if (count($children->childrens) <= 0)
                                                <li class="children">
                                                    <a
                                                        href="{{ route($children->route_name) }}">{{ $children->label }}</a>
                                                </li>
                                            @else
                                                <li class="side-nav-item children parent-1">
                                                    <a data-bs-toggle="collapse"
                                                        href="#siber-third-{{ $children->id }}" aria-expanded="false"
                                                        aria-controls="siber-third-{{ $children->id }}">
                                                        <span> {{ $children->label }} </span>
                                                        <span class="menu-arrow"></span>
                                                    </a>
                                                    <div class="collapse" id="siber-third-{{ $children->id }}">
                                                        <ul class="side-nav-third-level">
                                                            @foreach ($children->childrens as $children1)
                                                                @if (($children1->module == null ||
                                                                    ($children1->module != null && Module::find($children1->module)->isEnabled() == 1)) &&
                                                                    RoleController::isNotBlock($children1))
                                                                    <li class="children-1">
                                                                        <a
                                                                            href="{{ route($children1->route_name) }}">{{ $children1->label }}</a>
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </li>
                                            @endif
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                    @elseif($menu->parent == 0 && $menu->route_name != 'dashboard')
                        <li class="side-nav-item no-child">
                            <a href="{{ route($menu->route_name) }}" class="side-nav-link">
                                <i class="{{ $menu->icon }}"></i>
                                <span>{{ $menu->label }}</span>
                            </a>
                        </li>
                    @endif
                @endif
            @endforeach
        </ul>
        <div class="clearfix"></div>
    </div>
</div>

