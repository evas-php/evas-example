<?php
/**
 * Header example.
 * @author Egor Vasyakin <e.vasyakin@itevas.ru>
 * @since 14 Apr 2020
 * 
 * @param string $title - заголовок страницы
 * @param string|null $pageId - id страницы для body
 * @param assoc|null $meta - мета-теги
 * @param array|string|null $style - стили
 * @param array|string|null $script - скрипты
 */
use base\App;

if (empty($pageId)) $pageId = 'default';
$pageId = 'page' . ucfirst($pageId);
if (empty($meta)) $meta = [];
if (empty($style)) $style = [];
else if (is_string($style)) $style = [$style];
if (empty($script)) $script = [];
else if (is_string($script)) $script = [$script];

array_unshift($style, App::uri() . '/css/common.css');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
<?php foreach ($meta as $name => &$content): ?>
    <meta name="<?= $name ?>" content="<?= $content ?>">
<?php endforeach; ?>
    <title><?= $title ?? null ?></title>
<?php foreach ($style as &$substyle): ?>
    <link rel="stylesheet" type="text/css" href="<?= $substyle ?>">
<?php endforeach; ?>
<?php foreach ($script as &$subscript): ?>
    <script type="text/javascript" src="<?= $subscript ?>"></script>
<?php endforeach; ?>
</head>
<body>

<header id="site-header">Header</header>

<main id="<?= $pageId ?>" class="site-page">
