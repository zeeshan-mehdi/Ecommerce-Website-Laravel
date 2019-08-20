


<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.blade.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin Dashboard </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">


    <!-- Heading -->
    <div class="sidebar-heading">
        Store
    </div>



    <li class="nav-item">
        <a class="nav-link" href="/dashboard/products">
            <i class="fas fa-store"></i>
            <span>Products</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/dashboard/products/new">
            <i class="fas fa-plus-square"></i>
            <span>New Product</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/dashboard/orders">
            <i class="fab fa-buffer"></i>
            <span>Orders</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Heading -->
    <div class="sidebar-heading">
        Deals Mangement
    </div>



    <li class="nav-item">
        <a class="nav-link" href="/dashboard/deals">
            <i class="fas fa-store"></i>
            <span>Deals</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/dashboard/deals/new">
            <i class="fas fa-plus-square"></i>
            <span>New Deal</span></a>
    </li>


    <!-- Sidebar Toggler (Sidebar) -->
    {{--<div class="text-center d-none d-md-inline">--}}
        {{--<button class="rounded-circle border-0" id="sidebarToggle"></button>--}}
    {{--</div>--}}

</ul>
<!-- End of Sidebar -->