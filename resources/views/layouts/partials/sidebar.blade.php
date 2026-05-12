<!-- BEGIN Left Aside -->
<aside class="page-sidebar">
    <div class="page-logo">
        {{-- <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut"> --}}
            <img src="{{ asset('public/back/img/logo.png') }}" alt="SmartAdmin Laravel" aria-roledescription="logo">
            <span class="page-logo-text mr-1">TUK TUK</span>
        {{-- </a> --}}
    </div>
    <!-- BEGIN PRIMARY NAVIGATION -->
    <nav id="js-primary-nav" class="primary-nav" role="navigation">
        <div class="nav-filter">
            <div class="position-relative">
                <input type="text" id="nav_filter_input" placeholder="Filter menu" class="form-control" tabindex="0">
                <a href="#" onclick="return false;" class="btn-primary btn-search-close js-waves-off" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar">
                    <i class="fal fa-chevron-up"></i>
                </a>
            </div>
        </div>
        {{-- <div class="info-card">
            <img src="{{ asset('public/back/img/profileicon.jpg') }}" class="profile-image rounded-circle" alt="Dr. Codex Lantern">
            <div class="info-card-text">
                <a href="#" class="d-flex align-items-center text-white">
                    <span class="text-truncate text-truncate-sm d-inline-block">
                        {{ ucfirst(auth()->user()->name) }}
                        {{ Auth::user()->name }}
                    </span>
                </a>
                <span class="d-inline-block text-truncate text-truncate-sm">TUK TUK</span>
            </div>
            <img src="{{ asset('public/back/img/card-backgrounds/cover-1-lg.png') }}" class="cover" alt="cover">
            <a href="#" onclick="return false;" class="pull-trigger-btn" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar" data-focus="nav_filter_input">
                <i class="fal fa-angle-down"></i>
            </a>
        </div> --}}

        <ul id="js-nav-menu" class="nav-menu">
            @foreach ($menuItems as $item)
            {{-- @foreach ($decodedMenu->{'menuList'} as $key => $value) --}}
                @if(in_array($item->id,$arrParentID))

                    @if($item->is_parent == 1 && $item->child_order == 1)
                        <li class="{{ request()->is($item->url) ? 'active' : '' }}">
                            <a href="{{ url($item->url) }}" title="{{ $item->title }}" data-filter-tags="{{ $item->title }}">
                                <i class="{{ $item->icon }}"></i>
                                <span class="nav-link-text">
                                    {{ $item->title }}
                                </span>
                            </a>
                        </li>
                    @else
                        <li class="{{ request()->is($item->url) ? 'active' : '' }}">
                            <a href="javascript:void(0);" title="{{ $item->title }}" data-filter-tags="{{ $item->title }}">
                                <i class="{{ $item->icon }}"></i>
                                <span class="nav-link-text">{{ $item->title }}
                                </span>
                            </a>
                            <ul>
                                {{-- @for ($i=0; $i < sizeof($value->child); $i++) --}}
                                @foreach($subMenuItems as $subItem)
                                @if($item->id == $subItem->parent_id)
                                @if(in_array($subItem->id,$permissionHave))
                                    <li>
                                        <a href="{{ url($subItem->url) }}" title="{{ $subItem->title }}" data-filter-tags="{{ $subItem->title }}">
                                            <span class="nav-link-text">
                                                {{ $subItem->title }}
                                            </span>
                                            {{-- @if(isset($value->child[$i]->{'spanText'}))
                                            <span class="{{ isset(($value->child[$i]->{'spanClass'})) ? $value->child[$i]->{'spanClass'} : '' }}">{{ $value->child[$i]->{'spanText'} }} jdjsdni</span>
                                            @endif --}}
                                        </a>
                                    </li>
                                    {{-- @endfor --}}
                                @endif
                                @endif
                                @endforeach
                            </ul>
                        </li>

                    {{-- @if($item->is_parent != 1 && $item->) --}}
                    @endif
                @endif
            @endforeach
        </ul>
        <div class="filter-message js-filter-message bg-success-600"></div>
    </nav>
    <div class="nav-footer shadow-top">
        <a href="#" onclick="return false;" data-action="toggle" data-class="nav-function-minify" class="hidden-md-down">
            <i class="ni ni-chevron-right"></i>
            <i class="ni ni-chevron-right"></i>
        </a>
        {{-- <ul class="list-table m-auto nav-footer-buttons">
            <li>
                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Chat logs">
                    <i class="fal fa-comments"></i>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Support Chat">
                    <i class="fal fa-life-ring"></i>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Make a call">
                    <i class="fal fa-phone"></i>
                </a>
            </li>
        </ul> --}}
    </div> <!-- END NAV FOOTER -->
</aside>
<!-- END Left Aside -->
