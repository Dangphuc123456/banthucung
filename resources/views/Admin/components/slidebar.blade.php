<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class='fas fa-audio-description'></i>
        </div>
        <div class="sidebar-brand-text mx-3">ADMIN-PETS-SHOP</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('Admin.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
       
    </div>

    <!-- Nav Item - Categories -->
    <li class="nav-item">
        <!-- Categories Dropdown -->
        <a class="nav-link {{ Auth::guard('admin')->check() ? '' : 'disabled' }}" href="#" id="categoriesDropdown" role="button" data-toggle="collapse" data-target="#categoriesCollapse" aria-expanded="false" aria-controls="categoriesCollapse"
            @if(!Auth::guard('admin')->check()) style="pointer-events: none;" title="You must be logged in to access." @endif>
            <i class="far fa-address-book"></i>
            <span>Categories</span>
        </a>
        <div class="collapse" id="categoriesCollapse">
            <a class="nav-link {{ Auth::guard('admin')->check() ? '' : 'disabled' }}" href="{{ route('admin.category.index') }}"
                @if(!Auth::guard('admin')->check()) style="pointer-events: none;" title="You must be logged in to access." @endif>
                <i class="far fa-list-alt"></i>
                <span>List Categories</span>
            </a>
            <a class="nav-link {{ Auth::guard('admin')->check() ? '' : 'disabled' }}" href="{{ route('admin.category.create') }}"
                @if(!Auth::guard('admin')->check()) style="pointer-events: none;" title="You must be logged in to access." @endif>
                <i class="far fa-plus-square"></i>
                <span>Add Categories</span>
            </a>
        </div>
    </li>

    <!-- Pets Dropdown -->
    <li class="nav-item">
        <a class="nav-link {{ Auth::guard('admin')->check() ? '' : 'disabled' }}" href="#" id="petsDropdown" role="button" data-toggle="collapse" data-target="#petsCollapse" aria-expanded="false" aria-controls="petsCollapse"
            @if(!Auth::guard('admin')->check()) style="pointer-events: none;" title="You must be logged in to access." @endif>
            <i class="fas fa-dog"></i>
            <span>Pets</span>
        </a>
        <div class="collapse" id="petsCollapse">
            <a class="nav-link {{ Auth::guard('admin')->check() ? '' : 'disabled' }}" href="{{ route('admin.pets.index') }}"
                @if(!Auth::guard('admin')->check()) style="pointer-events: none;" title="You must be logged in to access." @endif>
                <i class="fas fa-list-alt"></i>
                <span>List Pets</span>
            </a>
            <a class="nav-link {{ Auth::guard('admin')->check() ? '' : 'disabled' }}" href="{{ route('admin.pets.create') }}"
                @if(!Auth::guard('admin')->check()) style="pointer-events: none;" title="You must be logged in to access." @endif>
                <i class="fas fa-plus-square"></i>
                <span>Add Pets</span>
            </a>
        </div>
    </li>


    <!-- Order Dropdown -->
    <li class="nav-item">
        <a class="nav-link {{ Auth::guard('admin')->check() ? '' : 'disabled' }}" href="#" id="orderDropdown" role="button" data-toggle="collapse" data-target="#orderCollapse" aria-expanded="false" aria-controls="orderCollapse"
            @if(!Auth::guard('admin')->check()) style="pointer-events: none;" title="You must be logged in to access." @endif>
            <i class='fas fa-clipboard'></i>
            <span>Order</span>
        </a>
        <div class="collapse" id="orderCollapse">
            <a class="nav-link {{ Auth::guard('admin')->check() ? '' : 'disabled' }}" href="{{ route('admin.order.index') }}"
                @if(!Auth::guard('admin')->check()) style="pointer-events: none;" title="You must be logged in to access." @endif>
                <i class="fas fa-list-alt"></i>
                <span>List Orders</span>
            </a>
            <a class="nav-link {{ Auth::guard('admin')->check() ? '' : 'disabled' }}" href="#"
                @if(!Auth::guard('admin')->check()) style="pointer-events: none;" title="You must be logged in to access." @endif>
                <i class="fas fa-plus-square"></i>
                <span>Add Order</span>
            </a>
        </div>
    </li>
     <!-- supplierDropdown -->
     <li class="nav-item">
        <a class="nav-link {{ Auth::guard('admin')->check() ? '' : 'disabled' }}" href="#" id="supplierDropdown " role="button" data-toggle="collapse" data-target="#supplierCollapse" aria-expanded="false" aria-controls="supplierCollapse"
            @if(!Auth::guard('admin')->check()) style="pointer-events: none;" title="You must be logged in to access." @endif>
            <i class='fas fa-folder-plus'></i>
            <span>Suppliers</span>
        </a>
        <div class="collapse" id="supplierCollapse">
            <a class="nav-link {{ Auth::guard('admin')->check() ? '' : 'disabled' }}" href="{{ route('admin.suppliers.index') }}"
                @if(!Auth::guard('admin')->check()) style="pointer-events: none;" title="You must be logged in to access." @endif>
                <i class="fas fa-list-alt"></i>
                <span>List Suppliers</span>
            </a>
            <a class="nav-link {{ Auth::guard('admin')->check() ? '' : 'disabled' }}" href="{{ route('admin.suppliers.create') }}"
                @if(!Auth::guard('admin')->check()) style="pointer-events: none;" title="You must be logged in to access." @endif>
                <i class="fas fa-plus-square"></i>
                <span>Add Suppliers</span>
            </a>
        </div>
    </li>
     <!-- supplierDropdown -->
     <li class="nav-item">
        <a class="nav-link {{ Auth::guard('admin')->check() ? '' : 'disabled' }}" href="#" id="inputinvoiDropdown " role="button" data-toggle="collapse" data-target="#inputinvoiCollapse" aria-expanded="false" aria-controls="inputinvoiCollapse"
            @if(!Auth::guard('admin')->check()) style="pointer-events: none;" title="You must be logged in to access." @endif>
            <i class='fas fa-file-import'></i>
            <span>PurchaseOrder</span>
        </a>
        <div class="collapse" id="inputinvoiCollapse">
            <a class="nav-link {{ Auth::guard('admin')->check() ? '' : 'disabled' }}" href="{{ route('admin.inputinvoi.index') }}"
                @if(!Auth::guard('admin')->check()) style="pointer-events: none;" title="You must be logged in to access." @endif>
                <i class="fas fa-list-alt"></i>
                <span>List PurchaseOrder</span>
            </a>
            <a class="nav-link {{ Auth::guard('admin')->check() ? '' : 'disabled' }}" href="{{ route('admin.inputinvoi.create') }}"
                @if(!Auth::guard('admin')->check()) style="pointer-events: none;" title="You must be logged in to access." @endif>
                <i class="fas fa-plus-square"></i>
                <span>Add PurchaseOrder</span>
            </a>
        </div>
    </li>
 <!-- Pets Dropdown -->
    <li class="nav-item">
        <a class="nav-link {{ Auth::guard('admin')->check() ? '' : 'disabled' }}" href="#" id="svDropdown" role="button" data-toggle="collapse" data-target="#svCollapse" aria-expanded="false" aria-controls="svCollapse"
            @if(!Auth::guard('admin')->check()) style="pointer-events: none;" title="You must be logged in to access." @endif>
            <i class='fas fa-city'></i>
            <span>Room</span>
        </a>
        <div class="collapse" id="svCollapse">
            <a class="nav-link {{ Auth::guard('admin')->check() ? '' : 'disabled' }}" href="{{ route('admin.room.index') }}"
                @if(!Auth::guard('admin')->check()) style="pointer-events: none;" title="You must be logged in to access." @endif>
                <i class="fas fa-list-alt"></i>
                <span>List Room</span>
            </a>
            <a class="nav-link {{ Auth::guard('admin')->check() ? '' : 'disabled' }}" href="{{ route('admin.servicee.create') }}"
                @if(!Auth::guard('admin')->check()) style="pointer-events: none;" title="You must be logged in to access." @endif>
                <i class="fas fa-plus-square"></i>
                <span>Add Service</span>
            </a>
        </div>
    </li>
    <!-- Statistical Dropdown -->
    <li class="nav-item">
        <a class="nav-link {{ Auth::guard('admin')->check() ? '' : 'disabled' }}" href="#" id="StatisticalDropdown" role="button" data-toggle="collapse" data-target="#StatisticalCollapse" aria-expanded="false" aria-controls="StatisticalCollapse"
            @if(!Auth::guard('admin')->check()) style="pointer-events: none;" title="You must be logged in to access." @endif>
            <i class="fas fa-list-alt"></i>
            <span>Statistical</span>
        </a>
        <div class="collapse" id="StatisticalCollapse">
            <a class="nav-link {{ Auth::guard('admin')->check() ? '' : 'disabled' }}" href="{{ route('admin.statistical.selling') }}"
                @if(!Auth::guard('admin')->check()) style="pointer-events: none;" title="You must be logged in to access." @endif>
                <i class="fas fa-list-alt"></i>
                <span>Thống kê bán</span>
            </a>
            <a class="nav-link {{ Auth::guard('admin')->check() ? '' : 'disabled' }}" href="{{ route('admin.statistical.import') }}"
                @if(!Auth::guard('admin')->check()) style="pointer-events: none;" title="You must be logged in to access." @endif>
                <i class="fas fa-list-alt"></i>
                <span>Thống kê nhập</span>
            </a>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Charts (Optional) -->
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
    </li>

    <!-- Nav Item - Tables (Optional) -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.register') }}">
        <i class="fas fa-user-plus"></i>
            <span>Sign Up</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>