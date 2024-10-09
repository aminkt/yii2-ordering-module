<?php
namespace aminkt\ordering\interfaces;

use yii\db\ActiveQueryInterface;

interface OrderInterface
{
    /** Order don't accepted by user and still in shopping cart */
    const STATUS_SHOP_CART = 1;
    /** Order accepted by user and waiting for sale-man confirmation */
    const STATUS_WAITING_FOR_CONFIRM = 2;
    /** User want to cancel order and order waiting for cancel process */
    const STATUS_WAITING_FOR_CANCEL = 3;
    /** Order cancelled and archived */
    const STATUS_CANCELLED = 4;
    /** Order confirmed by sale-man */
    const STATUS_CONFIRMED = 5;
    /** Order waiting for store processes like packing and ... */
    const STATUS_STORE_PROCESS = 6;
    /** Order processes are done and now waiting for sending processes */
    const STATUS_READY_TO_SEND = 7;
    /** Order send to user */
    const STATUS_SEND = 8;
    /** User don't receive order for and order returned to sale-man */
    const STATUS_RETURNED = 9;
    /** Order received by user and archived */
    const STATUS_RECEIVED = 10;

    /** Order paid by internet bank gates */
    const PAY_TYPE_INTERNET = 1;
    /** Order should pay by user when get order */
    const PAY_TYPE_IN_PLACE = 2;
    /** User pay order by bank fish same as card-to-card. */
    const PAY_TYPE_BANK_FISH = 3;

    /** Order don't paid yet */
    const PAY_STATUS_NOT_PAID = 1;
    /** Order paid successfully */
    const PAY_STATUS_PAID = 2;
    /** Order cost returned to user */
    const PAY_STATUS_RETURNED = 3;
    /** There is an error when user tried to pay by bank */
    const PAY_STATUS_BANK_ERROR = 4;


    /**
     * Use order id to get order.
     * @param $orderId integer
     * @return OrderInterface
     */
    public static function getOrder($orderId);

    /**
     * Use order tracking code to get order
     * @param string $trackingCode
     * @return OrderInterface
     */
    public static function getOrderByTrackingCode($trackingCode);


    /**
     * Return an active query of order model.
     * @return ActiveQueryInterface
     */
    public static function getOrderQuery();


    /**
     * Create and initial new order.
     * @param $customer CustomerProfileInterface
     * @param $note string
     * @return OrderInterface
     */
    public static function createNewOrder(CustomerProfileInterface $customer=null, int $botId = null, ?string $note=null): OrderInterface;

    /**
     * Return Customer
     * @return CustomerProfileInterface
     */
    public function getCustomer();

    /**
     * Return order items as array
     * @return OrderItemInterface[]
     */
    public function getItems();

    /**
     *
     * @param array $config Config data should be like this:
     *
     * [
     *
     *     'product'=>$product (productInterface),
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
     * Add one item to order items.
     * @return OrderItemInterface
     */
    public function addItem($config=[]);


    /**
     *
     * @param array $config Config data should be like this:
     * <code>
     * [
     *     'product'=>$product (productInterface),
     *     'qty'=>5 (optional. default is 1)
     * ]
     * //or be like this:
     * [
     *     'productId'=>5 (integer),
     *     'orderId'=>5 (integer),
     *     'qty'=>5 (optional. default is 1)
     * ]
     * </code>
     * Remove one item from order items.
     * @return OrderItemInterface
     */
    public function removeItem(array $config=[]): OrderItemInterface;



    /**
     * @return int
     */
    public function getId();

    /**
     * @return string
     */
    public function getTrackingCode();

    /**
     * @return int
     */
    public function getCustomerId();

    /**
     * @return string
     */
    public function getCustomerNote();

    /**
     * @return float
     */
    public function getTotalPrice();

    /**
     * @return string
     */
    public function getPostCode();

    /**
     * @param $postCode string
     * @return boolean
     */
    public function setPostCode($postCode);

    /**
     * @return float
     */
    public function getPostCost();

    /**
     * @return int
     */
    public function getSendTime();

    /**
     * @return int
     */
    public function getPayType();

    /**
     * Set payment type of order.
     * @param string $payType
     * @return void
     */
    public function setPayType($payType);

    /**
     * @return int
     */
    public function getPayStatus();

    /**
     * @return int
     */
    public function getStatus();

    /**
     * @return int
     */
    public function getChangeStatusTime();

    /**
     * @return int
     */
    public function getUpdateTime();

    /**
     * @return int
     */
    public function getCreateTime();

    /**
     * Change order status to new one.
     * @param $status
     * @return boolean
     */
    public function changeStatus($status);

}