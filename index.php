<?php 
$pdo = new PDO('mysql:host=localhost;dbname=test', "root", "2e331b21");//Подключения к БД
// Создать новую таблицу
if (isset($_POST['submit1'])) {
	$name=$_POST['valer1'];
	$result =$pdo->query('CREATE TABLE '.$name.' (id int(11))');
	}
//Изменения структуры таблицы
	if (isset($_POST['submit2'])) {
	$argument=$_POST['hero'];
	$argument2=$_POST['hero2'];
	$tablname=$_POST['valer2'];
	$name=$_POST['valer2'];
	if ($argument2=="ADD") {
		$result =$pdo->query('ALTER TABLE '.$argument.' '.$argument2.' '.$tablname.' varchar(50)');
	}elseif ($argument2=="MODIFY") {
		$result =$pdo->query('ALTER TABLE '.$argument.' '.$argument2.' '.$tablname.' varchar(100)');
	}elseif ($argument2=="DROP") {
		$result =$pdo->query('ALTER TABLE '.$argument.' '.$argument2.' '.$tablname.'');
	}
	
	}
//Удаления таблиц
	if (isset($_POST['submit3'])) {
	$argument=$_POST['del'];
	$result =$pdo->query('DROP TABLE '.$argument.'');
	}
// Изменение записей
	if (isset($_POST['submit4'])) {
	$text99=$_POST['text99'];
	$result =$pdo->query('UPDATE `test2` SET `text`="'.$text99.'" ORDER BY id DESC');
	}
//Добавления записи
	if (isset($_POST['submit5'])) {
	$text98=$_POST['text98'];
	$result =$pdo->query('INSERT INTO `test2`(`text`, `work`) VALUES ("'.$text98.'","'.rand(1, 8).'")');
	}
//Удаления записи
	if (isset($_POST['submit6'])) {
	$del=$_POST['del2'];
	$result =$pdo->query('DELETE FROM `test2` WHERE id='.$del.'');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Лабораторная работа №4</title>
</head>
<style type="text/css">
	    .conclusion
        {
            min-height: 100px;
		    border: 1px solid #000;
	    }
</style>
<body>
<div class="DDLHead">Команды DDL</div>
<div class="DDL">
    <form method="POST">
	    <div class="bloc">
	    <div class="nameTable">Создать новую таблицу</div>
	    Название таблицы:
	    <input type="text" name="valer1">
	    <input type="submit" name="submit1" value="Создать"><br>
</div>
<div class="bloc">
	<div class="nameTable">Изменения структуры таблицы</div>
  Выбор таблицы
  <select name="hero">
  	<?php
  	$result =$pdo->query('SHOW TABLES FROM test');
	while ( $db = $result->fetchColumn() ) 
{
    echo '<option value="'.$db.'">'.$db.'</option>';
}
  	?>
  </select>
  <select name="hero2">
  <option value="ADD">Добавить поле:</option>
  <option value="MODIFY">Изменить поле:</option>
  <option value="DROP">Удалить поле:</option>
  </select>
	<input type="text" name="valer2">
		<input type="submit" name="submit2" value="Выполнить"><br>
</div>

<div class="bloc">
	<div class="nameTable">Удалить таблицу</div>
	Выбор таблицы
  <select name="del">
  	<?php
  	$result =$pdo->query('SHOW TABLES FROM test');
	while ( $db = $result->fetchColumn() ) 
{
    echo '<option value="'.$db.'">'.$db.'</option>';
}
  	?>
  </select>
	<input type="submit" name="submit3" value="Удалить">
</div>
</form>
<h2>Список таблиц</h2>
<div class="conclusion">
<?php
	$result =$pdo->query('SHOW TABLES FROM test');
	while ( $db = $result->fetchColumn() ) 
{
    echo $db.'<br>';
}
	?>
</div>
</div>
<div class="DMLHead">Команды DML</div>
<div class="DML">
	<form method="POST">
	<div class="nameTable">Манипулирования данными</div>
  <?php
  	$result =$pdo->query('SELECT * FROM `test2` ORDER BY id DESC LIMIT 1');
	while ( $db = $result->fetch() ) 
{
    echo '<textarea name="text99" cols=140 rows=10>'.$db["text"].'</textarea><br>';
}
  	?>
	<br>
	<input type="submit" name="submit4" value="Изменение записей"><br>
	Добавить запись:<br>
	<textarea cols=140 rows=5 name="text98"></textarea><br>
	<input type="submit" name="submit5" value="Выполнить"><br>
	Удалить запись:
  	 <select name="del2">
  	 <div class="conclusion">
  	<?php
  	$result =$pdo->query('SELECT * FROM `test2`');
	while ( $db = $result->fetch() ) 
{
    echo '<option value="'.$db["id"].'">'.$db["id"].'</option>';
}
  	?>
  	</div>
  </select>
	<input type="submit" name="submit6" value="удаление записей"><br>
    </form>
</div>
<div>
<table border="1">
    <caption>Описания</caption>
            <tr><th>Фамилия</th><th>Задачи</th></tr>
	<?php
  	$result =$pdo->query('SELECT * FROM test INNER JOIN test2 ON test.work = test2.work');
	while ( $db = $result->fetch() ) 
{
    echo '<tr><td>'.$db["FIO"].'</td><td>'.$db["text"].'</td></tr>';
}
  	?></table></div>
</body>
</html>