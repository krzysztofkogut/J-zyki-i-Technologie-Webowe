<?php
	header( 'Content-Type: text/plain; charset=utf-8' );
	
	function make_dir($name) {
		if (!file_exists($name)) {
			mkdir($name, 0755);
			return True;
		}
		else {
			echo "Nazwa blogu zajęta";
			return False;
		}
	}
	
	function write_info($dir_path, $username, $password, $description) {
		$info_file = fopen($dir_path . "info", "w") or die("Nie można otworzyć pliku!");
		$lock = flock($info_file, LOCK_EX);
		fwrite($info_file, $username . "\n");
		fwrite($info_file, md5($password) . "\n");
		fwrite($info_file, $description);
		$lock = flock($info_file, LOCK_UN);
		fclose($info_file);
		return True;
	}
	
	$name = $_POST['name'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$description = $_POST['description'];
	
	$block_file = fopen("comment_blocker", "w") or die("Nie można zablokować sekcji krytycznej.");
	$blocker = flock($block_file, LOCK_EX);
	
	if (trim($username) == '' || trim($name) == '' || trim($password) == '')
		header("Location: http://borg.kis.agh.edu.pl/~kogukrzy/blogJS/error.php?err=2");
	else {
		if (file_exists($name)) {
			header("Location: http://borg.kis.agh.edu.pl/~kogukrzy/blogJS/error.php?err=0");
		}
		else {
			make_dir($name);
			$dir_path = $name . "/";
			
			write_info($dir_path, $username, $password, $description);
			header("Location: http://borg.kis.agh.edu.pl/~kogukrzy/blogJS/blog.php?nazwa=" . $name);
		}
	}

	$blocker = flock($block_file, LOCK_UN);
	fclose($block_file);
?>
