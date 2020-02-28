<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>


<script type="text/javascript">
var counter3 = 0;
function addAuthor() {
    // Get the main Div in which all the other divs will be added
    var mainContainer = document.getElementById('Author');

    // Create a new div for holding text and button input elements
    var newDiv = document.createElement('div');

    // Create a new text input
    var newText = document.createElement('input');
    newText.type = "text";
newText.required = "required";
	
    //var i = 1;
    newText.name = "Author[]";
    newText.value =  " ";

    //Counter starts from 2 since we already have one item
    //newText.class = "input.text";
    // Create a new button input
    var newDelButton = document.createElement('input');
    newDelButton.type = "button";
    newDelButton.value = "-";

    // Append new text input to the newDiv
    newDiv.appendChild(newText);
    // Append new button input to the newDiv
    newDiv.appendChild(newDelButton);
    // Append newDiv input to the mainContainer div
    mainContainer.appendChild(newDiv);
    counter3++;
    //i++;

    // Add a handler to button for deleting the newDiv from the mainContainer
    newDelButton.onclick = function() {
        mainContainer.removeChild(newDiv);
        counter3--;
    }
}
</script>

</head>

<body>
<form method="post" action="" name="t1">
<div id="Author">
    <LI>Author</LI> 
    <input type = "text" name="Author[]" value = " " required/>
    <input type="button" value="+" id="Authorbutton" onclick="addAuthor()" />
	<input type="submit" name="submit"  />
</div>
</form>
</body>
</html>
<?php 

mysql_connect('localhost','root','');
mysql_select_db('vihar');
if(isset($_POST['Author']))
{
$authors = $_POST['Author'];
foreach($authors as $author) :

    $sql="INSERT INTO savetest ( number) VALUES ('$author')";

    if (!mysql_query($sql)){
       die('Error: ' . mysql_error());
    }
endforeach;

}
?>