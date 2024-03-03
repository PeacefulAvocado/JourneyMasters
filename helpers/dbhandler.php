<?php
    

    class DbHandler {

        private $conn;
		function __construct() {
			$this->conn = new mysqli("localhost", "root", "", "journeymastersdatabase");
		}


        function getTableCount($table) {
            $result = $this->conn->query("select count(*) as '0' from $table where aktiv = 1");
            $row = $result->fetch_assoc();
            return $row;
        }

        function getMindenAdat($tabla, $db) 
        {
            $result = $this->conn->query("select * from $tabla where aktiv = 1 limit $db");
            return $this->result_as_array($result);
        }

        function getCsomagok($offset) {
            $result = $this->conn->query("select * from csomagok where aktiv = 1 LIMIT $offset, 3"); //"SELECT * FROM your_table LIMIT $offset, $limit";
            return $this->result_as_array($result);
        }


        function getKeresett($tabla, $keresett_oszlop, $hasonlito_oszlop, $adat) 
        {
            $result = $this->conn->query("select $keresett_oszlop as '0' from $tabla where $hasonlito_oszlop = $adat and aktiv = 1");
            $row = $result->fetch_assoc();
            return $row;
        }

        function getKeresettNoAktiv($tabla, $keresett_oszlop, $hasonlito_oszlop, $adat) 
        {
            $result = $this->conn->query("select $keresett_oszlop as '0' from $tabla where $hasonlito_oszlop = $adat");
            $row = $result->fetch_assoc();
            return $row;
        }

        function setUtas($nev, $szulev, $szulho, $szulnap, $kor,$nem,$igtipus,$igszam,$tel,$email,$orszag,$irszam,$varos,$utca,$erttel,$ertemail,$biztnev,$fizmod) {
            $this->conn->query("INSERT IGNORE INTO utasok (nev, szulev, szulho, szulnap, kor, nem, igtipus, igszam, tel, email, orszag, irszam, varos, utca, erttel, ertemail, biztnev, fizmod, aktiv)  VALUES ('$nev', '$szulev', '$szulho', '$szulnap', '$kor', '$nem', '$igtipus', '$igszam', '$tel', '$email', '$orszag', '$irszam', '$varos', '$utca', '$erttel', '$ertemail', '$biztnev', '$fizmod', 1);");

        }

        function updateUtas($utasazon, $igtipus, $igszam, $tel, $orszag, $irszam, $varos, $utca, $erttel, $ertemail, $biztnev, $fizmod) {
            $query = "UPDATE utasok
                      SET igtipus = '$igtipus',
                          igszam = '$igszam',
                          tel = '$tel',
                          orszag = '$orszag',
                          irszam = '$irszam',
                          varos = '$varos',
                          utca = '$utca',
                          erttel = '$erttel',
                          ertemail = '$ertemail',
                          biztnev = '$biztnev',
                          fizmod = '$fizmod'
                      WHERE utasazon = $utasazon";
            
            $this->conn->query($query);
        }
        

        function setUtazas($utazasazon,$utasazon, $honnan, $celpont, $mettol, $meddig, $utazasmod, $ellatas, $ar) {
            $query = "INSERT IGNORE INTO utazas (utazasazon,utasazon, honnan, celpont, mettol, meddig, utazasmod, ellatas, ar, aktiv)  
                      VALUES ($utazasazon, $utasazon, '$honnan', '$celpont', '$mettol', '$meddig', '$utazasmod', '$ellatas', $ar, 1);";
            $this->conn->query($query);
        }

        function setCsoport($utasid, $utazasid, $csoportid) {
            $query = "INSERT IGNORE INTO csoport (utasid, utazasid, csoportid)  
                      VALUES ('$utasid', '$utazasid', '$csoportid');";
            $this->conn->query($query);
        }
        
        
        function select($sql)
        {
            $result = $this->conn->query($sql);
            return $this->result_as_array($result);
        } 

        function noreturnselect($sql)
        {
            $result = $this->conn->query($sql);
        } 

        //SELECT * FROM helyszin ORDER BY nev LIMIT 2 OFFSET 2;

        function getHelyszinek() {
            $result = $this->conn->query("select * from helyszin where aktiv = 1");
            return $this->result_as_array($result);
        }

        function getCsomagokXHelyszinek() {
            $result = $this->conn->query("SELECT * from helyszin inner join csomagok on helyszin.nev = csomagok.celpont where csomagok.aktiv = 1 ");
            return $this->result_as_array($result);
        }

    
        function result_as_array($result)
        {
            $arr = array();
            while ($row = $result->fetch_assoc())
            {
                array_push($arr, $row);
            }
            return $arr;
        }


        
    }
?>