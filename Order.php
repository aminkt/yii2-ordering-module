<?php

namespace ordering;
use ordering\interfaces\CustomerProfileInterface;
use ordering\interfaces\OrderInterface;
use ordering\interfaces\OrderItemInterface;
use ordering\interfaces\ProductInterface;

/**
 * ordering module definition class
 */
class Order extends \yii\base\Module
{
    /** @var  OrderInterface $orderModelName */
    public $orderModelName;
    /** @var  OrderItemInterface $orderItemModelName */
    public $orderItemModelName;
    /** @var  CustomerProfileInterface $customerProfileModelName */
    public $customerProfileModelName;
    /** @var  ProductInterface $productModelName */
    public $productModelName;


    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'ordering\controllers';

}
