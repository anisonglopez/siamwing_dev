<?php
    $role_id = $_SESSION['role_id'];
    $statement = $pdo->prepare("SELECT 01_role_menu.*, 00_menu.module_id  FROM 01_role_menu 
    LEFT JOIN 00_menu ON 00_menu.menu_id = 01_role_menu.menu_id 
    WHERE role_id = '$role_id' ");
    $statement->execute();
    $result_role_chk = $statement->fetchAll();
    $role_menu_chk = array();
    $role_module_chk = array();
    foreach ($result_role_chk as $row) :
      $role_menu_chk[] = $row['menu_id'];
      $role_module_chk[] = $row['module_id'];
    endforeach;
?>

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center " href="../home/">
  <div class="sidebar-brand-icon">
    <!-- <i class="fas fa-apple"></i> -->
    <img src="../../img/kubota-logo.png" class="round" style="max-width: 80%"/>
  </div>
  <!-- <div class="sidebar-brand-text mx-3"><?= $app['name']?> Management </div> -->
</a>
<!-- Divider -->
<hr class="sidebar-divider my-0">


<?php if( in_array('ECN', $role_module_chk)) : ?>

<!-- Nav Item - Dashboard -->
<li class="nav-item  <?=$ap == ($ap == 'ecn') ? 'active':'';?>" >
  <a class="nav-link" href="../ecn/ecn.php">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>ECN Overview</span></a>
</li>
<?php endif; //end Ecn role?> 
<!-- Divider -->
<hr class="sidebar-divider">

<?php if( in_array('DWG', $role_module_chk)) : ?>
<!-- Heading -->
<div class="sidebar-heading">
DWG Control
</div>

<!-- Nav Item - Dashboard -->
<li class="nav-item  <?=$ap == ($ap == 'dwgcontrol') ? 'active':'';?>" >
  <a class="nav-link" href="../dwg/dwgcontrol.php">
    <i class="fas fa-fw fa-cubes"></i>
    <span>Drawing Control</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">
<?php endif; //end Ecn role?> 

<?php if( in_array('NTI', $role_module_chk)) : ?>
<!-- Heading -->
<div class="sidebar-heading">
Notification
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item <?=$ap == ($ap == 'noti_exp') ? 'active':'';?>">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
    <i class="fas fa-fw fa-bell"></i>
    <span>Notification</span>
  </a>
  <div id="collapseTwo" class="collapse <?=$ap == ($ap == 'noti_exp') ? 'show':'';?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">การแจ้งเตือน :</h6>
      <a class="collapse-item <?=$ap == ($ap == 'noti_exp') ? 'active':'';?>"  href="../noti_exp/noti_exp.php">Notification List</a>
    </div>
  </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider">
<?php endif; //end Ecn role?> 

<?php if( in_array('CON', $role_module_chk)) : ?>
<!-- Heading -->
<div class="sidebar-heading">
  System
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item <?=$ap == ($ap == 'module') || ($ap == 'menu') || ($ap == 'eff') || ($ap == 'mail_config') ? 'active':'';?>">
  <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseMaster" aria-expanded="true" aria-controls="collapseMaster">
    <i class="fas fa-fw fa-cog"></i>
    <span>Configuration</span>
  </a>
  <div id="collapseMaster" class="collapse <?=($ap == 'module') || ($ap == 'menu') || ($ap == 'eff') || ($ap == 'mail_config')  ? 'show':'';?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Configuration:</h6>
      <?php if( in_array('MOD', $role_menu_chk)) : ?>
          <a class="collapse-item <?=$ap == 'module'? 'active':'';?>" href="../module/module.php">Module</a>
      <?php endif; //end System role?> 
      <?php if( in_array('MENU', $role_menu_chk)) : ?>
          <a class="collapse-item <?=$ap == 'menu'? 'active':'';?>" href="../menu/menu.php">Menu</a>
          <?php endif; //end System role?> 
          <?php if( in_array('EFFDATE', $role_menu_chk)) : ?>
          <a class="collapse-item <?=$ap == 'eff'? 'active':'';?>" href="../effective_date/eff.php">Day of notice</a>
          <?php endif; //end System role?> 
          <a class="collapse-item <?=$ap == 'mail_config'? 'active':'';?>" href="../mail_config/mail_config.php">Manage email template</a>
      <!-- <a class="collapse-item <?=$ap == 'newpage'? 'active':'';?>" href="../base/newpage.php">Blank</a> -->
      <div class="collapse-divider"></div>
    </div>
  </div>
</li>

<?php endif; //end System role?> 
<?php if( in_array('MAS', $role_module_chk)) : ?>
<!-- Nav Item - Master -->
<li class="nav-item <?=$ap == 'dep' || ($ap == 'dep_create') ? 'active':'';?>">
  <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
    <i class="fas fa-fw fa-folder"></i>
    <span>Master Data</span>
  </a>
  <div id="collapsePages" class="collapse <?=($ap == 'dep') || ($ap == 'dep_create')  ? 'show':'';?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">ข้อมูลตั้งต้นระบบ:</h6>
      <a class="collapse-item <?=$ap == 'dep' || ($ap == 'dep_create')? 'active':'';?>" href="../department/dep.php">Department</a>
      <a class="collapse-item" href="../company/company.php">Company</a>
      <div class="collapse-divider"></div>
    </div>
  </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider">
<?php endif; //end System role?> 

<?php if( in_array('ADM', $role_module_chk)) : ?>
<!-- Heading -->
<div class="sidebar-heading">
  Authentication
</div>

<!-- Nav Item - Pages Configuration -->
<li class="nav-item <?=$ap == ($ap == 'user_profile') || ($ap == 'permission')  ? 'active':'';?>">
  <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseUser" aria-expanded="true" aria-controls="collapseUser">
    <i class="fas fa-fw fa-user"></i>
    <span>User Profile</span>
  </a>
  <div id="collapseUser" class="collapse <?=$ap == ($ap == 'user_profile') || ($ap == 'permission')  ? 'show':'';?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header ">User Manage:</h6>
      <?php if( in_array('USR', $role_menu_chk)) : ?>
      <a class="collapse-item <?=$ap == 'user_profile'? 'active':'';?>" href="../user/user_profile.php">User</a>
      <?php endif; //end System role?> 
      <?php if( in_array('PER', $role_menu_chk)) : ?>
      <a class="collapse-item <?=$ap == 'permission'? 'active':'';?>" href="../user_role/permission.php">Permission</a>
      <?php endif; //end System role?> 
      <div class="collapse-divider"></div>
    </div>
  </div>
</li>
<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">
<?php endif; //end System role?> 

<!-- Heading -->
<!-- <div class="sidebar-heading">
  Logs
</div> -->
<!-- Nav Item - Pages Configuration -->
<!-- <li class="nav-item ">
  <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseLogs" aria-expanded="true" aria-controls="collapseLogs">
    <i class="fas fa-fw fa-folder"></i>
    <span>Logs</span>
  </a>
  <div id="collapseLogs" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header ">ประวัติการใช้งาน:</h6>
      <a class="collapse-item <?=$ap == 'user_prsofile'? 'active':'';?>" href="#">Mail Logs</a>
      <a class="collapse-item <?=$ap == 'permisssion'? 'active':'';?>" href="#">User Logs</a>
      <a class="collapse-item <?=$ap == 'permisssion'? 'active':'';?>" href="#">Login Logs</a>
      <div class="collapse-divider"></div>
    </div>
  </div>
</li> -->

<!-- Divider -->
<!-- <hr class="sidebar-divider d-none d-md-block"> -->

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="btn btn-info border-0" id="sidebarToggle"></button>
  <button class="btn btn-info border-0" id="viewless" >
       <i class="fas fa-angle-right"></i>
      </button>
  
</div>

</ul>
<!-- End of Sidebar -->