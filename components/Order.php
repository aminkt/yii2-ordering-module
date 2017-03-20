<?php
namespace aminkt\ordering\components;

use aminkt\ordering\interfaces\OrderInterface;
use aminkt\ordering\interfaces\OrderItemInterface;
use yii\base\Component;

class Order extends Component{
    /** @var  OrderInterface $orderModel */
    public $orderModel;
    /** @var  OrderItemInterface $orderItemModel */
    public $orderItemModel;


    /**
     * @param array $config Config data should be like this:
     *
     * [
     *
     *     'product'=>$product (productInterface),
     *
     *      'customer'=>$customer (CustomerProfileInterface => for first adding)
     *
     *      'customerNote'=>note (CustomerProfileInterface => for first adding)
     *
     *     'orderId'=>5 (integer),
     *
     *     'qty'=>5 (optional. default is 1)
     *
     * ]
     *
     * or be like this:
     *
     * [
     *
     *     'productId'=>5 (integer),
     *
     *     'customer'=>$customer (CustomerProfileInterface for first adding)
     *
     *     'customerNote'=>note (CustomerProfileInterface for first adding)
     *
     *     'orderId'=>5 (integer),
     *
     *     'qty'=>5 (optional. default is 1)
     *
     * ]
     * @return OrderItemInterface
     */
    public function addItem($config=[]){
        $orderModel = $this->orderModel;
        /** @var OrderInterface $order */

        if(isset($config['orderId'])){
            $orderId = $config['orderId'];
            $order = $orderModel::getOrder($orderId);
        }
        else
            $order = null;

        if(!$order){
            if(isset($config['customer'])){
                if(isset($config['customerNote']))
                    $order = $orderModel::createNewOrder($config['customer'], $config['customerNote']);
                else
                    $order = $orderModel::createNewOrder($config['customer']);
            }else
                $order = $orderModel::createNewOrder();
        }

        return $order->addItem($config);
    }


    /**
     *
     * @param array $config Config data should be like this:
     *
     * [
     *
     *     'product'=>$product (productInterface),
     *
     *    'orderId'=>5 (integer),
     *
     *     'qty'=>5 (optional. default is 1)
     *
     * ]
     *
     * or be like this:
     *
     * [
     *
     *     'productId'=>5 (integer),
     *
     *     'orderId'=>5 (integer),
     *
     *     'qty'=>5 (optional. default is 1)
     *
     * ]
     * Remove one item from order items.
     * @return OrderItemInterface
     */
    public function removeItem($config=[]){
        $orderModel = $this->orderModel;
        /** @var OrderInterface $order */

        if(isset($config['orderId'])){
            $orderId = $config['orderId'];
            $order = $orderModel::getOrder($orderId);
        }
        else
            return null;

        return $order->removeItem($config);
    }

    /**
     * Change current order status to new order status.
     * @param $orderId integer
     * @param $newStatus integer
     * @return boolean
     */
    public function changeOrderStatus($orderId, $newStatus){
        $orderModel = $this->orderModel;
        $order = $orderModel::getOrder($orderId);
        if($orderModel){
            return $order->changeStatus($newStatus);
        }
        return false;
    }
}