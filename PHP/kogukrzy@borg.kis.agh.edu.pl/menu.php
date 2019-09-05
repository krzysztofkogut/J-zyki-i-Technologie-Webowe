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
	echo '<li onclick="window.location = \'http://student.agh.edu.pl/~kogukrzy/blog/blog.php?nazwa=' . $blogs[$i] . '\';">';
		echo '<a href="http://student.agh.edu.pl/~kogukrzy/blog/blog.php?nazwa=' . $blogs[$i] . '">' . $blogs[$i] . '</a>';
	echo '</li>';
}
echo '<li onclick="window.location = \'http://student.agh.edu.pl/~kogukrzy/blog/all_blogs.php\';">';
	echo '<a href="http://student.agh.edu.pl/~kogukrzy/blog/all_blogs.php">' . 'Wszystkie blogi' . '</a>';
echo '</li>';

echo '</ul>';
echo '<h2 id="sections">Opcje</h2>';
echo '<ul>';
echo '<li onclick="window.location = \'http://student.agh.edu.pl/~kogukrzy/blog/create_blog.php\';">';
	echo '<a href="http://student.agh.edu.pl/~kogukrzy/blog/create_blog.php">' . 'Załóż blog' . '</a>';
echo '</li>';
echo '<li onclick="window.location = \'http://student.agh.edu.pl/~kogukrzy/blog/add_post.php\';">';
	echo '<a href="http://student.agh.edu.pl/~kogukrzy/blog/add_post.php">' . 'Utwórz post' . '</a>';
echo '</li>';
echo '<li onclick="window.location = \'http://student.agh.edu.pl/~kogukrzy/index.html\';">';
	echo '<a href="http://student.agh.edu.pl/~kogukrzy/index.html">' . 'Przejdź do zadań' . '</a>';
echo '</li>';
echo '</ul>';
?>