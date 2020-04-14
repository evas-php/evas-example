<?php
/**
 * Header example.
 * @author Egor Vasyakin <e.vasyakin@itevas.ru>
 * @since 14 Apr 2020
 * 
 * @param array|string|null $script - скрипты
 */

if (empty($script)) $script = [];
else if (is_string($script)) $script = [$script];
?>
</main>

<footer id="site-footer">Footer</footer>

<?php foreach ($script as &$subscript): ?>
<script type="text/javascript" src="<?= $subscript ?>"></script>
<?php endforeach; ?>
</body>
</html>
