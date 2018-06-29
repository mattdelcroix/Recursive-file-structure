<?php
require 'partials/head.html';
$subtitleJumbotron = "Please, enter your search below : ";
require 'partials/jumbotron.php';
?>
    <div class="container">
    <form action="action.php" method="post">
      <div class="form-group">
        <label for="search">Search</label>
        <input type="text" class="form-control" id="search" name="search">
      </div>
      <button type="submit" class="btn btn-info">Search</button>
    </form>
</div>
<?php require 'partials/footer.html'; ?>
