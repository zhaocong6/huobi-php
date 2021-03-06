### It is recommended that you read the official document first

Huobi docs [https://github.com/huobiapi/API_Docs_en/wiki/REST_Reference](https://github.com/huobiapi/API_Docs_en/wiki/REST_Reference)

All interface methods are initialized the same as those provided by huobi. See details [src/api](https://github.com/zhouaini528/huobi-php/tree/master/src/Api)

Many interfaces are not yet complete, and users can continue to extend them based on my design. Welcome to improve it with me

[中文文档](https://github.com/zhouaini528/huobi-php/blob/master/README_CN.md)

### Other exchanges API

[Bitmex](https://github.com/zhouaini528/bitmex-php)

[Okex](https://github.com/zhouaini528/okex-php)

[Huobi](https://github.com/zhouaini528/huobi-php)

[Binance](https://github.com/zhouaini528/binance-php)

[Exchanges](https://github.com/zhouaini528/exchanges-php) All integration

#### Installation
```
composer require "linwj/huobi dev-master"
```

### Spot Trading API

Market related API [More](https://github.com/zhouaini528/huobi-php/blob/master/tests/spot/market.php)

```php
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
```

Order related API [More](https://github.com/zhouaini528/huobi-php/blob/master/tests/spot/order.php)

```php
$huobi=new HuobiSpot($key,$secret);

//Place an Order
try {
    $result=$huobi->order()->postPlace([
        'account-id'=>$account_id,
        'symbol'=>'btcusdt',
        'type'=>'buy-limit',
        'amount'=>'0.001',
        'price'=>'100',
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}
sleep(1);

//Get order details by order ID.
try {
    $result=$huobi->order()->get([
        'order-id'=>$result['data'],
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}
sleep(1);

//Cancelling an unfilled order.
try {
    $result=$huobi->order()->postSubmitCancel([
        'order-id'=>$result['data']['id'],
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}
```

Accounts related API [More](https://github.com/zhouaini528/huobi-php/blob/master/tests/spot/account.php)

```php
$huobi=new HuobiSpot($key,$secret);

//get the status of an account
try {
    $result=$huobi->account()->get();
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}

//Get the balance of an account
try {
    $result=$huobi->account()->getBalance([
        'account-id'=>$result['data'][0]['id']
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}

```

[More use cases](https://github.com/zhouaini528/huobi-php/tree/master/tests/spot)

[More API](https://github.com/zhouaini528/huobi-php/tree/master/src/Api/Spot)

### Futures Trading API

Contract related API [More](https://github.com/zhouaini528/huobi-php/blob/master/tests/future/contract.php)

```php
$huobi=new HuobiFuture($key,$secret);

//Place an Order
try {
    $result=$huobi->contract()->postOrder([
        'symbol'=>'BTC',//string    false   "BTC","ETH"...
        'contract_type'=>'quarter',//   string  false   Contract Type ("this_week": "next_week": "quarter":)
        'contract_code'=>'BTC190628',// string  false   BTC180914
        'price'=>'100',//   decimal true    Price
        'volume'=>'1',//    long    true    Numbers of orders (amount)
        'direction'=>'buy',//   string  true    Transaction direction
        'offset'=>'open',// string  true    "open", "close"
        //'client_order_id'=>'',//long  false   Clients fill and maintain themselves, and this time must be greater than last time
        //lever_rate    int true    Leverage rate [if“Open”is multiple orders in 10 rate, there will be not multiple orders in 20 rate
        //order_price_type   string true    "limit", "opponent"
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}

//Get Information of an Order
try {
    $result=$huobi->contract()->postOrderInfo([
        'order_id'=>'xxxx',//You can also 'xxxx,xxxx,xxxx' multiple ID
        //'client_order_id'=>'xxxx',
        'symbol'=>'BTC'
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}

//Cancel an Order
try {
    $result=$huobi->contract()->postCancel([
        'order_id'=>'xxxx',//You can also 'xxxx,xxxx,xxxx' multiple ID
        //'client_order_id'=>'xxxx',
        'symbol'=>'BTC'
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}



//User`s position Information
try {
    $result=$huobi->contract()->postPositionInfo();
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}

//User`s Account Information
try {
    $result=$huobi->contract()->postAccountInfo();
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}

//Get Contracts Information
try {
    $result=$huobi->contract()->getContractInfo();
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}
```

Market related API [More](https://github.com/zhouaini528/huobi-php/blob/master/tests/future/market.php)

```php
$huobi=new HuobiFuture();

//The Last Trade of a Contract
try {
    $result=$huobi->market()->getTrade([
        'symbol'=>'BTC_CQ'
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}

//Request a Batch of Trade Records of a Contract
try {
    $result=$huobi->market()->getHistoryTrade([
        'symbol'=>'BTC_CQ',
        //'size'=>100
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}

//Get Market Depth
try {
    $result=$huobi->market()->getDepth([
        'symbol'=>'BTC_CQ',
        'type'=>'step1'
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}
```

[More use cases](https://github.com/zhouaini528/huobi-php/tree/master/tests/future)

[More API](https://github.com/zhouaini528/huobi-php/tree/master/src/Api/Futures)
