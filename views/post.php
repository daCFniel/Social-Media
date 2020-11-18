<!-- Displays a form in which the user can write a new post. This form should
submit via POST to the /message/doPost action. -->
  <div class="content">
    <form action="<?php echo base_url(); ?>message/dopost" method="post">
      <label for="postMessage"><b>Post on Microblog:</b></label><br>
      <input type="text" placeholder="What's happening?" name="postMessage" required><br>

      <input type="submit" value="Post">
    </form>
  </div>