        <!-- sidebar: style can be found in sidebar.less -->
          <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
              <div class="pull-left image">
                <img src="{{asset('imges/imguser/'.auth()->user()->photo)}}" class="img-circle" alt="User Image">
              </div>
              <div class="pull-left info">
              <p>{{auth()->user()->name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
              </div>
            </div>
            <!-- search form -->
            <form action="#" method="get" class="sidebar-form">
              <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                      <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                      </button>
                    </span>
              </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">        
              <li class="home">
                <a href="/">
                  <i class="fa fa-home"></i> website
                </a>
              </li>





              <li class="treeview">
                <a href="#">
                  <i class="fa fa-pie-chart"></i>
                  <span>Categories</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="{{route('allcategory')}}"><i class="fa fa-chart"></i> All category</a></li>
                  <li><a href="{{route('addcategory')}}"><i class="fa fa-plus"></i> Add category</a></li>
                 
                </ul>
              </li>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-laptop"></i>
                  <span>Items</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="{{route('allitem')}}"><i class="fa fa-pie-chart"></i> All item</a></li>
                  <li><a href="{{route('myitem')}}"><i class="fa fa-circle-o"></i> My item</a></li>
                  <li><a href="{{route('createitem')}}"><i class="fa fa-plus"></i> Add item</a></li>

                </ul>
              </li>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-user"></i> <span>Users</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="{{route('alluser')}}"><i class="fa fa-users"></i> All users</a></li>
                  <li><a href="{{route('createuser')}}"><i class="fa fa-user-plus"></i> Add user</a></li>
                </ul>
              </li>
       
          
              <li>
         
            
            </ul>
          </section>
          <!-- /.sidebar -->