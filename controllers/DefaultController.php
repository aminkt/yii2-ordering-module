<?php

namespace ordering\controllers;

use ordering\interfaces\CustomerProfileInterface;
use ordering\interfaces\OrderInterface;
use ordering\Order;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

/**
 * Default controller for the `ordering` module
 */
class DefaultController extends Controller
{
    /** @var  Order $module */
    public $module;

    public function beforeAction($action)
    {
        $this->module = \Yii::$app->getModule('ordering');
        return parent::beforeAction($action);
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $order = $this->module->orderModelName;
        $dataProvider = new ActiveDataProvider([
            'query'=>$order::getOrderQuery(),
        ]);
        return $this->render('index',[
            'dataProvider'=>$dataProvider,
        ]);
    }

    /**
     * List all orders in shopping cart
     * @return string
     */
    public function actionShoppingCart()
    {
        $order = $this->module->orderModelName;
        $query = $order::getOrderQuery()->andWhere(['status'=>$order::STATUS_SHOP_CART]);
        $dataProvider = new ActiveDataProvider([
            'query'=>$query,
        ]);
        return $this->render('shopping-cart',[
            'dataProvider'=>$dataProvider,
        ]);
    }

    /**
     * List all orders by waiting for confirm status
     * @return string
     */
    public function actionWaitingForConfirm()
    {
        $order = $this->module->orderModelName;
        $query = $order::getOrderQuery()->andWhere(['status'=>$order::STATUS_WAITING_FOR_CONFIRM]);
        $dataProvider = new ActiveDataProvider([
            'query'=>$query,
        ]);
        return $this->render('waiting-for-confirm',[
            'dataProvider'=>$dataProvider,
        ]);
    }

    /**
     * List all orders by waiting for cancel status
     * @return string
     */
    public function actionWaitingForCancel()
    {
        $order = $this->module->orderModelName;
        $query = $order::getOrderQuery()->andWhere(['status'=>$order::STATUS_WAITING_FOR_CANCEL]);
        $dataProvider = new ActiveDataProvider([
            'query'=>$query,
        ]);
        return $this->render('waiting-for-cancel',[
            'dataProvider'=>$dataProvider,
        ]);
    }

    /**
     * List all orders by cancelled status
     * @return string
     */
    public function actionCancelled()
    {
        $order = $this->module->orderModelName;
        $query = $order::getOrderQuery()->andWhere(['status'=>$order::STATUS_CANCELLED]);
        $dataProvider = new ActiveDataProvider([
            'query'=>$query,
        ]);
        return $this->render('cancelled',[
            'dataProvider'=>$dataProvider,
        ]);
    }

    /**
     * List all orders by confirmed status
     * @return string
     */
    public function actionConfirmed()
    {
        $order = $this->module->orderModelName;
        $query = $order::getOrderQuery()->andWhere(['status'=>$order::STATUS_CONFIRMED]);
        $dataProvider = new ActiveDataProvider([
            'query'=>$query,
        ]);
        return $this->render('confirmed',[
            'dataProvider'=>$dataProvider,
        ]);
    }

    /**
     * List all orders by store process status
     * @return string
     */
    public function actionStoreProcess()
    {
        $order = $this->module->orderModelName;
        $query = $order::getOrderQuery()->andWhere(['status'=>$order::STATUS_STORE_PROCESS]);
        $dataProvider = new ActiveDataProvider([
            'query'=>$query,
        ]);
        return $this->render('store-process',[
            'dataProvider'=>$dataProvider,
        ]);
    }

    /**
     * List all orders by ready to send status
     * @return string
     */
    public function actionReadyToSend()
    {
        $order = $this->module->orderModelName;
        $query = $order::getOrderQuery()->andWhere(['status'=>$order::STATUS_READY_TO_SEND]);
        $dataProvider = new ActiveDataProvider([
            'query'=>$query,
        ]);
        return $this->render('ready-to-send',[
            'dataProvider'=>$dataProvider,
        ]);
    }

