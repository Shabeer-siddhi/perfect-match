<div class="menu">
    <div class="main-menu">
        <div class="scroll">
            <ul class="list-unstyled">
                <li class="active">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="iconsminds-shop-4"></i>
                        <span>Dashboards</span>
                    </a>
                </li>
                <li>
                    <a href="#customers">
                        <i class="iconsminds-user"></i> Customers
                    </a>
                </li>
                {{-- <li>
                    <a href="#ui">
                        <i class="iconsminds-pantone"></i> UI
                    </a>
                </li>
                <li>
                    <a href="#menu">
                        <i class="iconsminds-three-arrow-fork"></i> Menu
                    </a>
                </li>
                <li>
                    <a href="Blank.Page.html">
                        <i class="iconsminds-bucket"></i> Blank Page
                    </a>
                </li>
                <li>
                    <a href="https://dore-jquery-docs.coloredstrategies.com" target="_blank">
                        <i class="iconsminds-library"></i> Docs
                    </a>
                </li> --}}
            </ul>
        </div>
    </div>

    <div class="sub-menu">
        <div class="scroll">
            {{-- <ul class="list-unstyled" data-link="dashboard">
                <li class="active">
                    <a href="Dashboard.Default.html">
                        <i class="simple-icon-rocket"></i> <span class="d-inline-block">Default</span>
                    </a>
                </li>
                <li>
                    <a href="Dashboard.Analytics.html">
                        <i class="simple-icon-pie-chart"></i> <span class="d-inline-block">Analytics</span>
                    </a>
                </li>
                <li>
                    <a href="Dashboard.Ecommerce.html">
                        <i class="simple-icon-basket-loaded"></i> <span class="d-inline-block">Ecommerce</span>
                    </a>
                </li>
                <li>
                    <a href="Dashboard.Content.html">
                        <i class="simple-icon-doc"></i> <span class="d-inline-block">Content</span>
                    </a>
                </li>
            </ul> --}}

            <ul class="list-unstyled" data-link="customers">
                <li class="">
                    <a href="{{ route('admin.customer.index') }}">
                        <i class="simple-icon-eye"></i> <span class="d-inline-block">View All</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.customer.create') }}">
                        <i class="simple-icon-plus"></i> <span class="d-inline-block">Create User</span>
                    </a>
                </li>
            </ul>

        </div>
    </div>
</div>
