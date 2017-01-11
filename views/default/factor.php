<?php
/* @var $this yii\web\View */
/* @var $model \ordering\interfaces\OrderInterface */

$this->title='فاکتور فروش';
$this->params['breadcrumbs'][] = ['label' => 'سفارشات', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/../template/pages/css/invoice-rtl.min.css');
$customer = $model->getCustomer();
$items = $model->getItems();
?>
<!-- BEGIN PAGE BASE CONTENT -->
<?php /*
<div class="invoice">
    <div class="row invoice-logo">
        <div class="col-xs-6 invoice-logo-space">
            <img src="img/logo.png" class="img-responsive" alt="" /> </div>
        <div class="col-xs-6">
            <p> #<?= $model->getTrackingCode() ?> / <?= $model->getCreateTime() ?>
                <span class="muted"> تهیه شده توسط سیستم فروشگاه ساز تل بیت (telbit.ir) </span>
            </p>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-xs-4">
            <h3>مشتری:</h3>
            <ul class="list-unstyled">
                <li> <?= $customer->getCustomerName() ?> <?= $customer->getCustomerFamily() ?> </li>
                <li><?= $customer->getCustomerAddress() ?> </li>
            </ul>
        </div>
        <div class="col-xs-4">
            <h3>فروشنده :</h3>
            <ul class="list-unstyled">
                <li> Drem psum dolor sit amet </li>
                <li> Laoreet dolore magna </li>
                <li> Consectetuer adipiscing elit </li>
                <li> Magna aliquam tincidunt erat volutpat </li>
                <li> Olor sit amet adipiscing eli </li>
                <li> Laoreet dolore magna </li>
            </ul>
        </div>
        <div class="col-xs-4 invoice-payment">
            <h3>Payment Details:</h3>
            <ul class="list-unstyled">
                <li>
                    <strong>V.A.T Reg #:</strong> 542554(DEMO)78 </li>
                <li>
                    <strong>Account Name:</strong> FoodMaster Ltd </li>
                <li>
                    <strong>SWIFT code:</strong> 45454DEMO545DEMO </li>
                <li>
                    <strong>Account Name:</strong> FoodMaster Ltd </li>
                <li>
                    <strong>SWIFT code:</strong> 45454DEMO545DEMO </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th> # </th>
                    <th> Item </th>
                    <th class="hidden-xs"> Description </th>
                    <th class="hidden-xs"> Quantity </th>
                    <th class="hidden-xs"> Unit Cost </th>
                    <th> Total </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td> 1 </td>
                    <td> Hardware </td>
                    <td class="hidden-xs"> Server hardware purchase </td>
                    <td class="hidden-xs"> 32 </td>
                    <td class="hidden-xs"> $75 </td>
                    <td> $2152 </td>
                </tr>
                <tr>
                    <td> 2 </td>
                    <td> Furniture </td>
                    <td class="hidden-xs"> Office furniture purchase </td>
                    <td class="hidden-xs"> 15 </td>
                    <td class="hidden-xs"> $169 </td>
                    <td> $4169 </td>
                </tr>
                <tr>
                    <td> 3 </td>
                    <td> Foods </td>
                    <td class="hidden-xs"> Company Anual Dinner Catering </td>
                    <td class="hidden-xs"> 69 </td>
                    <td class="hidden-xs"> $49 </td>
                    <td> $1260 </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4">
            <div class="well">
                <address>
                    <?= $customer->getCustomerAddress() ?>
                    <abbr title="تلفن">تلفن:</abbr> <div style="display: inline-block; direction: ltr; text-align: right;"><?= $customer->getCustomerMobile() ?></div>  </address>
                <address>
                    <strong>نام و نام خانوادگی</strong>
                    <br/>
                    <a href="mailto:#"> <?= $customer->getCustomerName() ?> <?= $customer->getCustomerFamily() ?> </a>
                </address>
            </div>
        </div>
        <div class="col-xs-8 invoice-block">
            <ul class="list-unstyled amounts">
                <li>
                    <strong>Sub - Total amount:</strong> $9265 </li>
                <li>
                    <strong>Discount:</strong> 12.9% </li>
                <li>
                    <strong>VAT:</strong> ----- </li>
                <li>
                    <strong>Grand Total:</strong> $12489 </li>
            </ul>
            <br/>
            <a class="btn btn-lg blue hidden-print margin-bottom-5" onclick="javascript:window.print();"> پرینت فاکتور
                <i class="fa fa-print"></i>
            </a>
        </div>
    </div>
</div> */ ?>
<!-- END PAGE BASE CONTENT -->
    <script src="../template/barcode/barcode.js"></script>
    <script src="../template/barcode/code128auto.js"></script>
    <script src="../template/barcode/app-code128auto.js"></script>
    <link href="../template/factor.css" rel="stylesheet" type="text/css">
    <style type="text/css" media="screen,print">
        @font-face {
            font-family: WebCode128;
            src: url("../template/barcode/WebCode128H3.eot");
            src: url("../template/barcode/WebCode128H3.otf") format("opentype"), url("barcode/WebCode128H3.woff") format("woff");
        }

        div.barcodeVal {
            font-weight: normal;
            font-style: normal;
            line-height: normal;
            font-family: 'WebCode128', sans-serif;
            font-size: 15px;
            text-align: center;
        }

        /* required for GS1-128 */
        div.barcodeVal {
            white-space: pre;
        }
    </style>
    <style type="text/css" media="print">
        .factor{
            position: absolute;
            top:0;
            width: 90%;
            padding: 0;
            margin: 0 10px;
        }
    </style>
<?php

$total = 0 ;
$totalNum = 0;
foreach ($items as $item){
    $total += max(0, ($item->getPrice()-$item->getDiscount()))*$item->getNumber();
    $totalNum += $item->getNumber();
}
$total += $model->getPostCost();
$totalNum++;

$counter = 1;
$pageSize = 5;
$totalItems = count($items);
for ($j=0; $j<$totalItems; $j+=$pageSize):
    ?>
    <div class="factor" style="margin-top: 1.5cm;">
        <div class="name">
            <h1>صورتحساب فروش کالا و خدمات</h1>
        </div>
        <div class="header">
            <table width="100%">
                <tr>
                    <td class="title">فروشنده</td>
                    <td class="info">
                        <div class="seller">
                            <div class="item" style="width: 40%;"><strong>فروشنده :</strong> </div>
                            <div class="item" style="width: 50%;"><strong>آدرس شرکت :</strong>    </div>
                            <div class="item" style="width: 40%;"><strong>کدپستی :</strong> <span class="num"> </span></div>
                            <div class="item" style="width: 40%;"><strong>تلفن :</strong> <span class="num" style="display: inline-block"> </span> </div>
                        </div>
                    </td>
                    <td class="code">
                        <div class="numfild">
                            <div class="number">شماره فاکتور: <span
                                    class="num humanReadable"> <?= $model->getId() ?> </span></div>
                            <div class="barcodeVal"><?= $model->getId() ?></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="title">خریدار</td>
                    <td class="info">
                        <div class="buyer">
                            <div class="item"><strong>خریدار :</strong> <?= $customer->getCustomerName() ?> <?= $customer->getCustomerFamily() ?> </div>
                            <div class="item"><strong>تلفن :</strong> <span class="num" style="display: inline-block">  <?= $customer->getCustomerMobile() ?> </span></div>
                            <!-- <div class="item"><strong>کدپستی :</strong> <span class="num"><?= $customer->getCustomerEmail() ?></span></div> -->
                            <div class="item"><strong>آدرس :</strong><?= $customer->getCustomerAddress() ?></div>


                        </div>
                    </td>
                    <td class="code">
                        <div class="date">
                            <div class="number">تاریخ: <span class="num"><?= $model->getCreateTime() ?></span></div>
                            <div class="number"> پیگیری: <span class="num humanReadable"><?= $model->getTrackingCode() ?></span></div>
                            <div class="barcodeVal"> <?= $model->getTrackingCode() ?></div>
                        </div>
                    </td>
                </tr>
            </table>

        </div>

        <div class="body">
            <table class="factor-tbl" id="mainTbl">

                <tr style="background-color: #f0f0f0;">
                    <th>ردیف</th>
                    <th>کدکالا</th>
                    <th>شرح کالا</th>
                    <th>مبلغ واحد (ریال)</th>
                    <th>تعداد</th>
                    <th>مبلغ کل (ریال)</th>
                    <th>تخفیف (ریال)</th>
                    <th>مبلغ کل پس از محاسبه تخفیف (ریال)</th>
                    <!--                    <th>جمع مالیات و عوارض (ریال)</th>-->
                    <!--                    <th>جمع مبلغ کل پس از تخفیف و مالیات و عوارض (ریال)</th>-->
                </tr>
                <?php
                /* @var $item \ordering\interfaces\OrderItemInterface */
                $i=0;
                $totalPage = 0 ;
                $totalPageNum = 0;
                while($counter<=$totalItems and $i<$pageSize) :
                    $i++;
                    $item = $items[$counter-1];
                    /* @var $product \ordering\interfaces\ProductInterface */
                    $totalPage += max(0, ($item->getPrice()-$item->getDiscount()))*$item->getNumber();
                    $totalPageNum += $item->getNumber();
                    $product = $item->getProduct();
                    $tax = 0;
                    ?>
                    <tr>
                        <td class="num"><?= $counter++ ?></td>
                        <td class="num" style="direction: rtl !important;"><?= $product->getCode() ?></td>
                        <td style="text-align: right;"><?= $product->getName() ?></td>
                        <td class="num"><?= number_format($item->getPrice()) ?></td>
                        <td class="num"><?= $item->getNumber() ?></td>
                        <td class="num"><?= number_format($item->getPrice()*$item->getNumber()) ?></td>
                        <td class="num"><?= number_format(-($item->getDiscount()*$item->getNumber())) ?></td>
                        <td class="num"><?= number_format(max(0, ($item->getPrice()-$item->getDiscount()))*$item->getNumber()) ?></td>
                    </tr>
                <?php endwhile; ?>
                <?php if($j>$totalItems-$pageSize): ?>
                    <tr>
                        <td class="num"><?= $counter ?></td>
                        <td class="num">0</td>
                        <td style="text-align: right;"> خدمات بسته بندی، بیمه، حمل و ارسال
                        </td>
                        <td class="num"><?= number_format($model->getPostCost()) ?></td>
                        <td class="num">1</td>
                        <td class="num"><?= number_format($model->getPostCost()) ?></td>
                        <td class="num">0</td>
                        <td class="num"><?= number_format($model->getPostCost()) ?></td>
                        <?php $totalPage += $model->getPostCost(); $totalPageNum++;?>
                    </tr>
                <?php endif; ?>
                <tr style="background-color: #FCFCFC;">
                    <td colspan="3" style="text-align:  left; padding: 0 20px;">صفحه <?= round($j/$pageSize, 0, PHP_ROUND_HALF_DOWN)+1 ?> از   <?= round($totalItems/$pageSize, 0, PHP_ROUND_HALF_DOWN)+1 ?> صفحه</td>
                    <td style="text-align:  left; padding: 0 20px;">تعداد کل صفحه  </td>
                    <td class="num"> <?= $totalPageNum ?> </td>
                    <td colspan="2" style="text-align:  left; padding: 0 20px;">جمع کل فاکتور (ریال)  </td>
                    <td class="num"><?= number_format($total) ?></td>
                </tr>
                <tr style="background-color: #FCFCFC;">
                    <td colspan="3" style="text-align:  left; padding: 0 20px;">جمع کل صفحه (ریال)  </td>
                    <td colspan="2" class="num"><?= number_format($totalPage) ?></td>
                    <td colspan="2" style="text-align:  left; padding: 0 20px;">مبلغ تخفیف حاصل از کد تخفیف (ریال)  </td>
                    <td class="num">0</td>
                </tr>
                <tr style="background-color: #FCFCFC;">
                    <td colspan="3" style="text-align:  left; padding: 0 20px;">تعداد کل فاکتور  </td>
                    <td colspan="2" class="num"><?= $totalNum ?></td>
                    <td colspan="2" style="text-align:  left; padding: 0 20px;">جمع کل فاکتور پس از تخفیف (ریال) </td>
                    <td class="num"><?= number_format($total-0) ?></td>
                </tr>
                <tr style="background-color: #FCFCFC;">
                    <td colspan="7" style="text-align:  left; padding: 0 20px;">مالیات بر ارزش افزوده (ریال)  </td>
                    <td class="num">0</td>
                </tr>
                <tr style="background-color: #FCFCFC;">
                    <td colspan="7" style="text-align:  left; padding: 0 20px;">جمع مبلغ کل با احتساب  مالیات بر ارزش افزوده (ریال)  </td>
                    <td class="num"><?= number_format($model->getTotalPrice()+$model->getPostCost()) ?></td>
                </tr>
                <tr>
                    <td style="text-align: right; vertical-align: central; height: 55px;" colspan="10">
                        <span class="f-2">مهر و امضای فروشنده:</span>
                        <span class="f-2">تاریخ تحویل:</span>
                        <span class="f-2">ساعت تحویل:</span>
                        <span class="f-2">مهر و امضای خریدار:</span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <?php
endfor;
$js = <<<JS
    function setCm(mcm) {
        var mycm = 38;
        return mcm*mycm;
    }
    function getCm(mpx) {
        var mycm = 38;
        return mpx/mycm;
    }
    $(document).ready(function (){
        var firP = 13;
        var midP = 18;
        var lasP = 15;
        var pages = Math.ceil($(".factor").height() / setCm(18));
        console.log(pages);
        if (pages > 1) {
            var i = 1;
            var cutentPage = 1;
            var allHeigh = 0;
            var cHeigh = 0;
            $('#mainTbl  tr').each(function(i, tr) {
                cHeigh += $(this).height();

                var breakPage = setCm(firP);

                if (cutentPage > 1 && cutentPage < pages)
                    breakPage = setCm(midP);
                else if (cutentPage == pages)
                    breakPage = setCm(lasP);
                console.log(getCm(breakPage));
                if (cHeigh >= breakPage){
                    console.error(i+": height= "+cHeigh);
                    $(this).css('background', 'red');
                    $(this).after("<tr class='page-break'></tr>");
                    cHeigh = 0;
                    cutentPage++;
                }

                console.log((i++)+":("+cutentPage+") "+ cHeigh+" - "+getCm(cHeigh));
            });
        }
        window.print();
    });
JS;
$this->registerJs($js, \yii\web\View::POS_READY);