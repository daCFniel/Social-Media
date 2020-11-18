<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends MY_Controller {
    
    // Displays the Search view.
    public function index() {
        $this->load_view('search', null);
    }
    // Loads Messages_model, 
    // retrieves search string from GET parameters, 
    // runs searchMessages() 
    // and displays the output in the ViewMessages view.
    public function doSearch() {
        $this->load->model('messages_model'); 
        //get search string via GET 
        $searchString = $this->input->get('searchString');
        $messages = $this->messages_model->searchMessages($searchString);
        $messagesArray = array("messages" => $messages);
        $this->load_view('view_messages', $messagesArray);      
    }
}
