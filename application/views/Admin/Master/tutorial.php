<!DOCTYPE html>
<html>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header pt-0 pb-2">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12 text-left mt-2">
            <h4>Tutorial</h4>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12" align="center">
          <button class="btn btn-default filter-button" data-filter="all">All</button>
          <button class="btn btn-default filter-button" data-filter="new">New </button>
          <button class="btn btn-default filter-button" data-filter="treding">Treding</button>
      </div>


      <div class="gallery_product col-md-3 col-sm-3 col-xs-6 filter new">
          <a href="<?php echo base_url(); ?>Master/tutorial_details">
          <div class="card shadow">
             <img class="card-img-top featured-card-img p-30" src="<?php echo base_url(); ?>assets/images/tutorial/tutorial_1_1602848490.jpg" alt="" width="100">
             <div class="card-body">
               <h4 class="card-title text-center mb-2 text-dark font-weight-bold">Card title</h4>
               <p class="card-text text-justify text-dark">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
             </div>
          </div>
          </a>
        </div>

               <div class="gallery_product col-md-3 col-sm-3 col-xs-6 filter treding">
                 <a href="<?php echo base_url(); ?>Master/tutorial_details">
                 <div class="card shadow">
                    <img class="card-img-top featured-card-img p-30" src="<?php echo base_url(); ?>assets/images/tutorial/tutorial_1_1602848490.jpg" alt="" width="100">
                    <div class="card-body">
                      <h4 class="card-title text-center mb-2 text-dark font-weight-bold">Card title</h4>
                      <p class="card-text text-justify text-dark">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                 </div>
                 </a>
                </div>

                <div class="gallery_product col-md-3 col-sm-3 col-xs-6 filter new">
                  <a href="#">
                  <div class="card shadow">
                     <img class="card-img-top featured-card-img p-30" src="<?php echo base_url(); ?>assets/images/tutorial/tutorial_1_1602848490.jpg" alt="" width="100">
                     <div class="card-body">
                       <h4 class="card-title text-center mb-2 text-dark font-weight-bold">Card title</h4>
                       <p class="card-text text-justify text-dark">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                     </div>
                  </div>
                  </a>
                </div>

               <div class="gallery_product col-md-3 col-sm-3 col-xs-6 filter new">
                 <a href="#">
                 <div class="card shadow">
                    <img class="card-img-top featured-card-img p-30" src="<?php echo base_url(); ?>assets/images/tutorial/tutorial_1_1602848490.jpg" alt="" width="100">
                    <div class="card-body">
                      <h4 class="card-title text-center mb-2 text-dark font-weight-bold">Card title</h4>
                      <p class="card-text text-justify text-dark">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                 </div>
                 </a>
                </div>

               <div class="gallery_product col-md-3 col-sm-3 col-xs-6 filter treding">
                 <a href="#">
                 <div class="card shadow">
                    <img class="card-img-top featured-card-img p-30" src="<?php echo base_url(); ?>assets/images/tutorial/tutorial_1_1602848490.jpg" alt="" width="100">
                    <div class="card-body">
                      <h4 class="card-title text-center mb-2 text-dark font-weight-bold">Card title</h4>
                      <p class="card-text text-justify text-dark">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                 </div>
                 </a>
                </div>

               <div class="gallery_product col-md-3 col-sm-3 col-xs-6 filter new">
                 <a href="#">
                 <div class="card shadow">
                    <img class="card-img-top featured-card-img p-30" src="<?php echo base_url(); ?>assets/images/tutorial/tutorial_1_1602848490.jpg" alt="" width="100">
                    <div class="card-body">
                      <h4 class="card-title text-center mb-2 text-dark font-weight-bold">Card title</h4>
                      <p class="card-text text-justify text-dark">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                 </div>
                 </a>
                </div>
                <div class="gallery_product col-md-3 col-sm-3 col-xs-6 filter treding">
                  <a href="#">
                  <div class="card shadow">
                     <img class="card-img-top featured-card-img p-30" src="<?php echo base_url(); ?>assets/images/tutorial/tutorial_1_1602848490.jpg" alt="" width="100">
                     <div class="card-body">
                       <h4 class="card-title text-center mb-2 text-dark font-weight-bold">Card title</h4>
                       <p class="card-text text-justify text-dark">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                     </div>
                  </div>
                  </a>
                </div>

                <div class="gallery_product col-md-3 col-sm-3 col-xs-6 filter new">
                  <a href="#">
                  <div class="card shadow">
                     <img class="card-img-top featured-card-img p-30" src="<?php echo base_url(); ?>assets/images/tutorial/tutorial_1_1602848490.jpg" alt="" width="100">
                     <div class="card-body">
                       <h4 class="card-title text-center mb-2 text-dark font-weight-bold">Card title</h4>
                       <p class="card-text text-justify text-dark">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                     </div>
                  </div>
                  </a>
                </div>


        </div>
      </div>
    </section>
  </div>

  <script type="text/javascript">
  $(document).ready(function(){

$(".filter-button").click(function(){
    var value = $(this).attr('data-filter');

    if(value == "all")
    {
        //$('.filter').removeClass('hidden');
        $('.filter').show('1000');
    }
    else
    {
//            $('.filter[filter-item="'+value+'"]').removeClass('hidden');
//            $(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');
        $(".filter").not('.'+value).hide('3000');
        $('.filter').filter('.'+value).show('3000');

    }
});

if ($(".filter-button").removeClass("active")) {
$(this).removeClass("active");
}
$(this).addClass("active");

});
</script>

</body>
</html>
