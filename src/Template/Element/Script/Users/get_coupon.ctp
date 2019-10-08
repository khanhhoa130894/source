<script>
    $(document).ready(function(){
        $('#get-code').on('click', function(){
            let id_product = $('#listProduct').val();
            if (id_product && id_product > 0) {
                $.ajax({
                    type: 'post',
                    url: '<?=  $this->Url->build([
                        'controller' => 'Users',
                        'action' => 'ajaxGetCoupon'
                    ]) ?>',
                    cache: false,
                    data: {
                        _csrfToken: '<?= $this->request->getParam('_csrfToken') ?>',
                        id_product: id_product
                    },
                    success: function (data) {
                        res = JSON.parse(data);
                        if (res.status === 0) {
                            $('.alert-get-coupon').text(res.coupon);
                            $('#code-coupon').val('');
                        } else {
                            $('.alert-get-coupon').text('');
                            $('#code-coupon').val(res.coupon);
                        }

                    }
                });
            }
        });
    });
</script>
