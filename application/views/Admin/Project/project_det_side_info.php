<div class="card p-4">
  <div class="row">
   <div class="col-md-12">
     <h6>Project Details</h6>
     <hr>
   </div>
   <div class="col-6">
     <p>Client</p>
   </div>
   <div class="col-6">
     <p class="text-primary"><?php if($client_info){ echo $client_info[0]['reseller_name']; } ?></p>
   </div>

   <div class="col-6">
     <p>Start Date</p>
   </div>
   <div class="col-6">
     <p ><?php echo $project_info['project_start_date']; ?></p>
   </div>

   <div class="col-6">
     <p>End Date</p>
   </div>
   <div class="col-6">
     <p ><?php echo $project_info['project_end_date']; ?></p>
   </div>

   <div class="col-6">
     <p>Priority</p>
   </div>
   <div class="col-6">
     <p ><?php echo $project_info['project_piority']; ?></p>
   </div>

   <div class="col-6">
     <p>Project No.</p>
   </div>
   <div class="col-6">
     <p ><?php echo $project_info['project_no']; ?></p>
   </div>

   <div class="col-6">
     <p>Budget Hours</p>
   </div>
   <div class="col-6">
     <p ><?php echo $project_info['project_budget_hours']; ?> Hr.</p>
   </div>



   <!-- <div class="col-6">
     <p>Actual Hours</p>
   </div>
   <div class="col-6">
     <p >10 hours</p>
   </div> -->

   <div class="col-6">
     <p>Project Progress </p>
   </div>
   <div class="col-6">
    <span class="f-12">Complete: <?php echo $project_info['project_progress']; ?>%</span>
     <div class="progress">
        <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $project_info['project_progress']; ?>%;" aria-valuenow="44" aria-valuemin="0" aria-valuemax="100"><?php echo $project_info['project_progress']; ?>%</div>
     </div>
   </div>

   <div class="col-12 p-0">
    <hr>
      <div class="mobiletrack d-block m-0">
        <div class="timeline-block timeline-block-right w-100">
          <div class="marker"></div>
          <div class="timeline-content">
            <h6 class="mb-0 mt-2 ">Project Start</h6>
            <span><?php echo $project_info['project_start_date']; ?></span>
          </div>
        </div>
        <?php foreach ($task_list as $task_list1) { ?>
          <div class="timeline-block timeline-block-right w-100">
            <div class="marker"></div>
            <div class="timeline-content">
              <h6 class="mb-0 mt-2 "><?php echo $task_list1->task_title;  ?></h6>
              <span><?php echo $task_list1->task_start_date.' To '.$task_list1->task_end_date;  ?></span>
            </div>
          </div>
        <?php } ?>

       <?php if($project_info['project_end_date']){ ?>
         <div class="timeline-block timeline-block-right w-100">
           <div class="marker"></div>
           <div class="timeline-content">
             <h6 class="mb-0 mt-2 ">Project End</h6>
             <span><?php echo $project_info['project_end_date']; ?></span>
           </div>
         </div>
       <?php } ?>

    </div>
   </div>
</div>
</div>
