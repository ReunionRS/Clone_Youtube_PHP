<header>
    <div class="logo">
        <a href="index.php">
            <img src="img/icon/logo/logo.svg" alt="logo">
        </a>
        <p>RETube</p>
    </div>
    <div class="search-banner">
        <form>
            <input type="search" placeholder="Search...">
            <button type="submit">Search</button>
        </form>
    </div>
    <div class="icon-user">
        <?php if (isset($_SESSION['username'])) : ?>
        <img src="img/icon/settings/upload.svg" alt="upload" id="user-icon1">
        <div class="dark-bg" id="user-upload">
            <div class="upload">
            <a class="pointer exit" id="close-user-upload">←</a>
                <form method="post" enctype="multipart/form-data" class="content">
                    <label for="title">Название</label>
                    <input name="title" id="title" type="text" required>
                    <label for="description">Описание</label>
                    <textarea name="description" id="description" cols="30" rows="10"></textarea>
                    <label for="category">Категория</label>
                    <select name="category" id="category" required>
                        <option value="Gaming">Gaming</option>
                        <option value="Science">Science</option>
                        <option value="Music">Music</option>
                        <option value="Sport">Sport</option>
                        <option value="Movie">Movie</option>
                    </select>
                    <label for="video">Video</label>
	 	            <input type="file" name="video" class="file" id="file-uploader" accept="mp4, avi" required>
                    <label for="file">Preview</label>
                    <input type="file" name="preview" class="file" id="file-uploader" accept="png, jpeg" required>
                    <?php if (count($_SESSION['errors']) > 0 && isset($_POST['upload_video'])) : ?>
                        <div class="error">
                            <?php foreach ($_SESSION['errors'] as $error) : ?>
                                <p><?php echo $error ?></p>
                            <?php endforeach ?>
                        </div>
                    <?php endif ?>
	 	            <button type="submit" name="upload_video">Опубликовать</button>
                </form>
            </div>
        </div>
        <?php endif ?>

        <img src="img/icon/settings/user.svg" id="user-icon" alt="user">
        <div class="dark-bg" id="user-menu">
            <div class="auth">
                <a class="pointer exit" id="close-user-menu">←</a>
                <?php if (!isset($_SESSION['username']) && !isset($_SESSION['password'])) : ?>
                    <form class="content" id="login" method="post">
                        <div class="reg">
                            <h1>Войти</h1>
                            <h3>Введите логин и пароль</h3>
                            <h3>который указывали при регистрации</h3>
                        </div>
                        <label for="username">Логин</label>
                        <input name="username" type="text" id="username">
                        <label for="password">Пароль</label>
                        <input name="password" type="password" id="password">
                        <button type="submit" name="login">Войти</button>
                        <?php if (count($_SESSION['errors']) > 0 && isset($_POST['login'])) : ?>
                            <div class="error">
                                <?php foreach ($_SESSION['errors'] as $error) : ?>
                                    <p><?php echo $error ?></p>
                                <?php endforeach ?>
                            </div>
                        <?php endif ?>
                        <div class="ect">
                            <p>Нет аккаунта? <a class="pointer" id="close-login">Зарегистрируйтесь</a></p>
                        </div>
                    </form>
                    <form class="content" id="register" method="post">
                        <div class="reg">
                            <h1>Регистрация</h1>
                            <h3>Придумайте логин и пароль</h3>
                        </div>
                        <label for="email">E-mail</label>
                        <input name="email" id="email" type="email">
                        <label for="name">Логин</label>
                        <input id="name" name="username" type="text">
                        <label for="password_1">Пароль</label>
                        <input id="password_1" name="password_1" type="password">
                        <label for="password_2">Подтверждение пароля</label>
                        <input name="password_2" id="password_2" type="password">
                        <?php if (count($_SESSION['errors']) > 0 && isset($_POST['register'])) : ?>
                            <div class="error">
                                <?php foreach ($_SESSION['errors'] as $error) : ?>
                                    <p><?php echo $error ?></p>
                                <?php endforeach ?>
                            </div>
                        <?php endif ?>
                        <button type="submit" name="register">Зарегистрироваться</button>
                        <div class="ect">
                            <p>Есть аккаунт? <a class="pointer" id="close-register">Войдите</a></p>
                        </div>
                    </form>
                <?php endif ?>
                <?php if (isset($_SESSION['username']) && isset($_SESSION['password'])) : ?>
                    <div class="content">
                        <img src="img/icon/settings/user.svg">
                        <h1><?php echo $_SESSION['username'] ?></h1>
                        <form action="studio.php">
                            <button style="width: 100%" type="submit">Мои Видео</button>
                        </form>
                        <form method="post">
                            <button style="width: 100%" type="submit" name="logout">Выйти</button>
                        </form>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</header>
