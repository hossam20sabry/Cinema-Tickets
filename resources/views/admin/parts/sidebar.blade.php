<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
    <a class="sidebar-brand brand-logo" href="/redirect"><img src="{{asset('admin/assets/images/logo.svg')}}" alt="logo" /></a>
    <a class="sidebar-brand brand-logo-mini" href="/redirect"><img src="{{asset('admin/assets/images/logo-mini.svg')}}" alt="logo" /></a>
    </div>
    <ul class="nav">
    <li class="nav-item profile">
        <div class="profile-desc">
        <div class="profile-pic">
            <div class="count-indicator">
            <img class="img-xs rounded-circle " src="{{asset('admin/assets/images/new_picture.jpg')}}" alt="">
            <span class="count bg-success"></span>
            </div>
            <div class="profile-name">
            <h5 class="mb-0 font-weight-normal">hossam sapry</h5>
            <span>Gold Member</span>
            </div>
        </div>
        <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
        <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
            <a href="#" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
                <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-settings text-primary"></i>
                </div>
            </div>
            <div class="preview-item-content">
                <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
            </div>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
                <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-onepassword  text-info"></i>
                </div>
            </div>
            <div class="preview-item-content">
                <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
            </div>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
                <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-calendar-today text-success"></i>
                </div>
            </div>
            <div class="preview-item-content">
                <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
            </div>
            </a>
        </div>
        </div>
    </li>
    <li class="nav-item nav-category">
        <span class="nav-link">Navigation</span>
    </li>
    <li class="nav-item menu-items">
        <a class="nav-link" href="{{url('redirect')}}">
        <span class="menu-icon">
            <i class="mdi mdi-speedometer"></i>
        </span>
        <span class="menu-title">Dashboard</span>
        </a>
    </li>

    <li class="nav-item menu-items">
        <a class="nav-link" href="{{route('allbooking.index')}}">
        <span class="menu-icon">
            <i class="mdi mdi-table-large"></i>
        </span>
        <span class="menu-title">Bookings</span>
        </a>
    </li>

    
    <li class="nav-item menu-items">
        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <span class="menu-icon">
            <i class="mdi mdi-laptop"></i>
        </span>
        <span class="menu-title">Movies</span>
        <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{route('movies.index')}}">Index</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{route('movies.create')}}">Create</a></li>
        </ul>
        </div>
    </li>


    <li class="nav-item menu-items">
        <a class="nav-link" data-toggle="collapse" href="#ui-basic2" aria-expanded="false" aria-controls="ui-basic2">
        <span class="menu-icon">
            <i class="mdi mdi-laptop"></i>
        </span>
        <span class="menu-title">Theaters</span>
        <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic2">
        <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{route('theaters.index')}}">Index</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{route('theaters.create')}}">Create</a></li>
        </ul>
        </div>
    </li>
    <li class="nav-item menu-items">
        <a class="nav-link" data-toggle="collapse" href="#ui-basic3" aria-expanded="false" aria-controls="ui-basic3">
        <span class="menu-icon">
            <i class="mdi mdi-laptop"></i>
        </span>
        <span class="menu-title">Kinds</span>
        <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic3">
        <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{route('kind.index')}}">Index</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{route('kind.create')}}">Create</a></li>
        </ul>
        </div>
    </li>
    <li class="nav-item menu-items">
        <a class="nav-link" data-toggle="collapse" href="#ui-basic3" aria-expanded="false" aria-controls="ui-basic3">
        <span class="menu-icon">
            <i class="mdi mdi-laptop"></i>
        </span>
        <span class="menu-title">Categories</span>
        <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic3">
        <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{route('category.index')}}">Index</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{route('category.create')}}">Create</a></li>
        </ul>
        </div>
    </li>
    
    </ul>
</nav>