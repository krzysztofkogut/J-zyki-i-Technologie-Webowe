<?php
	header( 'Content-Type: text/plain; charset=utf-8' );
	
	function verify_password($current_dir, $username, $password) {
		$files = scandir($current_dir); #keeps "." and ".." at first 2 positions
		$file_count = count($files);
		for ($i = 2; $i < $file_count; $i++) {
			$file = $files[$i];
			if (is_dir ($file)) {
				if (!file_exists($info_filepath = $current_dir . "/" . $file . "/" . "info"))
					continue;
				$info_file = fopen($info_filepath, "r") or die("Nie można otworzyć pliku!");
				$lock = flock($info_file, LOCK_EX);
				
				if (feof($info_file))
					continue;
				
				$user = fgets($info_file);
				$user = trim($user);
				
				if ($user != $username)
					continue;
				if (feof($info_file))
					continue;
				$password_read = fgets($info_file);
				$lock = flock($info_file, LOCK_UN);
				fclose($info_file);
				
				$password_read = trim($password_read);
				$password_ciphered = md5($password);
				if ($password_read == $password_ciphered)
					return $file; #returns the blog folder
				else
					return False;
			}
		}
		return False;
	}
	
	function new_post($blog_dir, $text, $date, $time) {
		$seconds = getdate()["seconds"];
		$seconds = strval($seconds);
		if (mb_strlen($seconds) < 2)
			$seconds = "0" . $seconds;
		
		$date_arr = mb_split("-", $date);
		$year = $date_arr[0];
		$month = $date_arr[1];
		$day = $date_arr[2];
		if (mb_strlen($month) < 2)
			$month = "0" . $month;
		if (mb_strlen($day) < 2)
			$day = "0" . $day;
		
		$time_arr = mb_split(":", $time);
		$hour = $time_arr[0];
		$minute = $time_arr[1];
		if (mb_strlen($hour) < 2)
			$hour = "0" . $hour;
		if (mb_strlen($minute) < 2)
			$minute = "0" . $minute;
		
		$filename = $year . $month . $day . $hour . $minute . $seconds;
		
		$files = scandir($blog_dir);
		$file_count = count($files);
		
		$lock = flock($post_file, LOCK_EX);
		$unicode = 0;
		
		for ($i = 2; $i < $file_count; $i++) {
			$file = $files[$i];
			if (mb_strlen($file) != 16)
				continue;
			$file_date = intval(substr($file, 0, -2));
			if ($file_date != $filename)
				continue;
			$file_unicode = intval(substr($file, -2));
			if ($file_unicode >= $unicode)
				$unicode = $file_unicode + 1;
		}
		
		$crit_flag = true;
		while($crit_flag)
		{
			$crit_flag = false;
			$unicode_str = strval($unicode);
			if (mb_strlen($unicode_str) < 2)
				$unicode_str = "0" . $unicode_str;
			$filename = $filename . $unicode_str;
			$file_path = $blog_dir . "/" .$filename;
			
			$post_file = fopen($file_path, "a") or die("Nie można otworzyć pliku!");
			if (filesize($file_path) != 0) {
				$unicode++;
				$crit_flag = true;
				$lock = flock($post_file, LOCK_UN);
				fclose($post_file);
				continue;
			}
			chmod($file_path, 0755);
			fwrite($post_file, $text);
			$lock = flock($post_file, LOCK_UN);
			fclose($post_file);
		}
		return $file_path;
	}
	
	function set_text($file_path, $text) {
		$post_file = fopen($file_path, "w") or die("Nie można otworzyć pliku!");
		$lock = flock($post_file, LOCK_EX);
		fwrite($post_file, $text);
		$lock = flock($post_file, LOCK_UN);
		fclose($post_file);
		return $file_path;
	}
	
	function add_files($post_file, $id, $name) {
		$dir_name = pathinfo($post_file)['dirname'];
		$name = basename($post_file);
		
		
		$total = count($_FILES['upload']['name']);

		// Loop through each file
		for( $i=0 ; $i < $total && $i < 3; $i++ ) {

			//Get the temp file path
			$tmpFilePath = $_FILES['upload']['tmp_name'][$i];

			//Make sure we have a file path
			if ($tmpFilePath != ""){
				//Setup our new file path
				$newFilePath = $dir_name . "/" . $name . $i . '.' . pathinfo($_FILES['upload']['name'][$i], PATHINFO_EXTENSION);

				//Upload the file into the temp dir
				if(!move_uploaded_file($tmpFilePath, $newFilePath)) {
					echo "Nie udało się zapisać pliku: " . $tmpFilePath . "\n";
				}
			}
		}
	}
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	$post = $_POST['post'];
	$date = $_POST['date'];
	$time = $_POST['time'];
	
	if (trim($username) == '' || trim($password) == '' || trim($post) == '') {
		header("Location: http://student.agh.edu.pl/~kogukrzy/blog/error.php?err=2");
	}
	else {
		$current_dir = getcwd();
		
		$folder = null;
		if (!($folder = verify_password($current_dir, $username, $password))) 
			header("Location: http://student.agh.edu.pl/~kogukrzy/blog/error.php?err=1");
		else {
			$post_file = new_post($folder, $post, $date, $time);
			add_files($post_file, 'fileToUpload', 'files');
			header("Location: http://student.agh.edu.pl/~kogukrzy/blog/blog.php?nazwa=" . basename($folder));
		}
	}
?>
