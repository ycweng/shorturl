<?php
// print_r($_SERVER[SCRIPT_FILENAME]);

class shortenurl{
    public static function getLocation($id){
        // print_r($_SERVER);
        $args = func_get_args();
        // echo $args[0];
        require_once './RedisConn.php';
        $r = RedisConn::getInstance()->exec();
        $relocation= $r->hget('shorturl', $id);
        // echo $relocation;
        // var_dump($relocation);
        
        if($relocation){
            header("Location: https://$relocation/");
            header("Debug: $relocation");
        }else{
            http_response_code(404);
            header("Debug: $relocation");
        }
    }
    public static function getLocationM($id){
        echo "Mobile".$id.PHP_EOL;
    }
    public static function createShortUrl(){
        require_once './RedisConn.php';
        $r = RedisConn::getInstance()->exec();
        $strInput = file_get_contents('php://input',true);
        if($strInput==NULL){
            return (http_response_code(400));
        }
        $arrUserData = json_decode($strInput,true);
        header('Content-Type: application/json');
        if($arrUserData['aka']){
            $redisresponse = $r->hSetNx('shorturl', $arrUserData['aka'], $arrUserData['url']);
            if($redisresponse==false){
                header("Debug: already exist");
            }else{
                http_response_code(201);
            }
        }else{
            $strShortenName = base_convert($r->hLen('shorturl'), 10, 36);
            print_r($strShortenName);
            $redisresponse = $r->hSetNx('shorturl', $strShortenName, $arrUserData['url']);
            header("Debug: http://localhost/ycw/$strShortenNamee");
            echo "http://localhost/ycw/$strShortenName";
            http_response_code(201);
        }
    }
}
?>