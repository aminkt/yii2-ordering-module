<?php
/* @var $this yii\web\View */
/* @var $order \ordering\interfaces\OrderInterface */
/* @var $page string */

$items = $order->getItems();
$orderTotalPrice = $order->getTotalPrice()+$order->getPostCost();
?>

<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="portlet grey-cascade box">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>محتویات سفارش </div>
                <div class="actions">
                    <?= $this->render('_view-btns',[
                        'order'=>$order,
                        'page'=>$page,
                    ]) ?>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                        <tr>
                            <th> # </th>
                            <th> کد </th>
                            <th> محصول </th>
<!--                            <th> وضعیت انبار </th>-->
                            <th> قیمت </th>
                            <th> تخفیف </th>
                            <th> تعداد </th>
                            <th> مبلغ کل </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i=1;
                        foreach ($items as $item):
                            $product = $item->getProduct();
                        ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td> <?= $product->getCode() ?></td>
                            <td>
                                <a href="javascript:;"> <?= $product->getName() ?> </a>
                            </td>
<!--                            <td>-->
<!--                                <span class="label label-sm label-success"> Available </span>-->
<!--                            </td>-->
                            <td> <?= number_format($item->getPrice()) ?> تومان</td>
                            <td> <?= number_format($item->getDiscount()) ?> تومان</td>
                            <td> <?= $item->getNumber() ?> </td>
                            <td> <?= number_format($item->getTotalPrice()) ?> تومان</td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="portlet yellow-crusta box">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>جزئیات سفارش </div>
                <div class="actions">
<!--                    <a href="javascript:;" class="btn btn-default btn-sm">-->
<!--                        <i class="fa fa-pencil"></i> Edit </a>-->
                </div>
            </div>
            <div class="portlet-body">
                <div class="row static-info">
                    <div class="col-md-5 name"> کد پیگیری: </div>
                    <div class="col-md-7 value"> <?= \yii\helpers\Html::encode($order->getTrackingCode()) ?>
