<?php
    /*class Csomagok {
        private (string)$honnan;
        private (string)$celpont;
        private (string)$mettol;
        private (string)$meddig;
        private (string)$utazasmod;
        private (string)$ellatas;
        private (double)$ar;
        private (bool)$aktiv;
    }

    class Csoport {
        private (int)$utasid;
        private (int)$utazasid;
        private (int)$csoportid;
    }

    class Helyszin {
        private (string)$nev;
        private (string)$varos;
        private (string)$cim;
        private (string)$minoseg;
        private (int)$csillag;
        private (string)$leiras;
        private (bool)$aktiv;
    }

    class Szolgaltatasok {
        private (string)$nev;
        private (bool)$sajat_furdo;
        private (bool)$terasz;
        private (bool)$franciaagy;
        private (bool)$gyerekbarat;
        private (bool)$ac;
        private (bool)$konyha;
        private (bool)$parkolas;
        private (bool)$tv;
        private (bool)$gym;
        private (bool)$medence;
        private (bool)$bar;
        private (bool)$internet;
        private (bool)$szef;
        private (bool)$akadalymentes;
    }

    class Utasok {
        private (int)$utasazon;
        private (string)$nev;
        private (int)$szulev;
        private (int)$szulho;
        private (int)$szulnap;
        private (int)$kor;
        private (string)$nem;
        private (string)$igtipus;
        private (string)$igszam;
        private (string)$tel;
        private (string)$email;
        private (string)$orszag;
        private (int)$irszam;
        private (string)$varos;
        private (string)$utca;
        private (string)$erttel;
        private (string)$ertemail;
        private (string)$biztnev;
        private (string)$fizmod;
        private (bool)$aktiv;
    }

    class Userdata {
        private (int)$utasid;
        private (string)$email;
        private (string)$jelszo;
        
    }

    class Utazas {
        private (int)$utazason;
        private (string)$utasazon;
        private (string)$honnan;
        private (string)$celpont;
        private (string)$mettol;
        private (string)$meddig;
        private (string)$utazasmod;
        private (string)$ellatas;
        private (int)$ar;
        private (bool)$aktiv;


    }*/

    class DbHandler {

        private $conn;
		function __construct() {
			$this->conn = new mysqli("localhost", "root", "", "journeymastersdatabase");
		}

        function getUtazoCount() {
            $result = $this -> conn -> query("select count(*) from utasok where aktiv = 1");
            return $this->result($result);
            
        }

        function result($result)
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