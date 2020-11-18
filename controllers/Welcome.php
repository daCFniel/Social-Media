<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	/**
	 * This controller is set as the default controller 
	 * Displays the main page
	 */
	public function index()
	{
		$this->load_view('main_page', null);
	}
}
