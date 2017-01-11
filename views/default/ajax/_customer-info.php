<?php
/* @var $this yii\web\View */
/* @var $customer \ordering\interfaces\CustomerProfileInterface */
?>

<div class="row static-info">
    <div class="col-md-3 name"> نام مشتری: </div>
    <div class="col-md-9 value">
        <?= \yii\helpers\Html::encode($customer->getCustomerName())?>
        <?= \yii\helpers\Html::encode($customer->getCustomerFamily())?>
    </div>
</div>
<div class="row static-info">
    <div class="col-md-3 name"> ایمیل: </div>
    <div class="col-md-9 value"> <?= \yii\helpers\Html::encode($customer->getCustomerEmail())?> </div>
</div>
<div class="row static-info">
    <div class="col-md-3 name"> تلفن: </div>
    <div class="col-md-9 value"> <?= \yii\helpers\Html::encode($customer->getCustomerMobile())?> </div>
</div>
<div class="row static-info">
    <div class="col-md-3 name"> آدرس: </div>
    <div class="col-md-9 value"> <?= \yii\helpers\Html::encode($customer->getCustomerAddress())?> </div>
</div>