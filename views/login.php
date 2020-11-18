<!-- Displays a login form for a user to supply their username and password.
This form should submit via POST to /user/dologin.. -->
  <div class="content">
    <form action="<?php echo base_url(); ?>user/dologin" method="post">
      <label for="username"><b>Username: </b></label>
      <input type="text" placeholder="Enter Username" name="username" required><br>

      <label for="password"><b>Password: </b></label>
      <input type="password" placeholder="Enter Password" name="password" required><br>

      <input type="submit" value="Login"><br>
      <?php
        echo $this->session->flashdata("error");
      ?>
    </form>
  </div>