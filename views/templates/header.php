<!DOCTYPE html> 
<html lang="en"> 
  <head>
    <title>
      Microblog
    </title>

    <!-- meta elements -->
    <meta charset="utf-8">
	  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <!-- import external font -->
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">
    <!-- add external css file located in root/css directory-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">
    <!-- add external js file located in root/js directory-->
    <script src="<?php echo base_url(); ?>js/script.js"></script>

  </head> 
  
  <body>
  <div class="nav">
  <base href="http://raptor.kent.ac.uk/proj/co539c/microblog/db662/">
		<ol>
			<ol>
				<li> 
          <a href="user/feed/all">Feed</a>	
				</li>			
				<li> 
          <a href="search">Search</a>
				</li>
				<li> 
          <a href="user/view/me">Profile</a> 
				</li>
				<li> 
          <a href="message">Post</a> 
        </li>
        <li> 
          <a href="">Home</a> 
				</li>
			</ol>
		</ol>
	</div>
	
	<div class="welcome">
		<?php
			if($this->session->userdata('username') != '') {
        echo '<h3>Welcome - '.$this->session->userdata('username').'</h3>';
        echo '<a href="'.base_url().'user/logout">Logout</a>';
      } else {
        echo '<h3><a href="'.base_url().'user/login">Login</a></h3>';
      }
		?>
	</div>