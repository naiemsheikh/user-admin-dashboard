@php
    // $roleId = auth()->user()->role_id;
    $userRole = auth()->user()->role->name;
    $menuID = 0;
@endphp
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="admin/html/ltr/vertical-menu-template/index.html">
                    <div class="brand-logo"></div>
                    <h2 class="brand-text mb-0">Vuexy</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i
                        class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i
                        class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary"
                        data-ticon="icon-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item <?php if ($menuActive == 'home') {
                echo 'active';
            } ?>"><a href="{{url('/admin/home')}}"><i class="feather icon-home"></i><span
                        class="menu-title" data-i18n="Dashboard">Dashboard</span></a>

            </li>
            <li class=" navigation-header"><span>Menu</span>
            </li>
            {{-- <li class=" nav-item"><a href="app-email.html"><i class="feather icon-package"></i><span class="menu-title"
                          data-i18n="Email">Consignment Search</span></a>
              </li>
              <li class=" nav-item"><a href="app-chat.html"><i class="feather icon-message-square"></i><span
                          class="menu-title" data-i18n="Chat">Complaint List</span></a>
              </li>
              <li class=" nav-item"><a href="app-todo.html"><i class="feather icon-search"></i><span
                          class="menu-title" data-i18n="Todo">Complaint Search</span></a>
              </li>
              
              <li class=" nav-item"><a href="#"><i class="feather icon-activity"></i><span class="menu-title"
                          data-i18n="Ecommerce">Reports</span></a>
                  <ul class="menu-content">
                      <li><a href="app-ecommerce-shop.html"><i class="feather icon-circle"></i><span class="menu-item"
                                  data-i18n="Shop">Receiver Summery</span></a>
                      </li>
                      <li><a href="app-ecommerce-details.html"><i class="feather icon-circle"></i><span
                                  class="menu-item" data-i18n="Details">Complaint Summery</span></a>
                      </li>
                      <li><a href="app-ecommerce-wishlist.html"><i class="feather icon-circle"></i><span
                                  class="menu-item" data-i18n="Wish List">Solving Summery</span></a>
                      </li>
                      <li><a href="app-ecommerce-checkout.html"><i class="feather icon-circle"></i><span
                                  class="menu-item" data-i18n="Checkout">Service Wise Complain</span></a>
                      </li>
                  </ul>
              </li> --}}
            @if (count(array_intersect(range($menuID + 1, $menuID + 5), session('privileges'))) > 0)
                @if (in_array(++$menuID, session('privileges')))
                @endif
            @else
                @php
                    $menuID += 5;
                @endphp
            @endif
            @if ($userRole == 'Admin')
                <li class=" nav-item">
                    
                    <a href="#"><i class="feather icon-user"></i><span class="menu-title"
                            data-i18n="User">User</span></a>
                    <ul class="menu-content">
                        <li class="<?php if ($menuActive == 'users') { echo 'active'; } ?>">
                            <a href="{{ URL::to('/') }}/admin/users/index"><i class="feather icon-circle"></i><span class="menu-item"
                                    data-i18n="List">User List</span>
                            </a>
                        </li>
                        <li class="<?php if ($menuActive == 'designations') { echo 'active'; } ?>">
                            <a href="{{ URL::to('/') }}/admin/designation/index"><i class="feather icon-circle"></i><span class="menu-item"
                                    data-i18n="View">Designation List</span>
                            </a>
                        </li>
                        <li class="<?php if ($menuActive == 'sections') { echo 'active'; } ?>">
                            <a href="{{ URL::to('/') }}/admin/section/index"><i class="feather icon-circle"></i><span class="menu-item"
                                    data-i18n="View">Section List</span>
                            </a>
                        </li>
                        <li class="<?php if ($menuActive == 'roles') { echo 'active'; } ?>">
                            <a href="{{ URL::to('/') }}/admin/role/index"><i class="feather icon-circle"></i><span class="menu-item"
                                    data-i18n="Edit">Role List</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</div>
