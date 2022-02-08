
        <aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav" id="sidebar">
                    <ul id="sidebarnav" class="p-t-30">
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{URL('vendor-dashboard')}}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                        <!-- <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-face"></i><span class="hide-menu">product </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="{{URL('vendor-dashboard/product')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> All product </span></a></li>
                                <li class="sidebar-item"><a href="{{URL('vendor-dashboard/add_product')}}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Add product </span></a></li>
                            </ul>
                        </li> -->
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{URL('vendor-dashboard/product')}}" aria-expanded="false">
                                <i class="mdi mdi-relative-scale"></i>
                                <span class="hide-menu">All product</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{URL('vendor-dashboard/add_product')}}" aria-expanded="false">
                                <i class="mdi mdi-relative-scale"></i>
                                <span class="hide-menu">Add a product</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{URL('vendor-dashboard/order')}}" aria-expanded="false">
                                <i class="mdi mdi-relative-scale"></i>
                                <span class="hide-menu">Order</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{URL('home')}}" aria-expanded="false" target="_blank"><i class="mdi mdi-relative-scale"></i><span class="hide-menu">My Profile</span></a>
                        </li>
                        
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Payment </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a target="_blank" href="{{URL('transaction')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> All Transactions </span></a></li>
                            </ul>
                        </li>

                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>