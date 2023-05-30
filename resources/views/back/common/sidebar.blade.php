  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
      <img src="{{asset('favicon.ico')}}" alt="The Primal Cuts" class="brand-image img-circle elevation-3" style="width: 32px;">
      <span class="brand-text font-weight-light">The Primal Cuts</span>
    </a>
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        	<i class="fas fa-user-circle" style="font-size: 32px;color: #ccc;" aria-hidden="true"></i>
         
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>

     
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link {{'control-area/dashboard' == request()->path() ? 'active' : ''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/control-area/dashboard')}}" class="nav-link {{'control-area/dashboard' == request()->path() ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">Pages</li>
          <li class="nav-item">
            <a href="#" class="nav-link {{'control-area/branches' == request()->path() ? 'active' : ''}} {{'control-area/add-branch' == request()->path() ? 'active' : ''}}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Branches
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/control-area/branches')}}" class="nav-link {{'control-area/branches' == request()->path() ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Branches</p>
                </a>
              </li> 
              @can('isAdmin')   
              <li class="nav-item">
                <a href="{{url('/control-area/add-branch')}}" class="nav-link {{'control-area/add-branch' == request()->path() ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Branch</p>
                </a>
              </li> 
              @endcan            
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link {{'control-area/categories' == request()->path() ? 'active' : ''}} {{'control-area/add-category' == request()->path() ? 'active' : ''}}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Categories
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/control-area/categories')}}" class="nav-link {{'control-area/categories' == request()->path() ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Categories</p>
                </a>
              </li>  
              @can('isAdmin') 
               <li class="nav-item">
                <a href="{{url('/control-area/add-category')}}" class="nav-link {{'control-area/add-category' == request()->path() ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Category</p>
                </a>
              </li>   
              @endcan          
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link {{'control-area/menus' == request()->path() ? 'active' : ''}} {{'control-area/add-menu' == request()->path() ? 'active' : ''}}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Menu
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/control-area/menus')}}" class="nav-link {{'control-area/menu' == request()->path() ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Menu</p>
                </a>
              </li>  
               <li class="nav-item">
                <a href="{{url('/control-area/add-menu')}}" class="nav-link {{'control-area/add-menu' == request()->path() ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Menu</p>
                </a>
              </li>           
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link {{'control-area/user-contacts' == request()->path() ? 'active' : ''}} ">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Contacts
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/control-area/user-contacts')}}" class="nav-link {{'control-area/user-contacts' == request()->path() ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Contact</p>
                </a>
              </li>        
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-cog"></i>
              <p>
                Setting
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a data-toggle="modal" data-target="#personaldetail" class="nav-link" style="cursor: pointer;">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Personal Detail</p>
                </a>
                 
              </li>
              <li class="nav-item">
                <a data-toggle="modal" data-target="#changepassword" class="nav-link" style="cursor: pointer;">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Change Password</p>
                </a>
               
              </li>
              <li class="nav-item">
               <a  onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();"  class="nav-link" style="cursor: pointer;"><i class="far fa-circle nav-icon"></i><p>Logout</p></a><form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
              </li>
              
            </ul>
          </li>
        </ul>
      </nav>
    </div>
  </aside>
