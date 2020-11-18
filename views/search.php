<!-- Displays a form with a search box, in which the user can enter search
terms. The form should submit to /search/dosearch via GET. -->
  <div class="content">
    <form action="search/dosearch" method="get">
      <label for="searchbox"><b>Search for something:</b></label><br>
      <input type="text" id="searchbox" name="searchString" required>
      <input type="submit" value="Search">
    </form>
  </div>