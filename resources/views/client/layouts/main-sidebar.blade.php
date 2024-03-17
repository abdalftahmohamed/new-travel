<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('client.dashboard')}}" class="brand-link">
        <img src="{{URL::asset('admin/dist/img/constractor-logo.svg')}}" alt="AdminLTE Logo" class="img-fluid mb-2 "
             style="opacity: .8; width: 100%; height: 80%;">
        {{--        <span class="brand-text font-weight-light">Constructor</span>--}}
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
{{--            <div class="image">--}}
{{--                <img--}}
{{--                    src="{{(! empty(auth()->user()->logo)) ? asset('attachments/client/'.auth('client')->user()->id.'/'.auth('client')->user()->logo ) : asset('admin/dist/img/user2-160x160.jpg') }}"--}}
{{--                    class="img-circle elevation-2" alt="User Image">--}}
{{--            </div>--}}
            <div class="info">
                <a href="#" class="d-block">{{auth('client')->user()->name}}</a>
            </div>
        </div>
        <br>
        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{route('client.trip.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Trips
                            <span
                                class="badge badge-info right">20</span>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Blogs
                            <span
                                class="badge badge-info right">20</span>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Orders
                            <span
                                class="badge badge-info right">20</span>
                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Rating
                            <span
                                class="badge badge-info right">20</span>
                        </p>
                    </a>
                </li>



                {{--                <li class="nav-item">--}}
                {{--                    <a href="#" class="nav-link">--}}
                {{--                        <i class="nav-icon fas fa-edit"></i>--}}
                {{--                        <p>--}}
                {{--                            Forms--}}
                {{--                            <i class="fas fa-angle-left right"></i>--}}
                {{--                        </p>--}}
                {{--                    </a>--}}
                {{--                    <ul class="nav nav-treeview">--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{URL::asset('admin/pages/forms/general.html')}}" class="nav-link">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>General Elements</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{URL::asset('admin/pages/forms/advanced.html')}}" class="nav-link">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Advanced Elements</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{URL::asset('admin/pages/forms/editors.html')}}" class="nav-link">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Editors</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{URL::asset('admin/pages/forms/validation.html')}}" class="nav-link">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Validation</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                    </ul>--}}
                {{--                </li>--}}
                {{--                <li class="nav-item">--}}
                {{--                    <a href="#" class="nav-link">--}}
                {{--                        <i class="nav-icon fas fa-table"></i>--}}
                {{--                        <p>--}}
                {{--                            Tables--}}
                {{--                            <i class="fas fa-angle-left right"></i>--}}
                {{--                        </p>--}}
                {{--                    </a>--}}
                {{--                    <ul class="nav nav-treeview">--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{URL::asset('admin/pages/tables/simple.html')}}" class="nav-link">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Simple Tables</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{URL::asset('admin/pages/tables/data.html')}}" class="nav-link">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>DataTables</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{URL::asset('admin/pages/tables/jsgrid.html')}}" class="nav-link">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>jsGrid</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                    </ul>--}}
                {{--                </li>--}}
                {{--                <li class="nav-header">EXAMPLES</li>--}}
                {{--                <li class="nav-item">--}}
                {{--                    <a href="{{URL::asset('admin/pages/calendar.html')}}" class="nav-link">--}}
                {{--                        <i class="nav-icon fas fa-calendar-alt"></i>--}}
                {{--                        <p>--}}
                {{--                            Calendar--}}
                {{--                            <span class="badge badge-info right">2</span>--}}
                {{--                        </p>--}}
                {{--                    </a>--}}
                {{--                </li>--}}
                {{--                <li class="nav-item">--}}
                {{--                    <a href="{{URL::asset('admin/pages/gallery.html')}}" class="nav-link">--}}
                {{--                        <i class="nav-icon far fa-image"></i>--}}
                {{--                        <p>--}}
                {{--                            Gallery--}}
                {{--                        </p>--}}
                {{--                    </a>--}}
                {{--                </li>--}}
                {{--                <li class="nav-item">--}}
                {{--                    <a href="{{URL::asset('admin/pages/kanban.html')}}" class="nav-link">--}}
                {{--                        <i class="nav-icon fas fa-columns"></i>--}}
                {{--                        <p>--}}
                {{--                            Kanban Board--}}
                {{--                        </p>--}}
                {{--                    </a>--}}
                {{--                </li>--}}
                {{--                <li class="nav-item">--}}
                {{--                    <a href="#" class="nav-link">--}}
                {{--                        <i class="nav-icon far fa-envelope"></i>--}}
                {{--                        <p>--}}
                {{--                            Mailbox--}}
                {{--                            <i class="fas fa-angle-left right"></i>--}}
                {{--                        </p>--}}
                {{--                    </a>--}}
                {{--                    <ul class="nav nav-treeview">--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{URL::asset('admin/pages/mailbox/mailbox.html')}}" class="nav-link">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Inbox</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{URL::asset('admin/pages/mailbox/compose.html')}}" class="nav-link">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Compose</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{URL::asset('admin/pages/mailbox/read-mail.html')}}" class="nav-link">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Read</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                    </ul>--}}
                {{--                </li>--}}
                {{--                <li class="nav-item">--}}
                {{--                    <a href="#" class="nav-link">--}}
                {{--                        <i class="nav-icon fas fa-book"></i>--}}
                {{--                        <p>--}}
                {{--                            Pages--}}
                {{--                            <i class="fas fa-angle-left right"></i>--}}
                {{--                        </p>--}}
                {{--                    </a>--}}
                {{--                    <ul class="nav nav-treeview">--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{URL::asset('admin/pages/examples/invoice.html')}}" class="nav-link">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Invoice</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{URL::asset('admin/pages/examples/profile.html')}}" class="nav-link">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Profile</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{URL::asset('admin/pages/examples/e-commerce.html')}}" class="nav-link">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>E-commerce</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{URL::asset('admin/pages/examples/projects.html')}}" class="nav-link">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Projects</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{URL::asset('admin/pages/examples/project-add.html')}}" class="nav-link">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Project Add</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{URL::asset('admin/pages/examples/project-edit.html')}}" class="nav-link">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Project Edit</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{URL::asset('admin/pages/examples/project-detail.html')}}" class="nav-link">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Project Detail</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{URL::asset('admin/pages/examples/contacts.html')}}" class="nav-link">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Contacts</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{URL::asset('admin/pages/examples/faq.html')}}" class="nav-link">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>FAQ</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{URL::asset('admin/pages/examples/contact-us.html')}}" class="nav-link">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Contact us</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                    </ul>--}}
                {{--                </li>--}}
                {{--                <li class="nav-item">--}}
                {{--                    <a href="#" class="nav-link">--}}
                {{--                        <i class="nav-icon far fa-plus-square"></i>--}}
                {{--                        <p>--}}
                {{--                            Extras--}}
                {{--                            <i class="fas fa-angle-left right"></i>--}}
                {{--                        </p>--}}
                {{--                    </a>--}}
                {{--                    <ul class="nav nav-treeview">--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="#" class="nav-link">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>--}}
                {{--                                    Login & Register v1--}}
                {{--                                    <i class="fas fa-angle-left right"></i>--}}
                {{--                                </p>--}}
                {{--                            </a>--}}
                {{--                            <ul class="nav nav-treeview">--}}
                {{--                                <li class="nav-item">--}}
                {{--                                    <a href="{{URL::asset('admin/pages/examples/login.html')}}" class="nav-link">--}}
                {{--                                        <i class="far fa-circle nav-icon"></i>--}}
                {{--                                        <p>Login v1</p>--}}
                {{--                                    </a>--}}
                {{--                                </li>--}}
                {{--                                <li class="nav-item">--}}
                {{--                                    <a href="{{URL::asset('admin/pages/examples/register.html')}}" class="nav-link">--}}
                {{--                                        <i class="far fa-circle nav-icon"></i>--}}
                {{--                                        <p>Register v1</p>--}}
                {{--                                    </a>--}}
                {{--                                </li>--}}
                {{--                                <li class="nav-item">--}}
                {{--                                    <a href="{{URL::asset('admin/pages/examples/forgot-password.html')}}" class="nav-link">--}}
                {{--                                        <i class="far fa-circle nav-icon"></i>--}}
                {{--                                        <p>Forgot Password v1</p>--}}
                {{--                                    </a>--}}
                {{--                                </li>--}}
                {{--                                <li class="nav-item">--}}
                {{--                                    <a href="{{URL::asset('admin/pages/examples/recover-password.html')}}" class="nav-link">--}}
                {{--                                        <i class="far fa-circle nav-icon"></i>--}}
                {{--                                        <p>Recover Password v1</p>--}}
                {{--                                    </a>--}}
                {{--                                </li>--}}
                {{--                            </ul>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="#" class="nav-link">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>--}}
                {{--                                    Login & Register v2--}}
                {{--                                    <i class="fas fa-angle-left right"></i>--}}
                {{--                                </p>--}}
                {{--                            </a>--}}
                {{--                            <ul class="nav nav-treeview">--}}
                {{--                                <li class="nav-item">--}}
                {{--                                    <a href="{{URL::asset('admin/pages/examples/login-v2.html')}}" class="nav-link">--}}
                {{--                                        <i class="far fa-circle nav-icon"></i>--}}
                {{--                                        <p>Login v2</p>--}}
                {{--                                    </a>--}}
                {{--                                </li>--}}
                {{--                                <li class="nav-item">--}}
                {{--                                    <a href="{{URL::asset('admin/pages/examples/register-v2.html')}}" class="nav-link">--}}
                {{--                                        <i class="far fa-circle nav-icon"></i>--}}
                {{--                                        <p>Register v2</p>--}}
                {{--                                    </a>--}}
                {{--                                </li>--}}
                {{--                                <li class="nav-item">--}}
                {{--                                    <a href="{{URL::asset('admin/pages/examples/forgot-password-v2.html')}}" class="nav-link">--}}
                {{--                                        <i class="far fa-circle nav-icon"></i>--}}
                {{--                                        <p>Forgot Password v2</p>--}}
                {{--                                    </a>--}}
                {{--                                </li>--}}
                {{--                                <li class="nav-item">--}}
                {{--                                    <a href="{{URL::asset('admin/pages/examples/recover-password-v2.html')}}" class="nav-link">--}}
                {{--                                        <i class="far fa-circle nav-icon"></i>--}}
                {{--                                        <p>Recover Password v2</p>--}}
                {{--                                    </a>--}}
                {{--                                </li>--}}
                {{--                            </ul>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{URL::asset('admin/pages/examples/lockscreen.html')}}" class="nav-link">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Lockscreen</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{URL::asset('admin/pages/examples/legacy-user-menu.html')}}" class="nav-link">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Legacy User Menu</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{URL::asset('admin/pages/examples/language-menu.html')}}" class="nav-link">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Language Menu</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{URL::asset('admin/pages/examples/404.html')}}" class="nav-link">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Error 404</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{URL::asset('admin/pages/examples/500.html')}}" class="nav-link">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Error 500</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{URL::asset('admin/pages/examples/pace.html')}}" class="nav-link">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Pace</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{URL::asset('admin/pages/examples/blank.html')}}" class="nav-link">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Blank Page</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="starter.html" class="nav-link">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Starter Page</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                    </ul>--}}
                {{--                </li>--}}
                {{--                <li class="nav-item">--}}
                {{--                    <a href="#" class="nav-link">--}}
                {{--                        <i class="nav-icon fas fa-search"></i>--}}
                {{--                        <p>--}}
                {{--                            Search--}}
                {{--                            <i class="fas fa-angle-left right"></i>--}}
                {{--                        </p>--}}
                {{--                    </a>--}}
                {{--                    <ul class="nav nav-treeview">--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{URL::asset('admin/pages/search/simple.html')}}" class="nav-link">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Simple Search</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{URL::asset('admin/pages/search/enhanced.html')}}" class="nav-link">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Enhanced</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                    </ul>--}}
                {{--                </li>--}}
                {{--                <li class="nav-header">MISCELLANEOUS</li>--}}
                {{--                <li class="nav-item">--}}
                {{--                    <a href="iframe.html" class="nav-link">--}}
                {{--                        <i class="nav-icon fas fa-ellipsis-h"></i>--}}
                {{--                        <p>Tabbed IFrame Plugin</p>--}}
                {{--                    </a>--}}
                {{--                </li>--}}
                {{--                <li class="nav-item">--}}
                {{--                    <a href="https://adminlte.io/docs/3.1/" class="nav-link">--}}
                {{--                        <i class="nav-icon fas fa-file"></i>--}}
                {{--                        <p>Documentation</p>--}}
                {{--                    </a>--}}
                {{--                </li>--}}
                {{--                <li class="nav-header">MULTI LEVEL EXAMPLE</li>--}}
                {{--                <li class="nav-item">--}}
                {{--                    <a href="#" class="nav-link">--}}
                {{--                        <i class="fas fa-circle nav-icon"></i>--}}
                {{--                        <p>Level 1</p>--}}
                {{--                    </a>--}}
                {{--                </li>--}}
                {{--                <li class="nav-item">--}}
                {{--                    <a href="#" class="nav-link">--}}
                {{--                        <i class="nav-icon fas fa-circle"></i>--}}
                {{--                        <p>--}}
                {{--                            Level 1--}}
                {{--                            <i class="right fas fa-angle-left"></i>--}}
                {{--                        </p>--}}
                {{--                    </a>--}}
                {{--                    <ul class="nav nav-treeview">--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="#" class="nav-link">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Level 2</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="#" class="nav-link">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>--}}
                {{--                                    Level 2--}}
                {{--                                    <i class="right fas fa-angle-left"></i>--}}
                {{--                                </p>--}}
                {{--                            </a>--}}
                {{--                            <ul class="nav nav-treeview">--}}
                {{--                                <li class="nav-item">--}}
                {{--                                    <a href="#" class="nav-link">--}}
                {{--                                        <i class="far fa-dot-circle nav-icon"></i>--}}
                {{--                                        <p>Level 3</p>--}}
                {{--                                    </a>--}}
                {{--                                </li>--}}
                {{--                                <li class="nav-item">--}}
                {{--                                    <a href="#" class="nav-link">--}}
                {{--                                        <i class="far fa-dot-circle nav-icon"></i>--}}
                {{--                                        <p>Level 3</p>--}}
                {{--                                    </a>--}}
                {{--                                </li>--}}
                {{--                                <li class="nav-item">--}}
                {{--                                    <a href="#" class="nav-link">--}}
                {{--                                        <i class="far fa-dot-circle nav-icon"></i>--}}
                {{--                                        <p>Level 3</p>--}}
                {{--                                    </a>--}}
                {{--                                </li>--}}
                {{--                            </ul>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="#" class="nav-link">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Level 2</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                    </ul>--}}
                {{--                </li>--}}
                {{--                <li class="nav-item">--}}
                {{--                    <a href="#" class="nav-link">--}}
                {{--                        <i class="fas fa-circle nav-icon"></i>--}}
                {{--                        <p>Level 1</p>--}}
                {{--                    </a>--}}
                {{--                </li>--}}
                {{--                <li class="nav-header">LABELS</li>--}}
                {{--                <li class="nav-item">--}}
                {{--                    <a href="#" class="nav-link">--}}
                {{--                        <i class="nav-icon far fa-circle text-danger"></i>--}}
                {{--                        <p class="text">Important</p>--}}
                {{--                    </a>--}}
                {{--                </li>--}}
                {{--                <li class="nav-item">--}}
                {{--                    <a href="#" class="nav-link">--}}
                {{--                        <i class="nav-icon far fa-circle text-warning"></i>--}}
                {{--                        <p>Warning</p>--}}
                {{--                    </a>--}}
                {{--                </li>--}}
                {{--                <li class="nav-item">--}}
                {{--                    <a href="#" class="nav-link">--}}
                {{--                        <i class="nav-icon far fa-circle text-info"></i>--}}
                {{--                        <p>Informational</p>--}}
                {{--                    </a>--}}
                {{--                </li>--}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>


