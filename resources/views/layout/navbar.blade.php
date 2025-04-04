<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main Menu</span>
                </li>
                <li class="submenu active">
                    <a href="{{url('/admin/dashboard')}}"><i class="fas fa-home"></i> <span> Dashboard</span></a>
                </li>
                <li class="menu-title">
                    <span>New Registration</span>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fas fa-user-graduate"></i> <span> Application Form</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{url('admin/registration/new-registration')}}">New Application</a></li>
                        <li><a href="{{url('admin/registration/approved-registration')}}">Approved Registration</a></li>
                        <li><a href="{{url('admin/registration/rejected-registration')}}">Rejected Registration</a></li>
                    </ul>
                </li>

                <li class="menu-title">
                    <span>College</span>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fas fa-building"></i> <span> Colleges</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{url('admin/college/add-college')}}">Add College</a></li>
                        <li><a href="{{url('admin/college/colleges-list')}}">Colleges List</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fas fa-user-graduate"></i> <span> Students</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{url('admin/students/add-student')}}">Add Student</a></li>
                        <li><a href="{{url('admin/students/students-list')}}">Students List</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fas fa-chalkboard-teacher"></i> <span> Teachers</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{url('admin/teacher/teacher-list')}}">Teacher List</a></li>
                        <li><a href="{{url('admin/teacher/attendance')}}">Teacher Attendance</a></li>
                        <li><a href="{{url('admin/teacher/salary')}}">Teacher Salary</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fas fa-comment-dollar"></i> <span> Fee Management</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{url('admin/fee/collected-fee')}}">Collected Fee</a></li>
                        <li><a href="{{url('admin/fee/due-fee')}}">Due Fee</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fas fa-user"></i> <span> Roles & Permissions </span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{url('admin/roles')}}">Roles</a></li>
                        <li><a href="{{url('admin/permission')}}">Permissions</a></li>
                    </ul>
                </li>
                <li class="menu-title">
                    <span>Tools</span>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fas fa-file-invoice-dollar"></i> <span> Tools</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{url('admin/tools/add-university')}}">University</a></li>
                        <li><a href="{{url('admin/tools/add-category')}}">College Category</a></li>
                        <li><a href="{{url('admin/tools/add-course')}}">College Courses</a></li>
                        <li><a href="{{url('admin/tools/academic-course')}}">College Subject Course</a></li>
                        <li><a href="{{url('admin/tools/course-type-list')}}">Course Type List</a></li>
                        <li><a href="{{url('admin/tools/academic-fee')}}">Academic Fees</a></li>
                        <li><a href="{{url('admin/tools/required-document')}}">Required Document</a></li>
                        <li><a href="{{url('admin/tools/subject-list')}}">Subject List</a></li>
                    </ul>
                </li>
                {{-- <li>
                    <a href="holiday.html"><i class="fas fa-holly-berry"></i> <span>Holiday</span></a>
                </li>
                <li>
                    <a href="fees.html"><i class="fas fa-comment-dollar"></i> <span>Fees</span></a>
                </li>
                <li>
                    <a href="exam.html"><i class="fas fa-clipboard-list"></i> <span>Exam list</span></a>
                </li>
                <li>
                    <a href="event.html"><i class="fas fa-calendar-day"></i> <span>Events</span></a>
                </li>
                <li>
                    <a href="time-table.html"><i class="fas fa-table"></i> <span>Time Table</span></a>
                </li>
                <li>
                    <a href="library.html"><i class="fas fa-book"></i> <span>Library</span></a>
                </li>
                <li class="menu-title">
                    <span>Pages</span>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fas fa-shield-alt"></i> <span> Authentication </span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="login.html">Login</a></li>
                        <li><a href="register.html">Register</a></li>
                        <li><a href="forgot-password.html">Forgot Password</a></li>
                        <li><a href="error-404.html">Error Page</a></li>
                    </ul>
                </li>
                <li>
                    <a href="blank-page.html"><i class="fas fa-file"></i> <span>Blank Page</span></a>
                </li>
                <li class="menu-title">
                    <span>Others</span>
                </li>
                <li>
                    <a href="sports.html"><i class="fas fa-baseball-ball"></i> <span>Sports</span></a>
                </li>
                <li>
                    <a href="hostel.html"><i class="fas fa-hotel"></i> <span>Hostel</span></a>
                </li>
                <li>
                    <a href="transport.html"><i class="fas fa-bus"></i> <span>Transport</span></a>
                </li>
                <li class="menu-title">
                    <span>UI Interface</span>
                </li>
                <li>
                    <a href="components.html"><i class="fas fa-vector-square"></i> <span>Components</span></a>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fas fa-columns"></i> <span> Forms </span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="form-basic-inputs.html">Basic Inputs </a></li>
                        <li><a href="form-input-groups.html">Input Groups </a></li>
                        <li><a href="form-horizontal.html">Horizontal Form </a></li>
                        <li><a href="form-vertical.html"> Vertical Form </a></li>
                        <li><a href="form-mask.html"> Form Mask </a></li>
                        <li><a href="form-validation.html"> Form Validation </a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fas fa-table"></i> <span> Tables </span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="tables-basic.html">Basic Tables </a></li>
                        <li><a href="data-tables.html">Data Table </a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><i class="fas fa-code"></i> <span>Multi Level</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li class="submenu">
                            <a href="javascript:void(0);"> <span>Level 1</span> <span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="javascript:void(0);"><span>Level 2</span></a></li>
                                <li class="submenu">
                                    <a href="javascript:void(0);"> <span> Level 2</span> <span
                                            class="menu-arrow"></span></a>
                                    <ul>
                                        <li><a href="javascript:void(0);">Level 3</a></li>
                                        <li><a href="javascript:void(0);">Level 3</a></li>
                                    </ul>
                                </li>
                                <li><a href="javascript:void(0);"> <span>Level 2</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0);"> <span>Level 1</span></a>
                        </li>
                    </ul>
                </li> --}}
            </ul>
        </div>
    </div>
</div>