<!--                        <span class="label label-info label-sm"> ایمیل تائید ارسال شد </span>-->
                    </div>
                </div>
                <div class="row static-info">
                    <div class="col-md-5 name"> زمان ثبت سفارش: </div>
                    <div class="col-md-7 value"> <?= \yii\helpers\Html::encode($order->getCreateTime()) ?> </div>
                </div>
                <div class="row static-info">
                    <div class="col-md-5 name"> وضعیت سفارش: </div>
                    <div class="col-md-7 value">
                        <?php if($order->getStatus() == $order::STATUS_SHOP_CART) : ?>
                            <span class="label label-warning"> موجود در سبد خرید </span>
                        <?php elseif($order->getStatus() == $order::STATUS_WAITING_FOR_CONFIRM) : ?>
                            <span class="label label-warning"> در انتظار تائید </span>
                        <?php elseif($order->getStatus() == $order::STATUS_WAITING_FOR_CANCEL) : ?>
                            <span class="label label-warning"> در انتظار لغو </span>
                        <?php elseif($order->getStatus() == $order::STATUS_CANCELLED) : ?>
                            <span class="label label-danger"> لغو شده </span>
                        <?php elseif($order->getStatus() == $order::STATUS_CONFIRMED) : ?>
                            <span class="label label-success"> تائید شده </span>
                        <?php elseif($order->getStatus() == $order::STATUS_STORE_PROCESS) : ?>
                            <span class="label label-info"> پردازش انبار </span>
                        <?php elseif($order->getStatus() == $order::STATUS_READY_TO_SEND) : ?>
                            <span class="label label-warning"> آماده ارسال </span>
                        <?php elseif($order->getStatus() == $order::STATUS_SEND) : ?>
                            <span class="label label-success"> ارسال شده  </span>
                        <?php elseif($order->getStatus() == $order::STATUS_RETURNED) : ?>
                            <span class="label label-danger"> برگشت داده شده </span>
                        <?php elseif($order->getStatus() == $order::STATUS_RECEIVED) : ?>
                            <span class="label label-success"> دریافت شده </span>
                        <?php else : ?>
                            <span class="label label-warning"> مشخص نشده </span>
                        <?php endif; ?>
                        <?php if($postCode = $order->getPostCode()) : ?>
                            &nbsp;&nbsp;<span class="label label-info label-sm">کد پستی:  <?= $postCode ?> </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row static-info">
                    <div class="col-md-5 name"> مبلغ کل سفارش: </div>
                    <div class="col-md-7 value"> <?= number_format($orderTotalPrice) ?> تومان </div>
                </div>
                <div class="row static-info">
                    <div class="col-md-5 name"> نوع پرداخت: </div>
                    <div class="col-md-7 value">
                        <?php if($order->getPayType() == $order::PAY_TYPE_INTERNET): ?>
                            اینترنتی
                        <?php elseif($order->getPayType() == $order::PAY_TYPE_BANK_FISH): ?>
                            فیش بانکی
                        <?php elseif($order->getPayType() == $order::PAY_TYPE_IN_PLACE): ?>
                            پرداخت در محل
                        <?php else: ?>
                            مشخص نشده
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="well">
            <div class="row static-info align-reverse">
                <div class="col-md-8 name"> جمع کل: </div>
                <div class="col-md-3 value"> <?= number_format($order->getTotalPrice()) ?> تومان </div>
            </div>
            <div class="row static-info align-reverse">
                <div class="col-md-8 name"> تخفیف: </div>
                <div class="col-md-3 value"> 0  تومان</div>
            </div>
            <div class="row static-info align-reverse">
                <div class="col-md-8 name"> هزینه ارسال: </div>
                <div class="col-md-3 value"> <?= number_format($order->getPostCost()) ?> تومان </div>
            </div>
            <div class="row static-info align-reverse">
                <div class="col-md-8 name"> مالیات: </div>
                <div class="col-md-3 value"> 0  تومان</div>
            </div>
            <div class="row static-info align-reverse">
                <div class="col-md-8 name"> سود شرکت: </div>
                <div class="col-md-3 value"> 0  تومان</div>
            </div>
            <div class="row static-info align-reverse">
                <div class="col-md-8 name"> مبلغ نهایی: </div>
                <div class="col-md-3 value"> <?= number_format($orderTotalPrice) ?> تومان </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="portlet blue-hoki box">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>اطلاعات خریدار </div>
                <div class="actions">
<!--                    <a href="javascript:;" class="btn btn-default btn-sm">-->
<!--                        <i class="fa fa-pencil"></i> ویرایش </a>-->
                </div>
            </div>
            <div class="portlet-body">
                <?php if($order->getCustomer()) : ?>
                <div class="row static-info">
                    <div class="col-md-3 name"> نام مشتری: </div>
                    <div class="col-md-9 value">
                        <?= \yii\helpers\Html::encode($order->getCustomer()->getCustomerName()) ?>
                        <?= \yii\helpers\Html::encode($order->getCustomer()->getCustomerFamily()) ?>
                </div>
                </div>
                <div class="row static-info">
                    <div class="col-md-3 name"> ایمیل: </div>
                    <div class="col-md-9 value"> <?= \yii\helpers\Html::encode($order->getCustomer()->getCustomerEmail()) ?> </div>
                </div>
                <div class="row static-info">
                    <div class="col-md-3 name"> تلفن: </div>
                    <div class="col-md-9 value" style="direction: ltr; text-align: right"> <?= \yii\helpers\Html::encode($order->getCustomer()->getCustomerMobile()) ?> </div>
                </div>
                <div class="row static-info">
                    <div class="col-md-3 name"> آدرس: </div>
                    <div class="col-md-9 value"> <?= \yii\helpers\Html::encode($order->getCustomer()->getCustomerAddress()) ?> </div>
                </div>
                <div class="row static-info">
                    <div class="col-md-3 name"> توضیحات مشتری: </div>
                    <div class="col-md-9 value"> <?= \yii\helpers\Html::encode($order->getCustomerNote()) ?> </div>
                </div>
                <?php else: ?>
                    مشتری برای این سفارش یافت نشد.
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <?= $this->render('_view-actions',[
            'order'=>$order,
            'page'=>$page,
        ]) ?>
</div>