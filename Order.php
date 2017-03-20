<?php

namespace aminkt\ordering;
use aminkt\ordering\interfaces\CustomerProfileInterface;
use aminkt\ordering\interfaces\OrderInterface;
use aminkt\ordering\interfaces\OrderItemInterface;
use aminkt\ordering\interfaces\ProductInterface;

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
    public $controllerNamespace = 'aminkt\ordering\controllers';

}
