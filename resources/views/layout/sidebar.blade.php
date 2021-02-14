<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset("admin_LTE/dist/img/AdminLTELogo.png")}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
          <router-link to="/dashboard" class="nav-link">      
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p> Dashboard</p>
          </router-link>                      
          </li>
          <li class="nav-item">
          <router-link to="/teacher" class="nav-link">      
              <i class="nav-icon fas fa-th"></i>
              <p> Teacher</p>
          </router-link>                      
          </li>
          <li class="nav-item">
          <router-link to="/classes" class="nav-link">      
              <i class="nav-icon fas fa-th"></i>
              <p> Class</p>
          </router-link>                      
          </li>
          <li class="nav-item">
          <router-link to="/parents" class="nav-link">      
              <i class="nav-icon fas fa-th"></i>
              <p>Parents</p>
          </router-link>                      
          </li>
          <li class="nav-item">     
          <router-link to="/blog_list" class="nav-link">      
              <i class="nav-icon fas fa-th"></i>
              <p> Blog</p>
          </router-link>
          </li>   
          <li class="nav-item">     
          <router-link to="/category" class="nav-link">      
              <i class="nav-icon fas fa-th"></i>
              <p> Category</p>
          </router-link>
          </li>    
          <li class="nav-item">     
          <router-link to="/addtag" class="nav-link">      
              <i class="nav-icon fas fa-th"></i>
              <p> Tag</p>
          </router-link>
          </li>
          <li class="nav-item">              
          <a href="{{route('logout')}}" class="nav-link"><i class="nav-icon fas fa-th"></i> <p> Logout</p></a>     
          </li>                
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>