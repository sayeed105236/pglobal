
        <aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav" id="sidebar">
                    <ul id="sidebarnav" class="p-t-30">
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{URL('makecommand')}}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Category </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="{{URL('makecommand/category')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> All Category </span></a></li>
                                <li class="sidebar-item"><a href="{{URL('makecommand/add_category')}}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Add Category </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-face"></i><span class="hide-menu">product </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="{{URL('makecommand/product')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> All product </span></a></li>
                                <li class="sidebar-item"><a href="{{URL('makecommand/add_product')}}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Add product </span></a></li>
                                <li class="sidebar-item"><a href="{{URL('makecommand/unapproved_product')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Unapproved product </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-face"></i><span class="hide-menu">Customize </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="{{URL('makecommand/customize?type=home')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Home Page</span></a></li>
                                <li class="sidebar-item"><a href="{{URL('makecommand/visual_customization')}}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Visual Editor</span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{URL('makecommand/shipping')}}" aria-expanded="false"><i class="mdi mdi-relative-scale"></i><span class="hide-menu">Shipping</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{URL('makecommand/order')}}" aria-expanded="false"><i class="mdi mdi-relative-scale"></i><span class="hide-menu">Order</span></a></li>
                        
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i>Users</span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{URL('makecommand/user')}}" aria-expanded="false"><i class="nav-icon fa fa-users"></i><span class="hide-menu">All Users</span></a>
                                </li>
                                <li class="sidebar-item"><a href="{{URL('makecommand/pending_user')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu">Pending Users</span></a></li>
                            </ul>
                        </li> 

                       
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i>F&Q</span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="{{URL('makecommand/fnq?section')}}=page" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> On F&Q Page</span></a></li>
                                <li class="sidebar-item"><a href="{{URL('makecommand/fnq?section')}}=login" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu">On Login/Other Page</span></a></li>
                            </ul>
                        </li> 
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i>Withdraw</span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{URL('makecommand/withdraw_manage')}}" aria-expanded="false"><i class="mdi mdi-relative-scale"></i><span class="hide-menu">Manage withdraw</span></a></li>
                                <li class="sidebar-item"><a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{URL('makecommand/pending_withdraw')}}" aria-expanded="false"><i class="mdi mdi-relative-scale"></i><span class="hide-menu">Pending withdraw</span></a></li>
                                <li class="sidebar-item"><a target="_blank" href="{{URL('transaction')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu">My all transaction</span></a></li>
                            </ul>
                        </li> 
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{URL('makecommand/page')}}" aria-expanded="false"><i class="mdi mdi-relative-scale"></i><span class="hide-menu">Page</span></a></li>


                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i>See Dashboard</span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{URL('affiliate-dashboard')}}" aria-expanded="false">
                                        <i class="mdi mdi-relative-scale"></i>
                                        <span class="hide-menu">See Affiliate dashboard</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{URL('vendor-dashboard')}}" aria-expanded="false">
                                        <i class="mdi mdi-relative-scale"></i>
                                        <span class="hide-menu">See Vendor dashboard</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{URL('dealer-dashboard')}}" aria-expanded="false">
                                        <i class="mdi mdi-relative-scale"></i>
                                        <span class="hide-menu">See Dealer dashboard</span>
                                    </a>
                                </li>
                            </ul>
                        </li> 

                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>