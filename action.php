<?php

//Implement the header
require 'header.php';

//Add the HTML to organize the content + jumbotron
require 'vues/partials/head.html';
$subtitleJumbotron = "There is the results : ";
require 'vues/partials/jumbotron.php';

//Display the result :
echo "<div class='container'>";
 if(isset($_POST["search"]) && !empty($_POST["search"])){

   $filter = trim(htmlspecialchars($_POST['search']));
   $results = $manager->getElements($filter);
   if(sizeof($results) > 0){
   echo "<div class='panel panel-default'>";
    echo "<div class='panel-heading'>Search result</div>";
    echo "<div class='panel-body'>";
      echo "<ul>";
      foreach ($results as $result){
        //while the id parent != null
        $path = $result->name();
        while($result->id_parent() != null){
          $result = $manager->getElement($result->id_parent());
          $path = $result->name(). "/" .$path;
        }
         echo "<li>". $path . "</li>";
      }
        echo "</ul>";
      echo "</div>";
     echo "</div>";
   echo "</div>";
   }
   else {
     $errorTitle = "Not Found...";
     $errorMessage = "Sorry, nothing was found..";
     require 'vues/partials/error.php';
 }
 } else {
   $errorTitle = "Error!";
   $errorMessage = "Please, enter something in the previous field.";
   require 'vues/partials/error.php';
 }
 echo "</div>";
 require 'vues/partials/footer.html';
?>
