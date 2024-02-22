<?php
    /*class Csomagok {
        private $honnan;
        private $celpont;
        private $mettol;
        private $meddig;
        private $utazasmod;
        private $ar;
        private $aktiv;

        function __construct($honnan, $celpont, $mettol, $meddig, $utazasmod, $ar, $aktiv)
        {
            $this->honnan = $honnan;
            $this->celpont = $celpont;
            $this->mettol = $mettol;
            $this->meddig = $meddig;
            $this->utazasmod = $utazasmod;
            $this->ar = $ar;
            $this->aktiv = $aktiv;
        }

    }

    class Csoport {
        private $utasid;
        private $utazasid;
        private $csoportid;
    }

    class Helyszin {
        private $nev;
        private $varos;
        private $cim;
        private $minoseg;
        private $csillag;
        private $leiras;
        private $aktiv;
    }

    class Szolgaltatasok {
        private $nev;
        private $sajat_furdo;
        private $terasz;
        private $franciaagy;
        private $gyerekbarat;
        private $ac;
        private $konyha;
        private $parkolas;
        private $tv;
        private $gym;
        private $medence;
        private $bar;
        private $internet;
        private $szef;
        private $akadalymentes;
    }

    class Utasok {
        private $utasazon;
        private $nev;
        private $szulev;
        private $szulho;
        private $szulnap;
        private $kor;
        private $nem;
        private $igtipus;
        private $igszam;
        private $tel;
        private $email;
        private $orszag;
        private $irszam;
        private $varos;
        private $utca;
        private $erttel;
        private $ertemail;
        private $biztnev;
        private $fizmod;
        private $aktiv;
    }

    class Userdata {
        private $utasid;
        private $email;
        private $jelszo;
        
    }

    class Utazas {
        private $utazason;
        private $utasazon;
        private $honnan;
        private $celpont;
        private $mettol;
        private $meddig;
        private $utazasmod;
        private $ellatas;
        private $ar;
        private $aktiv;


    }*/

    class DbHandler {

        private $conn;
		function __construct() {
			$this->conn = new mysqli("localhost", "root", "", "journeymastersdatabase");
		}

        function getUtazoCount() {
            $result = $this->conn->query("select count(*) as '0' from utasok where aktiv = 1");
            $row = $result->fetch_assoc();
            return $row;
        }

        function getHelyszinCount() {
            $result = $this->conn->query("select count(*) as '0' from helyszin where aktiv = 1");
            $row = $result->fetch_assoc();
            return $row;
        }

        function getMindenAdat($tabla, $db) 
        {
            $result = $this->conn->query("select * from $tabla where aktiv = 1 limit $db");
            return $this->result_as_array($result);
        }

        function getKeresett($tabla, $keresett_oszlop, $hasonlito_oszlop, $adat) 
        {
            $result = $this->conn->query("select $keresett_oszlop as '0' from $tabla where $hasonlito_oszlop = '$adat'");
            $row = $result->fetch_assoc();
            return $row;
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