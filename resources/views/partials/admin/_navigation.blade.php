
<nav id="sidebar" aria-label="Main Navigation">
    <!-- Side Header -->
    <div class="content-header">
        <!-- Logo -->
        <a class="fw-semibold text-dual" href="#">
            <span class="smini-visible">
              <i class="fa fa-circle-notch text-primary"></i>
            </span>
            <span class="smini-hide fs-5 tracking-wider">EKSAD &nbsp;<span class="fw-normal">Admin</span></span>
        </a>
        <!-- END Logo -->

        <!-- Extra -->
        <div>
            <!-- Dark Mode -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="layout" data-action="dark_mode_toggle">
                <i class="far fa-moon"></i>
            </button>
            <!-- END Dark Mode -->

            <!-- Close Sidebar, Visible only on mobile screens -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <a class="d-lg-none btn btn-sm btn-alt-secondary ms-1" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
                <i class="fa fa-fw fa-times"></i>
            </a>
            <!-- END Close Sidebar -->
        </div>
        <!-- END Extra -->
    </div>
    <!-- END Side Header -->

    <!-- Sidebar Scrolling -->
    <div class="js-sidebar-scroll">
        <!-- Side Navigation -->
        <div class="content-side">
            <ul class="nav-main">
                <li class="nav-main-item">
                    <a class="nav-main-link active" href="{{route('admin.dashboard')}}">
                        <i class="nav-main-link-icon si si-speedometer"></i>
                        <span class="nav-main-link-name">Dashboard</span>
                    </a>
                </li>
{{--                <li class="nav-main-heading">CONTENT MODULE</li>--}}
{{--                <li class="nav-main-item">--}}
{{--                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">--}}
{{--                        <i class="nav-main-link-icon si si-puzzle"></i>--}}
{{--                        <span class="nav-main-link-name">Admin User</span>--}}
{{--                    </a>--}}
{{--                    <ul class="nav-main-submenu">--}}
{{--                        <li class="nav-main-item">--}}
{{--                            <a class="nav-main-link" href="{{route('admin.adminuser.index')}}">--}}
{{--                                <span class="nav-main-link-name">List Banner</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-main-item">--}}
{{--                            <a class="nav-main-link" href="be_comp_loaders.html">--}}
{{--                                <span class="nav-main-link-name">Add Banner</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
                <li class="nav-main-heading">ADMIN USER MODULE</li>
                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                        <i class="nav-main-link-icon si si-puzzle"></i>
                        <span class="nav-main-link-name">Admin User</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{route('admin.adminuser.index')}}">
                                <span class="nav-main-link-name">List Admin User</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{route('admin.adminuser.create')}}">
                                <span class="nav-main-link-name">Add Admin User</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-main-heading">CONTACT US MODULE</li>
                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                        <i class="nav-main-link-icon si si-puzzle"></i>
                        <span class="nav-main-link-name">Contact Us</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{route('admin.contactus.index')}}">
                                <span class="nav-main-link-name">List Message</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                        <i class="nav-main-link-icon si si-puzzle"></i>
                        <span class="nav-main-link-name">Subscribe</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{route('admin.subscribe.index')}}">
                                <span class="nav-main-link-name">List Subscriber</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-main-heading">BLOG & BLOG CATEGORY</li>
                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                        <i class="nav-main-link-icon si si-puzzle"></i>
                        <span class="nav-main-link-name">Blog</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{route('admin.blog.index')}}">
                                <span class="nav-main-link-name">Blog List</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{route('admin.blog.create')}}">
                                <span class="nav-main-link-name">Add New Blog</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                        <i class="nav-main-link-icon si si-puzzle"></i>
                        <span class="nav-main-link-name">Blog Category</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{route('admin.blogcategory.index')}}">
                                <span class="nav-main-link-name">Blog Category List</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{route('admin.blogcategory.create')}}">
                                <span class="nav-main-link-name">Add New Blog Category</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-main-heading">SOLUTION & SOLUTION CATEGORY</li>
                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                        <i class="nav-main-link-icon si si-puzzle"></i>
                        <span class="nav-main-link-name">Solution</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{route('admin.solution.index')}}">
                                <span class="nav-main-link-name">Solution List</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{route('admin.solution.create')}}">
                                <span class="nav-main-link-name">Add New Solution</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                        <i class="nav-main-link-icon si si-puzzle"></i>
                        <span class="nav-main-link-name">Solution Category</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{route('admin.solutioncategory.index')}}">
                                <span class="nav-main-link-name">Solution Category List</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{route('admin.solutioncategory.create')}}">
                                <span class="nav-main-link-name">Add New Solution Category</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-main-heading">PORTFOLIO MODULE</li>
                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                        <i class="nav-main-link-icon si si-puzzle"></i>
                        <span class="nav-main-link-name">Portfolio</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{route('admin.portfolio.index')}}">
                                <span class="nav-main-link-name">Portfolio List</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-main-heading">JOB VACANCY MODULE</li>
                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                        <i class="nav-main-link-icon si si-puzzle"></i>
                        <span class="nav-main-link-name">Job Vacancy</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{route('admin.job_vacancy.index')}}">
                                <span class="nav-main-link-name">Job Vacancy List</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{route('admin.job_application.index')}}">
                                <span class="nav-main-link-name">Application List</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{route('admin.vacancylevel.index')}}">
                                <span class="nav-main-link-name">Job Vacancy Level List</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{route('admin.vacancydepartment.index')}}">
                                <span class="nav-main-link-name">Job Vacancy Department List</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-main-heading">HOME CONTENT MODULE</li>
                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                        <i class="nav-main-link-icon si si-puzzle"></i>
                        <span class="nav-main-link-name">Home Content</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ route('admin.client.index') }}">
                                <span class="nav-main-link-name">Client Logo Slides</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ route('admin.mainimage.index') }}">
                                <span class="nav-main-link-name">Main Image</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                        <i class="nav-main-link-icon si si-puzzle"></i>
                        <span class="nav-main-link-name">About Team</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{route('admin.team.index')}}">
                                <span class="nav-main-link-name">Team List</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-main-heading">TESTIMONIAL MODULE</li>
                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                        <i class="nav-main-link-icon si si-puzzle"></i>
                        <span class="nav-main-link-name">Testimonial</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{route('admin.testimony.index')}}">
                                <span class="nav-main-link-name">Testimonial List</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- END Sidebar Scrolling -->
</nav>
