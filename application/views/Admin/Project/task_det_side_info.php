<div class="card p-4">
  <div class="row">
   <div class="col-md-12">
     <h6>Task Details</h6>
     <hr>
   </div>
   <div class="col-6">
     <p>Title</p>
   </div>
   <div class="col-6">
     <p class="text-primary"><?php if($task_info){ echo $task_info['task_title']; } ?></p>
   </div>

   <div class="col-6">
     <p>Project</p>
   </div>
   <div class="col-6">
     <p ><?php echo $project_info['project_name']; ?></p>
   </div>

   <div class="col-6">
     <p>Start Date</p>
   </div>
   <div class="col-6">
     <p ><?php echo $task_info['task_start_date']; ?></p>
   </div>
   <div class="col-6">
     <p>End Date</p>
   </div>
   <div class="col-6">
     <p ><?php echo $task_info['task_end_date']; ?></p>
   </div>
   <div class="col-6">
     <p>Hours</p>
   </div>
   <div class="col-6">
     <p ><?php echo $task_info['task_est_hour']; ?></p>
   </div>
   <div class="col-6">
     <p>Priority</p>
   </div>
   <div class="col-6">
     <p ><?php echo $task_info['task_priority']; ?></p>
   </div>

   <div class="col-6">
     <p>Client</p>
   </div>
   <div class="col-6">
     <p class="text-primary"><?php if($client_info){ echo $client_info[0]['reseller_name']; } ?></p>
   </div>

   <div class="col-6">
     <p>Progress </p>
   </div>
   <div class="col-6">
    <span class="f-12">Complete: <?php echo $task_info['task_progress']; ?>%</span>
     <div class="progress">
        <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $task_info['task_progress']; ?>%;" aria-valuenow="44" aria-valuemin="0" aria-valuemax="100"><?php echo $task_info['task_progress']; ?>%</div>
     </div>
   </div>


</div>
</div>
