<?php
	header( 'Content-Type: text/plain; charset=utf-8' );
	
	function make_dir($name) {
		if (!file_exists($name)) {
			mkdir($name, 0755);
			return True;
		}
		else {
			return False;
		}
	}
	
	function add_comment($dir_path, $type, $username, $text) {
		$block_file = fopen("comment_blocker", "w") or die("Nie można zablokować sekcji krytycznej.");
		$blocker = flock($block_file, LOCK_EX);
		
		$comment_count = count(scandir($dir_path)) - 2;
		
		$info_file = fopen($dir_path . "/" . $comment_count, "w") or die("Nie można otworzyć pliku!");
		fwrite($info_file, $type . "\n");
		$date_unformatted = getdate();
		$year = strval($date_unformatted["year"]);
		$month = strval($date_unformatted["mon"]);
		$day = strval($date_unformatted["mday"]);
		if (mb_strlen($month)<2)
			$month = '0' . $month;
		if (mb_strlen($day)<2)
			$day = '0' . $day;
		
		$hour = strval($date_unformatted["hours"]);
		$min = strval($date_unformatted["minutes"]);
		$sec = strval($date_unformatted["seconds"]);
		if (mb_strlen($hour)<2)
			$hour = '0' . $hour;
		if (mb_strlen($min)<2)
			$min = '0' . $min;
		if (mb_strlen($sec)<2)
			$sec = '0' . $sec;
		
		$date = $year . "-" . $month . "-" . $day;
		$time = $hour . ":" . $min . ":" . $sec;
		fwrite($info_file, $date . ", " . $time . "\n");
		fwrite($info_file, $username . "\n");
		fwrite($info_file, $text);
		fclose($info_file);
		
		$blocker = flock($block_file, LOCK_UN);
		fclose($block_file);
		
		return True;
	}
	
	$blog = $_POST['blog'];
	$post = $_POST['post'];
	$type = $_POST['type'];
	$username = $_POST['username'];
	$comment = $_POST['comment'];
	if (trim($username) == '' || trim($comment) == '')
		header("Location: http://borg.kis.agh.edu.pl/~kogukrzy/blog/error.php?err=2");
	else {
		$dir_path = "./" . $blog . "/" . $post . ".k" ;
		echo $post;
		make_dir($dir_path);
		
		add_comment($dir_path, $type, $username, $comment);
		header("Location: http://borg.kis.agh.edu.pl/~kogukrzy/blog/blog.php?nazwa=" . $blog);
	}
?>
