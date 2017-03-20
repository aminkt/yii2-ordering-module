<?php
namespace aminkt\ordering\interfaces;

/**
 * Interface CustomerProfileInterface
 * @package ordering\interfaces
 *
 * Define an interface to grantee that Customer profile model prepare some important data for ordering module.
 */
interface CustomerProfileInterface
{

    /**
     * Return customer profile model by id.
     * @param $customerId
     * @return CustomerProfileInterface
     */
    public static function getCustomer($customerId);

    /**
     * Return customer profile id
     * @return integer
     */
    public function getId();

    /**
     * Return customer profile name
     * @return string
     */
    public function getCustomerName();

    /**
     * Return customer profile family
     * @return string
     */
    public function getCustomerFamily();

    /**
     * Return customer profile mobile
     * @return string
     */
    public function getCustomerMobile();

    /**
     * Return email address of customer
     * @return string
     */
    public function getCustomerEmail();

    /**
     * Return customer profile address
     * @return string
     */
    public function getCustomerAddress();

}