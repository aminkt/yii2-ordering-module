How to install this module:

Step1: Copy `ordering` directory in your modules folder.

Step2: Add flowing code into your `bootstrap.php` file in your project.
```
Yii::setAlias('ordering', 'PATH_TO_MODULE_DIRECTORY/ordering');
```

Step3: Add flowing lines in your application config:

```
'ordering' => [
    'class' => 'ordering\Order',
    'orderModel' => 'YOUR_ORDER_CLASS_WHIT_NAME_SPACE'
    'orderItemModel' => 'YOUR_ORDER_ITEM_CLASS_WHIT_NAME_SPACE'
],
```

Step4: Implement `OrderInterface` in your order model and `OrderItemInterface` in your orderItem model.

Step5: Enjoy from module.