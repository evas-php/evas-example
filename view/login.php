<?php
/**
 * Login page example.
 * @author Egor Vasyakin <e.vasyakin@itevas.ru>
 * @since 14 Apr 2020
 */
use base\App;

$this->render('layouts/header.php', [
    'title' => 'Login',
    'pageId' => 'auth',
]);
?>

<form method="POST" class="authForm">
    <h1>Вход</h1>
    <input type="text" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Пароль" required>
    <button type="submit">Войти</button>
    <p>Нет аккаунта? <a href="<?= App::uri() ?>/registration">Регистрация</a></p>
    <p><a href="<?= App::uri() ?>">Вернуться на главную</p>
</form>

<?php
$this->render('layouts/footer.php');
