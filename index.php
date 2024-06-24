<?php include('php/db.php') ?>
<?php include('php/server.php') ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>RETube - Главная</title>
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
    <div class="nav-and-prev-video">
        <?php include 'navigation.php'; ?>
        <div class="preview-videos">
            <?php
            $sql = "SELECT * FROM videos WHERE restriction='none' ORDER BY date DESC";
            if(isset($_SESSION['username'])){
                if($_SESSION['username'] == 'admin') {
                    $sql = "SELECT * FROM videos ORDER BY date DESC";
                }
            }

            $res = mysqli_query($db, $sql);

            if (mysqli_num_rows($res) > 0) {
                while ($video = mysqli_fetch_assoc($res)) {
                    ?>
                    <div class="video-card pointer">
                        <img src="<?= $video['preview_url'] ?>" alt="preview">
                        <h1><?= $video['title'] ?></h1>
                        <h2><?php echo date_format(date_create($video['date']), "d-m-Y H:i") ?></php></h2>
                        <form method="post">
                            <input style="display: none" name="video_id" value="<?= $video['id'] ?>">
                            <div class="watch-btn">
                                <button type="submit" name="watch_video">Смотреть</button>
                            </div>
                        </form>
                    </div>
                    <?php
                }
            } else {
                echo "<h1>No Content</h1>";
            }
            ?>
        </div>
    </div>
</section>
</body>
</html>
