<?php


/**
 * @author lin <465382251@qq.com>
 * 
 * Fill in your key and secret and pass can be directly run
 * 
 * Most of them are unfinished and need your help
 * https://github.com/zhouaini528/huobi-php.git
 * */
use Lin\Huobi\HuobiSpot;

require __DIR__ .'../../../vendor/autoload.php';

$huobi=new HuobiSpot();

//Get market data. This endpoint provides the snapshots of market data and can be used without verifications.
try {
    $result=$huobi->market()->getDepth([
        'symbol'=>'btcusdt',
        //'type'=>'step3'   default step0
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}

//List trading pairs and get the trading limit, price, and more information of different trading pairs.
try {
    $result=$huobi->market()->getTickers();
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}




