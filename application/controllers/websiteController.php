<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class websiteController extends CI_Controller{
  public function __construct(){
    parent::__construct();
    date_default_timezone_set('Asia/Kolkata');
  }

 public function index(){
  $this->load->view('Website/index');
 }

 public function home1(){
  $this->load->view('Website/home1');
 }

 public function home2(){
  $this->load->view('Website/home2');
 }

 public function home3(){
  $this->load->view('Website/home3');
 }


}
?>
