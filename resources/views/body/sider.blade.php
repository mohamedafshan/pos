<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li class="menu-title">Navigation</li>

                <li>
                    <a href="{{ url('/dashboard') }}">
                        <i class="fa-solid fa-house"></i>
                        <span> Dashboard </span>
                    </a>
                </li>

                @if(Auth::user()->can('Pos Menu'))
                <li>
                    <a href="{{ route('pos') }}">
                        <span class="badge bg-pink float-end">Hot</span>
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span> POS </span>
                    </a>
                </li>
                @endif

                <li class="menu-title mt-2">Apps</li>


                {{-- @if(Auth::user()->can('employee.menu')) --}}
                <li>
                    <a href="#sidebarEcommerce" data-bs-toggle="collapse">
                        <i class="fa-solid fa-users"></i>
                        <span> Employee Manage </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEcommerce">
                        <ul class="nav-second-level">
                            {{-- @if(Auth::user()->can('employee.all')) --}}

                                <li>
                                    <a href="{{ route('all.employee') }}">All Employee</a>
                                </li>
                            {{-- @endif --}}

                            {{-- @if(Auth::user()->can('employee.add'))  --}}
                                <li>
                                    <a href="{{ route('add.employee') }}">Add Employee</a>
                                </li>
                            {{-- @endif --}}
                        </ul>
                    </div>
                </li>
                {{-- @endif --}}

                <li>
                    <a href="#salary" data-bs-toggle="collapse">
                        <i class="fa-solid fa-hand-holding-dollar"></i>
                        <span> Employee Salary </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="salary">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('add.advance.salary') }}">Add Advance Salary</a>
                            </li>
                            <li>
                                <a href="{{ route('all.advance.salary') }}">All Advance Salary</a>
                            </li>

                            <li>
                                <a href="{{ route('pay.salary') }}">Pay Salary</a>
                            </li>

                            <li>
                                <a href="{{ route('month.salary') }}">Last Month Salary</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarCrm" data-bs-toggle="collapse">
                        <i class="fa-solid fa-user"></i>
                        <span> Customer Manage </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarCrm">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.customer') }}">All Customer</a>
                            </li>
                            <li>
                                <a href="{{ route('add.customer') }}">Add Customer</a>
                            </li>
                    </div>
                </li>

                <li>
                    <a href="#sidebarEmail" data-bs-toggle="collapse">
                        <i class="fa-solid fa-truck-field"></i>
                        <span> Supplier Manage </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEmail">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.supplier') }}">All Supplier</a>
                            </li>
                            <li>
                                <a href="{{ route('add.supplier') }}">Add Supplier</a>
                            </li>
                        </ul>
                    </div>
                </li>
                
                <li>
                    <a href="#attendance" data-bs-toggle="collapse">
                        <i class="fa-solid fa-clipboard-user"></i>
                        <span> Employee Attendance </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="attendance">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('employee.attend.list') }}">Employee Attendance</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#catergory" data-bs-toggle="collapse">
                        <i class="fa-solid fa-layer-group"></i>
                        <span>Catergory</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="catergory">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.catergory') }}">All Catergory</a>
                            </li>
                        </ul>
                    </div>
                </li>

                
                <li>
                    <a href="#product" data-bs-toggle="collapse">
                        <i class="fa-solid fa-box-open"></i>
                        <span>Manage Product</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="product">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.product') }}">All Products</a>
                            </li>
                            <li>
                                <a href="{{ route('add.product') }}">Add Products</a>
                            </li>
                            <li>
                                <a href="{{ route('import.product') }}">Import Products</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#Order" data-bs-toggle="collapse">
                        <i class="fa-solid fa-file-pen"></i>
                        <span>Manage Order</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="Order">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('pending.order') }}">Pending Order</a>
                            </li>
                            <li>
                                <a href="{{ route('complete.order') }}">Complete Order</a>
                            </li>

                            <li>
                                <a href="{{ route('pending.due') }}">Pending Due</a>
                            </li>
                        </ul>
                    </div>
                </li>
                

                <li>
                    <a href="#stock" data-bs-toggle="collapse">
                        <i class="fa-solid fa-cubes-stacked"></i>
                        <span>Stock Manage</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="stock">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('stock.manage') }}">Stock</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#permission" data-bs-toggle="collapse">
                        <i class="fa-solid fa-person-circle-check"></i>
                        <span>Roles And Permission</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="permission">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.permission') }}">All Permission</a>
                            </li>

                            <li>
                                <a href="{{ route('all.roles') }}">All Roles</a>
                            </li>

                            <li>
                                <a href="{{ route('add.roles.permission') }}">Roles in Permission</a>
                            </li>

                            <li>
                                <a href="{{ route('all.roles.permission') }}">All Roles in Permission</a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li>
                    <a href="#admin" data-bs-toggle="collapse">
                        <i class="fa-solid fa-user-tie"></i>
                        <span>Setting Admin User</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="admin">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.admin') }}">All Admin</a>
                            </li>

                            <li>
                                <a href="{{ route('add.admin') }}">Add Admin</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="menu-title mt-2">Custom</li>

                <li>
                    <a href="#sidebarAuth" data-bs-toggle="collapse">
                        <i class="fa-solid fa-sack-dollar"></i>
                        <span> Expense </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarAuth">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('add.expense') }}">Add Expense</a>
                            </li>
                            <li>
                                <a href="{{ route('today.expense') }}">Today Expense</a>
                            </li>
                            <li>
                                <a href="{{ route('month.expense') }}">Monthly Expense</a>
                            </li>
                            <li>
                                <a href="{{ route('year.expense') }}">Yearly Expense</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#backup" data-bs-toggle="collapse">
                        <i class="fa-solid fa-database"></i>
                        <span> Backup Data</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="backup">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('database.backup') }}">Database Backup</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarExpages" data-bs-toggle="collapse">
                        <i class="mdi mdi-text-box-multiple-outline"></i>
                        <span> Complaint </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarExpages">
                        <ul class="nav-second-level">
                            <li>
                                <a href="pages-starter.html">Starter</a>
                            </li>
                            <li>
                                <a href="pages-timeline.html">Timeline</a>
                            </li>
                        </ul>
                    </div>
                </li>

            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
