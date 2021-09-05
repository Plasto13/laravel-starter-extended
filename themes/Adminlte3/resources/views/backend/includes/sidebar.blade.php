<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{route("backend.dashboard")}}" class="brand-link">
        <img class="brand-image img-circle elevation-3" style="opacity: .8" src="{{asset("img/backend-logo-square.jpg")}}" height="40" alt="{{ app_name() }}"> <span class="brand-text font-weight-light">{{ app_name() }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        {!! $admin_sidebar->asUl( ['class' => 'nav nav-pills nav-sidebar flex-column', 'data-widget'=>'treeview', 'role'=>'menu', 'data-accordion'=>'false'], ['class' => 'nav nav-treeview']) !!}
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

    

</aside>
