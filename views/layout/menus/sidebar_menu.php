<div class="sidebar-nav mm-active">
  <!--navigation-->
  <ul class="metismenu" id="sidenav">
    <!-- Dashboard Home -->
    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="material-icons-outlined">home</i>
        </div>
        <div class="menu-title">Home</div>
      </a>
      <ul>
        <li><a href="/home"><i class="material-icons-outlined">arrow_right</i>Home</a>
        </li>
        <?php if ($_SESSION['urole'] === 'Driver'): ?>
        <li><a href="<?=$base_url;?>/staff/trips"><i class="material-icons-outlined">arrow_right</i>My Trips</a>
        </li>
        <?php endif;?>
      </ul>
    </li>
    <!-- Dashboard User Menu Start -->
     <?php if ($_SESSION['urole'] === 'Admin' || $_SESSION['urole'] === 'Manager'): ?>
       <li>
        <a class='has-arrow' href='javascript:;'>
          <div class='parent-icon'><i class='material-icons-outlined'>settings_accessibility</i>
          </div>
          <div class='menu-title'>Users</div>
        </a>
        <ul>
          <li><a href='<?=$base_url?>/user'><i class='material-icons-outlined'>arrow_right</i>Users</a>
          </li>
          <li><a href='<?=$base_url?>/user/create'><i class='material-icons-outlined'>arrow_right</i>Add User</a>
          </li>
        </ul>
      </li>
    <?php endif;?>

    <!-- Dashboard User Menu End -->
    <!-- Dashboard User Role Menu Start -->
     <?php if ($_SESSION['urole'] === 'Admin' || $_SESSION['urole'] === 'Manager'): ?>
    <li>
      <a class="has-arrow" href="javascript:;">
        <div class="parent-icon"><i class="material-icons-outlined">key</i>
        </div>
        <div class="menu-title">Roles</div>
      </a>
      <ul>
        <li><a href="<?=$base_url?>/role"><i class="material-icons-outlined">arrow_right</i>Roles</a>
        </li>
        <li><a href="<?=$base_url?>/role/create"><i class="material-icons-outlined">arrow_right</i>Add Role</a>
        </li>
      </ul>
    </li>
     <?php endif;?>
    <!-- Dashboard User Role Menu End -->
    <!-- Dashboard Vehicle Management Menu Start -->
     <?php if ($_SESSION['urole'] === 'Admin' || $_SESSION['urole'] === 'Manager'): ?>
    <li>
      <a class="has-arrow" href="javascript:;">
        <div class="parent-icon"><i class="material-icons-outlined">car_rental</i>
        </div>
        <div class="menu-title">Vehicle Management</div>
      </a>
      <ul>
        <li><a class="has-arrow" href="javascript:;"><i class="material-icons-outlined">arrow_right</i>Vehicles</a>
          <ul>
            <li><a href="<?=$base_url?>/vehicle"><i class="material-icons-outlined">arrow_right</i>All Vehicle</a>
            </li>
            <li><a href="<?=$base_url?>/vehicle/create"><i class="material-icons-outlined">arrow_right</i>Add Vehicle</a>
            </li>
            <li><a href="<?=$base_url?>/vehicle/available"><i class="material-icons-outlined">arrow_right</i>Available Vehicle</a>
            </li>
            <li><a href="<?=$base_url?>/vehicle/intrip"><i class="material-icons-outlined">arrow_right</i>In Trip</a>
            </li>
            <li><a href="<?=$base_url?>/vehicle/under_maintenance"><i class="material-icons-outlined">arrow_right</i>Under Maintenance</a>
            </li>
          </ul>
        </li>
        <li><a class="has-arrow" href="javascript:;"><i class="material-icons-outlined">arrow_right</i>Vehicle Types</a>
          <ul>
            <li><a href="<?=$base_url?>/vehicle_type"><i class="material-icons-outlined">arrow_right</i>Vehicle Types</a>
            </li>
            <li><a href="<?=$base_url?>/vehicle_type/create"><i class="material-icons-outlined">arrow_right</i>Add Vehicle Type</a>
            </li>
          </ul>
        </li>
        <li><a class="has-arrow" href="javascript:;"><i class="material-icons-outlined">arrow_right</i>Vehicle status</a>
          <ul>
            <li><a href="<?=$base_url?>/vehicle_status"><i class="material-icons-outlined">arrow_right</i>Vehicle Status</a>
            </li>
            <li><a href="<?=$base_url?>/vehicle_status/create"><i class="material-icons-outlined">arrow_right</i>Add Vehicle Status</a>
            </li>
          </ul>
        </li>
        <li><a class="has-arrow" href="javascript:;"><i class="material-icons-outlined">arrow_right</i>Vehicle Engine Types</a>
          <ul>
            <li><a href="<?=$base_url?>/vehicle_engine_type"><i class="material-icons-outlined">arrow_right</i>Engine Types</a>
            </li>
            <li><a href="<?=$base_url?>/vehicle_engine_type/create"><i class="material-icons-outlined">arrow_right</i>Add Engine Type</a>
            </li>
          </ul>
        </li>
      </ul>
    </li>
     <?php endif;?>
    <!-- Dashboard Vehicle Management Menu End -->
    <!-- Dashboard Vehicle Maintenance Menu Start -->
     <li>
      <a class="has-arrow" href="javascript:;">
        <div class="parent-icon"><i class="material-icons-outlined">settings</i>
        </div>
        <div class="menu-title">Maintenance</div>
      </a>
      <ul>
        <?php if ($_SESSION['urole'] === 'Admin' || $_SESSION['urole'] === 'Manager' || $_SESSION['urole'] == 'Driver'): ?>
        <li><a href="<?=$base_url?>/maintenance/create"><i class="material-icons-outlined">arrow_right</i>Request Maintenance</a>
        </li>
        <li><a href="<?=$base_url?>/fuel/create"><i class="material-icons-outlined">arrow_right</i>ReFuel Vehicle</a>
        </li>
        <?php endif?>
        <li><a href="<?=$base_url?>/fuel"><i class="material-icons-outlined">arrow_right</i>Fuel Tracking</a>
        </li>
        <?php if ($_SESSION['urole'] === 'Admin' || $_SESSION['urole'] === 'Manager' || $_SESSION['urole'] === 'Owner'): ?>
        <li><a href="<?=$base_url?>/maintenance"><i class="material-icons-outlined">arrow_right</i>Maintenance Requests</a>
        </li>
        <?php endif;?>
