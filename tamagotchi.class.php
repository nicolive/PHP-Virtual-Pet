<?php

/*
 * 
 * Class Tamagotchi
 * - Virtual Pet PHP -
 * - Written by: nicolive -
 * 
 */

class Tamagotchi {
	
	function Tamagotchi($pet) {
		$this->db = new DBConnection;	
		$r = $this->db->Query("SELECT id FROM tamagotchis WHERE name = '$pet'");
		$res = mysql_fetch_array($r);
		
		if(!$res[id] && !$_POST[pet_name]) {
			$this->error = 'noaccount';
		}else 
		if(!$res[id] && $_POST[pet_name]) {
		$r = $this->db->Query("INSERT INTO tamagotchis (name,pet_name,lastfed,lastwashed,lastplayed,lastdoc) VALUES ('$pet','$_POST[pet_name]',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)");		
		
		$r = $this->db->Query("SELECT id FROM tamagotchis WHERE name = '$pet'");
		$res = mysql_fetch_array($r);
		$this->id = $res[id];
		} else $this->id = $res[id];
	}

	function restart($pet) {
		$r = $this->db->Query("DELETE FROM tamagotchis WHERE name = '$pet'");
		header("Location: /bigfatpig");
		exit;
	}

	function Calculate() {
		$this->calculateFullness();
		$this->calculateCleanliness();	
		$this->calculateHealth();	
		$this->calculateMood();
		$this->calculateDeath();		
	}
	
	function calculateAgeSize() {
		$r = $this->db->Query("SELECT UNIX_TIMESTAMP(created) AS created,UNIX_TIMESTAMP(dead) as dead FROM tamagotchis WHERE id = $this->id");
		$res = mysql_fetch_array($r);

		$time = time();
		if($res[dead] != 0) {
			$time = $res[dead];
		}
		
		$age[minutes] = round(($time - $res[created]) / 60);
		$age[hours] = round(($time - $res[created]-1800) / 3600);
		$age[days]  = round(($time - $res[created]) / 86400);
		
		$this->tempAge = $age[minutes];
		return $age;
	}
		
	function calculateCleanliness() {
		$r = $this->db->Query("SELECT cleanliness, lastwashed as lastwashed_original,UNIX_TIMESTAMP(lastwashed) as lastwashed FROM tamagotchis WHERE id = $this->id");
		$res = mysql_fetch_array($r);
		
		$mins = $this->getNightMins($res[lastwashed_original]);
	
		$secondsNotWashed = time() + rand(-360,360) - $res[lastwashed] - $mins *60;		
		$dirtyPercent = ($secondsNotWashed / 86400) * 100; 
		$cleanlinessPercent = 100 - $dirtyPercent;

		if($cleanlinessPercent > $res[cleanliness]) $cleanlinessPercent = $res[cleanliness];
		if($cleanlinessPercent > 100) $cleanlinessPercent = 100;
		if($cleanlinessPercent < 0) $cleanlinessPercent = 0;
		$cleanlinessPercent = round($cleanlinessPercent);

		$r = $this->db->Query("UPDATE tamagotchis SET cleanliness = $cleanlinessPercent WHERE id = $this->id");
		
		$this->tempCleanliness = $cleanlinessPercent;
		return $r;				
	}
	
	function calculateHealth() {
		$r = $this->db->Query("SELECT UNIX_TIMESTAMP(created) AS created,lastdoc AS lastdoc_original, UNIX_TIMESTAMP(lastdoc) AS lastdoc,fullness,cleanliness,mood,health FROM tamagotchis WHERE id = $this->id");
		$res = mysql_fetch_array($r);
		
		$mins = $this->getNightMins($res[lastdoc_original]);
		
		$minutesNotDoc = (time() - $res[lastdoc] - $mins * 60)/60;
		
		$age[minutes] = round((time() - $res[created]) / 60);
		$healthPercent = 100 - ($age[minutes]/200) - ($minutesNotDoc/10) - ( (100-$res[fullness])/10 ) - ( (100-$res[mood])/10 ) - ( (100-$res[cleanliness])/10 );
		$healthPercent = round($healthPercent);
		if($healthPercent < 0) $healthPercent = 0;
		$r = $this->db->Query("UPDATE tamagotchis SET health = $healthPercent WHERE id = $this->id");
		
		$this->tempHealth = $healthPercent;
		return $r;
	}
	
	function calculateDeath() {
		$r = $this->db->Query("SELECT * FROM tamagotchis WHERE id = $this->id");
		$res = mysql_fetch_array($r);
		
		$dead = 0;
		
		if( ($res[mood] - rand(-5,5)) < 10) $dead = 1;
		if( ($res[fullness] - rand(-5,5)) < 10) $dead = 1;
		if( ($res[health] - rand(-5,5)) < 10) $dead = 1;
		if( ($res[mood] < 20) AND ($res[hunger] <20) ) $dead = 1;
		
		//if($dead == 1) $r = $this->db->Query("UPDATE tamagotchis SET health = 0,dead = CURRENT_TIMESTAMP WHERE id = $this->id");
				
		$this->tempDeath = $death;
		return $r;		
	}
	
	function calculateFullness() {
		$r = $this->db->Query("SELECT fullness,lastfed AS lastfed_original, UNIX_TIMESTAMP(lastfed) as lastfed FROM tamagotchis WHERE id = $this->id");
		$res = mysql_fetch_array($r);
		
		$mins = $this->getNightMins($res[lastfed_original]);

		$secondsNotFed = time() + rand(-360,360) - $res[lastfed] - $mins * 60;	 	
		$hungerPercent = ($secondsNotFed / 12000) * 100; 
		$fullnessPercent = 100 - $hungerPercent;

		if($fullnessPercent > $res[fullness]) $fullnessPercent = $res[fullness];
		if($fullnessPercent > 100) $fullnessPercent = 100;
		if($fullnessPercent < 0) $fullnessPercent = 0;
		$fullnessPercent = round($fullnessPercent);

		$r = $this->db->Query("UPDATE tamagotchis SET fullness = $fullnessPercent WHERE id = $this->id");
				
		$this->tempFullness = $fullnessPercent;
		return $r;
	}
	
