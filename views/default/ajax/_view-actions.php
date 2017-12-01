<?php

use aminkt\ordering\interfaces\OrderInterface;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $order \aminkt\ordering\interfaces\OrderInterface */
/* @var $page string */
?>
<div class="col-md-12" style="text-align: left">
<?php if ($order->getStatus() == OrderInterface::STATUS_WAITING_FOR_CONFIRM) : ?>

    <a href="<?= Url::to(['change-status', 'id' => $order->getId(), 'page'=>$page, 'do' => $order::STATUS_CONFIRMED]) ?>"
       class="btn btn-default btn-sm green">
        <i class="fa fa-check"></i> تائید سفارش </a>

    <a href="<?= Url::to(['change-status', 'id' => $order->getId(), 'page'=>$page, 'do' => $order::STATUS_WAITING_FOR_CANCEL]) ?>"
       class="btn btn-default btn-sm red">
        <i class="fa fa-ban"></i> لغو سفارش </a>

    <a href="javascript:;" class="btn btn-default btn-sm blue"
       data-target="#pay-status"
       data-toggle="modal"
       data-url="<?= Url::to(['pay-status', 'id'=>$order->getId()]) ?>"
       data-title="مشاهده وضعیت پرداخت <?= $order->getTrackingCode() ?>"
       data-loader-container=".pay-status-content"
       data-parent-modal="#show-order">
        <i class="fa fa-credit-card"></i> مشاهده وضعیت پرداخت </a>


<?php elseif ($order->getStatus() == OrderInterface::STATUS_WAITING_FOR_CANCEL) : ?>
    <a href="<?= Url::to(['change-status', 'id' => $order->getId(), 'page'=>$page, 'do' => $order::STATUS_CANCELLED]) ?>"
       class="btn btn-default btn-sm red">
        <i class="fa fa-ban"></i> لغو سفارش </a>

    <a href="<?= Url::to(['change-status', 'id' => $order->getId(), 'page'=>$page, 'do' => $order::STATUS_WAITING_FOR_CONFIRM]) ?>"
       class="btn btn-default btn-sm yellow">
        <i class="fa fa-refresh"></i> برگشت به در انتظار تائید </a>

<?php elseif ($order->getStatus() == OrderInterface::STATUS_CANCELLED) : ?>

    <!--    <a href="--><? //= Url::to(['factor', 'id' => $order->getId(), 'page'=>$page]) ?><!--"-->
    <!--       class="btn btn-default btn-sm green">-->
    <!--        <i class="fa fa-factor"></i> پرینت فاکتور سفارش </a>-->

<?php elseif ($order->getStatus() == OrderInterface::STATUS_CONFIRMED) : ?>
    <a href="<?= Url::to(['change-status', 'id' => $order->getId(), 'page'=>$page, 'do' => $order::STATUS_READY_TO_SEND]) ?>"
       class="btn btn-default btn-sm green">
        <i class="fa fa-check"></i> انتقال به آماده ارسال </a>

    <a href="<?= Url::to(['change-status', 'id' => $order->getId(), 'page'=>$page, 'do' => $order::STATUS_WAITING_FOR_CONFIRM]) ?>"
       class="btn btn-default btn-sm yellow">
        <i class="fa fa-refresh"></i> برگشت به در انتظار تائید </a>

<?php elseif ($order->getStatus() == OrderInterface::STATUS_READY_TO_SEND) : ?>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-md-3 control-label">کد پستی: </label>
                <div class="col-md-6">
                    <?= \yii\helpers\Html::textInput('post_code', $order->getPostCode(), [
                        'placeholder'=>'کد پستی',
                        'class'=>'form-control',
                        'id'=>'post-code-input'
                    ]) ?>

