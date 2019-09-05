<?php echo '<?xml version="1.0"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Blog</title>
		<meta http-equiv="Content-Type" content="application/xhtml+xml;
			charset=UTF-8" />
		<meta name="Author" lang="pl" content="Krzysztof Kogut" />
		<link rel="stylesheet" title="compact" href="style.css" type="text/css" />
	</head>
	<body>
		<div id="container">
			<div id="logo">
				<p><?php 
					function err404() {
						if (!isset($_GET['nazwa']))
							return true;
						else {
							$name = $_GET['nazwa'];
							$dir = "./";
							$files = scandir($dir);
							$file_count = count($files);
							for ($i = 2; $i < $file_count; $i++) {
								$file = $files[$i];
								if ($file == $name and is_dir($file)) {
									return false;
								}
							}
							return true;
						}
					}
					if (!isset($_GET['nazwa']))
						header("Location: http://borg.kis.agh.edu.pl/~kogukrzy/blog/all_blogs.php");
					else if (err404())
						header("Location: http://borg.kis.agh.edu.pl/~kogukrzy/blog/error.php?err=404");
					else
						echo $_GET['nazwa'];
				?></p>
			</div>
			
			<div class="menu">
				<div class="option1"><a href="http://borg.kis.agh.edu.pl/~kogukrzy/blog/all_blogs.php">Wszystkie blogi</a></div>
				<div class="option1"><a href="http://borg.kis.agh.edu.pl/~kogukrzy/blog/create_blog.php">Załóż blog</a></div>
				<div class="option1"><a href="http://borg.kis.agh.edu.pl/~kogukrzy/blog/add_post.php">Dodaj post</a></div>
				<div style="clear:both;"></div>
			</div>

			<div id="content">
				<div id="blog">
					<?php
						include 'utils.php';
						if (err404()) {
							echo '<center><h2>Nie znaleziono strony o podanej nazwie!</h2></center>';
						} else {
							$blog = $_GET['nazwa'];
							$posts = get_posts($blog);
							$post_count = count($posts);
							
							//write blog description
							$info = get_info($blog);
							echo '<p class="desc-title">';
							echo 'Właściciel blogu: ' . '<span style = "font-weight:bold">' . $info['user'] . '</span>';
							echo '</p>';
							echo '<p id="description">';
							echo $info['description'];
							echo '</p>';
							

							for ($i = 0; $i < $post_count; $i++) {
								$post = $posts[$i];
								$post_name = $post['name'];
								$post_file_path = $dir . $post;
								
								//start post
								echo '<hr>';
								//post icon
								echo '<div class="icon-wrapper">';
								$score = get_post_score($blog, $post_name);
								
								if ($score > 0)
									$icon = "pozytywny";
								else if ($score < 0)
									$icon = "negatywny";
								else if ($score == 0)
									$icon = "neutralny";
								//echo '<div class="post-icon">';
								//echo $icon;
								//echo '</div>';
								echo '<p class="score">';
								echo '<strong>';
								if ($score > 0) {
									echo '<font color="' . '#39b54a' . '">';
									echo '+';
								} else if ($score < 0)
									echo '<font color="' . '#c1272d' . '">';
								else
									echo '<font color="' . 'white' . '">';
								echo $score;
								if ($comments = get_comments($blog, $post_name))
									echo ' (' . count($comments) . ')';
								else
									echo ' (' . 0 . ') ' . $icon;
								echo '</font>';
								echo '</strong>';
								echo '</p>';
								echo '</div>';
								
								//write post text
								echo '<p class="post">';
								echo $post['text'];
								echo '</p>';
								
								//attachments
								$attachments = get_attachments($blog, $post_name);
								
								if (count($attachments)>0) {
									echo '<div class="attachments">';
									echo '<ul>';
									for ($a = 0; $a < count($attachments); $a++) {
										$attach = $attachments[$a];
										echo '<li><a href="' . $blog . "/" . $attach . '">' . "Załącznik " . strval($a + 1) . '</a></li>';
									}
									echo '</ul>';
									echo '</div>';
								}
								
								//add comment link
								echo '<div class="subscript">';
								echo '<div class="add-comment">';
								$comment_form_address = "http://borg.kis.agh.edu.pl/~kogukrzy/blog/comment_blog.php";
								echo '<a href="' . $comment_form_address . '?blog=' . $blog . '&post=' . $post_name . '">';
								echo 'Dodaj komentarz';
								echo '</a>';
								echo '</div>';
								
								//blog time
								echo '<div class="blog-time">';
								echo '<p class="blog-time">';
								$date = $post['date'];
								$time = $post['time'];
								echo  $date . ", " . $time;
								echo '</p>';
								echo '</div>';
								echo '</div>';
								
								//comments
								if ($comments = get_comments($blog, $post_name)) {
									$comment_count = count($comments);
									echo '<div class="comments">';
									for ($k = 0; $k < $comment_count; $k++) {
										$comment = $comments[$k];
										$comment_name = $comments[$k]['name'];
										$comment_path = $comments[$k]['path'];
										$comment_type = $comments[$k]['type'];
										$comment_time = $comments[$k]['time'];
										$comment_user = $comments[$k]['user'];
										$comment_text = $comments[$k]['text'];
										echo '<hr>';
										
										
										if ($comment_type == "positive")
											$icon = '<font color="' . '#39b54a' . '">pozytywny</font>';
										if ($comment_type == "negative")
											$icon = '<font color="' . '#c1272d' . '">negatywny</font>';
										if ($comment_type == '<font color="' . 'white' . '">neutral</font>')
											$icon = "neutralny";
										
										//echo $icon;
										
										//username
										echo '<p class="user"><span style = "font-weight:bold">' . $comment_user . " " . $icon;
										
										echo '</span></p>';
										
										//apply formatting to @username
										$words = mb_split(' ', $comment_text);
										foreach ($words as $word) {
											if (mb_substr($word, 0, 1) == '@') {
												$comment_text = str_replace($word, '<span class="user_reference">' . $word . '</span>', $comment_text);
											}
										}
										
										//text
										echo '<div class="comment">';
										echo '<p>';
										echo $comment_text;
										echo '</p>';
										echo '</div>';
										echo '<div class="subscript">';
										
										//answer
										echo '<div class="add-comment">';
										$comment_form_address = "http://borg.kis.agh.edu.pl/~kogukrzy/blog/comment_blog.php";
										echo '<a href="' . $comment_form_address . '?blog=' . $blog . '&post=' . $post_name . '&user=' . $comment_user . '">';
										echo 'Odpowiedz';
										echo '</a>';
										echo '</div>';
										
										//time
										echo '<div class="blog-time">';
										echo '<p class="blog-time">';
										echo  $comment_time;
										echo '</p>';
										echo '</div>';
										echo '</div>';
									}
									echo '</div>';
								}
							}
							echo '<hr>';
							echo '<div class="add_post">';
							echo '<form action="http://borg.kis.agh.edu.pl/~kogukrzy/blog/add_post.php">';
								echo '<input type="submit" value="Dodaj wpis" />';
							echo '</form>';
							echo '</div>';
						}
					?>
				</div>
				<div id="menul" class="spis_menu">
					<h2>Spis</h2>
					<?php include 'menu.php';?>
				</div>
				
			</div>
			<p>
				<a href="http://validator.w3.org/check?uri=referer">
					<img src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Strict" height="31" width="88" />
				</a>
			</p>
			<p>
				<a href="http://jigsaw.w3.org/css-validator/check/referer">
					<img style="border:0;width:88px;height:31px"
							src="http://jigsaw.w3.org/css-validator/images/vcss-blue"
							alt="Poprawny CSS!" />
				</a>
			</p>
		</div>
	</body>
</html>
