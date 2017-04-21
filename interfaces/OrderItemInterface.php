<?php
namespace aminkt\ordering\interfaces;

/**
 *
 * Interface OrderItemInterface
 * @package ordering\interfaces
 * Define an interface for order items model in app to grantee some important data be available for ordering module.
 */
interface OrderItemInterface
{
    /** Item added normally to order by user */
    const STATUS_NORMAL = 1;
    /** Item removed from order by user */
    const STATUS_REMOVED = 2;
    /** Item cancelled from order by sale-man */
    const STATUS_CANCELLED = 3;
    /** Item expired from order */
    const STATUS_EXPIRED = 4;

    /**
     * Return Product
     * @return ProductInterface
     */
    public function getProduct();

    /**
     * Return Order
     * @return OrderInterface
     */
    public function getOrder();


    /**
     * @return int
     */
    public function getId();

    /**
     * @return int
     */
    public function getOrderId();

    /**
     * @return int
     */
    public function getProductId();

    /**
     * Return unit price
     * @return float
     */
    public function getPrice();

    /**
     * @return float
     */
    public function getDiscount();

    /**
     * @return int
     */
    public function getNumber();

    /**
     * Return total price
     * @return float
     */
    public function getTotalPrice();

    /**
     * @return int
     */
    public function getStatus();

    /**
     * @return int
     */
    public function getUpdateTime();

    /**
     * @return int
     */
    public function getCreateTime();

}