    /**
     * List all orders by send status
     * @return string
     */
    public function actionSend()
    {
        $order = $this->module->orderModelName;
        $query = $order::getOrderQuery()->andWhere(['status'=>$order::STATUS_SEND]);
        $dataProvider = new ActiveDataProvider([
            'query'=>$query,
        ]);
        return $this->render('send',[
            'dataProvider'=>$dataProvider,
        ]);
    }

    /**
     * List all orders by returned status
     * @return string
     */
    public function actionReturned()
    {
        $order = $this->module->orderModelName;
        $query = $order::getOrderQuery()->andWhere(['status'=>$order::STATUS_RETURNED]);
        $dataProvider = new ActiveDataProvider([
            'query'=>$query,
        ]);
        return $this->render('returned',[
            'dataProvider'=>$dataProvider,
        ]);
    }

    /**
     * List all orders by received status
     * @return string
     */
    public function actionReceived()
    {
        $order = $this->module->orderModelName;
        $query = $order::getOrderQuery()->andWhere(['status'=>$order::STATUS_RECEIVED]);
        $dataProvider = new ActiveDataProvider([
            'query'=>$query,
        ]);
        return $this->render('received',[
            'dataProvider'=>$dataProvider,
        ]);
    }

    /**
     * Show order information
     * @param $id integer Order id
     * @param $page string
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id, $page){
        /** @var OrderInterface $orderModel */
        $orderModel = $this->module->orderModelName;
        $order = $orderModel::getOrder($id);
        if(!$order)
            throw new NotFoundHttpException("سفارش مورد نظر یافت نشد.");

        return $this->renderAjax('ajax/_view',[
            'order'=>$order,
            'page'=>$page,
        ]);
    }


    /**
     * Show customer information
     * @param $id integer Customer id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionCustomerInfo($id){
        /** @var CustomerProfileInterface $customer */
        $customerModel = $this->module->customerProfileModelName;

        $customer = $customerModel::getCustomer($id);
        if(!$customer)
            throw new NotFoundHttpException("مشتری مورد نظر یافت نشد.");


        return $this->renderAjax('ajax/_customer-info',[
            'customer'=>$customer,
        ]);
    }

    /**
     * Show pay status information if available.
     * @param $id integer Order id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionPayStatus($id){
        /** @var OrderInterface $customer */
        $orderModal = $this->module->orderModelName;

        $order = $orderModal::getOrder($id);
        if(!$order)
            throw new NotFoundHttpException("سفارش مورد نظر یافت نشد.");

        return $this->renderAjax('ajax/_pay-status',[
            'model'=>$order,
        ]);
    }

    /**
     * Show order factor
     * @param $id integer Order id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionFactor($id){
        /** @var OrderInterface $customer */
        $orderModal = $this->module->orderModelName;

        $order = $orderModal::getOrder($id);
        if(!$order)
            throw new NotFoundHttpException("سفارش مورد نظر یافت نشد.");

        return $this->render('factor',[
            'model'=>$order,
        ]);
    }

    /**
     * Register post code for order.
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     * @throws ServerErrorHttpException
     * @internal param $orderId
     */
    public function actionRegisterPostCode($id){
        /** @var OrderInterface $customer */
        $orderModal = $this->module->orderModelName;

        $order = $orderModal::getOrder($id);
        if(!$order)
            throw new NotFoundHttpException("سفارش مورد نظر یافت نشد.");

        $postCode = trim(\Yii::$app->request->post('post_code', false));
        if($postCode and !empty($postCode)){
            if($order->setPostCode($postCode))
                return "کد پستی ذخیره شد.";
        }

        throw new ServerErrorHttpException("کدپستی ذخیره نشد");
    }

    /**
     * Change order status.
     * @param $id integer
     * @param $do integer
     * @return \yii\web\Response
     * @throws ServerErrorHttpException
     */
    public function actionChangeStatus($id, $do){

        /** @var \ordering\components\Order $orderComponent */
        $orderComponent = \Yii::$app->order;
        if(!$orderComponent->changeOrderStatus($id, $do)){
            throw new ServerErrorHttpException('وضعیت سفارش تغییر نکرد.');
        }

        if($page = \Yii::$app->request->get('page'))
            return $this->redirect([$page]);

        return $this->goBack();
    }
}
