<?php

require_once 'app/Mage.php';
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

umask(0);
Mage::app('default');

for ($i = 0; $i < 100; $i++) {
  $quote = Mage::getModel('sales/quote')
    ->setStoreId(Mage::app()->getStore('default')->getId());

  // The id inside load(##) below needs to be a product id from 
  // "Catalog" -> "Manage Products" in the admin UI of the store.
  // There is almost certainly a way to randomly pull a product 
  // using the Mage classes, but I kept running into errors trying 
  // that, so gave up on it.
  $product = Mage::getModel('catalog/product')->load(905);

  $buyInfo = array('qty' => 1);
  $quote->addProduct($product, new Varien_Object($buyInfo));
  // adding billing address
  $billingAddress = array(
    'firstname' => 'Jack',
    'lastname' => 'Ship',
    'company' => 'ShippingEasy',
    'email' =>  'jack@shipping.com',
    'street' => array(
      '609 Castle Ridge Rd',
      ''
    ),
    'city' => 'Austin',
    'region_id' => '57',
    'region' => 'state/province',
    'postcode' => '78746',
    'country_id' => 'US',
    'telephone' =>  '5125551234',
    'fax' => '',
    'customer_password' => '',
    'confirm_password' =>  '',
    'save_in_address_book' => '0',
    'use_for_shipping' => '1',
  );
  $quote->getBillingAddress()
    ->addData($billingAddress);

  //set shippingaddress, shipping method, payment method
  $quote->getShippingAddress()
    ->addData($billingAddress)
    ->setShippingMethod('flatrate_flatrate')
    ->setPaymentMethod('cashondelivery')
    ->setCollectShippingRates(true)
    ->collectTotals();

  $quote->setCheckoutMethod('guest')
    ->setCustomerId(null)
    ->setCustomerEmail($quote->getBillingAddress()->getEmail())
    ->setCustomerIsGuest(true)
    ->setCustomerGroupId(Mage_Customer_Model_Group::NOT_LOGGED_IN_ID);
  $quote->getPayment()->importData( array('method' => 'cashondelivery'));

  $quote->save();
  $service = Mage::getModel('sales/service_quote', $quote);
  $service->submitAll();
}
?>