	function calculateMood() {
		$r = $this->db->Query("SELECT lastplayed as lastplayed_original, UNIX_TIMESTAMP(lastplayed) AS lastplayed,fullness,cleanliness,health,mood FROM tamagotchis WHERE id = $this->id");
		$res = mysql_fetch_array($r);
		
		$mins = $this->getNightMins($res[lastplayed_original]);
		
		$secondsNotPlayed = time() + rand(-360,360) - $res[lastplayed] - $mins * 60;
		$badMoodPercent = ($secondsNotPlayed / 32000) * 100;
		$moodPercent = 100 - $badMoodPercent;

		$moodPercent = round($moodPercent);

		$moodPercent = $moodPercent - (100-$res[fullness])/10 - (100-$res[cleanliness])/10 - (100-$res[health])/10;

		if($moodPercent > 100) $moodPercent = 100;
		if($moodPercent < 0) $moodPercent = 0;
		
		$r = $this->db->Query("UPDATE tamagotchis SET mood = $moodPercent WHERE id = $this->id");
				
		$this->tempMood = $moodPercent;
		return $r;		
	}
	
	function getData() {
		$r = $this->db->Query("SELECT * FROM tamagotchis WHERE id = $this->id");
		
		$res = mysql_fetch_array($r);
		return $res;
	}
	
	function getNightMins($timestamp) {
		$last = split(" ",$timestamp);
		$last = split(":",$last[1]);

		$lastH = $last[0];
		$lastM = $last[1];
		$nowH = date("G");
		$nowM = date("i");
	
		$minutesNight = 0;
		if( ($lastH < 9) || ($lastH > $nowH) ) {
			/* über nacht */
			if($lastH < 9) {
					  $minutesNight = 9 * 60 - $lastH *60 - $lastM;
			} else {
			  	   	  $minutesNight = 9 * 60;
			}
			
		}
		return $minutesNight;
	}
	
	
	function getNightMinsLifetime() {
	    $result = $this->db->Query("SELECT UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(created) as secondsliving,created FROM tamagotchis WHERE id = $this->id");
		$r = mysql_fetch_array($result);
		
		$last = split(" ",$r[created]);
		$last_date = split("-",$last[0]); // 0 = jahr, 1 = monat, 2 = tag
		$last_time = split(":",$last[1]); // 0 = stunde, 1 = minute 
	
		$now_month = date("n");
		$now_month_string = date("F");
		$now_day = date("j");
		$now_hour = date("G");
		$now_minute = date("i");
	
		if( $last_date[1] == $now_month && $last_date[2] == $now_day) {
			// created today
			return $this->getNightMins($r[created]);
		} else {
		   // mins first day
		   if($last_time[0] < 9) {
		   		$minutesNight = 9 * 60 - $last_time[0] *60 - $last_time[1];   					
		   } 
		   // mins days between -- temp! monatsende!!!
		   $minutesNight = $minutesNight + 9 * 60 * ($now_day - $last_date[2]-1);
		   // mins today
		   $minutesNight = $minutesNight + $this->getNightMins(strtotime("$now_day $now_month_string $last_date[0]"));
		}
		return $minutesNight;
	}
	
	
	function actionFeed() {
		$r = $this->db->Query("SELECT UNIX_TIMESTAMP(lastfed) AS lastfed,fullness FROM tamagotchis WHERE id = $this->id");
		$res = mysql_fetch_array($r);
		
		$change = rand(3,20) + (10 -$res[fullness]/10);
		$newFullness = $res[fullness] + $change;

		if($newFullness > 100) $newFullness = 100;
		$r = $this->db->Query("UPDATE tamagotchis SET fullness = $newFullness,lastfed = CURRENT_TIMESTAMP WHERE id = $this->id");
		return $change;		
	}

	
	function actionDoctor() {
		$r = $this->db->Query("UPDATE tamagotchis SET lastdoc = CURRENT_TIMESTAMP WHERE id = $this->id");
		return $change;				
	}
	
	function actionShower() {
		$r = $this->db->Query("SELECT cleanliness FROM tamagotchis WHERE id = $this->id");
		$res = mysql_fetch_array($r);
		
		$change = rand(5,20) + (10 -$res[cleanliness]/10);
		$newCleanliness = $res[cleanliness] + $change;
		if($newCleanliness > 100) $newCleanliness = 100;
		$r = $this->db->Query("UPDATE tamagotchis SET cleanliness = $newCleanliness,lastwashed = CURRENT_TIMESTAMP WHERE id = $this->id");				
		return $change;
	}
	
	function actionPlay($number) {
		$secretNumber = rand(0,1);
		if($secretNumber == $number) {
			$r = $this->db->Query("SELECT mood FROM tamagotchis WHERE id = $this->id");
			$res = mysql_fetch_array($r);
			
			$change = rand(5,20) + (10 -$res[mood]/10);
			$newMood = $res[mood] + $change;
			if($newMood > 100) $newMood = 100;				
			
			$r = $this->db->Query("UPDATE tamagotchis SET mood = $newMood, lastplayed = CURRENT_TIMESTAMP WHERE id = $this->id");							
			return 1;
		}
		return 0;
	}
};

?>
