<?php
/* @var $this yii\web\View */
/* @var $model \ordering\interfaces\OrderInterface */
?>

<div class="row static-info">
    <div class="col-md-3 name"> وضعیت پرداخت:: </div>
    <div class="col-md-9 value">
        <?php
            if($model->getPayStatus() == $model::PAY_STATUS_NOT_PAID)
                echo "پرداخت نشده";
            elseif($model->getPayStatus() == $model::PAY_STATUS_PAID)
                echo "پرداخت شده";
            elseif($model->getPayStatus() == $model::PAY_STATUS_RETURNED)
                echo "برگشت داده شده";
            elseif($model->getPayStatus() == $model::PAY_STATUS_BANK_ERROR)
                echo "خطای بانکی در پرداخت";
            else
                echo "مشخص نشده";
        ?>
    </div>
</div>
<div class="row static-info">
    <div class="col-md-3 name"> مبلغ قابل پرداخت: </div>
    <div class="col-md-9 value"> <?= number_format($model->getTotalPrice()+$model->getPostCost()) ?> </div>
</div>
<?php if($model->getStatus() != $model::PAY_STATUS_NOT_PAID) : ?>
<div class="row static-info">
    <div class="col-md-3 name"> شیوده پرداخت: </div>
    <div class="col-md-9 value">
        <?php
        if($model->getPayType() == $model::PAY_TYPE_IN_PLACE)
            echo "پرداخت در محل";
        elseif($model->getPayType() == $model::PAY_TYPE_BANK_FISH)
            echo "فیش بانکی";
        elseif($model->getPayType() == $model::PAY_TYPE_INTERNET)
            echo "درگاه های اینترنتی بانکی";
        else
            echo "مشخص نشده";
        ?>
    </div>
</div>
<div class="row static-info">
    <div class="col-md-3 name"> مبلغ پرداخت شده: </div>
    <div class="col-md-9 value"> -- </div>
</div>
<?php endif; ?>