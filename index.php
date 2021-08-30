<?php
require 'vendor/autoload.php';
use RetailCrm\Api\Interfaces\ClientExceptionInterface;
use RetailCrm\Api\Enum\CountryCodeIso3166;
use RetailCrm\Api\Enum\Customers\CustomerType;
use RetailCrm\Api\Factory\SimpleClientFactory;
use RetailCrm\Api\Interfaces\ApiExceptionInterface;
use RetailCrm\Api\Model\Entity\Orders\Delivery\OrderDeliveryAddress;
use RetailCrm\Api\Model\Entity\Orders\Delivery\SerializedOrderDelivery;
use RetailCrm\Api\Model\Entity\Orders\Items\Offer;
use RetailCrm\Api\Model\Entity\Orders\Items\OrderProduct;
use RetailCrm\Api\Model\Entity\Orders\Items\PriceType;
use RetailCrm\Api\Model\Entity\Orders\Items\Unit;
use RetailCrm\Api\Model\Entity\Orders\Order;
use RetailCrm\Api\Model\Entity\Orders\Payment;
use RetailCrm\Api\Model\Entity\Orders\SerializedRelationCustomer;
use RetailCrm\Api\Model\Request\Orders\OrdersCreateRequest;

$client = SimpleClientFactory::createClient('https://superposuda.retailcrm.ru', 'QlnRWTTWw9lv3kjxy1A8byjUmBQedYqb');

$request         = new OrdersCreateRequest();
$order           = new Order();
//$payment         = new Payment();
//$delivery        = new SerializedOrderDelivery();
//$deliveryAddress = new OrderDeliveryAddress();
$offer           = new Offer();
$item            = new OrderProduct();

/*$payment->type   = 'bank-card';
$payment->status = 'paid';
$payment->amount = 1000;
$payment->paidAt = new DateTime();

$deliveryAddress->index      = '344001';
$deliveryAddress->countryIso = CountryCodeIso3166::RUSSIAN_FEDERATION;
$deliveryAddress->region     = 'Region';
$deliveryAddress->city       = 'City';
$deliveryAddress->street     = 'Street';
$deliveryAddress->building   = '10';

$delivery->address = $deliveryAddress;
$delivery->cost    = 0;
$delivery->netCost = 0;*/

$offer->name        = 'Маникюрный набор';
$offer->displayName = 'Offer №1445123';
$offer->xmlId       = 'tGunLo27jlPGmbA8BrHxY2';
$offer->article     = 'AZ105R';
$offer->unit        = new Unit('796', 'Piece', 'pcs');

$item->offer         = $offer;
//$item->priceType     = new PriceType('base');
$item->quantity      = 1;
//$item->purchasePrice = 60;

//$order->delivery      = $delivery;
$order->company->brand='Azalita';
$order->items         = [$item];
//$order->payments      = [$payment];
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
/*$order->managerId     = 28;
$order->customer      = SerializedRelationCustomer::withIdAndType(
    4924,
    CustomerType::CUSTOMER
);*/
$order->status        = 'trouble';
$order->number        = '5111999';
$order->weight        = 1000;
//$order->shipmentStore = 'main12';
//$order->shipmentDate  = (new DateTime())->add(new DateInterval('P7D'));
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
