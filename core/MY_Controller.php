<?php
// Core controller.
// Other base controllers like user or search inherit functions from it
class MY_Controller extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
  }

  // load view with header and footer
  public function load_view($view, $vars = array()) {
    $this->load->view('templates/header');
    $this->load->view($view, $vars);
    $this->load->view('templates/footer');
  }

}