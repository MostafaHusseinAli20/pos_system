<aside class="main-sidebar">

  <section class="sidebar">

      <div class="user-panel">
          <div class="pull-left image">
              <img src="{{ asset('dashboard_files/img/avatar5.png') }}" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
              <p>{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
      </div>

      <ul class="sidebar-menu" data-widget="tree">
          <li><a href="{{route('dashboard.index')}}"><i class="fa fa-th"></i><span>@lang('site.dashboard')</span></a></li>

              @can('read_category')
                <li><a href="{{route('categories.index')}}"><i class="fa fa-th"></i><span>@lang('site.categories')</span></a></li>
              @endcan

              @can('read_product')
                <li><a href="{{route('products.index')}}"><i class="fa fa-th"></i><span>@lang('site.products')</span></a></li>
              @endcan

              @can('read_client')
                <li><a href="{{route('clients.index')}}"><i class="fa fa-th"></i><span>@lang('site.clients')</span></a></li>
              @endcan
              
          
              @can('read_order')
                <li><a href="{{route('orders.index')}}"><i class="fa fa-th"></i><span>@lang('site.orders')</span></a></li>
              @endcan

              @can('read_user')
                <li><a href="{{route('users.index')}}"><i class="fa fa-th"></i><span>@lang('site.users')</span></a></li>
              @endcan

              @can('read_role')
                <li><a href="{{route('roles.index')}}"><i class="fa fa-th"></i><span>@lang('site.permissions')</span></a></li>
              @endcan
              
      </ul>

  </section>

</aside>