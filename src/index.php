<?php


$loader = require_once __DIR__ . '/../vendor/autoload.php';


$container  = \ServiceBuilder\ServiceBuilder::load(['redis','twig','doctrine']);
$container1 = \ServiceBuilder\ServiceBuilder::load(['redis','twig','doctrine']);
$container2 = \ServiceBuilder\ServiceBuilder::load(['redis','twig','doctrine']);

echo $container->time . PHP_EOL . $container1->time . PHP_EOL . $container2->time . PHP_EOL ;

$redis      = $container->redis;
$twig       = $container->twig;
$conn       = $container->doctrine;

/*$redis = \ServiceBuilder\Services\Redis::getInstance();*/

$key = 'test';
foreach (['t1','t2','t3','t4'] as $i )
    $redis->sadd($key,$i);

var_dump($redis->sismember($key,'t1'));
var_dump($redis->sismember($key,'t111'));

var_dump($redis->smembers($key));
$redis->quit();



//$twig = ServiceBuilder\Services\Twig::getInstance();
echo $twig->render('index.twig',['name'=>'Anderson']);


//$conn = ServiceBuilder\Services\Doctrine::getInstance();

$sql = "SELECT * FROM test";
$stmt = $conn->query($sql);

while ($row = $stmt->fetch()) {
    echo PHP_EOL. $row['t'];
}