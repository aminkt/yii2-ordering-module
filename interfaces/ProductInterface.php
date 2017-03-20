<?php
namespace aminkt\ordering\interfaces;

/**
 * Interface ProductInterface
 * @package ordering\interfaces
 *
 * Define an interface for product model in app to grantee some important data be available for ordering module.
 */
interface ProductInterface
{
    /**
     * Return product id
     * @return integer
     */
    public function getId();

    /**
     * Return product code.
     * @return string
     */
    public function getCode();
    /**
     * Return product name
     * @return string
     */
    public function getName();

    /**
     * Return main picture address.
     * @return string
     */
    public function getMainPicture();

    /**
     * Return product price
     * @return double
     */
    public function getPrice();

    /**
     * Return product discount
     * @return double
     */
    public function getDiscount();

    /**
     * Increment order num counter.
     * @return void
     */
    public function incrementOrderNum();

    /**
     * Increment visit num counter.
     * @return void
     */
    public function incrementVisitNum();

}