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

        function select($sql)
        {
            $result = $this->conn->query($sql);
            return $this->result_as_array($result);
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