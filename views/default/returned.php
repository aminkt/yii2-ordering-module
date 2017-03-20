<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel panel\models\search\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'سفارشات برگشت داده شده';
$this->params['breadcrumbs'][] = ['label' => 'سفارشات', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="<?= $this->context->id ?>-<?= $this->context->action->id ?>">

    <?= \yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'options'=>[
            'class'=>'table-responsive'
        ],
        //'filterModel'=>$searchModel,
        'columns'=>[
            [
                'attribute'=>'trackingCode',
//                'options'=>[
//                    'style'=>'width:20%;',
//                ]
            ],
            [
                'attribute'=>'customerId',
                'format'=>'raw',
                'value'=>function ($model){
                    /** @var $model \aminkt\ordering\interfaces\OrderInterface */
                    $customer = $model->getCustomer();
                    if($customer){
                        $name = $customer->getCustomerName().' '.$customer->getCustomerFamily();
                        return Html::a($name, '#', [
                            'type'=>'button',
                            'class'=>'show-modal',
                            'data'=>[
                                'target'=>'#customer-info',
                                'toggle'=>'modal',
                                'url'=>\yii\helpers\Url::to(['customer-info', 'id'=>$customer->getId()]),
                                'title'=>'مشخصات مشتری: '.$name,
                                'loader-container'=>'.customer-content',
                            ]
                        ]);
                    }
                    return $customer;
                }
            ],
            [
                'attribute'=>'totalPrice',
                'options'=>[
                    'style'=>'width:10%;',
                ]
            ],
            [
                'attribute'=>'payStatus',
                'options'=>[
                    'style'=>'width:10%;',
                ],
                'value'=>function ($model){
                    /** @var $model \aminkt\ordering\interfaces\OrderInterface */
                    if($model->getPayStatus() == $model::PAY_STATUS_NOT_PAID)
                        return "پرداخت نشده";
                    elseif($model->getPayStatus() == $model::PAY_STATUS_PAID)
                        return "پرداخت شده";
                    elseif($model->getPayStatus() == $model::PAY_STATUS_RETURNED)
                        return "برگشت داده شده";
                    elseif($model->getPayStatus() == $model::PAY_STATUS_BANK_ERROR)
                        return "خطای بانکی در پرداخت";
                    return null;
                }
            ],
            [
                'attribute'=>'status',
                'value'=>function ($model){
                    /** @var $model \aminkt\ordering\interfaces\OrderInterface */
                    if($model->getStatus() == $model::STATUS_SHOP_CART)
                        return "در سبد خرید";
                    elseif($model->getStatus() == $model::STATUS_WAITING_FOR_CONFIRM)
                        return "درانتظار تائید";
                    elseif ($model->getStatus() == $model::STATUS_WAITING_FOR_CANCEL)
                        return "در انتظار لغو";
                    elseif($model->getStatus() == $model::STATUS_CANCELLED)
                        return "لغو شده";
                    elseif($model->getStatus() == $model::STATUS_CONFIRMED)
                        return "تائید شده";
                    elseif($model->getStatus() == $model::STATUS_STORE_PROCESS)
                        return "پردازش انبار";
                    elseif($model->getStatus() == $model::STATUS_READY_TO_SEND)
                        return "آماده ارسال";
                    elseif($model->getStatus() == $model::STATUS_SEND)
                        return "ارسال شده";
                    elseif($model->getStatus() == $model::STATUS_RETURNED)
                        return "برگشت خورده";
                    elseif($model->getStatus() == $model::STATUS_RECEIVED)
                        return "دریافت شده";
                    return null;
                }
            ],
            [
                'attribute'=>'changeStatusTime',
                'options'=>[
                    'style'=>'width:12%;',
                ],
                'value'=>function ($model){
                    /** @var $model \aminkt\ordering\interfaces\OrderInterface */
                    return $model->getChangeStatusTime();
                }
            ],
            [
                'attribute'=>'createTime',
                'options'=>[
                    'style'=>'width:12%;',
                ],
                'value'=>function ($model){
                    /** @var $model \aminkt\ordering\interfaces\OrderInterface */
                    return $model->getCreateTime();
                }
            ],
            [
                'label' => 'عملیات',
                'format' => 'raw',
                'headerOptions'=>[
                    'style'=>'width:15%;',
                    'class'=>'text-center'
                ],
                'value' => function ($model) {
                    /** @var \aminkt\ordering\interfaces\OrderInterface $model */
                    $html = '<div style="text-align: center;"> <div class="btn-group">';
                    $html .= Html::a('<i class="fa fa-eye"></i>', '#', [
                        'class'=>'btn btn-icon-only blue show-modal tooltips',
                        'type'=>'button',
                        'data'=>[
                            'container'=>'body',
                            'placement'=>'top',
                            'original-title'=>'نمایش سفارش',
                            'target'=>'#show-order',
                            'toggle'=>'modal',
                            'url'=>\yii\helpers\Url::to(['view', 'id'=>$model->getId(), 'page'=>$this->context->action->id]),
                            'title'=>'مشخصات سفارش شماره '.$model->getTrackingCode(),
                            'loader-container'=>'.order-content',
                        ]
                    ]);
                    $html .= Html::a('<i class="fa fa-truck"></i>',
                        [
                            'change-status',
                            'id'=>$model->getId(),
                            'page'=>$this->context->action->id,
                            'do'=>$model::STATUS_SEND
                        ], ['class'=>'btn btn-icon-only green tooltips', 'data'=>[
                            'container'=>'body',
                            'placement'=>'top',
                            'original-title'=>'تغییر وضعیت به ارسال شده',
                            'confirm'=>"توصیه میشود که کد پیگیری پستی جدید را جایگزین کنید. این کار را کرده اید؟",
                            'method'=>'post'
                        ]]);
                    $html .= Html::a('<i class="fa fa-times"></i>', [
                        'change-status',
                        'id'=>$model->getId(),
                        'page'=>$this->context->action->id,
                        'do'=>$model::STATUS_WAITING_FOR_CANCEL
                    ], ['class'=>'btn btn-icon-only yellow tooltips', 'data'=>[
                        'container'=>'body',
                        'placement'=>'top',
                        'original-title'=>'لغو سفارش',
                        'confirm'=>'آیا از لغو این مورد اطمینان دارید؟',
                        'method'=>'post'
                    ]]);
                    $html .= '</div> </div>';
                    return $html;
                },
            ],
        ]
    ]) ?>
</div>
<?php
echo $this->render('_modals');
?>

