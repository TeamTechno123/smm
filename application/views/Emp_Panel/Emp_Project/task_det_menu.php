<div class="card card-widget widget-user-2 project_menu">
  <div class="card-footer p-0">
    <ul class="nav">
      <li class="nav-item <?php if($page == 'Task Overview'){ echo 'active'; } ?>" >
        <a href="<?php echo base_url(); ?>Emp_Panel/Emp_Project/task_det_overview" class="nav-link ">Overview</a>
      </li>
       <li class="nav-item <?php if($page == 'Task Progress'){ echo 'active'; } ?>">
        <a href="<?php echo base_url(); ?>Emp_Panel/Emp_Project/task_det_progress" class="nav-link">Progress </a>
      </li>
      <li class="nav-item <?php if($page == 'Task File'){ echo 'active'; } ?>">
        <a href="<?php echo base_url(); ?>Emp_Panel/Emp_Project/task_det_file" class="nav-link">File</a>
      </li>

      <!-- <li class="nav-item">
        <a href="<?php echo base_url(); ?>Emp_Panel/Emp_Master/note" class="nav-link">Note </a>
      </li> -->


    </ul>
  </div>
</div>
