<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">

        <span class="brand-text font-weight-light">Take the Stage</span>
    </a>
{{--{{dd(auth()->user()->roles)}}--}}
    <!-- Sidebar -->
    <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">

                <div class="info">
                    <a href="{{route('dashboard')}}" class="d-block">{{auth()->user()->name}} ({{auth()->user()->roles->first()->display_name}})</a>
                </div>
            </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                @role('super-admin')
                <li class="nav-item has-treeview">
                    <a href=" {{route('studio.index')}}"
                       class="nav-link {{ Request::is('admin/studio') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-dashboard"></i>
                        <p>
                           Studio
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href=" {{route('performanceCategory.index')}}"
                       class="nav-link {{ Request::is('admin/performanceCategory') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-th"></i>
                        <p>
                           Performance Category
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href=" {{route('slider.index')}}"
                       class="nav-link {{ Request::is('admin/sliderentry') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-sliders"></i>
                        <p>
                           Slider
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href=" {{route('result.index')}}"
                       class="nav-link {{ Request::is('admin/result') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-server"></i>
                        <p>
                            Result
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href=" {{route('competitionDetail.index')}}"
                       class="nav-link {{ Request::is('admin/competitionDetail') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-sticky-note"></i>
                        <p>
                            Competition Details
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href=" {{route('discount.index')}}"
                       class="nav-link {{ Request::is('admin/discount') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-dashboard"></i>
                        <p>
                            Regional  Cost
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href=" {{route('nationalCosts.index')}}"
                       class="nav-link {{ Request::is('admin/nationalCosts') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-dashboard"></i>
                        <p>
                           National Cost
                        </p>
                    </a>
                </li>
                @endrole

                @role('studio')
                
                
                <li class="nav-item has-treeview">
                    <a href="{{route('dashboard')}}" class="nav-link  {{ Request::is('studio/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-home"></i>
                        <p>
                         Dashboard Home
                        </p>
                    </a>
                </li>
                
                 <li class="nav-item has-treeview">
                    <a href="{{route('studio.studio.edit',auth()->user()->studio->id)}}" class="nav-link  {{ Request::is('studio/studio/{id }/edit') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-sticky-note"></i>
                        <p>
                            Studio
                        </p>
                    </a>
                </li>
                
                <li class="nav-item has-treeview">
                    <a href="{{route('studio.performer.index')}}" class="nav-link  {{ Request::is('studio/performer') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-dashboard"></i>
                        <p>
                         Master Contestant
                        </p>
                    </a>
                </li>


               

                <li class="nav-item has-treeview">
                    <a href="{{route('studio.performerEntry.create',['id'=>null])}}" class="nav-link  {{ Request::is('studio/performerEntry/create') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-server"></i>
                        <p>
                      Add Competition Entry
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{route('studio.performerEntry.index')}}" class="nav-link  {{ Request::is('studio/performerEntry') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-sliders"></i>
                        <p>
                           Entry List
                        </p>
                    </a>
                </li>
                @endrole

                <li class="nav-item has-treeview">
                    <a class="nav-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="nav-icon fa fa-ticket"></i>
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>