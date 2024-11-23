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
      </ul>
    </li>
    <!-- Dashboard User Menu Start -->
    <li>
      <a class="has-arrow" href="javascript:;">
        <div class="parent-icon"><i class="material-icons-outlined">settings_accessibility</i>
        </div>
        <div class="menu-title">Users</div>
      </a>
      <ul>
        <li><a href="<?= $base_url ?>/user"><i class="material-icons-outlined">arrow_right</i>Users</a>
        </li>
        <li><a href="<?= $base_url ?>/user/create"><i class="material-icons-outlined">arrow_right</i>Add User</a>
        </li>
      </ul>
    </li>
    <!-- Dashboard User Menu End -->
    <!-- Dashboard User Role Menu Start -->
    <li>
      <a class="has-arrow" href="javascript:;">
        <div class="parent-icon"><i class="material-icons-outlined">key</i>
        </div>
        <div class="menu-title">Roles</div>
      </a>
      <ul>
        <li><a href="<?= $base_url ?>/role"><i class="material-icons-outlined">arrow_right</i>Roles</a>
        </li>
        <li><a href="<?= $base_url ?>/role/create"><i class="material-icons-outlined">arrow_right</i>Add Role</a>
        </li>
      </ul>
    </li>
    <!-- Dashboard User Role Menu End -->
    <!-- Dashboard Vehicle Management Menu Start -->
    <li>
      <a class="has-arrow" href="javascript:;">
        <div class="parent-icon"><i class="material-icons-outlined">car_rental</i>
        </div>
        <div class="menu-title">Vehicle Management</div>
      </a>
      <ul>
        <li><a class="has-arrow" href="javascript:;"><i class="material-icons-outlined">arrow_right</i>Vehicles</a>
          <ul>
            <li><a href="<?= $base_url ?>/vehicle"><i class="material-icons-outlined">arrow_right</i>All Vehicle</a>
            </li>
            <li><a href="<?= $base_url ?>/vehicle/create"><i class="material-icons-outlined">arrow_right</i>Add Vehicle</a>
            </li>
            <li><a href="#"><i class="material-icons-outlined">arrow_right</i>Available Vehicle</a>
            </li>
            <li><a href="#"><i class="material-icons-outlined">arrow_right</i>In Trip</a>
            </li>
            <li><a href="#"><i class="material-icons-outlined">arrow_right</i>Under Maintenance</a>
            </li>
          </ul>
        </li>
        <li><a class="has-arrow" href="javascript:;"><i class="material-icons-outlined">arrow_right</i>Vehicle Types</a>
          <ul>
            <li><a href="<?= $base_url ?>/vehicle_type"><i class="material-icons-outlined">arrow_right</i>Vehicle Types</a>
            </li>
            <li><a href="<?= $base_url ?>/vehicle_type/create"><i class="material-icons-outlined">arrow_right</i>Add Vehicle Type</a>
            </li>
          </ul>
        </li>
        <li><a class="has-arrow" href="javascript:;"><i class="material-icons-outlined">arrow_right</i>Vehicle status</a>
          <ul>
            <li><a href="<?= $base_url ?>/vehicle_status"><i class="material-icons-outlined">arrow_right</i>Vehicle Status</a>
            </li>
            <li><a href="<?= $base_url ?>/vehicle_status/create"><i class="material-icons-outlined">arrow_right</i>Add Vehicle Status</a>
            </li>
          </ul>
        </li>
        <li><a class="has-arrow" href="javascript:;"><i class="material-icons-outlined">arrow_right</i>Vehicle Engine Types</a>
          <ul>
            <li><a href="<?= $base_url ?>/vehicle_engine_type"><i class="material-icons-outlined">arrow_right</i>Engine Types</a>
            </li>
            <li><a href="<?= $base_url ?>/vehicle_engine_type/create"><i class="material-icons-outlined">arrow_right</i>Add Engine Type</a>
            </li>
          </ul>
        </li>
      </ul>
    </li>
    <!-- Dashboard Vehicle Management Menu End -->
    <!-- Dashboard Bookings Management Menu Start -->
    <li>
      <a class="has-arrow" href="javascript:;">
        <div class="parent-icon"><i class="material-icons-outlined">list</i>
        </div>
        <div class="menu-title">Bookings</div>
      </a>
      <ul>
        <li><a href="#"><i class="material-icons-outlined">arrow_right</i>All Bookings</a>
        </li>
      </ul>
    </li>
    <!-- Dashboard Bookings Management Menu End -->
    <!-- Dashboard Staff Management Menu Start -->
    <li>
      <a class="has-arrow" href="javascript:;">
        <div class="parent-icon"><i class="material-icons-outlined">group_add</i>
        </div>
        <div class="menu-title">Staff Management</div>
      </a>
      <ul>
        <li><a class="has-arrow" href="javascript:;"><i class="material-icons-outlined">arrow_right</i>Staff</a>
          <ul>
            <li><a href="<?= $base_url ?>/staff"><i class="material-icons-outlined">arrow_right</i>All Staff</a>
            </li>
            <li><a href="<?= $base_url ?>/staff/create"><i class="material-icons-outlined">arrow_right</i>Add Staff</a>
            </li>
            <li><a href="#"><i class="material-icons-outlined">arrow_right</i>Processing Tasks</a>
            </li>
            <li><a href="#"><i class="material-icons-outlined">arrow_right</i>Salary Tracking</a>
            </li>
        </li>
      </ul>
    </li>
    <li><a class="has-arrow" href="javascript:;"><i class="material-icons-outlined">arrow_right</i>Staff Task</a>
      <ul>
        <li><a href="<?= $base_url ?>/staff_task"><i class="material-icons-outlined">arrow_right</i>Tasks</a>
        </li>
        <li><a href="<?= $base_url ?>/staff_task/create"><i class="material-icons-outlined">arrow_right</i>Task Assign</a>
        </li>
      </ul>
    </li>
    <li><a class="has-arrow" href="javascript:;"><i class="material-icons-outlined">arrow_right</i>Staff Designation</a>
      <ul>
        <li><a href="<?= $base_url ?>/designation"><i class="material-icons-outlined">arrow_right</i>Staff Designations</a>
        </li>
        <li><a href="<?= $base_url ?>/designation/create"><i class="material-icons-outlined">arrow_right</i>Add Designation</a>
        </li>
      </ul>
    </li>
    <li><a class="has-arrow" href="javascript:;"><i class="material-icons-outlined">arrow_right</i>Task status</a>
      <ul>
        <li><a href="<?= $base_url ?>/task_status"><i class="material-icons-outlined">arrow_right</i>All Task Status</a>
        </li>
        <li><a href="<?= $base_url ?>/task_status/create"><i class="material-icons-outlined">arrow_right</i>Add Task Status</a>
        </li>
      </ul>
    </li>
    <li><a class="has-arrow" href="javascript:;"><i class="material-icons-outlined">arrow_right</i>Salary Status</a>
      <ul>
        <li><a href="<?= $base_url ?>/salary_status"><i class="material-icons-outlined">arrow_right</i>Salary Status</a>
        </li>
        <li><a href="<?= $base_url ?>/salary_status/create"><i class="material-icons-outlined">arrow_right</i>Add Salary Status</a>
        </li>
      </ul>
    </li>
  </ul>
  </li>
  <!-- Dashboard Staff Management Menu End -->
  </ul>
  <!--end navigation-->
</div>