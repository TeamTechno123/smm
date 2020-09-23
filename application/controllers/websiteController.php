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

 public function login1(){
  $this->load->view('Website/login1');
 }

 public function signup1(){
  $this->load->view('Website/signup1');
 }

 public function home2(){
  $this->load->view('Website/home2');
 }

 public function login2(){
  $this->load->view('Website/login2');
 }

 public function signup2(){
  $this->load->view('Website/signup2');
 }

 public function home3(){
  $this->load->view('Website/home3');
 }

 public function login3(){
  $this->load->view('Website/login3');
 }

 public function signup3(){
  $this->load->view('Website/signup3');
 }


}
?>
