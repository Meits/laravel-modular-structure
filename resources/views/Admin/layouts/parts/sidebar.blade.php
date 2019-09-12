<div class="sidebar sidebar-light sidebar-main sidebar-expand-md">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        <span class="font-weight-semibold">Navigation</span>
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->


    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user-material">
            <div class="sidebar-user-material-body">
                <div class="card-body text-center">
                    @if($photo)
                    <a href="#">
                        <img src="{{asset('storage/images/settings/'.$photo)}}" class="img-fluid rounded-circle shadow-1 mb-3" width="80" height="80" alt="">
                    </a>
                    @endif
                    <h6 class="mb-0 text-white text-shadow-dark">
                        @isset($user->firstname)
                            {{$user->firstname}}
                        @endisset
                    </h6>
                    <span class="font-size-sm text-white text-shadow-dark">
                        @isset($user->lastname)
                            {{$user->lastname}}
                        @endisset
                    </span>
                </div>

                <div class="sidebar-user-material-footer">
                    <a href="#user-nav" class="d-flex justify-content-between align-items-center text-shadow-dark dropdown-toggle" data-toggle="collapse"><span>{{__('admin.menu_account_title')}}</span></a>
                </div>
            </div>

            <div class="collapse" id="user-nav">
                <ul class="nav nav-sidebar">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="icon-switch2"></i>
                            <span>{{__('admin.menu_account_logout')}}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /user menu -->


        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">
            @if($menu)
                <ul class="nav nav-sidebar" data-nav-type="accordion">
                    @include('administrator::layouts.parts.customMenuItems',['items'=>$menu->roots()])
                </ul>
            @endif
        </div>
        <!-- /main navigation -->
    </div>
    <!-- /sidebar content -->

</div>