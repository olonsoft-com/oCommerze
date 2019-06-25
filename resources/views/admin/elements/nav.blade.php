<div class="sidebar-sticky" id="menu">

            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="dashboard">
                  <span class="fa fa-home"></span>
                  Dashboard <span class="sr-only">(current)</span>
                </a>
              </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Inventory</span>
              <a class="d-flex align-items-center text-muted menuExpandIcon" href="#">
                <span class="fa <?php echo ( in_array( 'test', array('product', 'brand', 'category', '' ) ) ) ? 'fa-minus-circle' : 'fa-plus-circle'; ?>"></span>
              </a>
            </h6>
            <ul class="nav flex-column <?php echo ( in_array( 'test', array('product', 'brand', 'category', '' ) ) ) ? '' : 'd-none'; ?>">
              <li class="nav-item">
                <a class="nav-link" href="dashboard/product">
                  <span class="fa fa-shopping-cart"></span>
                  Products
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="dashboard/brand">
                  <span class="fa fa-award"></span>
                  Brands
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="dashboard/category">
                  <span class="fa fa-bars"></span>
                  Categories
                </a>
              </li>
            </ul>


            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Stock Management</span>
              <a class="d-flex align-items-center text-muted menuExpandIcon" href="#">
                <span class="fa <?php echo ( in_array( 'test', array('stock') ) ) ? 'fa-minus-circle' : 'fa-plus-circle'; ?>"></span>
              </a>
            </h6>
            <ul class="nav flex-column <?php echo ( in_array( 'test', array('stock' ) ) ) ? '' : 'd-none'; ?>">
              <li class="nav-item">
                <a class="nav-link" href="dashboard/stock">
                  <span class="fa fa-store"></span>
                  Stocks
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="dashboard/home/relocated" style="color:red" onclick="return confirm('Are you sure to delete all data of your stock? You will never to restore this data again. Please backup your database first to relocate.');">
                  <span class="fa fa-store"></span>
                  Relocate Stock
                </a>
              </li>
            </ul>


            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Relationship</span>
              <a class="d-flex align-items-center text-muted menuExpandIcon" href="#">
                <span class="fa <?php echo ( in_array( 'test', array('retailer', 'wholeseller', 'area' ) ) ) ? 'fa-minus-circle' : 'fa-plus-circle'; ?>"></span>
              </a>
            </h6>
            <ul class="nav flex-column <?php echo ( in_array( 'test', array('retailer', 'wholeseller', 'area' ) ) ) ? '' : 'd-none'; ?>">
              <li class="nav-item">
                <a class="nav-link" href="dashboard/retailer">
                  <span class="fa fa-users"></span>
                  Retailers
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="dashboard/wholeseller">
                  <span class="fa fa-user-secret"></span>
                  Wholesellers
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="dashboard/area">
                  <span class="fa fa-users"></span>
                  Areas
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="dashboard/retailer/closing">
                  <span class="fa fa-times"></span>
                  Closing Account
                </a>
              </li>
            </ul>


            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Payments</span>
              <a class="d-flex align-items-center text-muted menuExpandIcon" href="#">
                <span class="fa <?php echo ( 'test' == 'payment' ) ? 'fa-minus-circle' : 'fa-plus-circle'; ?>"></span>
              </a>
            </h6>
            <ul class="nav flex-column <?php echo ( 'test' == 'payment' ) ? '' : 'd-none'; ?>">
              <li class="nav-item">
                <a class="nav-link" href="dashboard/payment">
                  <span class="fa fa-users"></span>
                  Summary
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="dashboard/payment/log">
                  <span class="fa fa-user-secret"></span>
                  Payment Log
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="dashboard/payment/pay">
                  <span class="fa fa-users"></span>
                  Make Payment
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="dashboard/payment/discount">
                  <span class="fa fa-users"></span>
                  Give Discount
                </a>
              </li>
            </ul>


            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Sales order</span>
              <a class="d-flex align-items-center text-muted menuExpandIcon" href="#">
                <span class="fa <?php echo ( in_array( 'test', array('order', 'invoice', 'sale', 'purchase') ) ) ? 'fa-minus-circle' : 'fa-plus-circle'; ?>"></span>
              </a>
            </h6>
            <ul class="nav flex-column mb-2 <?php echo ( in_array( 'test', array('order', 'invoice', 'sale', 'purchase' ) ) ) ? '' : 'd-none'; ?>">
              <li class="nav-item">
                <a class="nav-link" href="dashboard/purchase">
                  <span class="fa fa-file-invoice-dollar"></span>
                  Purchases
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="dashboard/sale">
                  <span class="fa fa-file-invoice-dollar"></span>
                  Sales
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="dashboard/order">
                  <span class="fa fa-file-invoice-dollar"></span>
                  Orders
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="dashboard/invoice">
                  <span class="fa fa-file-invoice"></span>
                  Invoices
                </a>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link" href="dashboard/order/returns">
                  <span class="fa fa-undo-alt"></span>
                  Returns
                </a>
              </li> -->
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Reports</span>
              <a class="d-flex align-items-center text-muted menuExpandIcon" href="#">
                <span class="fa <?php echo ( in_array( 'test', array('report') ) ) ? 'fa-minus-circle' : 'fa-plus-circle'; ?>"></span>
              </a>
            </h6>
            <ul class="nav flex-column mb-2 <?php echo ( in_array( 'test', array('report' ) ) ) ? '' : 'd-none'; ?>">
              <li class="nav-item">
                <a class="nav-link" href="dashboard/report/daily">
                  <span class="fa fa-chart-bar"></span>
                  By Day
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="dashboard/report/monthly">
                  <span class="fa fa-chart-area"></span>
                  By Month
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="dashboard/report/retailer">
                  <span class="fa fa-chart-pie"></span>
                  By Retailers
                </a>
              </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Daily Expences</span>
              <a class="d-flex align-items-center text-muted menuExpandIcon" href="#">
                <span class="fa <?php echo ( in_array( 'test', array('expence') ) ) ? 'fa-minus-circle' : 'fa-plus-circle'; ?>"></span>
              </a>
            </h6>
            <ul class="nav flex-column mb-2 <?php echo ( in_array( 'test', array('expence' ) ) ) ? '' : 'd-none'; ?>">
              <li class="nav-item">
                <a class="nav-link" href="dashboard/expence/edit">
                  <span class="fa fa-edit"></span>
                  Add new
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="dashboard/expence/daily">
                  <span class="fa fa-list-alt"></span>
                  Summary
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="dashboard/expence/search">
                  <span class="fa fa-list-alt"></span>
                  All Expences
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="dashboard/expence/daily">
                  <span class="fa fa-chart-bar"></span>
                  Daily Report
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="dashboard/expence/monthly">
                  <span class="fa fa-chart-area"></span>
                  Monthly Report
                </a>
              </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Employees</span>
              <a class="d-flex align-items-center text-muted menuExpandIcon" href="#">
                <span class="fa <?php echo ( in_array( 'test', array('employees') ) ) ? 'fa-minus-circle' : 'fa-plus-circle'; ?>"></span>
              </a>
            </h6>
            <ul class="nav flex-column mb-2 <?php echo ( in_array( 'test', array('employees' ) ) ) ? '' : 'd-none'; ?>">
              <li class="nav-item">
                <a class="nav-link" href="dashboard/employees">
                  <span class="fa fa-chart-bar"></span>
                  Employees
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="dashboard/employees/salary">
                  <span class="fa fa-chart-area"></span>
                  Salary
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="dashboard/employees/increment">
                  <span class="fa fa-chart-area"></span>
                  Increments
                </a>
              </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Advanced</span>
              <a class="d-flex align-items-center text-muted menuExpandIcon" href="#">
                <span class="fa <?php echo ( in_array( 'test', array('page', 'user', 'settings' ) ) ) ? 'fa-minus-circle' : 'fa-plus-circle'; ?>"></span>
              </a>
            </h6>
            <ul class="nav flex-column mb-2 <?php echo ( in_array( 'test', array('page', 'user', 'settings' ) ) ) ? '' : 'd-none'; ?>">
              <li class="nav-item">
                <a class="nav-link" href="dashboard/page">
                  <span class="fa fa-leaf"></span>
                  Pages
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="dashboard/user/administrator">
                  <span class="fa fa-user-secret"></span>
                  Administrations
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="dashboard/settings">
                  <span class="fa fa-cog"></span>
                  Settings
                </a>
              </li>
            </ul>
          </div>
