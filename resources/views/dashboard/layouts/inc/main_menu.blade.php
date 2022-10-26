<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item"><a class="navbar-brand" href="{{ route('dashboard.home') }}">
                <span class="brand-logo">
                    <img src="{{ image_or_placeholder($Settings->dashboard_logo_full_path) }}" alt="{{$Settings->name}}">   
                </span>
                    <h2 class="brand-text" style="color: black">{{ $Settings->name }}</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" style="margin: 27px 0;" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    
    <div class="shadow-bottom"></div>

    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" style="margin-bottom: 30px; margin-top: 30px;">

            <li class="nav-item @if (itemIsActive('dashboard', 'home')) {{'active'}} @endif">
                <a class="d-flex align-items-center" href="{{ route('dashboard.home') }}">
                    <i data-feather="home"></i>
                    <span class="menu-title text-truncate" data-i18n="Home">الرئيسية</span>
                </a>
            </li>

            @if(auth()->user()->canany(['super', 'reports-list']))
                <li class="nav-item @if (itemIsActive('reports', 'index')) {{'active'}} @endif">
                    <a class="d-flex align-items-center" href="{{ route('dashboard.reports.index') }}">
                        <i data-feather='pie-chart'></i>
                        <span class="menu-title text-truncate" data-i18n="Reports">التقرير</span>
                    </a>
                </li>
            @endif

            {{-- @if(auth()->user()->canany(['super', 'reports-list']))
                <li class="nav-item ">
                    <a class="d-flex align-items-center" href="#">
                        <i data-feather='dollar-sign'></i>
                        <span class="menu-title text-truncate" data-i18n="Reports">مراقبة حركة الرصيد</span>
                    </a>
                </li>
            @endif --}}

            @if(auth()->user()->canany(['super', 'merchants-list', 'merchants-show', 'merchants-create', 'merchants-edit', 'merchants-destroy']))
                <li class="navigation-header"><span data-i18n="merchants">المستخدمين</span><i data-feather="more-horizontal"></i></li>
            @endif

            @if(auth()->user()->canany(['super', 'distributors-show', 'distributors-create', 'distributors-edit', 'distributors-destroy']))
                <li class="nav-item has-sub @if(isActive('distributors')) {{ 'sidebar-group-active open'}} @endif">
                    <a class="d-flex align-items-center" href="#">
                        <i data-feather='user-plus'></i>
                        <span class="menu-title text-truncate" data-i18n="distributors">الموزعين</span>
                    </a>
                    <ul class="menu-content">
                        @if(auth()->user()->canany(['super', 'distributors-show', 'distributors-create', 'distributors-edit', 'distributors-destroy']))
                            <li class="@if (itemIsActive('distributors', 'index')) {{'active'}} @endif">
                                <a class="d-flex align-items-center" href="{{ route('dashboard.distributors.index') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="List">عرض</span>
                                </a>
                            </li>
                        @endif
                        @if(auth()->user()->canany(['super', 'distributors-create']))
                            <li class="@if (itemIsActive('distributors', 'create')) {{'active'}} @endif">
                                <a class="d-flex align-items-center" href="{{ route('dashboard.distributors.create') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="New">اضافة</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if(auth()->user()->canany(['super', 'merchants-show', 'merchants-create', 'merchants-edit', 'merchants-destroy']))
                <li class="nav-item has-sub @if(isActive('merchants')) {{ 'sidebar-group-active open'}} @endif">
                    <a class="d-flex align-items-center" href="#">
                        <i data-feather='user'></i>
                        <span class="menu-title text-truncate" data-i18n="merchants">التجار</span>
                    </a>
                    <ul class="menu-content">
                        @if(auth()->user()->canany(['super', 'merchants-show', 'merchants-create', 'merchants-edit', 'merchants-destroy']))
                            <li class="@if (itemIsActive('merchants', 'index')) {{'active'}} @endif">
                                <a class="d-flex align-items-center" href="{{ route('dashboard.merchants.index') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="List">عرض</span>
                                </a>
                            </li>
                        @endif
                        @if(auth()->user()->canany(['super', 'merchants-create']))
                            <li class="@if (itemIsActive('merchants', 'create')) {{'active'}} @endif">
                                <a class="d-flex align-items-center" href="{{ route('dashboard.merchants.create') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="New">اضافة</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            <li class="nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather='users'></i>
                    <span class="menu-title text-truncate" data-i18n="Users">العميل</span>
                    <span class="badge badge-light-success badge-pill ml-auto mr-1">قريباً</span>

                </a>
            </li>

            <li class="nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather='layers'></i>
                    <span class="menu-title text-truncate" data-i18n="Mall">المولات</span>
                    <span class="badge badge-light-success badge-pill ml-auto mr-1">قريباً</span>
                </a>
            </li>
            



            @if(auth()->user()->canany(['super', 
                'indebtedness-list', 'indebtedness-show', 'indebtedness-create', 'indebtedness-edit', 'indebtedness-delete',
                'pledges-list', 'pledges-show', 'pledges-create', 'pledges-edit', 'pledges-delete',
                'compensation-list', 'compensation-show', 'compensation-create', 'compensation-edit', 'compensation-delete',
               

            ]))
                <li class="navigation-header"><span data-i18n="Main Section">العمليات</span><i data-feather="more-horizontal"></i></li>
            @endif

            
            {{-- @if(auth()->user()->canany(['super', 'lines-list', 'lines-show', 'lines-create', 'lines-edit', 'lines-destroy']))
                <li class="nav-item has-sub @if(isActive('lines')) {{ 'sidebar-group-active open'}} @endif">
                    <a class="d-flex align-items-center" href="#">
                        <i data-feather='clipboard'></i>
                        <span class="menu-title text-truncate" data-i18n="Lines">التحصيلات والتحويلات</span>
                    </a>
                    <ul class="menu-content">
                        @if(auth()->user()->canany(['super', 'lines-list', 'lines-show', 'lines-create', 'lines-edit', 'lines-destroy']))
                            <li class="@if (itemIsActive('lines', 'index')) {{'active'}} @endif">
                                <a class="d-flex align-items-center" href="{{ route('dashboard.lines.index') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="List">عرض</span>
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->canany(['super', 'lines-create']))
                            <li class="@if (itemIsActive('lines', 'create')) {{'active'}} @endif">
                                <a class="d-flex align-items-center" href="{{ route('dashboard.lines.create') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="New">اضافة</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif --}}

            
            @if(auth()->user()->canany(['super', 'pledges-list', 'pledges-show', 'pledges-create', 'pledges-edit', 'pledges-destroy']))
                <li class="nav-item has-sub @if(isActive('pledges')) {{ 'sidebar-group-active open'}} @endif">
                    <a class="d-flex align-items-center" href="#">
                        <i data-feather='inbox'></i>
                        <span class="menu-title text-truncate" data-i18n="Lines">العهود</span>
                    </a>
                    <ul class="menu-content">
                        @if(auth()->user()->canany(['super', 'pledges-list', 'pledges-show', 'pledges-create', 'pledges-edit', 'pledges-destroy']))
                            <li class="@if (itemIsActive('pledges', 'index')) {{'active'}} @endif">
                                <a class="d-flex align-items-center" href="{{ route('dashboard.pledges.index') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="List">عمليات التعهيد</span>
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->canany(['super', 'pledges-create']))
                            <li class="@if (itemIsActive('pledges', 'create')) {{'active'}} @endif">
                                <a class="d-flex align-items-center" href="{{ route('dashboard.pledges.create') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="New">اضافة عهدة</span>
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->canany(['super', 'collect-pledges-list', 'collect-pledges-show', 'collect-pledges-create', 'collect-pledges-edit', 'collect-pledges-destroy']))
                            <li class="@if (itemIsActive('collect-pledges', 'index')) {{'active'}} @endif">
                                <a class="d-flex align-items-center" href="{{ route('dashboard.collect-pledges.index') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="List">عمليات تحصيل العهد</span>
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->canany(['super', 'collect-pledges-create']))
                            <li class="@if (itemIsActive('collect-pledges', 'create')) {{'active'}} @endif">
                                <a class="d-flex align-items-center" href="{{ route('dashboard.collect-pledges.create') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="New">اضافة عملية تحصيل</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            
            

            @if(auth()->user()->canany(['super', 'indebtedness-list', 'indebtedness-show', 'indebtedness-create', 'indebtedness-edit', 'indebtedness-destroy']))
                <li class="nav-item has-sub @if(isActive('indebtedness')) {{ 'sidebar-group-active open'}} @endif">
                    <a class="d-flex align-indebtedness-center" href="#">
                        <i data-feather='file-text'></i>
                        <span class="menu-title text-truncate" data-i18n="Items">المديونيات</span>
                    </a>
                    <ul class="menu-content">
                        @if(auth()->user()->canany(['super', 'indebtedness-list', 'indebtedness-show', 'indebtedness-create', 'indebtedness-edit', 'indebtedness-destroy']))
                            <li class="@if (itemIsActive('indebtedness', 'index')) {{'active'}} @endif">
                                <a class="d-flex align-indebtedness-center" href="{{ route('dashboard.indebtedness.index') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="List">عمليات الاستدانة</span>
                                </a>
                            </li>
                        @endif
                        @if(auth()->user()->canany(['super', 'indebtedness-create']))
                            <li class="@if (itemIsActive('indebtedness', 'create')) {{'active'}} @endif">
                                <a class="d-flex align-indebtedness-center" href="{{ route('dashboard.indebtedness.create') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="New">اضافة عملية استدانة</span>
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->canany(['super', 'collect-indebtedness-list', 'collect-indebtedness-show', 'collect-indebtedness-create', 'collect-indebtedness-edit', 'collect-indebtedness-destroy']))
                            <li class="@if (itemIsActive('collect-indebtedness', 'index')) {{'active'}} @endif">
                                <a class="d-flex align-collect-indebtedness-center" href="{{ route('dashboard.collect-indebtedness.index') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="List">عمليات تحصيل الدين</span>
                                </a>
                            </li>
                        @endif
                        @if(auth()->user()->canany(['super', 'collect-indebtedness-create']))
                            <li class="@if (itemIsActive('collect-indebtedness', 'create')) {{'active'}} @endif">
                                <a class="d-flex align-collect-indebtedness-center" href="{{ route('dashboard.collect-indebtedness.create') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="New">اضافة عملية تحصيل دين</span>
                                </a>
                            </li>
                        @endif
                        
                    </ul>
                </li>
            @endif

            
            @if(auth()->user()->canany(['super', 'compensation-list', 'compensation-show', 'compensation-create', 'compensation-edit', 'compensation-destroy']))
                <li class="nav-item has-sub @if(isActive('compensation')) {{ 'sidebar-group-active open'}} @endif">
                    <a class="d-flex align-compensation-center" href="#">
                        <i data-feather='smile'></i>
                        <span class="menu-title text-truncate" data-i18n="Items">التعويضات</span>
                    </a>
                    <ul class="menu-content">
                        @if(auth()->user()->canany(['super', 'compensation-list', 'compensation-show', 'compensation-create', 'compensation-edit', 'compensation-destroy']))
                            <li class="@if (itemIsActive('compensation', 'index')) {{'active'}} @endif">
                                <a class="d-flex align-compensation-center" href="{{ route('dashboard.compensation.index') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="List">عرض</span>
                                </a>
                            </li>
                        @endif
                        @if(auth()->user()->canany(['super', 'compensation-create']))
                            <li class="@if (itemIsActive('compensation', 'create')) {{'active'}} @endif">
                                <a class="d-flex align-compensation-center" href="{{ route('dashboard.compensation.create') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="New">اضافة</span>
                                </a>
                            </li>
                        @endif
                        
                    </ul>
                </li>
            @endif

            {{-- <li class="nav-item @if (itemIsActive('compensation', 'index')) {{'active'}} @endif">
                <a class="d-flex align-items-center" href="{{ route('dashboard.compensation.index') }}">
                    <i data-feather='smile'></i>
                    <span class="menu-title text-truncate" data-i18n="Products">التعويضات</span>
                </a>
            </li> --}}

            @if(auth()->user()->canany(['super', 'profit-withdrawal-requests-list', 'profit-withdrawal-requests-show', 'profit-withdrawal-requests-create', 'profit-withdrawal-requests-edit', 'profit-withdrawal-requests-destroy']))
                <li class="nav-item has-sub @if(isActive('profit-withdrawal-requests')) {{ 'sidebar-group-active open'}} @endif">
                    <a class="d-flex align-profit-withdrawal-requests-center" href="#">
                        <i data-feather='file-minus'></i>
                        <span class="menu-title text-truncate" data-i18n="Items">طلبات سحب الارباح</span>
                    </a>
                    <ul class="menu-content">
                        @if(auth()->user()->canany(['super', 'profit-withdrawal-requests-list', 'profit-withdrawal-requests-show', 'profit-withdrawal-requests-create', 'profit-withdrawal-requests-edit', 'profit-withdrawal-requests-destroy']))
                            <li class="@if (itemIsActive('profit-withdrawal-requests', 'index')) {{'active'}} @endif">
                                <a class="d-flex align-profit-withdrawal-requests-center" href="{{ route('dashboard.profit-withdrawal-requests.index') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="List">عرض الجميع</span>
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->canany(['super', 'profit-withdrawal-requests-list', 'profit-withdrawal-requests-show', 'profit-withdrawal-requests-create', 'profit-withdrawal-requests-edit', 'profit-withdrawal-requests-destroy']))
                            <li class="@if (itemIsActive('profit-withdrawal-requests', 'new')) {{'active'}} @endif">
                                <a class="d-flex align-profit-withdrawal-requests-center" href="{{ route('dashboard.profit-withdrawal-requests.new') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="List">عرض الطلبات الجديدة</span>
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->canany(['super', 'profit-withdrawal-requests-list', 'profit-withdrawal-requests-show', 'profit-withdrawal-requests-create', 'profit-withdrawal-requests-edit', 'profit-withdrawal-requests-destroy']))
                            <li class="@if (itemIsActive('profit-withdrawal-requests', 'watched')) {{'active'}} @endif">
                                <a class="d-flex align-profit-withdrawal-requests-center" href="{{ route('dashboard.profit-withdrawal-requests.watched') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="List">عرض الطلبات المفتوحة</span>
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->canany(['super', 'profit-withdrawal-requests-list', 'profit-withdrawal-requests-show', 'profit-withdrawal-requests-create', 'profit-withdrawal-requests-edit', 'profit-withdrawal-requests-destroy']))
                            <li class="@if (itemIsActive('profit-withdrawal-requests', 'accepted')) {{'active'}} @endif">
                                <a class="d-flex align-profit-withdrawal-requests-center" href="{{ route('dashboard.profit-withdrawal-requests.accepted') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="List">عرض الطلبات المقبولة</span>
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->canany(['super', 'profit-withdrawal-requests-list', 'profit-withdrawal-requests-show', 'profit-withdrawal-requests-create', 'profit-withdrawal-requests-edit', 'profit-withdrawal-requests-destroy']))
                            <li class="@if (itemIsActive('profit-withdrawal-requests', 'transferred')) {{'active'}} @endif">
                                <a class="d-flex align-profit-withdrawal-requests-center" href="{{ route('dashboard.profit-withdrawal-requests.transferred') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="List">عرض الطلبات المحولة</span>
                                </a>
                            </li>
                        @endif
                        @if(auth()->user()->canany(['super', 'profit-withdrawal-requests-list', 'profit-withdrawal-requests-show', 'profit-withdrawal-requests-create', 'profit-withdrawal-requests-edit', 'profit-withdrawal-requests-destroy']))
                            <li class="@if (itemIsActive('profit-withdrawal-requests', 'rejected')) {{'active'}} @endif">
                                <a class="d-flex align-profit-withdrawal-requests-center" href="{{ route('dashboard.profit-withdrawal-requests.rejected') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="List">عرض الطلبات المرفوضة</span>
                                </a>
                            </li>
                        @endif
                        
                    </ul>
                </li>
            @endif

            {{-- <li class="nav-item @if (itemIsActive('profit-withdrawal-requests', 'index')) {{'active'}} @endif">
                <a class="d-flex align-items-center" href="{{route('dashboard.profit-withdrawal-requests.index')}}">
                    <i data-feather='file-minus'></i>
                    <span class="menu-title text-truncate" data-i18n="Products">طلبات سحب الارباح</span>
                </a>
            </li> --}}

            {{-- <li class="nav-item @if (itemIsActive('add-credit-withdrawal-requests', 'index')) {{'active'}} @endif">
                <a class="d-flex align-items-center" href="{{route('dashboard.add-credit-withdrawal-requests.index')}}">
                    <i data-feather='file-plus'></i>
                    <span class="menu-title text-truncate" data-i18n="Products">طلبات اضافة رصيد</span>
                </a>
            </li> --}}

            @if(auth()->user()->canany(['super', 'add-credit-withdrawal-requests-list', 'add-credit-withdrawal-requests-show', 'add-credit-withdrawal-requests-create', 'add-credit-withdrawal-requests-edit', 'add-credit-withdrawal-requests-destroy']))
                <li class="nav-item has-sub @if(isActive('add-credit-withdrawal-requests')) {{ 'sidebar-group-active open'}} @endif">
                    <a class="d-flex align-add-credit-withdrawal-requests-center" href="#">
                        <i data-feather='file-plus'></i>
                        <span class="menu-title text-truncate" data-i18n="Items">طلبات اضافة رصيد</span>
                    </a>
                    <ul class="menu-content">
                        @if(auth()->user()->canany(['super', 'add-credit-withdrawal-requests-list', 'add-credit-withdrawal-requests-show', 'add-credit-withdrawal-requests-create', 'add-credit-withdrawal-requests-edit', 'add-credit-withdrawal-requests-destroy']))
                            <li class="@if (itemIsActive('add-credit-withdrawal-requests', 'index')) {{'active'}} @endif">
                                <a class="d-flex align-add-credit-withdrawal-requests-center" href="{{ route('dashboard.add-credit-withdrawal-requests.index') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="List">عرض الجميع</span>
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->canany(['super', 'add-credit-withdrawal-requests-list', 'add-credit-withdrawal-requests-show', 'add-credit-withdrawal-requests-create', 'add-credit-withdrawal-requests-edit', 'add-credit-withdrawal-requests-destroy']))
                            <li class="@if (itemIsActive('add-credit-withdrawal-requests', 'new')) {{'active'}} @endif">
                                <a class="d-flex align-add-credit-withdrawal-requests-center" href="{{ route('dashboard.add-credit-withdrawal-requests.new') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="List">عرض الطلبات الجديدة</span>
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->canany(['super', 'add-credit-withdrawal-requests-list', 'add-credit-withdrawal-requests-show', 'add-credit-withdrawal-requests-create', 'add-credit-withdrawal-requests-edit', 'add-credit-withdrawal-requests-destroy']))
                            <li class="@if (itemIsActive('add-credit-withdrawal-requests', 'watched')) {{'active'}} @endif">
                                <a class="d-flex align-add-credit-withdrawal-requests-center" href="{{ route('dashboard.add-credit-withdrawal-requests.watched') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="List">عرض الطلبات المفتوحة</span>
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->canany(['super', 'add-credit-withdrawal-requests-list', 'add-credit-withdrawal-requests-show', 'add-credit-withdrawal-requests-create', 'add-credit-withdrawal-requests-edit', 'add-credit-withdrawal-requests-destroy']))
                            <li class="@if (itemIsActive('add-credit-withdrawal-requests', 'accepted')) {{'active'}} @endif">
                                <a class="d-flex align-add-credit-withdrawal-requests-center" href="{{ route('dashboard.add-credit-withdrawal-requests.accepted') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="List">عرض الطلبات المقبولة</span>
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->canany(['super', 'add-credit-withdrawal-requests-list', 'add-credit-withdrawal-requests-show', 'add-credit-withdrawal-requests-create', 'add-credit-withdrawal-requests-edit', 'add-credit-withdrawal-requests-destroy']))
                            <li class="@if (itemIsActive('add-credit-withdrawal-requests', 'transferred')) {{'active'}} @endif">
                                <a class="d-flex align-add-credit-withdrawal-requests-center" href="{{ route('dashboard.add-credit-withdrawal-requests.transferred') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="List">عرض الطلبات المحولة</span>
                                </a>
                            </li>
                        @endif
                        @if(auth()->user()->canany(['super', 'add-credit-withdrawal-requests-list', 'add-credit-withdrawal-requests-show', 'add-credit-withdrawal-requests-create', 'add-credit-withdrawal-requests-edit', 'add-credit-withdrawal-requests-destroy']))
                            <li class="@if (itemIsActive('add-credit-withdrawal-requests', 'rejected')) {{'active'}} @endif">
                                <a class="d-flex align-add-credit-withdrawal-requests-center" href="{{ route('dashboard.add-credit-withdrawal-requests.rejected') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="List">عرض الطلبات المرفوضة</span>
                                </a>
                            </li>
                        @endif
                        
                    </ul>
                </li>
            @endif

            @if(auth()->user()->canany(['super', 
                'companies-list', 'companies-show', 'companies-create', 'companies-edit', 'companies-delete',
                'services-list', 'services-show', 'services-create', 'services-edit', 'services-delete',
                'specialties-list', 'specialties-show', 'specialties-create', 'specialties-edit', 'specialties-delete',


            ]))
                <li class="navigation-header"><span data-i18n="Main Section">الخدمات</span><i data-feather="more-horizontal"></i></li>
            @endif

            @if(auth()->user()->canany(['super', 'companies-list', 'companies-show', 'companies-create', 'companies-edit', 'companies-destroy']))
                <li class="nav-item has-sub @if(isActive('companies')) {{ 'sidebar-group-active open'}} @endif">
                    <a class="d-flex align-items-center" href="#">
                        <i data-feather='hash'></i>
                        <span class="menu-title text-truncate" data-i18n="Offices">الشركات</span>
                    </a>
                    <ul class="menu-content">
                        @if(auth()->user()->canany(['super', 'companies-list', 'companies-show', 'companies-create', 'companies-edit', 'companies-destroy']))
                            <li class="@if (itemIsActive('companies', 'index')) {{'active'}} @endif">
                                <a class="d-flex align-items-center" href="{{ route('dashboard.companies.index') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="List">عرض</span>
                                </a>
                            </li>
                        @endif
                        @if(auth()->user()->canany(['super', 'companies-create']))
                            <li class="@if (itemIsActive('companies', 'create')) {{'active'}} @endif">
                                <a class="d-flex align-items-center" href="{{ route('dashboard.companies.create') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="New">اضافة</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            <li class="nav-item @if (itemIsActive('dashboard', 'services')) {{'active'}} @endif">
                <a class="d-flex align-items-center" href="{{ route('dashboard.services.index') }}">
                    <i data-feather='grid'></i>
                    <span class="menu-title text-truncate" data-i18n="Products">ادارة الخدمات</span>
                </a>
            </li>

            @if(auth()->user()->canany(['super', 'cards-service-companies-list', 'cards-service-companies-show', 'cards-service-companies-create', 'cards-service-companies-edit', 'cards-service-companies-destroy']))
                <li class="nav-item has-sub @if(isActive('cards-service-companies')) {{ 'sidebar-group-active open'}} @endif">
                    <a class="d-flex align-items-center" href="#">
                        <i data-feather='credit-card'></i>
                        <span class="menu-title text-truncate" data-i18n="Offices">خدمة البطاقات</span>
                    </a>
                    <ul class="menu-content">
                        @if(auth()->user()->canany(['super', 'cards-service-companies-list', 'cards-service-companies-show', 'cards-service-companies-create', 'cards-service-companies-edit', 'cards-service-companies-destroy']))
                            <li class="@if (itemIsActive('cards-service-companies', 'index')) {{'active'}} @endif">
                                <a class="d-flex align-items-center" href="{{ route('dashboard.cards-service-companies.index') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="List">حالة الخدمة للشركات</span>
                                </a>
                            </li>
                        @endif
                        @if(auth()->user()->canany(['super', 'merchant-packages-list']))
                            <li class="@if (itemIsActive('merchant-packages', 'index')) {{'active'}} @endif">
                                <a class="d-flex align-items-center" href="{{ route('dashboard.merchant-packages.index') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="New">باقات التجار</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            {{-- <li class="nav-item @if (itemIsActive('dashboard', 'cards-service-companies')) {{'active'}} @endif">
                <a class="d-flex align-items-center" href="{{ route('dashboard.cards-service-companies.index') }}">
                    <i data-feather='credit-card'></i>
                    <span class="menu-title text-truncate" data-i18n="Products">خدمة البطاقات</span>
                </a>
            </li> --}}

            <li class="nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather='rss'></i>
                    <span class="menu-title text-truncate" data-i18n="Products">شحن على الطاير</span>
                    <span class="badge badge-light-success badge-pill ml-auto mr-1">قريباً</span>
                </a>
            </li>


            {{-- @if(auth()->user()->canany(['super', 'products-list', 'products-show', 'products-create', 'products-edit', 'products-destroy']))
                <li class="nav-item has-sub @if(isActive('products')) {{ 'sidebar-group-active open'}} @endif">
                    <a class="d-flex align-items-center" href="#">
                        <i data-feather='package'></i>
                        <span class="menu-title text-truncate" data-i18n="Products">البطاقات</span>
                    </a>
                    <ul class="menu-content">
                        @if(auth()->user()->canany(['super', 'products-list', 'products-show', 'products-create', 'products-edit', 'products-destroy']))
                            <li class="@if (itemIsActive('products', 'index')) {{'active'}} @endif">
                                <a class="d-flex align-items-center" href="{{ route('dashboard.products.index') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="List">عرض</span>
                                </a>
                            </li>
                        @endif
                        @if(auth()->user()->canany(['super', 'products-create']))
                            <li class="@if (itemIsActive('products', 'create')) {{'active'}} @endif">
                                <a class="d-flex align-items-center" href="{{ route('dashboard.products.create') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="New">اضافة</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif --}}
            

            @if(auth()->user()->canany(['super',
                'roles-list', 'roles-show', 'roles-create', 'roles-edit', 'roles-delete',
                'staff-list', 'staff-show', 'staff-create', 'staff-edit', 'staff-delete',
                'settings-show', 'settings-edit',
            ]))
                <li class="navigation-header"><span data-i18n="Settings && Staff">الاعدادات والمشرفين</span><i data-feather="more-horizontal"></i></li>
            @endif

            @if(auth()->user()->canany(['super', 'roles-list', 'roles-show', 'roles-create', 'roles-edit', 'roles-destroy']))
                <li class="nav-item has-sub @if(isActive('roles')) {{ 'sidebar-group-active open'}} @endif">
                    <a class="d-flex align-items-center" href="#">
                        <i data-feather='pocket'></i>
                        <span class="menu-title text-truncate" data-i18n="Roles">الادوار</span>
                    </a>
                    <ul class="menu-content">
                        @if(auth()->user()->canany(['super', 'roles-list', 'roles-show', 'roles-create', 'roles-edit', 'roles-destroy']))
                            <li class="@if (itemIsActive('roles', 'index')) {{'active'}} @endif">
                                <a class="d-flex align-items-center" href="{{ route('dashboard.roles.index') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="List">عرض</span>
                                </a>
                            </li>
                        @endif
                        @if(auth()->user()->canany(['super', 'roles-create']))
                            <li class="@if (itemIsActive('roles', 'create')) {{'active'}} @endif">
                                <a class="d-flex align-items-center" href="{{ route('dashboard.roles.create') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="New">اضافة</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            

            @if(auth()->user()->canany(['super', 'staff-list', 'staff-show', 'staff-create', 'staff-edit', 'staff-destroy']))
                <li class="nav-item has-sub @if(isActive('staff')) {{ 'sidebar-group-active open'}} @endif">
                    <a class="d-flex align-items-center" href="#">
                        <i data-feather='user-check'></i>
                        <span class="menu-title text-truncate" data-i18n="Staff">المشرفين</span>
                    </a>
                    <ul class="menu-content">
                        @if(auth()->user()->canany(['super', 'staff-list', 'staff-show', 'staff-create', 'staff-edit', 'staff-destroy']))
                            <li class="@if (itemIsActive('staff', 'index')) {{'active'}} @endif">
                                <a class="d-flex align-items-center" href="{{ route('dashboard.staff.index') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="List">عرض</span>
                                </a>
                            </li>
                        @endif
                        @if(auth()->user()->canany(['super', 'staff-create']))
                            <li class="@if (itemIsActive('staff', 'create')) {{'active'}} @endif">
                                <a class="d-flex align-items-center" href="{{ route('dashboard.staff.create') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="New">اضافة</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            
            @if(auth()->user()->canany(['super', 'general-settings-edi']))
                <li class="nav-item has-sub @if(isActive('settings')) {{ 'sidebar-group-active open'}} @endif">
                    <a class="d-flex align-items-center" href="#">
                        <i data-feather='settings'></i>
                        <span class="menu-title text-truncate" data-i18n="Settings">الاعدادات</span>
                    </a>
                    <ul class="menu-content">
                        @if(auth()->user()->canany(['super', 'general-settings-edit']))
                            <li class="@if (itemIsActive('settings', 'general')) {{'active'}} @endif">
                                <a class="d-flex align-items-center" href="{{ route('dashboard.settings.general') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="General">الاعدادات العامة</span>
                                </a>
                            </li>
                        @endif

                        {{-- @if(auth()->user()->canany(['super', 'smtp-settings-edit']))
                            <li class="@if (itemIsActive('settings', 'seo')) {{'active'}} @endif">
                                <a class="d-flex align-items-center" href="{{ route('dashboard.settings.seo') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="SEO">SEO</span>
                                </a>
                            </li>
                        @endif --}}
                    
                        @if(auth()->user()->canany(['super', 'smtp-settings-edit']))
                            <li class="@if (itemIsActive('settings', 'smtp')) {{'active'}} @endif">
                                <a class="d-flex align-items-center" href="{{ route('dashboard.settings.smtp') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="SMTP">اعدادات الـ SMTP</span>
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->canany(['super', 'merchants-app-edit']))
                            <li class="@if (itemIsActive('settings', 'merchants-app')) {{'active'}} @endif">
                                <a class="d-flex align-items-center" href="{{ route('dashboard.settings.merchants-app') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="Merchants App">تطبيق التاجر</span>
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->canany(['super', 'distributors-app-edit']))
                            <li class="@if (itemIsActive('settings', 'distributors-app')) {{'active'}} @endif">
                                <a class="d-flex align-items-center" href="{{ route('dashboard.settings.distributors-app') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="Distributors APP">تطبيق الموزع</span>
                                </a>
                            </li>
                        @endif

                        {{-- @if(auth()->user()->canany(['super', 'distributors-app-edit'])) --}}
                            <li >
                                <a class="d-flex align-items-center" href="#">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="Distributors APP">تطبيق المستخدم العادي</span>
                                    <span class="badge badge-light-success badge-pill ml-auto mr-1">قريباً</span>
                                </a>
                            </li>
                        {{-- @endif --}}

                        {{-- @if(auth()->user()->canany(['super', 'distributors-app-edit'])) --}}
                            <li >
                                <a class="d-flex align-items-center" href="#">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="Distributors APP">تطبيق المولات</span>
                                    <span class="badge badge-light-success badge-pill ml-auto mr-1">قريباً</span>
                                </a>
                            </li>
                        {{-- @endif --}}
                    </ul>
                </li>
            @endif


            

            @if(auth()->user()->canany(['super', 
                'companies-list', 'companies-show', 'companies-create', 'companies-edit', 'companies-delete',

            ]))
                <li class="navigation-header"><span data-i18n="Main Section">الدعم الفني ومراقبة الحسابات</span><i data-feather="more-horizontal"></i></li>
            @endif



            {{-- @if(auth()->user()->canany(['super', 'roles-list', 'roles-show', 'roles-create', 'roles-edit', 'roles-destroy']))
                <li class="nav-item has-sub @if(isActive('roles')) {{ 'sidebar-group-active open'}} @endif">
                    <a class="d-flex align-items-center" href="#">
                        <i data-feather='tool'></i>
                        <span class="menu-title text-truncate" data-i18n="Roles">الدعم الفني</span>
                        <span class="badge badge-light-danger badge-pill ml-auto mr-2">2</span>
                    </a>
                    <ul class="menu-content">
                        
                        @if(auth()->user()->canany(['super', 'roles-create']))
                            <li>
                                <a class="d-flex align-items-center" href="#">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="New">الموزعين</span>
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->canany(['super', 'roles-list', 'roles-show', 'roles-create', 'roles-edit', 'roles-destroy']))
                            <li >
                                <a class="d-flex align-items-center" href="#">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="List">التجار</span>
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->canany(['super', 'roles-create']))
                            <li>
                                <a class="d-flex align-items-center" href="#">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="New">العميل</span>
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->canany(['super', 'roles-create']))
                            <li>
                                <a class="d-flex align-items-center" href="#">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="New">المولات</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif --}}

            {{-- @if(auth()->user()->canany(['super', 'roles-list', 'roles-show', 'roles-create', 'roles-edit', 'roles-destroy']))
                <li class="nav-item has-sub @if(isActive('roles')) {{ 'sidebar-group-active open'}} @endif">
                    <a class="d-flex align-items-center" href="#">
                        <i data-feather='eye'></i>
                        <span class="menu-title text-truncate" data-i18n="Roles">انشطة الحسابات</span>
                    </a>
                    <ul class="menu-content">
                        @if(auth()->user()->canany(['super', 'roles-list', 'roles-show', 'roles-create', 'roles-edit', 'roles-destroy']))
                            <li>
                                <a class="d-flex align-items-center" href="#">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="List">المشرفين</span>
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->canany(['super', 'roles-list', 'roles-show', 'roles-create', 'roles-edit', 'roles-destroy']))
                            <li>
                                <a class="d-flex align-items-center" href="#">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="List">التجار</span>
                                </a>
                            </li>
                        @endif
                        @if(auth()->user()->canany(['super', 'roles-create']))
                            <li>
                                <a class="d-flex align-items-center" href="#">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="New">الموزعين</span>
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->canany(['super', 'roles-create']))
                            <li>
                                <a class="d-flex align-items-center" href="#">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="New">المستخدم العادي</span>
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->canany(['super', 'roles-create']))
                            <li>
                                <a class="d-flex align-items-center" href="#">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="New">المولات</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif --}}

            @if(auth()->user()->canany(['super', 'help-list', 'help-show', 'help-create', 'help-edit', 'help-destroy']))
                <li class="nav-item has-sub @if(isActive('help')) {{ 'sidebar-group-active open'}} @endif">
                    <a class="d-flex align-help-center" href="#">
                        <i data-feather='tool'></i>
                        <span class="menu-title text-truncate" data-i18n="Items">الدعم الفني</span>
                    </a>
                    <ul class="menu-content">
                        @if(auth()->user()->canany(['super', 'help-list', 'help-show', 'help-create', 'help-edit', 'help-destroy']))
                            <li class="@if (itemIsActive('help', 'index')) {{'active'}} @endif">
                                <a class="d-flex align-help-center" href="{{ route('dashboard.help.index') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="List">عرض الجميع</span>
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->canany(['super', 'help-list', 'help-show', 'help-create', 'help-edit', 'help-destroy']))
                            <li class="@if (itemIsActive('help', 'new')) {{'active'}} @endif">
                                <a class="d-flex align-help-center" href="{{ route('dashboard.help.new') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="List">عرض الطلبات الجديدة</span>
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->canany(['super', 'help-list', 'help-show', 'help-create', 'help-edit', 'help-destroy']))
                            <li class="@if (itemIsActive('help', 'watched')) {{'active'}} @endif">
                                <a class="d-flex align-help-center" href="{{ route('dashboard.help.watched') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="List">عرض الطلبات المفتوحة</span>
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->canany(['super', 'help-list', 'help-show', 'help-create', 'help-edit', 'help-destroy']))
                            <li class="@if (itemIsActive('help', 'accepted')) {{'active'}} @endif">
                                <a class="d-flex align-help-center" href="{{ route('dashboard.help.accepted') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="List">عرض الطلبات المقبولة</span>
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->canany(['super', 'help-list', 'help-show', 'help-create', 'help-edit', 'help-destroy']))
                            <li class="@if (itemIsActive('help', 'transferred')) {{'active'}} @endif">
                                <a class="d-flex align-help-center" href="{{ route('dashboard.help.transferred') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="List">عرض الطلبات المحولة</span>
                                </a>
                            </li>
                        @endif
                        @if(auth()->user()->canany(['super', 'help-list', 'help-show', 'help-create', 'help-edit', 'help-destroy']))
                            <li class="@if (itemIsActive('help', 'rejected')) {{'active'}} @endif">
                                <a class="d-flex align-help-center" href="{{ route('dashboard.help.rejected') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="List">عرض الطلبات المرفوضة</span>
                                </a>
                            </li>
                        @endif
                        
                    </ul>
                </li>
            @endif

            
            
        </ul>
    </div>
</div>