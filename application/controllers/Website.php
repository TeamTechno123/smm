<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Website extends CI_Controller{
  public function __construct(){
    parent::__construct();
    date_default_timezone_set('Asia/Kolkata');
  }

 // public function index(){
 //  $this->load->view('Website/index1');
 // }

 public function index(){
  $this->load->view('Website/index');
 }

 

}
