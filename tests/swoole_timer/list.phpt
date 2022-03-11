--TEST--
swoole_timer: list
--CONFLICTS--
all
--SKIPIF--
<?php require __DIR__ . '/../include/skipif.inc'; ?>
--FILE--
<?php declare(strict_types = 1);
require __DIR__ . '/../include/bootstrap.php';
$timers = [];
for ($c = MAX_CONCURRENCY; $c--;) {
    $timers[] = Swoole\Timer::after(mt_rand(1, 100), function () { });
}
$iterator = Swoole\Timer::list();
Assert::isInstanceOf($iterator, ArrayIterator::class);
$timers_2 = iterator_to_array($iterator);
sort($timers_2);
sort($timers);
Assert::same($timers_2, $timers);
Swoole\Event::wait();
echo "DONE\n";
?>
--EXPECT--
DONE
