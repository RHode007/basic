<?php
require 'vendor/autoload.php';
use RetailCrm\Api\Interfaces\ClientExceptionInterface;
use RetailCrm\Api\Enum\CountryCodeIso3166;
use RetailCrm\Api\Factory\SimpleClientFactory;
use RetailCrm\Api\Interfaces\ApiExceptionInterface;
use RetailCrm\Api\Model\Entity\Orders\Items\Offer;
use RetailCrm\Api\Model\Entity\Orders\Items\OrderProduct;
use RetailCrm\Api\Model\Entity\Orders\Items\Unit;
use RetailCrm\Api\Model\Entity\Orders\Order;
use RetailCrm\Api\Model\Request\Orders\OrdersCreateRequest;

$client = SimpleClientFactory::createClient('https://superposuda.retailcrm.ru', 'QlnRWTTWw9lv3kjxy1A8byjUmBQedYqb');

$request         = new OrdersCreateRequest();
$order           = new Order();
$offer           = new Offer();
$item            = new OrderProduct();


$offer->name        = 'Маникюрный набор';
$offer->displayName = 'Offer №1445123';
$offer->xmlId       = 'tGunLo27jlPGmbA8BrHxY2';
$offer->article     = 'AZ105R';
$offer->unit        = new Unit('796', 'Piece', 'pcs');

$item->offer         = $offer;
$item->quantity      = 1;

$order->company->brand='Azalita';
$order->items         = [$item];
$order->orderType     = 'fizik';
$order->orderMethod   = 'test';
$order->countryIso    = CountryCodeIso3166::RUSSIAN_FEDERATION;
$order->firstName     = 'Ruslan';
$order->lastName      = 'Vengerenko';
$order->patronymic    = 'Alexandrovic';
$order->phone         = '89003005069';
$order->customerComment = 'тестовое задание';
$order->managerComment = 'https://github.com/RHode007/basic/blob/f3a66a222a815903a8976387aa154049ae477261/index.php';
$order->email         = 'testuser12345678901@example.com';

$order->status        = 'trouble';
$order->number        = '5111999';
$order->weight        = 1000;

$order->shipped       = false;
$order->customFields  = [
    "galka" => false,
    "test_number" => 0,
    "otpravit_dozakaz" => false,
];

$request->order = $order;
$request->site  = 'test';

try {
    $response = $client->orders->create($request);
    $client->api->apiVersions();
} catch (ApiExceptionInterface | ClientExceptionInterface $exception) {
    echo $exception; // Every ApiExceptionInterface instance should implement __toString() method.
    exit(-1);
}

printf(
    'Created order id = %d with the following data: %s',
    $response->id,
    print_r($response->order, true)
);
