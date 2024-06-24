<div class="navigation">
    <nav>
        <ul>
            <li>
                <a href="index.php"><img class="img-icon" src="img/icon/nav/home.svg" alt="house"> Главная</a>
            </li>
            <?php if (isset($_SESSION['username'])) : ?>
                <li>
                    <a href="studio.php"><img class="img-icon" src="img/icon/nav/myvideo.svg">
                        <?php if ($_SESSION['username'] == 'admin') {
                            echo "Админ панель";
                        } else {
                            echo "Мои видео";
                        } ?></a>
                </li>
            <?php endif ?>
        </ul>
    </nav>
</div>
