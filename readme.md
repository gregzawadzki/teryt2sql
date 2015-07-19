## Struktury
### Opis struktury zbioru WMRODZ - Katalog miejscowości

http://stat.gov.pl/teryt_struktury/wmrodz.htm  

###Opis struktury zbioru SIMC - Katalog miejscowości

http://stat.gov.pl/teryt_struktury/simc.htm

###Opis struktury zbioru TERC - Katalog podziału terytorialnego

http://stat.gov.pl/teryt_struktury/terc.htm

### Opis struktury zbioru ULIC - Katalog ulic
http://stat.gov.pl/teryt_struktury/ulic.htm


##Pliki

* **convert.php** - Konwerter, po uruchomieniu szuka plików XML i tworzy plik output.sql - gotowy do wgrania do bazy.
* **schema.sql** - Struktura tabel
* **xml.zip** - Spakowane pliki XML. Rozpakowane zajmują ponad 100MB. Po wypakowaniu pojawią się pliki:
	* **xml/ULIC.xml** - *j/w.*
	* **xml/SIMC.xml** - *j/w.*
	* **xml/TERC.xml** - *j/w.*
	* **xml/WMRODZ.xml** - *j/w.*
* **output.sql** - Plik wynikowy (tworzony w momencie uruchomienia skryptu).
* **output.zip** - Plik wynikowy (spakowany, 60MB > 6MB). *Jeśli ktoś nie chce generować pliku SQL, może pobrać gotowy wygenerowany plik.*