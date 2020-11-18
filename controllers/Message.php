<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends MY_Controller {
    
    // Redirects to /user/login if not logged in.
    // Displays the Post view.
    public function index() {
        if($this->session->userdata('username') == '') {
            redirect(base_url().'user/login');
            exit;
        } else {
            $this->load_view('post', null);
        }
    }
    

    // Redirects to /user/login if not logged in.
    // Loads the Messages_model. 
    // Runs the insertMessage function passing the currently logged in user
    // from your session variable, along with the posted message.
    // Redirects to /user/view/{username} when done, which
    // should show the user’s new post.
    public function doPost() {
        if($this->session->userdata('username') == '') {
            redirect(base_url().'user/login');
            exit;
        } else {
            $postMessage = $this->input->post('postMessage');
            $this->load->model('messages_model');
            $this->messages_model->insertMessage($this->session->userdata('username'), $postMessage);
            redirect(base_url().'user/view/'.$this->session->userdata('username'));
        }
    }

}
