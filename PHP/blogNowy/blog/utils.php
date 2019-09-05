<?php

function get_blogs() {
	$files = scandir(getcwd());
	$file_count = count($files);
	$blogs = array();
	for ($i = 2; $i < $file_count; $i++) {
		$file = $files[$i];
		if (!is_dir($file) or $file[0] == '_')
			continue;
		array_push($blogs, $file);
	}
	return $blogs;
}

function get_posts($blog) {
	$files = scandir($blog);
	$file_count = count($files);
	$all_posts = array();
	for ($i = 2; $i < $file_count; $i++) {
		$post = array();
		$file = $files[$i];
		$file_path = $blog . "/" . $file;
		if (mb_strlen($file) != 16)
			continue;
		$open_file = fopen($file_path, "r") or die("Nie można otworzyć pliku!");
		$lock = flock($open_file, LOCK_EX);
		$post['name'] = $file;
		$post['text'] = fread($open_file, filesize($file_path));
		$post['date'] = get_post_date($file);
		$post['time'] = get_post_time($file);
		$post['unicode'] = get_post_unicode($file);
		$lock = flock($open_file, LOCK_UN);
		fclose($open_file);
		array_push($all_posts, $post);
	}
	return $all_posts;
}

function get_post_number($blog) {
	$posts = scandir($blog);
	$n = 0;
	for ($j = 2; $j < count($posts); $j++) {
		if (mb_strlen($posts[$j]) == 16)
			$n++;
	}
	return $n;
}

function get_post_score($blog, $post) {
	$comment_array = get_comments($blog, $post);
	$score = 0;
	for ($j = 0; $j < count($comment_array); $j++) {
		if ($comment_array[$j]['type'] == 'positive')
			$score++;
		else if ($comment_array[$j]['type'] == 'negative')
			$score--;
	}
	return $score;
}

function get_attachments($blog, $post) {
	$files = scandir($blog);
	$file_count = count($files);
	$attachments = array();
	for ($a = 2; $a < $file_count; $a++) {
		$attachment = $files[$a];
		if (mb_strlen($attachment)<=16 or is_dir($blog . "/" . $attachment)) {
			continue;
		}
		else if (mb_substr($attachment, 0, 16) == $post)
			array_push($attachments, $attachment);
	}
	return $attachments;
}

function swap(&$x, &$y) {
    $tmp = $x;
    $x = $y;
    $y = $tmp;
}


function sort_comments($comment_array) {
	$flag = true;
	while($flag) {
		$flag = false;
		for($i = 0; $i < count($comment_array) - 1; $i++) {
			$index_1 = intval($comment_array[$i]['name']);
			$index_2 = intval($comment_array[$i+1]['name']);
			if ($index_2<$index_1){
				swap($comment_array[$i], $comment_array[$i+1]);
				$flag = true;
			}
		}
	}
	return $comment_array;
}

function get_comments($blog, $post) {
	$comment_dir = $blog . "/" . $post . ".k";
	if (!file_exists($comment_dir) or !is_dir($comment_dir)) 
		return false;
	$comment_files = scandir($comment_dir);
	$comment_count = count($comment_files);
	$comment_array = array();
	$arr = array();
	
	for ($k = 2; $k < $comment_count; $k++) {
		$comment_name = $comment_files[$k];
		$comment_path = $comment_dir . "/" . $comment_name;
		$comment_file = fopen($comment_path, "r") or die("Nie można otworzyć pliku!");
		$lock = flock($comment_file, LOCK_EX);
		$comment_type = trim(fgets($comment_file));
		$comment_time = trim(fgets($comment_file));
		$comment_user = trim(fgets($comment_file));
		$comment_text = fread($comment_file, filesize($comment_path));
		$lock = flock($comment_file, LOCK_UN);
		fclose($comment_file);
		
		$comment_array['name'] = $comment_name;
		$comment_array['path'] = $comment_path;
		$comment_array['type'] = $comment_type;
		$comment_array['time'] = $comment_time;
		$comment_array['user'] = $comment_user;
		$comment_array['text'] = $comment_text;
		array_push($arr, $comment_array);
	}
	
	$arr = sort_comments($arr);
	return $arr;
}

function get_info($blog) {
	$path = $blog . "/info";
	$info_file = fopen($path, "r") or die("Nie można otworzyć pliku info!");
	$lock = flock($info_file, LOCK_EX);
	$info = array();
	if (!feof($info_file))
		$info['user'] = trim(fgets($info_file));
	if (!feof($info_file))
		$info['password'] = trim(fgets($info_file));
	if (!feof($info_file))
		$info['description'] = trim(fread($info_file, filesize($path)));
	$lock = flock($info_file, LOCK_UN);
	fclose($info_file);
	
	return $info;
}

function get_post_date($post_name) {
	return mb_substr($post_name, 0, 4) . "-" . mb_substr($post_name, 4, 2) . "-" . mb_substr($post_name, 6, 2);
}

function get_post_time($post_name) {
	return mb_substr($post_name, 8, 2) . ":" . mb_substr($post_name, 10, 2) . ":" . mb_substr($post_name, 12, 2);
}

function get_post_unicode($post_name) {
	return mb_substr($post_name, 14, 2);
}
?>