<?php
//How many space by indentation (Tab)
$constNBSPACE = 2;

//Function to know if the $line contains a file (check if an extension exists)
  function isFile($line){
    //Deleting the "white spaces" before and after the name of the file
    $filename = trim($line);
    $pattern = '/\.[a-zA-Z]{3}$/'; //A file must to have an extension
    return preg_match($pattern, $filename);
  }

function indentOf($line){
  global $constNBSPACE;
  //The lenght of the whole line minus the lenght of the line without the white spaces before the name
  // = the lenght of white space before the name.
  $nbSpacebeforeName = strlen($line) - strlen(ltrim($line));
  // The level of the hierarchisation.
  $newIndent = $nbSpacebeforeName / $constNBSPACE;

  return $newIndent;
}

function addElementDB($name, $id_parent){
    global $manager;
    $element = new Element(["name" => $name, "id_parent" => $id_parent]);
    $manager->AddElement($element);
    return $element->id();
}

function reader(Array $parents, $line){
    global $file;
    global $constNBSPACE;

    if(feof($file)){
       return null;
    }
    //We get the level of indentation by the lenght of the parents's array
    $nbIndent = sizeof($parents) * $constNBSPACE;
    $newIndent = indentOf($line);


    if(sizeof($parents) == 0){
      //If the element is without indent, then there is no parents (null);
        $lastID = addElementDB(trim($line), null);
    }
    else if(sizeof($parents)-1 < $newIndent){
      //If the indent of the last parent is lower than the indent of the child
      //Add the child with the correct id_parent;
      $lastID = addElementDB(trim($line), $parents[sizeof($parents)-1]);

    } else if (sizeof($parents)-1 == $newIndent){
      //If the indent of the last parent is equal to the indent of the child,
      //then, they are brother and they got the same parent id.
      //We pop the last parent in the parents's array
      $lastParent = array_pop($parents);
      $lastID = addElementDB(trim($line), $parents[sizeof($parents)-1]);

    } else if (sizeof($parents)-1 > $newIndent){
      //If the indent of the last parent is bigger than the indent of the new indent,
      //then we pop all the closed parents in the parents's array.
      while(sizeof($parents)-1 >= $newIndent){
        $lastID = array_pop($parents);
      }
        $lastID = addElementDB(trim($line), $parents[sizeof($parents)-1]);
    }

    //If the line is for a folder, we put it in the array $parents
    if(!isFile($line)){
      $parents[sizeof($parents)] = $lastID;//trim($line);
    }
    reader($parents, fgets($file));
  }



?>
