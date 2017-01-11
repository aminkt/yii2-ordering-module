<?php

use yii\bootstrap\Modal;

/* @var $this yii\web\View */

$loadingImage = '../img/loading-spinner-grey.gif';
$loading = <<<HTML
<div class="data-loader hidden"><img src="$loadingImage"> &nbsp; &nbsp; درحال بارگزاری ...</div>
HTML;
?>
<?php
Modal::begin([
    'id'=>'show-order',
    'size'=>Modal::SIZE_LARGE,
    'header' => '<h4 class="modal-title">جزئیات سفارش</h4>',
]);
echo $loading;
?>
<div class="order-content"></div>
<?php Modal::end();

Modal::begin([
'id'=>'customer-info',
'size'=>Modal::SIZE_DEFAULT,
'header' => '<h4 class="modal-title">مشخصات مشتری</h4>',
]);
echo $loading;
?>
    <div class="customer-content"></div>
<?php Modal::end();
Modal::begin([
    'id'=>'pay-status',
    'size'=>Modal::SIZE_DEFAULT,
    'header' => '<h4 class="modal-title">مشاهده وضعیت پرداخت.</h4>',
]);
echo $loading;
?>
<input type="hidden" id="pay-status-parent-modal">
<div class="pay-status-content"></div>
<?php Modal::end();
$js = <<<JS
    $(".modal").on("show.bs.modal", function(e) {
        var link = $(e.relatedTarget);
        var modal = $(this);
        var ajaxDisable = modal.data('ajax-disable')?true:false;
        console.log('data-ajax-disable:'+ajaxDisable);
        if(!ajaxDisable){
           var parent =  link.data('parent-modal')
            if(parent){
                $(parent).modal('hide');
                modal.find('#pay-status-parent-modal').val(parent);
            }
            modal.show();
            modal.find(".modal-title").text(link.data("title"));  
            modal.find(".data-loader").removeClass("hidden"); 
            $(link.data('loader-container')).empty();
            modal.find(link.data('loader-container')).load(link.data("url"), function(responseTxt, statusTxt, xhr){
                if(statusTxt == "success")
                   modal.find(".data-loader").addClass("hidden");
                    
                if(statusTxt == "error"){
                    console.error("Error: "+ xhr.status + ": "+ xhr.statusText);
                    modal.find(".data-loader").addClass("hidden");
                    modal.find(link.data('loader-container')).text('خطا در بارگزاری اطلاعات!');
                }
            }); 
        }
    });
    
    $('.modal').on('hide.bs.modal', function (e) {
        var modal = $(this);
        modal.data('ajax-disable', false);
        var parent = modal.find('#pay-status-parent-modal').val();
        if(parent){
            $(parent).data('ajax-disable', true);
            $(parent).modal('show');
        }
    })
    
JS;
$this->registerJs($js, yii\web\View::POS_END, 'modals');
?>

