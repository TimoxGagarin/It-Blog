<?php require "../../includes/config.php";
	$article= mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM articles WHERE id='". $_GET[ 'id'] . "'"));
	$comments= mysqli_query($connection, "SELECT * FROM comments WHERE article='". $_GET[ 'id'] . "'");
	mysqli_query($connection, "UPDATE articles SET views = '". $article[ 'views'] . "'+ 1 WHERE id = '". $_GET[ 'id']. "'");
	if(isset($_POST[ 'do_post'])){
		$errors=array();
		if($_POST[ 'name']=="" ){
			$errors[]="Введите имя!" ;
		}
		if($_POST[ 'email']=="" ){ 
			$errors[]="Введите почту!" ;
		}
		if($_POST[ 'text']=="" ){
			$errors[]="Введите текст комментария!" ;
		}
		if(empty($errors)){
			mysqli_query($connection, "INSERT INTO comments (author, email, text, article) VALUES ('". $_POST[ 'name'] . "', '". $_POST[ 'email'] . "', '". $_POST[ 'text'] . "', '". $article[ 'id'] . "')");
			$_POST = null;
		}
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>
        <?php echo $config[ 'title']; ?>
    </title>
    <link rel="stylesheet" href="../../bootstrap/bootstrap-grid.min.css">
    <link rel="stylesheet" href="../../bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../../style.css">
    <link rel="stylesheet" href="article-style.css">
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
    <section class="blogs">
        <div class="nav">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="page__article d-flex">
                            <div class="page__user-info">
                                <img src="<?php echo $article['Image']; ?>" alt="" class="page__article-img">
                            </div>
                            <div class="page__article-content">
                                <h1 class="page__article-title">
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
									</h1>
                                <p class="page__article-text">
                                    <?php echo $article[ 'text']; ?>
                                </p>
                                <div class="page__article-info d-flex justify-content-between">
                                    <p class="date">
                                        <?php echo $article[ 'pubdate']; ?>
                                    </p>
                                    <p class="comments-btn">
                                        Comments
                                        <?php echo mysqli_num_rows($comments); ?>
                                    </p>
                                    <p class="views">
                                        <?php echo $article[ 'views']; ?> views
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="add-comment">
                            <form method="POST" action="http://php-blog/pages/article-temp/article.php?id=<?php echo $article['id'] ?>">
                                <h1 class="add-comment__title">
										Оставить комментарий
									</h1>
                                <div class="d-flex justify-content-between">
                                    <input type="text" placeholder="Ник" name="name" class="comment-name" value="<?php echo $_POST['name'] ?>">
                                    <input type="email" placeholder="Почта" name="email" class="comment-email" value="<?php echo $_POST['email'] ?>">
                                </div>
                                <textarea type="text" placeholder="Текст комментария" name="text" class="w-100 comment-text">
                                    <?php echo $_POST[ 'text'] ?>
                                </textarea>
                                <input type="submit" value="Оставить" name="do_post" class="d-block">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <?php while($comment = mysqli_fetch_assoc($comments)){ ?>
                        <div class="page__comment">
                            <div class="page__user-info d-flex align-items-center">
                                <img src="https://www.gravatar.com/avatar/<?php echo md5($comment['email']) ?>" alt="" class="page__comment__user-avatar">
                                <div>
                                    <h1 class="page__comment__user-nick">
										<?php echo $comment['author']; ?>
									</h1>
                                    <p class="comment-pubdate">
                                        <?php echo $comment[ 'pubdate']; ?>
                                    </p>
                                </div>
                            </div>
                            <p class="page__comment-text">
                                <?php echo $comment[ 'text']; ?>
                            </p>
                        </div>
                        <?php } ?>
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
                            <img src="../../img/Vector%204.png" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
<script src="../../jQuery.js"></script>
<script src="../../bootstrap/bootstrap.bundle.min.js"></script>
<script src="../../bootstrap/bootstrap.min.js"></script>

</html>