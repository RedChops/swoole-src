--TEST--
swoole_timer: enable_coroutine setting
--CONFLICTS--
all
--SKIPIF--
<?php require __DIR__ . '/../include/skipif.inc'; ?>
--FILE--
<?php declare(strict_types = 1);
require __DIR__ . '/../include/bootstrap.php';
Swoole\Timer::set([
    'enable_coroutine' => false
]);
Swoole\Timer::after(1, function () {
    $uid = Co::getuid();
    echo "#{$uid}\n";
    Swoole\Timer::set([
        'enable_coroutine' => true
    ]);
    Swoole\Timer::after(1, function () {
        $uid = Co::getuid();
        echo "#{$uid}\n";
    });
});
?>
--EXPECT--
#-1
#1
