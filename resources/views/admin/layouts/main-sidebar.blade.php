<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.dashboard')}}" class="brand-link">
        <img src="{{URL::asset('admin/dist/img/constractor-logo.svg')}}" alt="AdminLTE Logo" class="img-fluid mb-2 "
             style="opacity: .8; width: 100%; height: 80%;">
        {{--        <span class="brand-text font-weight-light">Constructor</span>--}}
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img
                    src="{{(! empty(auth()->user()->logo)) ? asset('attachments/company/'.auth('web')->user()->id.'/'.auth('web')->user()->logo ) : asset('admin/dist/img/user2-160x160.jpg') }}"
                    class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{auth('web')->user()->name}}</a>
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
                    <a href="{{route('admin.country.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Country
                            <span
                                class="badge badge-info right">{{\App\Models\Country::get()->count()}}</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.city.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            City
                            <span
                                class="badge badge-info right">{{\App\Models\City::get()->count()}}</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.company.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                           Create Affiliate Co.
                            <span
                                class="badge badge-info right">{{\App\Models\Company::get()->count()}}</span>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.department.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Category
                            <span
                                class="badge badge-info right">{{\App\Models\Department::get()->count()}}</span>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.trip.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            trip
                            <span
                                class="badge badge-info right">{{\App\Models\Trip::get()->count()}}</span>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.offer.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            offer
                            <span
                                class="badge badge-info right">{{\App\Models\Offer::get()->count()}}</span>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.blog.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            blog
                            <span
                                class="badge badge-info right">{{\App\Models\Blog::get()->count()}}</span>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.client.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            client
                            <span
                                class="badge badge-info right">{{\App\Models\Client::get()->count()}}</span>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.review.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            review
                            <span
                                class="badge badge-info right">{{\App\Models\Review::get()->count()}}</span>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.coupon.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            coupon
                            <span
                                class="badge badge-info right">{{\App\Models\Coupon::get()->count()}}</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.ourPartner.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Our Partner
                            <span
                                class="badge badge-info right">{{\App\Models\OurPartner::get()->count()}}</span>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.contact.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Messages Home
                            <span
                                class="badge badge-info right">{{\App\Models\Contact::get()->count()}}</span>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.subscriptionEmail.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Subscription Email
                            <span
                                class="badge badge-info right">{{\App\Models\SupscripeEmail::get()->count()}}</span>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.invitation.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Invitation
                            <span
                                class="badge badge-info right">0</span>
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>


