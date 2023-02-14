<?php


namespace Clearpay;


class Order
{
   public $orderReference;
   public $grossTotal;
   public $netTotal;
   public $orderExtras = array();
   public $currency;
   public $type;
   public $additionalDetails;
   public $orderItems = array();
   public $orderMeta =  array();
}
