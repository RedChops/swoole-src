--TEST--
swoole_timer: enable_coroutine setting
--CONFLICTS--
all
--SKIPIF--
<?php require __DIR__ . '/../include/skipif.inc'; ?>
--FILE--
<?php declare(strict_types = 1);
require __DIR__ . '/../include/bootstrap.php';
swoole_async_set([
    'enable_coroutine' => false
]);
swoole_timer_after(1, function () {
    $uid = Co::getuid();
    echo "#{$uid}\n";
});
?>
--EXPECT--
#-1
