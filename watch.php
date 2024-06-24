<?php include('php/db.php') ?>
<?php include('php/server.php') ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>RETube</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut-icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <script src="js/script.js"></script>
</head>
<body>
<?php include 'header.php'; ?>
<section>
    <div class="wrapper">
        <?php
        $id = $_SESSION['video_id'];
        $sql = "SELECT * FROM videos WHERE restriction='none' AND id='$id' OR restriction='ghost' AND id='$id'";

        if (isset($_SESSION['username'])) {
            if ($_SESSION['username'] == 'admin') {
                $sql = "SELECT * FROM videos WHERE id='$id'";
            }
        }
        $res = mysqli_query($db, $sql);

        if (mysqli_num_rows($res) > 0) {
            while ($video = mysqli_fetch_assoc($res)) {
                ?>
                <div class="main-content">
                    <div class="main-content-left">
                        <div class="main-content-left-video">
                            <video src="<?= $video['video_url'] ?>" controls>
                        </div>
                        <div class="main-content-left-description">
                            <div>
                                <h1><?= $video['title'] ?></h1>
                            </div>
                            <h4 style="text-align: start; opacity: 50%;"><?= $video['date'] ?></h4>
                            <div>
                                <div class="flex">
                                    <form method="post">
                                        <button type="submit" name="like"  class="review">
                                            <img src="img/icon/like.png" alt="like">
                                        </button>
                                    </form>
                                    <h4><?php
                                        $id = $_SESSION['video_id'];
                                        $sql_like = "SELECT * FROM review WHERE video_id='$id' AND review=true";
                                        $res_like = mysqli_query($db, $sql_like);
                                        echo mysqli_num_rows($res_like);
                                        ?></h4>
                                </div>
                                <div class="flex">
                                    <form method="post">
                                        <button type="submit" name="dislike" class="review">
                                            <img class="dislike" src="img/icon/like.png" alt="dislike">
                                        </button>
                                    </form>
                                    <h4><?php
                                        $id = $_SESSION['video_id'];
                                        $sql_dislike = "SELECT * FROM review WHERE video_id='$id' AND review=false";
                                        $res_dislike = mysqli_query($db, $sql_dislike);
                                        echo mysqli_num_rows($res_dislike);
                                        ?></h4>
                                </div>
                            </div>
                            <h1><?= $video['creator'] ?></h1>
                            <p class="main-content-left-description-paragraph"><?= $video['description'] ?></p>
                        </div>
                        <?php if (isset($_SESSION['username'])) : ?>
                            <form method="post" class="main-content-left-input">
                                <input type="text" name="comment" required placeholder="Введите текст комментария">
                                <div class="watch-btn">
                                    <button type="submit" name="add_comment">Отправить</button>
                                </div>
                            </form>
                        <?php endif ?>
                        <?php
                        ?>
                        <div class="main-content-left-comments">
                            <?php
                            $sql = "SELECT * FROM comments WHERE video_id='$id' ORDER BY date DESC ";

                            $comments_res = mysqli_query($db, $sql);

                            if (mysqli_num_rows($comments_res) > 0) {
                                while ($comment = mysqli_fetch_assoc($comments_res)) {
                                    ?>
                                    <div class="main-content-left-comments-container">
                                        <div>
                                            <h1><?= $comment['user'] ?></h1>
                                            <p><?php echo date_format(date_create($comment['date']), "d-m-Y H:i") ?></p>
                                        </div>
                                        <p><?= $comment['comm'] ?></p>
                                    </div>
                                    <?php
                                }
                            } else {
                                echo "<h1>Нет комментариев</h1>";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="main-content-right">
                        <?php
                        $videos_sql = "SELECT * FROM videos WHERE restriction='none' AND id!='$id' ORDER BY date DESC  LIMIT 5 ";

                        if (isset($_SESSION['username'])) {
                            if ($_SESSION['username'] == 'admin') {
                                $videos_sql = "SELECT * FROM videos WHERE restriction='none' AND id!='$id' ORDER BY date DESC LIMIT 5";
                            }
                        }
                        $videos_query = mysqli_query($db, $videos_sql);

                        if (mysqli_num_rows($videos_query) > 0) {
                            while ($videos = mysqli_fetch_assoc($videos_query)) {
                                ?>
                                <div class="next-video">
                                    <img src="<?= $videos['preview_url'] ?>" alt="preview"><br>
                                    <span>
                                    <h1><?= $videos['title'] ?></h1>
                                    <h2><?php echo date_format(date_create($videos['date']), "d-m-Y H:i") ?></php></h2>
                                    <form method="post">
                                        <input style="display: none" name="video_id" value="<?= $videos['id'] ?>">
                                        <div class="watch-btn-2">
                                            <button type="submit" name="watch_video">Смотреть</button>
                                        </div>
                                    </form>
                                    </span>
                                </div>
                                <?php
                            }
                        } else {
                            echo "<h1>Нет рекомендаций</h1>";
                        }
                        ?>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<h1>Нет загруженных видео</h1>";
        }
        ?>
    </div>
</section>
</body>
</html>
