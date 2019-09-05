<?php
echo '<ul>';
$current_dir = getcwd();
$files = scandir($current_dir);
$file_count = count($files);
$max_count = 4;
$blogs = array();
for ($i = 2; $i < $file_count; $i++) {
	$file = $files[$i];
	if (!is_dir($file) or $file[0] == '_')
		continue;
	array_push($blogs, $file);
}

for ($i = 0; $i < count($blogs) and $i < $max_count; $i++) {
	echo '<div class="option2">';
		echo '<a href="http://borg.kis.agh.edu.pl/~kogukrzy/blog/blog.php?nazwa=' . $blogs[$i] . '">' . $blogs[$i] . '</a>';
	echo '</div>';
}

?>