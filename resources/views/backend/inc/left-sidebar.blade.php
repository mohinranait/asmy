@php

  $prefix = Request::route()->getPrefix();
  $route = Route::current()->getName();

@endphp

<div class="br-logo"><a href="{{url('/')}}"><span>[</span>ASMY <i>BD</i><span>]</span></a></div>
    <div class="br-sideleft sideleft-scrollbar">
      <label class="sidebar-label pd-x-10 mg-t-20 op-3">Navigation</label>
      <ul class="br-sideleft-menu">
        <li class="br-menu-item">
          <a href="{{route('admin.dashboard')}}" class="br-menu-link active">
            <i class="menu-item-icon icon ion-ios-home-outline tx-24"></i>
            <span class="menu-item-label">Dashboard</span>
          </a><!-- br-menu-link -->
        </li><!-- br-menu-item -->
       
        <li class="br-menu-item">
          <a href="#" class="br-menu-link with-sub {{ ($prefix == 'admin/order') ? 'show-sub' : ''}} ">
            <!-- <i class="menu-item-icon icon ion-ios-color-filter-outline tx-20"></i> -->
            
            <i class="fa fa-tag"></i>
            <span class="menu-item-label">Orders</span>
          </a><!-- br-menu-link -->
          <ul class="br-menu-sub ">
            <li class="sub-item"><a href="{{route('order.index')}}" class="sub-link {{ ($route== 'order.index') ? 'active' : ''}} ">All Products</a></li>
            <!-- <li class="sub-item"><a href="{{route('order.create')}}" class="sub-link  {{ ($route== 'order.create') ? 'active' : ''}}">New Product</a></li> -->
          </ul>
        </li>
       
       
        <li class="br-menu-item">
          <a href="#" class="br-menu-link with-sub {{ ($prefix == 'admin/products') ? 'show-sub' : ''}} ">
            <!-- <i class="menu-item-icon icon ion-ios-color-filter-outline tx-20"></i> -->
            
            <i class="fa fa-tag"></i>
            <span class="menu-item-label">Products</span>
          </a><!-- br-menu-link -->
          <ul class="br-menu-sub ">
            <li class="sub-item"><a href="{{route('product.index')}}" class="sub-link {{ ($route== 'product.index') ? 'active' : ''}} ">All Products</a></li>
            <li class="sub-item"><a href="{{route('product.create')}}" class="sub-link  {{ ($route== 'product.create') ? 'active' : ''}}">New Product</a></li>
          </ul>
        </li>
       
        <li class="br-menu-item">
          <a href="#" class="br-menu-link with-sub {{ ($prefix == 'admin/sliders') ? 'show-sub' : ''}} ">
            <!-- <i class="menu-item-icon icon ion-ios-color-filter-outline tx-20"></i> -->
            <i class="fa fa-tag"></i>
            <span class="menu-item-label">Slider</span>
          </a><!-- br-menu-link -->
          <ul class="br-menu-sub ">
            <li class="sub-item"><a href="{{route('slider.index')}}" class="sub-link {{ ($route== 'slider.index') ? 'active' : ''}} ">All Slider</a></li>
            <!-- <li class="sub-item"><a href="{{route('slider.create')}}" class="sub-link ">New Category</a></li> -->
          </ul>
        </li>
       
        <li class="br-menu-item">
          <a href="#" class="br-menu-link with-sub {{ ($prefix == 'admin/primary/category') ? 'show-sub' : ''}} ">
            <!-- <i class="menu-item-icon icon ion-ios-color-filter-outline tx-20"></i> -->
            <i class="fa fa-tag"></i>
            <span class="menu-item-label">Primary Categorys</span>
          </a><!-- br-menu-link -->
          <ul class="br-menu-sub ">
            <li class="sub-item"><a href="{{route('category.index')}}" class="sub-link {{ ($route== 'category.index') ? 'active' : ''}} ">All Category</a></li>
            <!-- <li class="sub-item"><a href="{{route('category.create')}}" class="sub-link ">New Category</a></li> -->
          </ul>
        </li>
       
        <li class="br-menu-item">
          <a href="#" class="br-menu-link with-sub {{ ($prefix == 'admin/sub/category') ? 'show-sub' : ''}}">
            <!-- <i class="menu-item-icon icon ion-ios-color-filter-outline tx-20"></i> -->
            <i class="fa fa-tags"></i>
            <span class="menu-item-label">Sub Categorys</span>
          </a><!-- br-menu-link -->
          <ul class="br-menu-sub">
            <li class="sub-item"><a href="{{route('sub.category.index')}}" class="sub-link {{ ($route== 'sub.category.index') ? 'active' : ''}}">All Category</a></li>
            <!-- <li class="sub-item"><a href="{{route('sub.category.create')}}" class="sub-link">New Category</a></li> -->
          </ul>
        </li>
       
        <li class="br-menu-item">
          <a href="#" class="br-menu-link with-sub {{ ($prefix == 'admin/district') ? 'show-sub' : ''}}">
            <i class="menu-item-icon icon ion-location tx-20"></i>
            <span class="menu-item-label">District</span>
          </a><!-- br-menu-link -->
          <ul class="br-menu-sub">
            <li class="sub-item"><a href="{{route('district.index')}}" class="sub-link {{ ($route== 'district.index') ? 'active' : ''}}">All Districts</a></li>
          </ul>
        </li>
       
        <li class="br-menu-item">
          <a href="#" class="br-menu-link with-sub {{ ($prefix == 'admin/upzilas') ? 'show-sub' : ''}}">
            <i class="menu-item-icon icon icon ion-location tx-20"></i>
            <span class="menu-item-label">Upzila</span>
          </a><!-- br-menu-link -->
          <ul class="br-menu-sub">
            <li class="sub-item"><a href="{{route('upzila.index')}}" class="sub-link {{ ($route== 'upzila.index') ? 'active' : ''}}">All Upzila</a></li>
          </ul>
        </li>
       
        <li class="br-menu-item">
          <a href="#" class="br-menu-link with-sub {{ ($prefix == 'admin/users') ? 'show-sub' : ''}}">
            <i class="menu-item-icon icon ion-person-stalker tx-20"></i>
            <span class="menu-item-label">Users</span>
          </a><!-- br-menu-link -->
          <ul class="br-menu-sub">
            <li class="sub-item"><a href="{{route('user.index')}}" class="sub-link {{ ($route== 'user.index') ? 'active' : ''}}">All User</a></li>
          </ul>
        </li>
       
        <li class="br-menu-item">
          <a href="#" class="br-menu-link with-sub {{ ($prefix == 'admin/brands') ? 'show-sub' : ''}}">
            <!-- <i class="menu-item-icon icon ion-bookmark tx-20"></i> -->
            <i class="fa fa-building"></i>
            <span class="menu-item-label">Brands</span>
          </a><!-- br-menu-link -->
          <ul class="br-menu-sub">
            <li class="sub-item"><a href="{{route('brand.index')}}" class="sub-link {{ ($route== 'brand.index') ? 'active' : ''}}">All Brand</a></li>
          </ul>
        </li>
       
        <!-- Color menu -->
        <!-- <li class="br-menu-item">
          <a href="#" class="br-menu-link with-sub {{ ($prefix == 'admin/color') ? 'show-sub' : ''}}">
           
            <i class="fas fa-brush"></i>
            <span class="menu-item-label">Colors</span>
          </a>
          <ul class="br-menu-sub">
            <li class="sub-item"><a href="{{route('color.index')}}" class="sub-link {{ ($route== 'color.index') ? 'active' : ''}}">All User</a></li>
          </ul>
        </li> -->
       
       
      </ul><!-- br-sideleft-menu -->

      <label class="sidebar-label pd-x-10 mg-t-25 mg-b-20 tx-info">Information Summary</label>

      <br>
    </div><!-- br-sideleft -->