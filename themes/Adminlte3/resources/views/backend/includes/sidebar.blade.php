<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{route("backend.dashboard")}}" class="brand-link">
        <img class="brand-image" style="opacity: .8" src="{{asset("img/backend-logo-square.png")}}" height="40" alt="{{ setting('core::app_name') }}"> <span class="brand-text font-weight-light">{{ setting('core::app_name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        {!! $menu !!}
        {{-- {!! $admin_sidebar->asUl( ['class' => 'nav nav-pills nav-sidebar flex-column', 'data-widget'=>'treeview', 'role'=>'menu', 'data-accordion'=>'false'], ['class' => 'nav nav-treeview']) !!!! --}}
        }
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->



</aside>
