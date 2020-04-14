<?php
/**
 * 404 page example.
 * @author Egor Vasyakin <e.vasyakin@itevas.ru>
 * @since 14 Apr 2020
 */

$this->response->withStatusCode(404)->applyHeaders();

$this->render('layouts/header.php', [
    'title' => '404. Not Found',
    'pageId' => '404',
    'meta' => ['robots' => 'noindex, nofollow'],
]);
?>

<h1>404. Not Found.</h1>
<p>The custom 404 page.</p>

<?php
$this->render('layouts/footer.php');
