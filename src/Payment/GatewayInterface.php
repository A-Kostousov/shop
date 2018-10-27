<?php
namespace App\Payment;

use App\Entity\Order;
interface GatewayInterface
{
    public function getButton(Order $order): string;
    public function checkPayment(Order $order): int;

}