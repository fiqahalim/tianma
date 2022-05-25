<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">
    <div class="c-sidebar-brand d-md-down-none">
        <img src="{{ asset('/images/tianma_logo_op-03.png') }}" style="width: 190px;">
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("home.index") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt"></i>
                {{ trans('global.dashboard') }}
            </a>
        </li>

        {{-- My Customers --}}
        <li class="c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i class="fas fa-user c-sidebar-nav-icon"></i>
                Customers
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                 <li class="c-sidebar-nav-item">
                    <a href="{{ route("user.myCustomers") }}" class="c-sidebar-nav-link">
                        My {{ trans('global.order.myCust') }}
                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.decease-people.index") }}" class="c-sidebar-nav-link">
                        Deceased Person
                    </a>
                </li>
            </ul>
        </li>

        {{-- Commissions --}}
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('user.myCommission') }}" >
                <i class="fas fa-dollar-sign c-sidebar-nav-icon"></i>
                {{ trans('global.reports.title_singular') }}
            </a>
        </li>

        {{-- Downline --}}
        <li class="c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i class="fa-fw fas fa-code-fork c-sidebar-nav-icon"></i>
                {{ trans('global.downline.title') }}
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                 <li class="c-sidebar-nav-item">
                    <a href="{{ route('user.myTree') }}" class="c-sidebar-nav-link" >
                        {{ trans('global.downline.my_tree') }}
                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('user.my-downline.index') }}" class="c-sidebar-nav-link">
                        {{ trans('global.downline.my_downline') }}
                    </a>
                </li>
            </ul>
        </li>

        {{-- My Orders --}}
        <li class="c-sidebar-nav-item">
            <a href="{{ route("user.my-orders.index") }}" class="c-sidebar-nav-link">
                <i class="fa-fw fab fa-first-order-alt c-sidebar-nav-icon"></i>
                {{ trans('global.order.myOrder') }}
            </a>
        </li>

        {{-- Documents --}}
        <li class="c-sidebar-nav-item">
            <a href="{{ route('user.my-documents.index') }}" class="c-sidebar-nav-link">
                <i class="fa-fw fas fa-folder c-sidebar-nav-icon"></i>
                    {{ trans('global.documents.title') }}
            </a>
        </li>

        {{-- Settings --}}
        <li class="c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon"></i>
                {{ trans('cruds.setting.title') }}
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{ route('profile.index') }}" >
                        {{ trans('cruds.setting.profile') }}
                    </a>
                </li>
                @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="{{ route('profile.password.edit') }}">
                            {{ trans('cruds.setting.change_password') }}
                        </a>
                    </li>
                @endif
            </ul>
        </li>

        <hr>
        <li class="c-sidebar-nav-item">
            <a href="{{ route('home.help') }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-question-circle"></i>
                    {{ trans('global.helps') }}
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt"></i>
                    {{ trans('global.logout') }}
            </a>
        </li>
    </ul>
</div>
