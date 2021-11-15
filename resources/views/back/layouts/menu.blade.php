
<body id="page-top">

<div id="wrapper">
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-text mx-2">Blog Sitesi Admin </div>
        </a>
        <hr class="sidebar-divider my-0">

        <li class="nav-item @if(Request::segment(2) == "panel") active @endif">
            <a class="nav-link" href="{{route("admin.dashboard")}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Panel</span></a>
        </li>

        <hr class="sidebar-divider">

        <div class="sidebar-heading">
            İçerik Yönetimi
        </div>

        @role("SupperAdmin|Editor|Admin")
        <li class="nav-item">
            <a class="nav-link @if(Request::segment(2) == "makaleler") in @else collapsed @endif" href="#" data-toggle="collapse" data-target="#collapseTwo"
               aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-edit"></i>
                <span>Makaleler</span>
            </a>
            <div id="collapseTwo" class="collapse @if(Request::segment(2) == "makaleler") show @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Makale İşlemleri</h6>
                    <a class="collapse-item @if(Request::segment(2) == "makaleler" and !Request::segment(3)) active @endif" href="{{route("admin.makaleler.index")}}">Tüm Makaleler</a>
                    <a class="collapse-item @if(Request::segment(2) == "makaleler" and Request::segment(3) == "create") active @endif" href="{{route("admin.makaleler.create")}}">Makale Oluştur</a>
                </div>
            </div>
        </li>
        @endrole

        <li class="nav-item @if(Request::segment(2) == "kategoriler") active @endif">
            <a class="nav-link collapsed" href="{{route("admin.category.index")}}">
                <i class="fas fa-fw fa-list"></i>
                <span>Kategoriler</span>
            </a>
        </li>

        @role("Admin|SupperAdmin")
        <li class="nav-item">
            <a class="nav-link @if(Request::segment(2) == "sayfalar") in @else collapsed @endif" href="#" data-toggle="collapse" data-target="#collapseSayfa"
               aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-folder"></i>
                <span>Sayfalar</span>
            </a>
            <div id="collapseSayfa" class="collapse @if(Request::segment(2) == "sayfalar") show @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Sayfa İşlemleri</h6>
                    <a class="collapse-item @if(Request::segment(2) == "sayfalar" and !Request::segment(3)) active @endif" href="{{route("admin.page.index")}}">Tüm Sayfalar</a>
                    <a class="collapse-item @if(Request::segment(2) == "sayfalar" and Request::segment(3) == "create") active @endif" href="{{route("admin.page.create")}}">Sayfalar Oluştur</a>
                </div>
            </div>
        </li>
        @endrole

        <hr class="sidebar-divider">

        @role("SupperAdmin")
        <div class="sidebar-heading">
            Site Ayarları
        </div>


        <li class="nav-item">
            <a class="nav-link @if(Request::segment(2) == "adminler") in @else collapsed @endif" href="#" data-toggle="collapse" data-target="#collapseAdmin"
               aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-user"></i>
                <span>Adminler</span>
            </a>
            <div id="collapseAdmin" class="collapse @if(Request::segment(2) == "adminler") show @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Admin İşlemleri</h6>
                    <a class="collapse-item @if(Request::segment(2) == "adminler" and !Request::segment(3)) active @endif" href="{{route("admin.adminler.index")}}">Tüm Adminler</a>
                    <a class="collapse-item @if(Request::segment(2) == "adminler" and Request::segment(3) == "create") active @endif" href="{{route("admin.adminler.yeni-admin")}}">Yeni Admin Oluştur</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link @if(Request::segment(2) == "roller") in @else collapsed @endif" href="#" data-toggle="collapse" data-target="#collapseRole"
               aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-user-lock"></i>
                <span>Roller ve İzinler</span>
            </a>
            <div id="collapseRole" class="collapse @if(Request::segment(2) == "roller") show @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Rol ve İzin İşlemleri</h6>
                    <a class="collapse-item @if(Request::segment(2) == "roller" and !Request::segment(3)) active @endif" href="{{route("admin.roller.index")}}">Tüm Roller</a>
                    <a class="collapse-item @if(Request::segment(2) == "roller" and Request::segment(3) == "create") active @endif" href="{{route("admin.adminler.yeni-admin")}}">Yeni Rol Oluştur</a>
                    <a class="collapse-item @if(Request::segment(2) == "izinler" and !Request::segment(3)) active @endif">Tüm İzinler</a>
                    <a class="collapse-item @if(Request::segment(2) == "izinler" and Request::segment(3) == "create") active @endif">Yeni İzin Oluştur</a>
                </div>
            </div>
        </li>

        <li class="nav-item @if(Request::segment(2) == "ayarlar") active @endif">
            <a class="nav-link collapsed" href="{{route("admin.config.index")}}">
                <i class="fas fa-fw fa-cog"></i>
                <span>Ayarlar</span>
            </a>
        </li>
        @endrole


        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

        <!-- Sidebar Message -->
        <div class="sidebar-card d-none d-lg-flex">
            <img class="sidebar-card-illustration mb-2" src="{{asset("back/")}}/img/undraw_rocket.svg" alt="...">
            <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
            <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Messages -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-envelope fa-fw"></i>
                            <!-- Counter - Messages -->
                            <span class="badge badge-danger badge-counter">{{\Illuminate\Support\Facades\Auth::user()->unreadNotifications->count()}}</span>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="messagesDropdown">
                            <h6 class="dropdown-header">
                                Message Center
                            </h6>
                            @foreach(\Illuminate\Support\Facades\Auth::user()->unreadNotifications as $item)
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="{{asset("back/")}}/img/undraw_profile_1.svg"
                                             alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">
                                            {{$item->data["name"]}}.
                                        </div>
                                        <div class="small text-gray-500">
                                            Emily Fowler · 58m
                                        </div>
                                    </div>
                                </a>
                            @endforeach

                            @foreach(\Illuminate\Support\Facades\Auth::user()->readNotifications as $item)
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="{{asset("back/")}}/img/undraw_profile_2.svg"
                                             alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                            @endforeach
                            <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                        </div>
                    </li>

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{\Illuminate\Support\Facades\Auth::user()->name}}</span>
                            <img class="img-profile rounded-circle"
                                 src="{{asset("back/")}}/img/undraw_profile.svg">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                Settings
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                Activity Log
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>

            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">@yield("title")</h1>
                    <a href="{{route("homepage")}}" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                            class="fas fa-globe fa-sm text-white-50"></i> Siteyi Görüntüle</a>
                </div>
