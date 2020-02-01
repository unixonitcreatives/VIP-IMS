  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">VIP International</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Invoice
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="invoice-add.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Invoice</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="invoice-manage.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Invoice</p>
                </a>
              </li>

              <!-- <li class="nav-item">
                <a href="invoice-paid.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Paid Invoice</p>
                </a>
              </li> -->

              <li class="nav-item">
                <a href="invoice-unpaid.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Unpaid Invoice</p>
                </a>
              </li>
            </ul>
          </li>


          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cubes"></i>
              <p>
                Products
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="product-add.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Product Model</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="product-manage.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Product Model</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="stock-add.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Stock</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="stock-manage.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Stocks</p>
                </a>
              </li>
               
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cube"></i>
              <p>
                Packages
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="package-add.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Packages</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="package-manage.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Packages</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-warehouse"></i>
              <p>
                Warehouse
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="warehouse-add.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Warehouse</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="warehouse-manage.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Warehouse</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="stock-transfer.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Transfer Stocks</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="stock-transfer-manage.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Stocks Transfer</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Members
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="members-add.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Member</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="members-manage.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Active Members</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="members-inactive.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inactive Members</p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Reports
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <!-- <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/tables/simple.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stock Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/data.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Some Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/jsgrid.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Report</p>
                </a>
              </li>
            </ul> -->
          </li>

            <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Settings
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
               

              <li class="nav-item">
                <a href="staff-account-manage.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Account</p>
                </a>
              </li>

            </ul>
          </li>


          <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="nav-icon fas fa-power-off"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
