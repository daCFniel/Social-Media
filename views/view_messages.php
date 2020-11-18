<!-- Displays a list of messages, with details of poster, content and time of each 
message. Poster’s name should be linked to the user/view/{poster} for that user. -->
    <div class="content">
    <?php if(empty($messages)) {
      echo '<h1>No messages</h1>';
    } else { ?>
      <table>
      <?php foreach ($messages as $row) {?>
        <tr>
          <!-- click on username to go to user/view/username -->
          <td><?php echo '<a class="username" href="user/view/'.$row['user_username'].'">'; echo $row['user_username']; ?></a></td>
          <td><?php echo $row['text']; ?></td>
          <td><?php echo $row['posted_at']; ?></td>
        </tr>
      <?php } ?>
      </table> 
    </div>
    <?php } ?> 
