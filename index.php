<?php
// print_r($_SERVER);
require_once '/var/www/html/ycweng/MasterProject/phplib/SlimFork/v1/SlimFork.class.php';
use SlimFork\SlimFork as Slim;
$app = new Slim;
// echo PHP_EOL."hi".PHP_EOL;
// shorten url apply page
// require_once './shortenurl.php';
require_once('./shortenurl.php');

$app->get('/ycw/test/:id', function($id){
    echo "walawala".$id.PHP_EOL;
    print_r($_SERVER[HTTP_USER_AGENT]);
});
$app->post('/ycw/', array('shortenurl','createShortUrl'));
// $app->post('/ycw/', function(){
//     require_once './RedisConn.php';
//     $r = RedisConn::getInstance()->exec();
//     $strInput = file_get_contents('php://input',true);
//     $arrUserData = json_decode($strInput,true);
//     header('Content-Type: application/json');
//     if($arrUserData['aka']){
//         $redisresponse = $r->hSetNx('shorturl', $arrUserData['aka'], $arrUserData['url']);
//         if($redisresponse==false){
//             header("Debug: already exist");
//         }else{
//             http_response_code(201);
//         }
//     }else{
//         $strShortenName = base_convert($r->hLen('shorturl'), 10, 36);
//         $redisresponse = $r->hSetNx('shorturl', $strShortenName, $arrUserData['url']);
//         header("Debug: http://localhost/ycw/$strShortenNamee");
//         echo "http://localhost/ycw/$strShortenName";
//         http_response_code(201);
//     }
// });
// redirect
$app->get('/bot/:id',array('shortenurl','getLocationM'));
$app->get('/ycw/:id', array('shortenurl','getLocation'));
// $app->get('/ycw/:id', function(){
//     $args = func_get_args();
//     // echo $args[0];
//     require_once './RedisConn.php';
//     $r = RedisConn::getInstance()->exec();
//     $relocation= $r->hget('shorturl', $args[0]);
//     // echo $relocation;
//     // var_dump($relocation);
    
//     if($relocation){
//         header("Location: https://$relocation/");
//         header("Debug: $relocation");
//     }else{
//         http_response_code(404);
//         header("Debug: $relocation");
//     }

// });

$app->get('/ycw/admin/', function(){
    require_once './RedisConn.php';
    $r = RedisConn::getInstance()->exec();
    var_dump($r->hget('shorturl', 'ruten'));
});



$app->run();
// var_dump($app);
?>