<?php if ($_SESSION['urole'] === 'Admin' || $_SESSION['urole'] === 'Manager'): ?>
        <li><a href="<?=$base_url?>/maintenance_status"><i class="material-icons-outlined">arrow_right</i>All Maintenance Status</a>
        </li>
        <li><a href="<?=$base_url?>/fuel_type"><i class="material-icons-outlined">arrow_right</i>All Fuel Types</a>
        </li>
        <?php endif;?>
      </ul>
    </li>
    <!-- Dashboard Vehicle Maintenance Menu End -->
    <!-- Dashboard Bookings Management Menu Start -->
    <?php if ($_SESSION['urole'] === 'Admin' || $_SESSION['urole'] === 'Manager'): ?>
    <li>
      <a class="has-arrow" href="javascript:;">
        <div class="parent-icon"><i class="material-icons-outlined">dataset</i>
        </div>
        <div class="menu-title">Bookings</div>
      </a>
      <ul>
        <li><a href="<?=$base_url?>/booking"><i class="material-icons-outlined">arrow_right</i>All Bookings</a>
        </li>
        <li><a href="<?=$base_url?>/booking/pending_bookings"><i class="material-icons-outlined">arrow_right</i>Pending Bookings</a>
        </li>
        <li><a href="<?=$base_url?>/booking_status"><i class="material-icons-outlined">arrow_right</i>Booking Status</a>
        </li>
      </ul>
    </li>
     <?php endif;?>
    <!-- Dashboard Bookings Management Menu End -->
    <!-- Dashboard Staff Management Menu Start -->
     <?php if ($_SESSION['urole'] === 'Admin' || $_SESSION['urole'] === 'Manager'): ?>
    <li>
      <a class="has-arrow" href="javascript:;">
        <div class="parent-icon"><i class="material-icons-outlined">group_add</i>
        </div>
        <div class="menu-title">Staff Management</div>
      </a>
      <ul>
        <li><a class="has-arrow" href="javascript:;"><i class="material-icons-outlined">arrow_right</i>Staff</a>
          <ul>
            <li><a href="<?=$base_url?>/staff"><i class="material-icons-outlined">arrow_right</i>All Staff</a>
            </li>
            <li><a href="<?=$base_url?>/staff/create"><i class="material-icons-outlined">arrow_right</i>Add Staff</a>
            </li>
            <li><a href="#"><i class="material-icons-outlined">arrow_right</i>Processing Tasks</a>
            </li>
            <li><a href="#"><i class="material-icons-outlined">arrow_right</i>Salary Tracking</a>
            </li>
          </ul>
        </li>
        <li><a class="has-arrow" href="javascript:;"><i class="material-icons-outlined">arrow_right</i>Staff Task</a>
          <ul>
            <li><a href="<?=$base_url?>/staff_task"><i class="material-icons-outlined">arrow_right</i>Tasks</a>
            </li>
            <li><a href="<?=$base_url?>/staff_task/create"><i class="material-icons-outlined">arrow_right</i>Task Assign</a>
            </li>
          </ul>
        </li>
        <li><a class="has-arrow" href="javascript:;"><i class="material-icons-outlined">arrow_right</i>Staff Designation</a>
          <ul>
            <li><a href="<?=$base_url?>/designation"><i class="material-icons-outlined">arrow_right</i>Staff Designations</a>
            </li>
            <li><a href="<?=$base_url?>/designation/create"><i class="material-icons-outlined">arrow_right</i>Add Designation</a>
            </li>
          </ul>
        </li>
        <li><a class="has-arrow" href="javascript:;"><i class="material-icons-outlined">arrow_right</i>Task status</a>
          <ul>
            <li><a href="<?=$base_url?>/task_status"><i class="material-icons-outlined">arrow_right</i>All Task Status</a>
            </li>
            <li><a href="<?=$base_url?>/task_status/create"><i class="material-icons-outlined">arrow_right</i>Add Task Status</a>
            </li>
          </ul>
        </li>
        <li><a class="has-arrow" href="javascript:;"><i class="material-icons-outlined">arrow_right</i>Salary Status</a>
          <ul>
            <li><a href="<?=$base_url?>/salary_status"><i class="material-icons-outlined">arrow_right</i>Salary Status</a>
            </li>
            <li><a href="<?=$base_url?>/salary_status/create"><i class="material-icons-outlined">arrow_right</i>Add Salary Status</a>
            </li>
          </ul>
        </li>
      </ul>
    </li>
     <?php endif;?>
    <!-- Dashboard Staff Management Menu End -->
    <!-- Dashboard Owner Management Menu Start -->
     <?php if ($_SESSION['urole'] === 'Admin' || $_SESSION['urole'] === 'Manager'): ?>
      <li>
        <a class="has-arrow" href="javascript:;">
          <div class="parent-icon"><i class="material-icons-outlined">engineering</i>
          </div>
          <div class="menu-title">Owner Management</div>
        </a>
        <ul>
          <li><a class="has-arrow" href="javascript:;"><i class="material-icons-outlined">arrow_right</i>Owner</a>
            <ul>
              <li><a href="<?=$base_url?>/owner"><i class="material-icons-outlined">arrow_right</i>All Owner</a>
              </li>
              <li><a href="<?=$base_url?>/owner/create"><i class="material-icons-outlined">arrow_right</i>Add Owner</a>
              </li>
            </ul>
          </li>
          <li><a class="has-arrow" href="javascript:;"><i class="material-icons-outlined">arrow_right</i>Commission Types</a>
            <ul>
              <li><a href="<?=$base_url?>/commission_type"><i class="material-icons-outlined">arrow_right</i>All Commissions</a>
              </li>
              <li><a href="<?=$base_url?>/commission_type/create"><i class="material-icons-outlined">arrow_right</i>Add Commission</a>
              </li>
            </ul>
          </li>
        </ul>
      </li>
    <?php endif;?>
    <!-- Dashboard Owner Management Menu End -->
    <!-- Dashboard Customer Management Menu Start -->
    <?php if ($_SESSION['urole'] === 'Admin' || $_SESSION['urole'] === 'Manager'): ?>
    <li>
      <a class="has-arrow" href="javascript:;">
        <div class="parent-icon"><i class="material-icons-outlined">groups</i>
        </div>
        <div class="menu-title">Customers</div>
      </a>
      <ul>
            <li><a href="<?=$base_url?>/customers"><i class="material-icons-outlined">arrow_right</i>All Customers</a>
            </li>
      </ul>
    </li>
     <?php endif;?>
    <!-- Dashboard Customer Management Menu End -->
    <!-- Dashboard Revenue & Payment Management Menu Start -->
     <?php if ($_SESSION['urole'] === 'Admin' || $_SESSION['urole'] === 'Manager' || $_SESSION['urole'] === 'Owner'): ?>
    <li>
      <a class="has-arrow" href="javascript:;">
        <div class="parent-icon"><i class="material-icons-outlined">paid</i>
        </div>
        <div class="menu-title">Revenue & Payment</div>
      </a>
      <ul>
        <?php if ($_SESSION['urole'] === 'Admin' || $_SESSION['urole'] === 'Manager'): ?>
        <li><a class="has-arrow" href="javascript:;"><i class="material-icons-outlined">arrow_right</i>Admin Revenue</a>
          <ul>
            <li><a href="<?=$base_url?>/agency/agency_revenue"><i class="material-icons-outlined">arrow_right</i>Agency Revenue</a>
            </li>
            <li><a href="<?=$base_url?>/agency/owner_payment"><i class="material-icons-outlined">arrow_right</i>Owner's Payment</a>
            </li>
          </ul>
        </li>
        <?php endif?>
