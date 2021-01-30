<!DOCTYPE html>
<html lang="en">
<head>
  <title>Databases CRUD</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
  .checkbox-menu li label {
    display: block;
    padding: 3px 10px;
    clear: both;
    font-weight: normal;
    line-height: 1.42857143;
    color: #333;
    white-space: nowrap;
    margin:0;
    transition: background-color .4s ease;
}
.checkbox-menu li input {
    margin: 0px 5px;
    top: 2px;
    position: relative;
}

.checkbox-menu li.active label {
    background-color: #cbcbff;
    font-weight:bold;
}

.checkbox-menu li label:hover,
.checkbox-menu li label:focus {
    background-color: #f5f5f5;
}

.checkbox-menu li.active label:hover,
.checkbox-menu li.active label:focus {
    background-color: #b8b8ff;
}
  </style>
  <script>
  $(".checkbox-menu").on("change", "input[type='checkbox']", function() {
   $(this).closest("li").toggleClass("active", this.checked);
});
</script>


</head>
<body>


  <div class="container">
    <div class="jumbotron">
      <center>
<h2> Databases CRUD
  <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" fill="currentColor" class="bi bi-wrench" viewBox="0 0 16 16">
    <path d="M.102 2.223A3.004 3.004 0 0 0 3.78 5.897l6.341 6.252A3.003 3.003 0 0 0 13 16a3 3 0 1 0-.851-5.878L5.897 3.781A3.004 3.004 0 0 0 2.223.1l2.141 2.142L4 4l-1.757.364L.102 2.223zm13.37 9.019l.528.026.287.445.445.287.026.529L15 13l-.242.471-.026.529-.445.287-.287.445-.529.026L13 15l-.471-.242-.529-.026-.287-.445-.445-.287-.026-.529L11 13l.242-.471.026-.529.445-.287.287-.445.529-.026L13 11l.471.242z"/>
  </svg>
</svg>
</h2>
</center>
<br>
<div class="form-group row">
<form method="post" action="index.php">
  <div class="col-xs-2">
<label for="usr"><span class="badge badge-primary">People</span> Name:</label> <input type="text" class="form-control" id="name" name="name" required placeholder="name" />
</div>
<div class="col-xs-2">
<label for="usr"><span class="badge badge-primary">People</span> Surname:</label>  <input type="text" class="form-control" id="surname" name="surname" required placeholder="surname"/>
</div>
<div class="col-xs-2">
<label for="usr"><span class="badge badge-primary">People</span> Patronymic:</label>  <input type="text" class="form-control" id="patronymic" name="patronymic" required placeholder="patronymic"/>
</div>
<div class="col-xs-4">
<label for="usr"><span class="badge badge-primary">Comments</span> Comment:</label>  <input type="text" class="form-control" id="comment" name="comment" class="comment" required placeholder="comment"/>
</div>
</div>
<div class="form-group row">
<div class="col-xs-12">
<input type="submit" class="btn btn-success btn-lg btn-block" id="submit" name="submit" value="Submit" />
</div>
</div>
<div class="form-group row">
<div class="col-xs-6">
  CREATE TABLE people(<br>
  Id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,<br>
  Name VARCHAR(15),<br>
  Surname VARCHAR(15),<br>
  Patronymic VARCHAR(15)<br>
  );
<br>
  CREATE TABLE comments(<br>
  id_comment INT(255) NOT NULL AUTO_INCREMENT PRIMARY KEY,<br>
  comment TEXT not null,<br>
  id_people int(8) not null,<br>
  foreign key(id_people) references people(Id) on delete cascade);<br>
</div>
<div class="col-xs-3">
Change existing comment <input type="checkbox" name="edit" value="Yes" />
</div>
<div class="col-xs-3">
<label for="usr"><span class="badge badge-primary">People</span> id:</label>  <input type="text" class="form-control" id="id" name="id" class="comment"/>
</div>
</div>
</form>
</div>



<div id="shout"></div>


<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'webpage';
$link = mysqli_connect($host, $user, $pass, $db)
    or die("Ошибка " . mysqli_error($link));





if(isset($_POST['name']))
{
$name = $_POST['name'];
$surname = $_POST['surname'];
$patronymic = $_POST['patronymic'];
$comment = $_POST['comment'];
$query1 ="INSERT INTO people (name, surname, patronymic)
VALUES ('$name', '$surname', '$patronymic')";
$query2 ="INSERT INTO comments (comment, id_people)
VALUES ('$comment',LAST_INSERT_ID())";

$result = mysqli_query($link, $query1) or die("Ошибка " . mysqli_error($link));
$result = mysqli_query($link, $query2) or die("Ошибка " . mysqli_error($link));
}

if (isset($_POST['edit']) && $_POST['edit'] == 'Yes')
{
  $id=$_POST['id'];
  $name = $_POST['name'];
  $surname = $_POST['surname'];
  $patronymic = $_POST['patronymic'];
  $comment = $_POST['comment'];
  $queryupdate ="UPDATE people a INNER JOIN comments b ON (a.id= b.id_people)
SET a.name =  '$name' , a.surname= '$surname', a.patronymic='$patronymic', b.comment =  '$comment'
WHERE a.id = '$id' and b.id_people = '$id'";


  $result = mysqli_query($link, $queryupdate) or die("Ошибка " . mysqli_error($link));
}



/* Створюэмо БД
CREATE TABLE people(
Id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
Name VARCHAR(15),
Surname VARCHAR(15),
Patronymic VARCHAR(15)
);
*/
/*
CREATE TABLE comments(
id_comment INT(255) NOT NULL AUTO_INCREMENT PRIMARY KEY,
comment TEXT not null,
id_people int(8) not null,
foreign key(id_people) references people(Id) on delete cascade);
*/
/*вносимо дани в БД*/
$query3 ="SELECT people.id, people.name,people.surname,people.patronymic, comments.comment
FROM people
INNER JOIN Comments ON people.id=comments.id_people";
$result1 = mysqli_query($link, $query3) or die("Ошибка " . mysqli_error($link));




if(isset($_GET['id']))
{
$row_id = strip_tags($_GET['id']);
$query0 =  "DELETE FROM people WHERE id=" . $row_id;
$result0 = mysqli_query($link, $query0) or die("Ошибка " . mysqli_error($link));
}




if($result1)
{

    while ($row = mysqli_fetch_row($result1)) {
        echo "<div class=\"panel panel-default\"><div class=\"panel-body\"><div class=\"row\"> <div class=\"col-sm-1\">$row[0]</div><div class=\"col-sm-1\">$row[1]</div><div class=\"col-sm-1\">$row[2]</div><div class=\"col-sm-1\">$row[3]</div><div class=\"col-sm-1\">$row[4]</div><div class=\"col-sm-1\"><form method='get' action=''><input type='hidden' name='id' value='$row[0]' /> <input type='submit' class=\"btn btn-danger\" value='Delete'>
        </form></div><div class=\"col-sm-6\">
      </div></div></div></div>";
}


    mysqli_free_result($result1);
}

?>

</div>
</body>
</html>
