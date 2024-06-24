<?php include('php/db.php') ?>
<?php include('php/server.php') ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>RETube - Мои видео</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut-icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <script src="js/script.js"></script>
</head>
<body>
<?php include 'header.php';
    if(!isset($_SESSION['username'])){
        header('location: index.php');
    }
?>
<section>
    <div class="nav-and-prev-video">
        <?php include 'navigation.php' ?>
        <div class="main-videos">
            <h1>Опубликованные видео</h1>
            <div class="main-video-content">
                <p>Видео</p>
                <p>Ограничения</p>
                <p>Категория</p>
                <p>Дата загрузки</p>
            </div>
            <div class="video">
                <?php
                $username = $_SESSION['username'];

                $sql = "SELECT * FROM videos WHERE creator='$username' AND restriction != 'ban' ORDER BY date DESC";

                if ($_SESSION['username'] == 'admin') {
                    $sql = "SELECT * FROM videos ORDER BY date DESC";
                }
                $res = mysqli_query($db, $sql);

                if (mysqli_num_rows($res) > 0) {
                    while ($video = mysqli_fetch_assoc($res)) {
                        ?>
                        <div class="video-preview">
                            <a>
                                <img class="video-preview-image" src="<?= $video['preview_url'] ?>" alt="video preview">
                            </a>
                            <p class="video-title"><?= $video['title'] ?></p>
                            <p class="video-description"><?= $video['description'] ?></p>
                            <img class="like" src="img/icon/like.png" alt="like">
                            <p class="like-count"><?php
                                $id = $video['id'];
                                $sql_like = "SELECT * FROM review WHERE video_id='$id' AND review=true";
                                $res_like = mysqli_query($db, $sql_like);
                                echo mysqli_num_rows($res_like);
                                ?></p>
                            <img class="dislike" src="img/icon/like.png" alt="dislike">
                            <p class="dislike-count"><?php
                                $id = $video['id'];
                                $sql_dislike = "SELECT * FROM review WHERE video_id='$id' AND review=false";
                                $res_dislike = mysqli_query($db, $sql_dislike);
                                echo mysqli_num_rows($res_dislike);
                                ?></p>
                            <?php
                            $restriction = $video['restriction'];
                            if($video['restriction'] == 'none' && $_SESSION['username'] != 'admin' || $video['restriction'] == 'ghost' && $_SESSION['username'] != 'admin') : ?>
                            <form class="watch" method="post">
                                <input style="display: none" name="video_id" value="<?= $video['id'] ?>">
                                <div class="watch-btn">
                                    <button type="submit" name="watch_video">Смотреть</button>
                                </div>
                            </form>
                            <?php endif; ?>
                            <?php if($_SESSION['username'] == 'admin') : ?>
                            <form class="watch" method="post">
                                <input style="display: none" name="video_id" value="<?= $video['id'] ?>">
                                <div class="watch-btn">
                                    <button type="submit" name="watch_video">Смотреть</button>
                                </div>
                            </form>
                            <?php endif; ?>
                        </div>
                        <?php if($_SESSION['username'] != 'admin') : ?>
                        <p><?php
                            switch ($restriction) {
                                case 'none':
                                    echo 'Нет ограничения';
                                    break;
                                case 'ghost':
                                    echo 'Теневой бан';
                                    break;
                                case 'danger':
                                    echo 'Нарушение';
                                    break;
                                case 'ban':
                                    echo 'Бан';
                                    break;
                            }
                            ?></p>
                        <?php endif; ?>
                        <?php if($_SESSION['username'] == 'admin') :?>
                        <?php $restriction = $video['restriction']; ?>
                        <form method="post">
                            <input style="display: none" name="restriction_id" value="<?= $video['id'] ?>">
                            <select name="restriction_option" id="restriction" required>
                                <option value="none"<?php if($restriction=='none'){echo "selected";} ?>>Нет ограничения</option>
                                <option value="ghost" <?php if($restriction=='ghost'){echo "selected";} ?>>Теневой бан</option>
                                <option value="danger" <?php if($restriction=='danger'){echo "selected";} ?>>Нарушение</option>
                                <option value="ban" <?php if($restriction=='ban'){echo "selected";} ?>>Бан</option>
                            </select>
                            <div class="update">
                                <button type="submit" name="change_restriction">Обновить</button>
                            </div>
                        </form>
                        <?php endif; ?>
                        <div class="tooltip">
                            <div class="tooltip-content" aria-describedby="some_id">
                                <img class="category-icon"
                                     src="<?php echo "img/tool-tip/" . $video['category'] . ".svg" ?>" alt="">
                                <span class="tooltip-arrow" role="tooltip"><?= $video['category'] ?></span>
                            </div>

                        </div>
                        <p>
                            <span><?php echo date_format(date_create($video['date']), "d-m-Y H:i") ?></span>
                        </p>
                        <?php
                    }
                } else {
                    echo "<h1>Нет загруженных видео</h1>";
                }
                ?>
            </div>
        </div>
</section>
</body>
</html>
