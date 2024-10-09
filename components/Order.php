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
     * Return order model directly.
     * @param string $orderId
     *
     * @return OrderInterface
     */
    public function getOrder($orderId){
        $orderModel = $this->orderModel;
        return $orderModel::getOrder($orderId);
    }

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

        $botId = $config['botId'] ?? throw new \InvalidArgumentException("botId is not exist in bot config.");
        $order = ($orderId = $config['orderId'] ?? null) ? $orderModel::getOrder($orderId) : null;

        if(!$order){
            $customerNote = $config['customerNote'] ?? null;
            $customer = $config['customer'] ?? null;

            if ($customer && $customerNote) {
                $order = $orderModel::createNewOrder($customer, $botId, $customerNote);
            } else if ($customer) {
                $order = $orderModel::createNewOrder($customer, $botId);
            } else {
                throw new \RuntimeException("Can not create order, Customer dose not exist..");
            }
        }

        return $order->addItem($config);
    }


    /**
     *
     * @param array $config Config data should be like this:
     * <code>
     * [
     *    'product'=>$product (productInterface),
     *    'orderId'=>5 (integer),
     *    'qty'=>5 (optional. default is 1)
     * ]
     * // or be like this:
     * [
     *     'productId'=>5 (integer),
     *     'orderId'=>5 (integer),
     *     'qty'=>5 (optional. default is 1)
     * ]
     *  </code>
     *
     * Remove one item from order items.
     * @return OrderItemInterface
     */
    public function removeItem(array $config=[]){
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