<?php if ($_SESSION['urole'] === 'Owner'): ?>
        <li><a class="has-arrow" href="javascript:;"><i class="material-icons-outlined">arrow_right</i>Owner Revenue</a>
          <ul>
            <li><a href="<?=$base_url?>/revenue/owner_revenues"><i class="material-icons-outlined">arrow_right</i>Revenue Tracking</a>
            </li>
            <li><a href="<?=$base_url?>/revenue/owner_expenses"><i class="material-icons-outlined">arrow_right</i>Expense Tracking</a>
            </li>
            <li><a href="<?=$base_url?>/revenue/owner_net_earnings"><i class="material-icons-outlined">arrow_right</i>Net Earnings</a>
            </li>
          </ul>
        </li>
        <?php endif;?>
<?php if ($_SESSION['urole'] === 'Admin' || $_SESSION['urole'] === 'Manager'): ?>
        <li><a class="has-arrow" href="javascript:;"><i class="material-icons-outlined">arrow_right</i>Payments</a>
          <ul>
            <li><a href="<?=$base_url?>/payments"><i class="material-icons-outlined">arrow_right</i>All Payments</a>
            </li>
            <li><a href="<?=$base_url?>/payment_status"><i class="material-icons-outlined">arrow_right</i>Payment Status</a>
            </li>
          </ul>
        </li>
        <?php endif;?>
      </ul>
    </li>
     <?php endif;?>
    <!-- Dashboard Revenue & Payment Management Menu End -->
    <!-- Dashboard Report & Analytics Management Menu Start -->
     <?php if ($_SESSION['urole'] === 'Admin' || $_SESSION['urole'] === 'Manager'): ?>
    <li>
      <a class="has-arrow" href="javascript:;">
        <div class="parent-icon"><i class="material-icons-outlined">trending_up</i>
        </div>
        <div class="menu-title">Report & Analytics</div>
      </a>
      <ul>
        <li><a class="has-arrow" href="javascript:;"><i class="material-icons-outlined">arrow_right</i>Owner Reports</a>
          <ul>
            <li><a href="<?=$base_url?>"><i class="material-icons-outlined">arrow_right</i>Vehicle Revenue & Expenses</a>
            </li>
            <li><a href="<?=$base_url?>"><i class="material-icons-outlined">arrow_right</i>Trip Summaries</a>
            </li>
            <li><a href="<?=$base_url?>"><i class="material-icons-outlined">arrow_right</i>Earnings Summary</a>
            </li>
          </ul>
        </li>
        <li><a class="has-arrow" href="javascript:;"><i class="material-icons-outlined">arrow_right</i>Revenue Report</a>
          <ul>
            <li><a href="<?=$base_url?>"><i class="material-icons-outlined">arrow_right</i>Total Revenue</a>
            </li>
            <li><a href="<?=$base_url?>"><i class="material-icons-outlined">arrow_right</i>Total Expenses</a>
            </li>
            <li><a href="<?=$base_url?>"><i class="material-icons-outlined">arrow_right</i>Net Earnings</a>
            </li>
          </ul>
        </li>
      </ul>
    </li>
     <?php endif;?>
    <!-- Dashboard Revenue & Payment Management Menu End -->
    <li class="text-center mt-2">
      <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="<?=$base_url?>/logout.php"><i
          class="material-icons-outlined">power_settings_new</i>Logout</a>
    </li>
  </ul>
  <!--end navigation-->
</div>