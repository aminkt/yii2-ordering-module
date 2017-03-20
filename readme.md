How to install this module:

Step1: First add flowing codes into project `composer.json`

```
"repositories": [
    {
        "type": "gitlab",
        "url": "https://gitlab.com/aminkt/yii2-ordering-module"
    }
],
```

Then add flowing line to require part of `composer.json` :
```
"aminkt/yii2-ordering-module": "*",
```

And after that run bellow command in your composer :
```
Composer update aminkt/yii2-ordering-module
```

Step2: Add flowing lines in modules part of your application config:

```
'ordering' => [
    'class' => \aminkt\ordering\Order::className(),
    'orderModelName' => models\Order::className(),
    'orderItemModelName' => models\OrderItem::className(),
    'customerProfileModelName' => models\Customer::className(),
    'productModelName' => models\Product::className(),
],
```

step3: Add flowing lines in components part of your application config:

```
'order' => [
    'class' => aminkt\ordering\components\Order::className(),
    'orderModel'=> models\Order::className(),
    'orderItemModel'=> models\OrderItem::className(),
],
```

Step4: Implement 
* `OrderInterface` in your orders model
* `OrderItemInterface` in your orderItems model
* `CustomerProfileInterface` in you customer users model
* `ProductInterface` in your products model

Step5: Enjoy from module.

[Created by Amin Keshavarz](http://telbit.ir)

[ak_1596@yahoo.com](mailto:ak_1596@yahoo.com)

[Gitlab repo](https://gitlab.com/aminkt/yii2-ordering-module)