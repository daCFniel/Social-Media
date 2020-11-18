<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {
    // Loads Messages_model. 
    // runs getMessagesByPoster() passing the specified name.
    // Displays output in the ViewMessages view.
    // Loads Users_model.
    // Adds a “follow” link if the isFollowing() function,
    // indicates the currently logged-in user (from login session variable) 
    // isn’t following the viewed user. 
    // Link points to /user/follow/.
    public function view($name) {
        if($name == "me") {
            if($this->session->userdata('username') == '') { 
                redirect(base_url().'user/login');
                exit;
            } else {
                $name = $this->session->userdata('username');
            }
        }
        $this->load->model('messages_model'); 
        $messages = $this->messages_model->getMessagesByPoster($name);
        $messagesArray = array("messages" => $messages);
        $this->load_view('view_messages', $messagesArray);  
        
        // Don't show the follow link for when visiting your own profile.
        if($this->session->userdata('username') != $name) {
            $this->load->model('users_model');
            $isFollowing = $this->users_model->isFollowing($this->session->userdata('username'),$name);
            if(!$isFollowing && $this->session->userdata('username') != '') {
                $userExists = $this->users_model->checkForUser($name); // Check if users exists.
                if($userExists) {
                    echo '<a class="follow" href="'.base_url().'user/follow/'.$name.'">Follow</a>';
                } else {
                    echo '<span class="error">User with that username does not exist</span>';
                }
            }
        }
    }

    // Displays the Login view.
    public function login() {
        $this->load_view('login', null);  
    }

    // Loads the Users_model.
    // Calls checkLogin() passing POSTed username/password. 
    // Either re-displays Login view with error message, or 
    // redirects to the user/view/{username} controller to view their messages. 
    // If login is successful,a session variable containing the username is set.
    public function doLogin() {
        $this->load->model('users_model'); 
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if($this->form_validation->run()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            // Validate credentianls. 
            if($this->users_model->checkLogin($username, $password)) {
                // Store username is session.
                $session_data = array('username' => $username);
                $this->session->set_userdata($session_data);
                redirect(base_url().'user/view/'.$this->session->userdata('username'));
            } else {
                $this->session->set_flashdata('error', 'Invalid username or password.');
                redirect(base_url().'user/login'); 
            }
        } else {
            $this->login();
        }
    }

    // Logs the user out, clearing their session variable.
    // Redirects to /user/login.
    public function logout() {
        $this->session->unset_userdata('username');
        redirect(base_url().'user/login');
    }

    // Loads the Messages_model. 
    // Invokes the getFollowedMessages() function. 
    // Puts the output into the ViewMessages view.
    public function feed($name) {
        // Feed contains all posts as users is not logged in.
        if($name == "all") {
            if($this->session->userdata('username') == '') { 
                redirect(base_url().'user/viewall');
                exit;
            } else {
                $name = $this->session->userdata('username');
            }
        }
        $this->load->model('messages_model');
        $messages = $this->messages_model->getFollowedMessages($name);
        $messagesArray = array("messages" => $messages);
        $this->load_view('view_messages', $messagesArray);   
    }

    // Loads the Users_model. 
    // Invokes the follow() function to add the entry into the database table.
    // Redirects back to the /user/view/{followed} page when done.
    public function follow($followed) { 
        $this->load->model('users_model');
        $this->users_model->follow($this->session->userdata('username'), $followed);
        redirect(base_url().'user/view/'.$followed);
    }

    // View all posts from all users.
    // Used when user is not logged in.
    public function viewAll() {
        $this->load->model('messages_model'); 
        $messages = $this->messages_model->getAllMessages();
        $messagesArray = array("messages" => $messages);
        $this->load_view('view_messages', $messagesArray);  
    }
}
