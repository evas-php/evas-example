<?php
/**
 * Home page example.
 * @author Egor Vasyakin <e.vasyakin@itevas.ru>
 * @since 14 Apr 2020
 */

$this->render('layouts/header.php', [
    'title' => 'The home page',
    'pageId' => 'home',
]);
?>

<h1>The home page</h1>

<?php
$this->render('layouts/footer.php');
