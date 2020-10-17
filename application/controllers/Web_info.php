<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web_info extends CI_Controller{
  public function __construct(){
    parent::__construct();
    date_default_timezone_set('Asia/Kolkata');
  }

  public function index(){

  }

/*********************************** Slider *********************************/

  // Add Slider....
  public function slider(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('slider_name', 'Slider Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $slider_status = $this->input->post('slider_status');
      if(!isset($slider_status)){ $slider_status = '1'; }
      $save_data = $_POST;
      $save_data['slider_status'] = $slider_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['slider_addedby'] = $smm_user_id;
      $slider_id = $this->Master_Model->save_data('smm_slider', $save_data);

      if($_FILES['slider_image']['name']){
        $time = time();
        $image_name = 'slider_'.$slider_id.'_'.$time;
        $config['upload_path'] = 'assets/images/slider/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['slider_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('slider_image') && $slider_id && $image_name && $ext && $filename){
          $slider_image_up['slider_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('slider_id', $slider_id, 'smm_slider', $slider_image_up);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Web_info/slider');
    }

    $data['slider_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'slider_addedby_type','1','','','','','slider_id','DESC','smm_slider');
    $data['page'] = 'Slider';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Web_info/slider', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Slider...
  public function edit_slider($slider_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('slider_name', 'Slider Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $slider_status = $this->input->post('slider_status');
      if(!isset($slider_status)){ $slider_status = '1'; }
      $update_data = $_POST;
      unset($update_data['old_slider_img']);
      $update_data['slider_status'] = $slider_status;
      $update_data['slider_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('slider_id', $slider_id, 'smm_slider', $update_data);

      if($_FILES['slider_image']['name']){
        $time = time();
        $image_name = 'slider_'.$slider_id.'_'.$time;
        $config['upload_path'] = 'assets/images/slider/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['slider_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('slider_image') && $slider_id && $image_name && $ext && $filename){
          $slider_image_up['slider_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('slider_id', $slider_id, 'smm_slider', $slider_image_up);
          if($_POST['old_slider_img']){ unlink("assets/images/slider/".$_POST['old_slider_img']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Web_info/slider');
    }

    $slider_info = $this->Master_Model->get_info_arr('slider_id',$slider_id,'smm_slider');
    if(!$slider_info){ header('location:'.base_url().'Web_info/slider'); }
    $data['update'] = 'update';
    $data['update_slider'] = 'update';
    $data['slider_info'] = $slider_info[0];
    $data['act_link'] = base_url().'Web_info/edit_slider/'.$slider_id;

    $data['slider_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'slider_addedby_type','1','','','','','slider_id','DESC','smm_slider');
    $data['page'] = 'Edit Slider';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Web_info/slider', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Slider...
  public function delete_slider($slider_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $slider_info = $this->Master_Model->get_info_arr_fields('slider_image, slider_id', 'slider_id', $slider_id, 'smm_slider');
    if($slider_info){
      $slider_image = $slider_info[0]['slider_image'];
      if($slider_image){ unlink("assets/images/slider/".$slider_image); }
    }
    $this->Master_Model->delete_info('slider_id', $slider_id, 'smm_slider');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Web_info/slider');
  }

/*********************************** Testimonial *********************************/

  // Add Testimonial....
  public function testimonial(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('testimonial_name', 'Batch Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $testimonial_status = $this->input->post('testimonial_status');
      if(!isset($testimonial_status)){ $testimonial_status = '1'; }
      $save_data = $_POST;
      $save_data['testimonial_status'] = $testimonial_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['testimonial_addedby'] = $smm_user_id;
      $testimonial_id = $this->Master_Model->save_data('smm_testimonial', $save_data);

      if($_FILES['testimonial_image']['name']){
        $time = time();
        $image_name = 'testimonial_'.$testimonial_id.'_'.$time;
        $config['upload_path'] = 'assets/images/testimonial/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['testimonial_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('testimonial_image') && $testimonial_id && $image_name && $ext && $filename){
          $testimonial_image_up['testimonial_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('testimonial_id', $testimonial_id, 'smm_testimonial', $testimonial_image_up);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Web_info/testimonial');
    }
    $data['testimonial_no'] = $this->Master_Model->get_count_no($smm_company_id, 'testimonial_no', 'smm_testimonial');

    $data['testimonial_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','testimonial_id','DESC','smm_testimonial');
    $data['page'] = 'Testimonial';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Web_info/testimonial', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Testimonial...
  public function edit_testimonial($testimonial_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('testimonial_name', 'First Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $testimonial_status = $this->input->post('testimonial_status');
      if(!isset($testimonial_status)){ $testimonial_status = '1'; }
      $update_data = $_POST;
      unset($update_data['old_testimonial_img']);
      $update_data['testimonial_status'] = $testimonial_status;
      $update_data['testimonial_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('testimonial_id', $testimonial_id, 'smm_testimonial', $update_data);

      if($_FILES['testimonial_image']['name']){
        $time = time();
        $image_name = 'testimonial_'.$testimonial_id.'_'.$time;
        $config['upload_path'] = 'assets/images/testimonial/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['testimonial_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('testimonial_image') && $testimonial_id && $image_name && $ext && $filename){
          $testimonial_image_up['testimonial_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('testimonial_id', $testimonial_id, 'smm_testimonial', $testimonial_image_up);
          if($_POST['old_testimonial_img']){ unlink("assets/images/testimonial/".$_POST['old_testimonial_img']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Web_info/testimonial');
    }

    $testimonial_info = $this->Master_Model->get_info_arr('testimonial_id',$testimonial_id,'smm_testimonial');
    if(!$testimonial_info){ header('location:'.base_url().'Web_info/testimonial'); }
    $data['update'] = 'update';
    $data['update_testimonial'] = 'update';
    $data['testimonial_info'] = $testimonial_info[0];
    $data['act_link'] = base_url().'Web_info/edit_testimonial/'.$testimonial_id;

    $data['testimonial_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','testimonial_id','DESC','smm_testimonial');
    $data['page'] = 'Edit Testimonial';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Web_info/testimonial', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Testimonial...
  public function delete_testimonial($testimonial_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $testimonial_info = $this->Master_Model->get_info_arr_fields('testimonial_image, testimonial_id', 'testimonial_id', $testimonial_id, 'smm_testimonial');
    if($testimonial_info){
      $testimonial_image = $testimonial_info[0]['testimonial_image'];
      if($testimonial_image){ unlink("assets/images/testimonial/".$testimonial_image); }
    }
    $this->Master_Model->delete_info('testimonial_id', $testimonial_id, 'smm_testimonial');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Web_info/testimonial');
  }



/********************************* Blog Category ***********************************/

  // Add Blog Category...
  public function blog_category(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('blog_category_name', 'Blog Category Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $blog_category_status = $this->input->post('blog_category_status');
      if(!isset($blog_category_status)){ $blog_category_status = '1'; }
      $save_data = $_POST;
      $save_data['blog_category_status'] = $blog_category_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['blog_category_addedby'] = $smm_user_id;
      $user_id = $this->Master_Model->save_data('smm_blog_category', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Web_info/blog_category');
    }

    $data['blog_category_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','blog_category_id','ASC','smm_blog_category');
    $data['page'] = 'Blog Category';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Web_info/blog_category', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Blog Category...
  public function edit_blog_category($blog_category_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('blog_category_name', 'Blog Category Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $blog_category_status = $this->input->post('blog_category_status');
      if(!isset($blog_category_status)){ $blog_category_status = '1'; }
      $update_data = $_POST;
      $update_data['blog_category_status'] = $blog_category_status;
      $update_data['blog_category_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('blog_category_id', $blog_category_id, 'smm_blog_category', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Web_info/blog_category');
    }

    $blog_category_info = $this->Master_Model->get_info_arr('blog_category_id',$blog_category_id,'smm_blog_category');
    if(!$blog_category_info){ header('location:'.base_url().'Web_info/blog_category'); }
    $data['update'] = 'update';
    $data['update_blog_category'] = 'update';
    $data['blog_category_info'] = $blog_category_info[0];
    $data['act_link'] = base_url().'Web_info/edit_blog_category/'.$blog_category_id;

    $data['blog_category_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','blog_category_id','ASC','smm_blog_category');
    $data['page'] = 'Edit Blog Category';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Web_info/blog_category', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Blog Category...
  public function delete_blog_category($blog_category_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('blog_category_id', $blog_category_id, 'smm_blog_category');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Web_info/blog_category');
  }

/*********************************** Blog *********************************/

  // Add Blog....
  public function blog(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('blog_name', 'Blog Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $blog_status = $this->input->post('blog_status');
      if(!isset($blog_status)){ $blog_status = '1'; }
      $save_data = $_POST;
      $save_data['blog_status'] = $blog_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['blog_addedby_type'] = '1';
      $save_data['blog_addedby'] = $smm_user_id;
      $blog_id = $this->Master_Model->save_data('smm_blog', $save_data);

      if($_FILES['blog_image']['name']){
        $time = time();
        $image_name = 'blog_'.$blog_id.'_'.$time;
        $config['upload_path'] = 'assets/images/blog/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['blog_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('blog_image') && $blog_id && $image_name && $ext && $filename){
          $blog_image_up['blog_image'] =  base_url().'assets/images/blog/'.$image_name.'.'.$ext;
          $this->Master_Model->update_info('blog_id', $blog_id, 'smm_blog', $blog_image_up);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Web_info/blog');
    }
    $data['blog_category_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','blog_category_name','ASC','smm_blog_category');

    $data['blog_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'blog_addedby_type','1','','','','','blog_id','DESC','smm_blog');
    $data['page'] = 'Blog';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Web_info/blog', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Blog...
  public function edit_blog($blog_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('blog_name', 'Blog Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $blog_status = $this->input->post('blog_status');
      if(!isset($blog_status)){ $blog_status = '1'; }
      $update_data = $_POST;
      unset($update_data['old_blog_img']);
      $update_data['blog_status'] = $blog_status;
      $update_data['blog_addedby_type'] = '1';
      $save_data['blog_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('blog_id', $blog_id, 'smm_blog', $update_data);

      if($_FILES['blog_image']['name']){
        $time = time();
        $image_name = 'blog_'.$blog_id.'_'.$time;
        $config['upload_path'] = 'assets/images/blog/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['blog_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('blog_image') && $blog_id && $image_name && $ext && $filename){
          $blog_image_up['blog_image'] =  base_url().'assets/images/blog/'.$image_name.'.'.$ext;
          $this->Master_Model->update_info('blog_id', $blog_id, 'smm_blog', $blog_image_up);
          if($_POST['old_blog_img']){
            $unlink_image = str_replace(base_url(), "",$_POST['old_blog_img']);
            unlink($unlink_image);
          }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Web_info/blog');
    }

    $blog_info = $this->Master_Model->get_info_arr('blog_id',$blog_id,'smm_blog');
    if(!$blog_info){ header('location:'.base_url().'Admin/Web_info/blog'); }
    $data['update'] = 'update';
    $data['update_blog'] = 'update';
    $data['blog_info'] = $blog_info[0];
    $data['act_link'] = base_url().'Web_info/edit_blog/'.$blog_id;
    $data['blog_category_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','blog_category_name','ASC','smm_blog_category');

    $data['blog_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'blog_addedby_type','1','','','','','blog_id','DESC','smm_blog');
    $data['page'] = 'Edit Blog';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Web_info/blog', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Blog...
  public function delete_blog($blog_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $blog_info = $this->Master_Model->get_info_arr_fields('blog_image, blog_id', 'blog_id', $blog_id, 'smm_blog');
    if($blog_info){
      $blog_image = $blog_info[0]['blog_image'];
      if($blog_image){
        $unlink_image = str_replace(base_url(), "",$blog_image);
        unlink($unlink_image);
      }
    }
    $this->Master_Model->delete_info('blog_id', $blog_id, 'smm_blog');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Web_info/blog');
  }


/********************************* Tutorial Category ***********************************/

  // Add Tutorial Category...
  public function tutorial_category(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('tutorial_category_name', 'Tutorial Category Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $tutorial_category_status = $this->input->post('tutorial_category_status');
      if(!isset($tutorial_category_status)){ $tutorial_category_status = '1'; }
      $save_data = $_POST;
      $save_data['tutorial_category_status'] = $tutorial_category_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['tutorial_category_addedby'] = $smm_user_id;
      $user_id = $this->Master_Model->save_data('smm_tutorial_category', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Web_info/tutorial_category');
    }

    $data['tutorial_category_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','tutorial_category_id','ASC','smm_tutorial_category');
    $data['page'] = 'Tutorial Category';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Web_info/tutorial_category', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Tutorial Category...
  public function edit_tutorial_category($tutorial_category_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('tutorial_category_name', 'Tutorial Category Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $tutorial_category_status = $this->input->post('tutorial_category_status');
      if(!isset($tutorial_category_status)){ $tutorial_category_status = '1'; }
      $update_data = $_POST;
      $update_data['tutorial_category_status'] = $tutorial_category_status;
      $update_data['tutorial_category_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('tutorial_category_id', $tutorial_category_id, 'smm_tutorial_category', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Web_info/tutorial_category');
    }

    $tutorial_category_info = $this->Master_Model->get_info_arr('tutorial_category_id',$tutorial_category_id,'smm_tutorial_category');
    if(!$tutorial_category_info){ header('location:'.base_url().'Web_info/tutorial_category'); }
    $data['update'] = 'update';
    $data['update_tutorial_category'] = 'update';
    $data['tutorial_category_info'] = $tutorial_category_info[0];
    $data['act_link'] = base_url().'Web_info/edit_tutorial_category/'.$tutorial_category_id;

    $data['tutorial_category_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','tutorial_category_id','ASC','smm_tutorial_category');
    $data['page'] = 'Edit Tutorial Category';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Web_info/tutorial_category', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Tutorial Category...
  public function delete_tutorial_category($tutorial_category_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('tutorial_category_id', $tutorial_category_id, 'smm_tutorial_category');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Web_info/tutorial_category');
  }


/*********************************** Tutorial *********************************/

  // Add Tutorial....
  public function tutorial(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('tutorial_name', 'Tutorial Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $tutorial_status = $this->input->post('tutorial_status');
      if(!isset($tutorial_status)){ $tutorial_status = '1'; }
      $save_data = $_POST;
      $save_data['tutorial_status'] = $tutorial_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['tutorial_addedby_type'] = '1';
      $save_data['tutorial_addedby'] = $smm_user_id;
      $tutorial_id = $this->Master_Model->save_data('smm_tutorial', $save_data);

      if($_FILES['tutorial_image']['name']){
        $time = time();
        $image_name = 'tutorial_'.$tutorial_id.'_'.$time;
        $config['upload_path'] = 'assets/images/tutorial/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['tutorial_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('tutorial_image') && $tutorial_id && $image_name && $ext && $filename){
          $tutorial_image_up['tutorial_image'] =  base_url().'assets/images/tutorial/'.$image_name.'.'.$ext;
          $this->Master_Model->update_info('tutorial_id', $tutorial_id, 'smm_tutorial', $tutorial_image_up);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Web_info/tutorial');
    }
    $data['tutorial_category_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','tutorial_category_name','ASC','smm_tutorial_category');

    $data['tutorial_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'tutorial_addedby_type','1','','','','','tutorial_id','DESC','smm_tutorial');
    $data['page'] = 'Tutorial';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Web_info/tutorial', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Tutorial...
  public function edit_tutorial($tutorial_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('tutorial_name', 'Tutorial Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $tutorial_status = $this->input->post('tutorial_status');
      if(!isset($tutorial_status)){ $tutorial_status = '1'; }
      $update_data = $_POST;
      unset($update_data['old_tutorial_img']);
      $update_data['tutorial_status'] = $tutorial_status;
      $update_data['tutorial_addedby_type'] = '1';
      $save_data['tutorial_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('tutorial_id', $tutorial_id, 'smm_tutorial', $update_data);

      if($_FILES['tutorial_image']['name']){
        $time = time();
        $image_name = 'tutorial_'.$tutorial_id.'_'.$time;
        $config['upload_path'] = 'assets/images/tutorial/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['tutorial_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('tutorial_image') && $tutorial_id && $image_name && $ext && $filename){
          $tutorial_image_up['tutorial_image'] =  base_url().'assets/images/tutorial/'.$image_name.'.'.$ext;
          $this->Master_Model->update_info('tutorial_id', $tutorial_id, 'smm_tutorial', $tutorial_image_up);
          if($_POST['old_tutorial_img']){
            $unlink_image = str_replace(base_url(), "",$_POST['old_tutorial_img']);
            unlink($unlink_image);
          }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Web_info/tutorial');
    }

    $tutorial_info = $this->Master_Model->get_info_arr('tutorial_id',$tutorial_id,'smm_tutorial');
    if(!$tutorial_info){ header('location:'.base_url().'Admin/Web_info/tutorial'); }
    $data['update'] = 'update';
    $data['update_tutorial'] = 'update';
    $data['tutorial_info'] = $tutorial_info[0];
    $data['act_link'] = base_url().'Web_info/edit_tutorial/'.$tutorial_id;
    $data['tutorial_category_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','tutorial_category_name','ASC','smm_tutorial_category');

    $data['tutorial_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'tutorial_addedby_type','1','','','','','tutorial_id','DESC','smm_tutorial');
    $data['page'] = 'Edit Tutorial';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Web_info/tutorial', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Tutorial...
  public function delete_tutorial($tutorial_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $tutorial_info = $this->Master_Model->get_info_arr_fields('tutorial_image, tutorial_id', 'tutorial_id', $tutorial_id, 'smm_tutorial');
    if($tutorial_info){
      $tutorial_image = $tutorial_info[0]['tutorial_image'];
      if($tutorial_image){
        $unlink_image = str_replace(base_url(), "",$tutorial_image);
        unlink($unlink_image);
      }
    }
    $this->Master_Model->delete_info('tutorial_id', $tutorial_id, 'smm_tutorial');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Web_info/tutorial');
  }

/*********************************** FAQ *********************************/

  // Add FAQ....
  public function faq(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('faq_name', 'FAQ Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $faq_status = $this->input->post('faq_status');
      if(!isset($faq_status)){ $faq_status = '1'; }
      $save_data = $_POST;
      $save_data['faq_status'] = $faq_status;
      $save_data['company_id'] = $smm_company_id;
      $save_data['faq_addedby_type'] = '1';
      $save_data['faq_addedby'] = $smm_user_id;
      $faq_id = $this->Master_Model->save_data('smm_faq', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Web_info/faq');
    }

    $data['faq_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'faq_addedby_type','1','','','','','faq_id','DESC','smm_faq');
    $data['page'] = 'FAQ';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Web_info/faq', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update FAQ...
  public function edit_faq($faq_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('faq_name', 'FAQ Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $faq_status = $this->input->post('faq_status');
      if(!isset($faq_status)){ $faq_status = '1'; }
      $update_data = $_POST;
      $update_data['faq_status'] = $faq_status;
      $update_data['faq_addedby_type'] = '1';
      $save_data['faq_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('faq_id', $faq_id, 'smm_faq', $update_data);


      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Web_info/faq');
    }

    $faq_info = $this->Master_Model->get_info_arr('faq_id',$faq_id,'smm_faq');
    if(!$faq_info){ header('location:'.base_url().'Admin/Web_info/faq'); }
    $data['update'] = 'update';
    $data['update_faq'] = 'update';
    $data['faq_info'] = $faq_info[0];
    $data['act_link'] = base_url().'Web_info/edit_faq/'.$faq_id;

    $data['faq_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'faq_addedby_type','1','','','','','faq_id','DESC','smm_faq');
    $data['page'] = 'Edit FAQ';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Web_info/faq', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete FAQ...
  public function delete_faq($faq_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->Master_Model->delete_info('faq_id', $faq_id, 'smm_faq');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Web_info/faq');
  }


/*************************************** Website Setting **********************************/
  public function web_setting(){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_company_id = $this->session->userdata('smm_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' && $smm_company_id == ''){ header('location:'.base_url().'User'); }

    $web_setting_data = $this->Master_Model->get_info_arr_fields3('web_setting_id', $smm_company_id, 'web_setting_addedby_type', '1', 'reseller_id', '0', '', '', 'smm_web_setting');
    if(!$web_setting_data){ header('location:'.base_url().'User/dashboard'); }
    $web_setting_id = $web_setting_data[0]['web_setting_id'];

    $this->form_validation->set_rules('web_setting_name', 'Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $up_data = $_POST;
      unset($up_data['old_web_setting_logo']);
      unset($up_data['old_web_setting_favicon']);
      $up_data['web_setting_addedby'] = $smm_user_id;
      $this->Master_Model->update_info('web_setting_id', $web_setting_id, 'smm_web_setting', $up_data);

      if($_FILES['web_setting_logo']['name']){
        $time = time();
        $image_name = 'web_setting_comlogo_'.$web_setting_id.'_'.$time;
        $config['upload_path'] = 'assets/images/master/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['web_setting_logo']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('web_setting_logo') && $web_setting_id && $image_name && $ext && $filename){
          $web_setting_logo_up['web_setting_logo'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('web_setting_id', $web_setting_id, 'smm_web_setting', $web_setting_logo_up);
          if($_POST['old_web_setting_logo']){ unlink("assets/images/master/".$_POST['old_web_setting_logo']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      if($_FILES['web_setting_favicon']['name']){
        $time = time();
        $image_name2 = 'web_setting_comfavicon_'.$web_setting_id.'_'.$time;
        $config['upload_path'] = 'assets/images/master/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name2;
        $filename = $_FILES['web_setting_favicon']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('web_setting_favicon') && $web_setting_id && $image_name2 && $ext && $filename){
          $web_setting_favicon_up['web_setting_favicon'] =  $image_name2.'.'.$ext;
          $this->Master_Model->update_info('web_setting_id', $web_setting_id, 'smm_web_setting', $web_setting_favicon_up);
          if($_POST['old_web_setting_favicon']){ unlink("assets/images/master/".$_POST['old_web_setting_favicon']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);

          // echo $error;
        }
      }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Web_info/web_setting');
    }
    $web_setting_info = $this->Master_Model->get_info_arr('web_setting_id',$web_setting_id,'smm_web_setting');
    if(!$web_setting_info){ header('location:'.base_url().'Company/web_setting_list'); }
    $data['update'] = 'update';
    $data['update_web_setting'] = 'update';
    $data['web_setting_info'] = $web_setting_info[0];
    $data['act_link'] = base_url().'Company/edit_web_setting/'.$web_setting_id;

    $data['country_list'] = $this->Master_Model->get_list('','country_name','ASC','country');
    $data['state_list'] = $this->Master_Model->get_list('','state_name','ASC','state');
    $data['district_list'] = $this->Master_Model->get_list('','district_name','ASC','district');
    $data['city_list'] = $this->Master_Model->get_list('','city_name','ASC','city');
    // $data['currency_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','currency_name','ASC','smm_currency');
    // $data['company_entity_list'] = $this->Master_Model->get_list_by_id3($smm_company_id,'','','','','','','company_entity_name','ASC','smm_company_entity');

    $data['page'] = 'Website Information';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Web_info/web_setting', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

}
?>
