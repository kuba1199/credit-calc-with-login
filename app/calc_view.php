<?php require_once dirname(__FILE__) .'/../config.php';?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
    <meta charset="utf-8" />
    <title>Kalkulator kredytowy</title>
    <link rel="stylesheet" href="https://unpkg.com/purecss@2.0.5/build/pure-min.css">
</head>
</head>
<body>

<style>
body{
	background-color:darkgrey;
}
#container{
	font-family: 'Akaya Telivigala', cursive;
	width: 400px;
	height	: 250px;
	background-color: lightblue;
	border-style: solid;
    border-width: 2px;
	border-radius: 2px;
	margin: 200px auto 150px;
	padding: 50px 30px 50px 80px;
	}
</style>
	
<div id = "container">
<form action="<?php print(_APP_URL);?>/app/calc_credit.php" method="post">
    <h3>Kalkulator kredytowy</h3>
	<label for="id_kwota">Kwota kredytu: </label>
	<input id="id_kwota" type="text" name="kwota" value="<?php if (isset($kwota)) print($kwota); ?>" /><br />
	<label for="id_czas">Czas kredytu: </label>
	<input id="id_czas" type="text" name="czas" value="<?php if (isset($czas)) print($czas); ?>" /><br />
	<label for="id_percent">Oprocentowanie: </label>
	<input id="id_percent" type="text" name="percent" value="<?php if (isset($percent)) print($percent); ?>" /><br />
	<input type = "submit" value="Oblicz" class="pure-button" />
        <a href="<?php print(_APP_ROOT); ?>/app/security/logout.php" class="pure-button pure-button-active">Wyloguj</a>
</form>


<?php
//wyświeltenie listy błędów, jeśli istnieją
if (isset($messages)) {
	if (count ( $messages ) > 0) {
		echo '<ol style="margin: 20px; padding: 10px 10px 10px 30px; border-radius: 5px; background-color: #f88; width:300px;">';
		foreach ( $messages as $key => $msg ) {
			echo '<li>'.$msg.'</li>';
		}
		echo '</ol>';
	}
}
?>

<?php if (isset($result)){ ?>
<div style="margin: 20px; padding: 10px; border-radius: 5px; background-color: #ff0; width:300px;">
<?php echo 'Wynik: '.$result; ?>
</div>
<?php } ?>
</div>

</body>
</html>