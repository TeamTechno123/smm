<div class="card card-widget widget-user-2 project_menu">
  <div class="card-footer p-0">
    <ul class="nav">
      <li class="nav-item <?php if($page == 'Project Overview'){ echo 'active'; } ?>" >
        <a href="<?php echo base_url(); ?>Project/project_det_overview" class="nav-link ">Overview</a>
      </li>

       <li class="nav-item <?php if($page == 'Project Progress'){ echo 'active'; } ?>">
        <a href="<?php echo base_url(); ?>Project/project_det_progress" class="nav-link">Progress </a>
      </li>

       <li class="nav-item <?php if($page == 'Project Time Log'){ echo 'active'; } ?>">
        <a href="<?php echo base_url(); ?>Project/project_det_time_log" class="nav-link">Time Log </a>
      </li>
       <li class="nav-item <?php if($page == 'Project Revision'){ echo 'active'; } ?>">
        <a href="<?php echo base_url(); ?>Project/project_det_revision" class="nav-link">Revision</a>
      </li>
      <li class="nav-item <?php if($page == 'Project Task'){ echo 'active'; } ?>">
        <a href="<?php echo base_url(); ?>Project/project_det_task" class="nav-link">Task</a>
      </li>
      <li class="nav-item <?php if($page == 'Project File'){ echo 'active'; } ?>">
        <a href="<?php echo base_url(); ?>Project/project_det_file" class="nav-link">File</a>
      </li>
      <li class="nav-item <?php if($page == 'Project Milestone'){ echo 'active'; } ?>">
        <a href="<?php echo base_url(); ?>Project/project_det_milestone" class="nav-link">Milestone</a>
      </li>
      <li class="nav-item <?php if($page == 'Project Invoice'){ echo 'active'; } ?>">
        <a href="<?php echo base_url(); ?>Project/project_det_invoice" class="nav-link">Invoice</a>
      </li>
      <li class="nav-item <?php if($page == 'Project Discussion'){ echo 'active'; } ?>">
        <a href="<?php echo base_url(); ?>Project/project_det_discussion" class="nav-link">Discussions</a>
      </li>

      <!-- <li class="nav-item">
        <a href="<?php echo base_url(); ?>Emp_Panel/Emp_Master/note" class="nav-link">Note </a>
      </li> -->


    </ul>
  </div>
</div>
