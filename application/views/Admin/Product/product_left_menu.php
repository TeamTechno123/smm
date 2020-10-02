<div class="card card-widget widget-user-2">
  <div class="card-footer p-0">
    <ul class="nav flex-column hr_setting_leftmenu">
      <li class="nav-item">
        <a href="<?php echo base_url(); ?>Product/unit" class="nav-link <?php if($setting_menu == 'unit'){ echo 'active'; } ?>">Unit</a>
      </li>
      <li class="nav-item">
        <a href="<?php echo base_url(); ?>Product/item_company" class="nav-link <?php if($setting_menu == 'item_company'){ echo 'active'; } ?>">Item Company</a>
      </li>
      <li class="nav-item">
        <a href="<?php echo base_url(); ?>Product/item_group" class="nav-link <?php if($setting_menu == 'item_group'){ echo 'active'; } ?>">Item Group</a>
      </li>
      <li class="nav-item">
        <a href="<?php echo base_url(); ?>Product/package_category" class="nav-link <?php if($setting_menu == 'package_category'){ echo 'active'; } ?>">Package Category</a>
      </li>
    </ul>
  </div>
</div>
