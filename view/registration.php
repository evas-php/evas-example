<?php
/**
 * Login page example.
 * @author Egor Vasyakin <e.vasyakin@itevas.ru>
 * @since 14 Apr 2020
 */
use base\App;

$this->render('layouts/header.php', [
    'title' => 'Registration',
    'pageId' => 'auth',
]);
?>

<form method="POST" class="authForm">
    <h1>Регистрация</h1>
    <input type="text" name="first_name" placeholder="Имя" required>
    <input type="text" name="last_name" placeholder="Фамилия" required>
    <input type="text" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Пароль" required>
    <input type="password" name="password_repeat" placeholder="Повторите пароль" required>
    <button type="submit">Зарегистрироваться</button>
    <p>Уже есть аккаунт? <a href="<?= App::uri() ?>/login">Вход</a></p>
    <p><a href="<?= App::uri() ?>">Вернуться на главную</p>
</form>

<?php
$this->render('layouts/footer.php');
