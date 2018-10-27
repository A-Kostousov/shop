<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 24.10.2018
 * Time: 19:30
 */

namespace App\Payment;

use App\Entity\Order;
class LiqPay implements GatewayInterface
{

    public function getButton(Order $order): string
    {
        // TODO: Implement getButton() method.
    }

    public function checkPayment(Order $order): int
    {
        // TODO: Implement checkPayment() method.
    }
}