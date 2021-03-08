<?php
require_once dirname(__FILE__).'/../config.php';

include _ROOT_PATH.'/app/security/check.php';
//pobieranie parametrów
function getParams(&$kwota,&$czas,&$percent){
    $kwota = isset($_REQUEST['kwota']) ? $_REQUEST['kwota'] : null;
    $czas = isset($_REQUEST['czas']) ? $_REQUEST['czas'] : null;
    $percent = isset($_REQUEST['percent']) ? $_REQUEST['percent'] : null;
}

// 2. walidacja parametrów z przygotowaniem zmiennych dla widoku
function validate(&$kwota,&$czas,&$percent,&$messages){
    if ( ! (isset($kwota) && isset($czas) && isset($percent))) {
	return false;
}
//sprawdzanie czy dane parametry zostały wpisane
    if ( $kwota == "") {
	$messages [] = 'Nie podano kwoty kredytu';
}
    if ( $czas == "") {
	$messages [] = 'Nie podano czasu kredytu';
}
    if ($percent == "") {
	$messages [] = 'Nie podano oprocentowania';
}
    if (empty( $messages )) {
	
	// sprawdzenie, czy $x i $y są liczbami całkowitymi
	if (! is_numeric( $kwota )) {
		$messages [] = 'Pierwsza wartość nie jest liczbą całkowitą';
	}
	
	if (! is_numeric( $czas )) {
		$messages [] = 'Druga wartość nie jest liczbą całkowitą';
	}	
	
	if (! is_numeric( $percent )) {
		$messages [] = 'Trzecia wartość nie jest liczbą całkowitą';
}
}
if (count($messages) != 0) {
        return false;
    } else {
        return true;
    }
}

// 3. wykonaj zadanie jeśli wszystko w porządku
function process(&$kwota,&$czas,&$percent,&$messages,&$result){
    global $role;
    
    if (empty ( $messages )) { // gdy brak błędów
	
	//konwersja parametrów na int
	$kwota = floatval($kwota);
	$czas = floatval($czas);
	$percent = floatval($percent);
 
	
	
        
        
        if ($czas>5 && $role == 'user'){
            $messages [] = 'Tylko administrator może obliczać kredyt na czas powyzej 5 lat !';
        } else {
            $result = round($kwota / (12 * $czas) + ($percent * 0.01*($kwota / (12 * $czas))));
         
                
            }
    }
}

//definicja zmiennych kontrolera
$kwota = null;
$czas = null;
$percent = null;
$result = null;
$messages = array();

//pobierz parametry i wykonaj zadanie jeśli jest ok
getParams($kwota, $czas, $percent);
if (validate($kwota, $czas, $percent, $messages)){
    process($kwota, $czas, $percent, $messages, $result);
}
// 4. Wywołanie widoku z przekazaniem zmiennych
// - zainicjowane zmienne ($messages,$x,$y,$z,$result)
//   będą dostępne w dołączonym skrypcie
include 'calc_view.php';