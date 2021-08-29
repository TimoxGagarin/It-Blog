<?php
	require "includes/config.php";
	$categories = mysqli_query($connection, "SELECT * FROM articles_categories");
	if($_GET['id'] != null)
		$articles = mysqli_query($connection, "SELECT * FROM articles WHERE categorie='". $_GET['id'] ."'");
	else
		$articles = mysqli_query($connection, "SELECT * FROM articles");
	$comments = mysqli_query($connection, "SELECT * FROM comments");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title><?php echo $config['title']; ?></title>
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="bootstrap/bootstrap-grid.min.css">
		<link rel="stylesheet" href="bootstrap/bootstrap.min.css">
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<header class="header">
			<div class="nav">
				<div class="container">
					<div class="row">
						<div class="col-md-2">
							<h1 class="header-title">
								<?php echo $config['title']; ?>
							</h1>
						</div>
						<div class="offset-md-8 col-md-2 d-flex justify-content-between align-items-center">
							<a href="<?php echo $config['urls']['main']; ?>">
								Главная
							</a>
							<a href="<?php echo $config['urls']['vk-url']; ?>" target="_blank">
								Vk
							</a>
						</div>
					</div>
				</div>
			</div>
		</header>
		<section class="categories">
			<div class="nav">
				<div class="container">
					<div class="row">
						<div class="offset-md-1 col-md-10">
							<ul class="categories-list  d-flex justify-content-between">
								<li class="category <?php if($_GET['id'] == null)  echo "active";?>">
									<a href="/">
										Все
									</a>
								</li>
								<?php
									while($cat = mysqli_fetch_assoc($categories)){
									?>
									<li class="category <?php if($_GET['id'] != null && $_GET['id'] == $cat['id']) echo "active"; ?>">
										<a href="/index.php?id=<?php echo $cat['id']; ?>">
											<?php echo $cat['title']; ?>
										</a>
									</li>	
									<?php	
									}
								?>
							</ul>
						</div>
						<div class="offser-md-1"></div>
					</div>
				</div>
			</div>
		</section>
		<section class="blogs">
			<div class="nav">
				<div class="container">
					<div class="row">
						<div class="col all-articles">		
							<?php
								if(mysqli_num_rows($articles) == 0){
									echo "<h1 class='d-flex justify-content-center articles-not-found'>Статей не найдено!</h1>";
								}
								else
									while($article = mysqli_fetch_assoc($articles))
									{
										?>
										<div class="article d-flex">
											<div class="user-info">
												<img src="<?php echo $article['Image']; ?>" alt="" class="article-img">
											</div>
											<div class="article-content">
												<a href="http://php-blog/pages/article-temp/article.php?id=<?php echo $article['id']; ?>" class="article-title">
													<?php 
														$art_cat = $article['categorie'];
														$categories_for_art = mysqli_query($connection, "SELECT * FROM articles_categories");
														while($cat_for_art = mysqli_fetch_assoc($categories_for_art)){
															if($cat_for_art['id'] == $art_cat){
																$categorie_name = $cat_for_art['title'];
																break;
															}
														}
													?>
													<?php echo $article['title']; ?> <span class="article-category">- <?php echo $categorie_name; ?></span>
												</a>
												<p class="article-text">
													<?php echo $article['text']; ?>
												</p>
												<div class="article-info d-flex justify-content-between">
													<p class="date">
														<?php echo $article['pubdate']; ?>
													</p>
													<?php 
														$articles_comments = mysqli_query($connection, "SELECT * FROM comments WHERE article='". $article['id'] ."'");
													?>
													<p class="comments-btn">
														Comments <?php echo mysqli_num_rows($articles_comments); ?>
													</p>
													<p class="views">
														<?php echo $article['views']; ?> views
													</p>
												</div>
											</div>
										</div>
								<?php
									}
								?>
						</div>
					</div>
				</div>
			</div>
		</section>
		<footer class="footer">
			<div class="nav">
				<div class="container">
					<div class="row">
						<div class="col-md-2">
							<h1 class="header-title">
								<?php echo $config['title']; ?>
							</h1>
						</div>
						<div class="offset-md-8 col-md-2 d-flex justify-content-between align-items-center">
							<a href="https://vk.com/timoxgagarin">
								Vk
							</a>
							<a href="#" class="up">
								<img src="img/Vector%204.png" alt="">
							</a>
						</div>
					</div>
				</div>
			</div>
		</footer>
	</body>
	<script src="jQuery.js"></script>
	<script src="bootstrap/bootstrap.bundle.min.js"></script>
	<script src="bootstrap/bootstrap.min.js"></script>
</html>