<!--                    <span class="help-block"> A block of help text. </span>-->
                </div>
                <div class="col-md-3">
                    <?= \yii\helpers\Html::button('ثبت', [
                        'id'=>'reg-post-code',
                        'class'=>'btn btn-primary',
                        'style'=>'float:right;',
                    ]) ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <a href="<?= Url::to(['change-status', 'id' => $order->getId(), 'page'=>$page, 'do' => $order::STATUS_SEND]) ?>"
               class="btn btn-default btn-sm green">
                <i class="fa fa-truck"></i> تغییر وضعیت به ارسال شده </a>

            <a href="<?= Url::to(['change-status', 'id' => $order->getId(), 'page'=>$page, 'do' => $order::STATUS_CONFIRMED]) ?>"
               class="btn btn-default btn-sm yellow">
                <i class="fa fa-refresh"></i> برگشت به تائید شده </a>

        </div>
    </div>

<?php elseif ($order->getStatus() == OrderInterface::STATUS_SEND) : ?>
    <a href="<?= Url::to(['change-status', 'id' => $order->getId(), 'page'=>$page, 'do' => $order::STATUS_RECEIVED]) ?>"
       class="btn btn-default btn-sm green">
        <i class="fa fa-check"></i> سفارش توسط مشتری دریافت شد </a>

    <a href="<?= Url::to(['change-status', 'id' => $order->getId(), 'page'=>$page, 'do' => $order::STATUS_RETURNED]) ?>"
       class="btn btn-default btn-sm yellow">
        <i class="fa fa-times"></i> سفارش توسط مشتری دریافت نشد و برگشت خورد </a>

<?php elseif ($order->getStatus() == OrderInterface::STATUS_RETURNED) : ?>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-md-3 control-label">کد پستی: </label>
                <div class="col-md-6">
                    <?= \yii\helpers\Html::textInput('post_code', $order->getPostCode(), [
                        'placeholder'=>'کد پستی',
                        'class'=>'form-control',
                        'id'=>'post-code-input'
                    ]) ?>

                    <!--                    <span class="help-block"> A block of help text. </span>-->
                </div>
                <div class="col-md-3">
                    <?= \yii\helpers\Html::button('ثبت', [
                        'id'=>'reg-post-code',
                        'class'=>'btn btn-primary',
                        'style'=>'float:right;',
                    ]) ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <a href="<?= Url::to(['change-status', 'id' => $order->getId(), 'page'=>$page, 'do' => $order::STATUS_SEND]) ?>"
               class="btn btn-default btn-sm green">
                <i class="fa fa-truck"></i> تغییر وضعیت به ارسال شده </a>

            <a href="<?= Url::to(['change-status', 'id' => $order->getId(), 'page'=>$page, 'do' => $order::STATUS_WAITING_FOR_CANCEL]) ?>"
               class="btn btn-default btn-sm yellow">
                <i class="fa fa-times"></i> لغو سفارش </a>

        </div>
    </div>


<?php elseif ($order->getStatus() == OrderInterface::STATUS_RECEIVED) : ?>

    <a href="<?= Url::to(['factor', 'id' => $order->getId(), 'page'=>$page]) ?>"
       class="btn btn-default btn-sm green">
        <i class="fa fa-factor"></i> پرینت فاکتور سفارش </a>

<?php endif; ?>

    <a href="<?= Url::to(['factor', 'id' => $order->getId(), 'page' => $page]) ?>"
       class="btn btn-default btn-sm green">
        <i class="fa fa-factor"></i> پرینت فاکتور سفارش </a>
</div>
<?php
$url = \yii\helpers\Url::to(['register-post-code', 'id'=>$order->getId()]);
$js = <<<JS
$(document).ready(function() {
  $('#reg-post-code').click(function() {
        var btn = $(this);
        btn.attr('disabled', true);
        btn.text('درحال ثبت ...');
        var post = $.post( "$url", { post_code: $('#post-code-input').val()})
        .done(function( data ) {
            btn.text('ویرایش');
            btn.attr('disabled', false);
        })
        .fail(function() {
            btn.text('خطا در ارتباط');
            btn.removeClass('btn-primary').addClass('btn-danger');
        });
        
    });
});
    
JS;
$this->registerJs($js);