<?php

class DBConnection
{

	function DBConnection()
         {
         global $DB;
$DB[server] = 'localhost';
$DB[user] = 'root';
$DB[pass] = '';
$DB[db] = 'tamagotchi';
		$connection = mysql_connect($DB[server], $DB[user], $DB[pass]);
		if (!$connection)
                 {
                 	echo "no connection"; exit;
                 } else
                 {
			$select = mysql_select_db($DB[db]);
			if (!$select) { echo "no database"; exit; }
		}
         }

         function Query($query)
         {
         	return mysql_query($query);
         }
};

?>
