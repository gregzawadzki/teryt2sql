<?php
/* 
*
*	Mały skrypt służący do konwersji plików XML GUS TERYT na plik SQL (schema + data)
*	Najnowsze pliki dostępne do pobrania: http://www.stat.gov.pl/broker/access/prefile/listPreFiles.jspa
*	
*	@author Grzegorz Zawadzki <kontakt@seigi.eu>
*	@version 1.0
*	@license http://opensource.org/licenses/GPL-3.0
*	@link https://github.com/seigieu/teryt2sql
*
*/

define('MYEOL', '<br>');

set_time_limit(2000);

$dir_xml = dirname(__FILE__).'/xml/'; 


$fh = fopen('output.sql', 'w+');

if(file_exists(dirname(__FILE__).'/schema.sql'))
	fwrite($fh, file_get_contents(dirname(__FILE__).'/schema.sql'));
else
	echo 'Brak schema.sql - zostanie utworzony tylko plik z danymi.'.MYEOT;

if(file_exists($dir_xml . 'ULIC.xml')) {
	$xml = simplexml_load_file($dir_xml . 'ULIC.xml');
	foreach($xml->catalog->row as $row){
		fwrite($fh, array_to_insert('ULIC', array(
			'WOJ' => $row->col[0],
			'POW' => $row->col[1],
			'GMI' => $row->col[2],
			'RODZ_GMI' => $row->col[3],
			'SYM' => $row->col[4],
			'SYM_UL' => $row->col[5],
			'CECHA' => $row->col[6],
			'NAZWA_1' => $row->col[7],
			'NAZWA_2' => $row->col[8],
			'STAN_NA' => $row->col[9],
		)));
	}
	echo 'Zakonczono przetwarzanie ULIC.xml'.MYEOL;
} else
	echo 'Nie odnaleziono pliku ULIC.xml'.MYEOL;

if(file_exists($dir_xml . 'TERC.xml')) {
	$xml = simplexml_load_file($dir_xml . 'TERC.xml');
	foreach($xml->catalog->row as $row){
		fwrite($fh, array_to_insert('TERC', array(
			'WOJ' => $row->col[0],
			'POW' => $row->col[1],
			'GMI' => $row->col[2],
			'RODZ' => $row->col[3],
			'NAZWA' => $row->col[4],
			'NAZDOD' => $row->col[5],
			'STAN_NA' => $row->col[6]
		)));
	}
		echo 'Zakonczono przetwarzanie TERC.xml'.MYEOL;
} else
	echo 'Nie odnaleziono pliku TERC.xml'.MYEOL;

if(file_exists($dir_xml . 'SIMC.xml')) {
	$xml = simplexml_load_file($dir_xml . 'SIMC.xml');
	foreach($xml->catalog->row as $row){
		fwrite($fh, array_to_insert('SIMC', array(
			'WOJ' => $row->col[0],
			'POW' => $row->col[1],
			'GMI' => $row->col[2],
			'RODZ_GMI' => $row->col[3],
			'RM' => $row->col[4],
			'MZ' => $row->col[5],
			'NAZWA' => $row->col[6],
			'SYM' => $row->col[7],
			'SYMPOD' => $row->col[8],
			'STAN_NA' => $row->col[9],
		)));
	}
	echo 'Zakonczono przetwarzanie SIMC.xml'.MYEOL;
} else
	echo 'Nie odnaleziono pliku SIMC.xml'.MYEOL;
	
	
if(file_exists($dir_xml . 'WMRODZ.xml')) {
	$xml = simplexml_load_file($dir_xml . 'WMRODZ.xml');
	foreach($xml->catalog->row as $row){
		fwrite($fh, array_to_insert('WMRODZ', array(
			'RM' => $row->col[0],
			'NAZWA_RM' => $row->col[1],
			'STAN_NA' => $row->col[2],
		)));
	}
	echo 'Zakonczono przetwarzanie WMRODZ.xml'.MYEOL;
} else
	echo 'Nie odnaleziono pliku WMRODZ.xml'.MYEOL;

echo 'Zrobione!';
fclose($fh);



/* ************************************************************************
***************************************************************************

			FUNKCJE

***************************************************************************
************************************************************************* */



/* Funkcja jest modyfikacją http://www.abeautifulsite.net/inserting-an-array-into-a-mysql-database-table/ */

function array_to_insert ($table, $data, $exclude = array()) {
    $fields = $values = array();
    if( !is_array($exclude) ) $exclude = array($exclude);
    foreach( array_keys($data) as $key ) {
        if( !in_array($key, $exclude) ) {
            $fields[] = "`$key`";
			
			if(is_numeric($data[$key]))
				$values[] = trim($data[$key]);
			else
				$values[] = "'" . addslashes(trim($data[$key])) . "'";
				//$values[] = "'" . mysql_real_escape_string($data[$key]) . "'";
        }
    }
    $fields = implode(",", $fields);
    $values = implode(",", $values);
    return "INSERT INTO `$table` ($fields) VALUES ($values); \r\n" ;
}

