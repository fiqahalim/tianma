@can('admin_only')
    <div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">
        <div class="c-sidebar-brand d-md-down-none">
            <img src="{{ asset('/images/tianma_logo_op-03.png') }}" style="width: 190px;">
        </div>

        <ul class="c-sidebar-nav">
            <li class="c-sidebar-nav-item">
                <a href="{{ route("home.index") }}" class="c-sidebar-nav-link">
                    <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>

            {{-- Customer Management --}}
            @can('customer_access')
                <li class="c-sidebar-nav-dropdown">
                    <a class="c-sidebar-nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-user-friends c-sidebar-nav-icon"></i>
                        {{ trans('cruds.customer.title') }} Management
                    </a>
                    <ul class="c-sidebar-nav-dropdown-items">
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.customers.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/customers") || request()->is("admin/customers/*") ? "c-active" : "" }}">
                                All {{ trans('cruds.customer.title') }}s
                            </a>
                        </li>
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.contact-people.index") }}" class="c-sidebar-nav-link">
                                All Intended Users
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan

            @can('commission_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.commissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/commissions") || request()->is("admin/commissions/*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-hand-holding-usd c-sidebar-nav-icon"></i>
                        {{ trans('cruds.commission.title') }}
                    </a>
                </li>
            @endcan

            @can('order_access')
                <li class="c-sidebar-nav-dropdown">
                    <a class="c-sidebar-nav-dropdown-toggle" href="#">
                        <i class="fa-fw fab fa-first-order-alt c-sidebar-nav-icon"></i>
                        {{ trans('cruds.order.title') }}
                    </a>
                    <ul class="c-sidebar-nav-dropdown-items">
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.showLocation") }}" class="c-sidebar-nav-link">
                                {{ trans('cruds.order.fields.createOrder') }}
                            </a>
                        </li>
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.orders.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/orders") || request()->is("admin/orders/*") ? "c-active" : "" }}">
                                {{ trans('cruds.order.fields.orderList') }}
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan

            {{-- Product Management --}}
            @can('product_management_access')
                <li class="c-sidebar-nav-dropdown {{ request()->is("admin/product-categories*") ? "c-show" : "" }} {{ request()->is("admin/products*") ? "c-show" : "" }} {{ request()->is("admin/product-tags*") ? "c-show" : "" }}">
                    <a class="c-sidebar-nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-shopping-bag c-sidebar-nav-icon"></i>
                        {{ trans('cruds.productManagement.title') }}
                    </a>
                    <ul class="c-sidebar-nav-dropdown-items">
                        @can('product_category_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route("admin.product-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/product-categories") || request()->is("admin/product-categories/*") ? "c-active" : "" }}">
                                    {{ trans('cruds.productCategory.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('product_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route("admin.products.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/products") || request()->is("admin/products/*") ? "c-active" : "" }}">
                                    {{ trans('cruds.product.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('product_tag_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route("admin.product-tags.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/product-tags") || request()->is("admin/product-tags/*") ? "c-active" : "" }}">
                                    {{ trans('cruds.productTag.title') }}
                                </a>
                            </li>
                        @endcan
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.add-on-products.index") }}" class="c-sidebar-nav-link">
                                {{ trans('cruds.addOnProduct.title') }}
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan

            {{-- Document Management --}}
            @can('document_management_access')
                <li class="c-sidebar-nav-dropdown {{ request()->is("admin/my-documents*") ? "c-show" : "" }}">
                    <a class="c-sidebar-nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-folder-open c-sidebar-nav-icon"></i>
                        {{ trans('cruds.documentManagement.title') }}
                    </a>
                    <ul class="c-sidebar-nav-dropdown-items">
                        {{-- @can('user_alert_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route("admin.user-alerts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "c-active" : "" }}">
                                    {{ trans('cruds.userAlert.title') }}
                                </a>
                            </li>
                        @endcan --}}
                        @can('my_document_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route("admin.my-documents.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/my-documents") || request()->is("admin/my-documents/*") ? "c-active" : "" }}">
                                    {{ trans('cruds.myDocument.title') }}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            {{-- Report Management --}}
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-line-chart c-sidebar-nav-icon"></i>
                    Report Management
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item">
                        <a href="{{ route("admin.invoices.index") }}" class="c-sidebar-nav-link">
                            AR Invoices
                        </a>
                    </li>
                    <li class="c-sidebar-nav-item">
                        <a href="{{ route("admin.payments.index") }}" class="c-sidebar-nav-link">
                            AR Payments
                        </a>
                    </li>
                </ul>
            </li>

            {{-- User Management --}}
            @can('user_management_access')
                <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }} {{ request()->is("admin/audit-logs*") ? "c-show" : "" }} {{ request()->is("admin/teams*") ? "c-show" : "" }}">
                    <a class="c-sidebar-nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-user-shield c-sidebar-nav-icon"></i>
                        {{ trans('cruds.userManagement.title') }}
                    </a>
                    <ul class="c-sidebar-nav-dropdown-items">
                        @can('user_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                    {{ trans('cruds.user.title') }}
                                </a>
                            </li>
                        @endcan
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.users.show', Auth::user()->id) }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                {{ trans('cruds.user.fields.hierarchies') }}
                            </a>
                        </li>
                        {{-- @can('permission_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                    {{ trans('cruds.permission.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('role_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                    {{ trans('cruds.role.title') }}
                                </a>
                            </li>
                        @endcan --}}
                    </ul>
                </li>
            @endcan

            {{-- Profile Settings --}}
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon"></i>
                    {{ trans('cruds.setting.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                        @can('profile_password_edit')
                            <li class="c-sidebar-nav-item">
                                <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                                    {{ trans('cruds.setting.change_password') }}
                                </a>
                            </li>
                        @endcan
                    @endif
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="{{ route('profile.index') }}" >
                                {{ trans('cruds.setting.profile') }}
                        </a>
                    </li>
                </ul>
            </li>
            <hr>

            {{-- Master Settings --}}
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa fa-desktop c-sidebar-nav-icon"></i>
                    {{ trans('cruds.masterSetting.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="{{ route('admin.building-types.index') }}" >
                            Manage {{ trans('cruds.masterSetting.fields.building') }}
                        </a>
                    </li>
                    {{-- <li class="c-sidebar-nav-item">
                        <a href="{{ route("admin.lot.layouts") }}" class="c-sidebar-nav-link">
                            Manage {{ trans('cruds.masterSetting.fields.layout') }}
                        </a>
                    </li> --}}
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="{{ route('admin.levels.index') }}" >
                            Manage {{ trans('cruds.masterSetting.fields.levels') }}
                        </a>
                    </li>
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="{{ route('admin.locations.index') }}" >
                            Manage {{ trans('cruds.masterSetting.fields.location') }}
                        </a>
                    </li>
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="{{ route('admin.product-types.index') }}" >
                            Manage {{ trans('cruds.masterSetting.fields.productType') }}
                        </a>
                    </li>
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="{{ route('admin.rooms.index') }}" >
                            Manage {{ trans('cruds.room.title') }}
                        </a>
                    </li>
                    {{-- <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="{{ route('admin.sections.index') }}" >
                            Manage {{ trans('cruds.masterSetting.fields.section') }}
                        </a>
                    </li> --}}
                </ul>
            </li>

            {{-- @can('audit_log_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.audit-logs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "c-active" : "" }}">
                        <i class="c-sidebar-nav-icon fab fa-searchengin"></i>
                        {{ trans('cruds.auditLog.title') }}
                    </a>
                </li>
            @endcan --}}

            <li class="c-sidebar-nav-item">
                <a href="{{ route('home.help') }}" class="c-sidebar-nav-link">
                    <i class="c-sidebar-nav-icon fas fa-question-circle"></i>
                    {{ trans('global.helps') }}
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul>
    </div>
@else
{{-- This is users sidebar --}}
    @include('partials.user-menu')
@endcan
