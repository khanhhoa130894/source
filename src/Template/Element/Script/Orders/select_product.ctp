<script>
    function ajaxLoadTotalPrice(this_ele, arr_idsp = [], coupon = [])
    {
        $.ajax({
            type: 'post',
            url: '<?= $this->Url->build(['controller' => 'Orders', 'action' => 'ajaxLoadTotalPrice']) ?>',
            cache: false,
            data: {
                _csrfToken: '<?= $this->request->getParam('_csrfToken') ?>',
                arr_idsp: JSON.stringify(arr_idsp),
                coupon: JSON.stringify(coupon),
            },
            success: function (result) {
                res = JSON.parse(result);
                if (res.error && res.error != null) {
                    this_ele.parents('.item').find('.error-coupon').text(res.error);
                    this_ele.val('');
                } else {
                    this_ele.parents('.item').find('.error-coupon').text('');
                }
                $('#total-price').val(res.totalPrice);
            }
        });
    }
    $(document).ready(function () {
        var arr_idsp = [];
        $(document).on('change', '#listProduct',function () {
            let this_ele = $(this);
            let id = $(this).val();
            if (id) {
                text = $(this).find('option:selected').text();
                html =  '<div class="item mb-2 row">\n' +
                        '    <div class="col-6">\n' +
                        '        <span class="col-8 tag btn btn-info text-left col-12">'+text+'\n' +
                        '            <span class="remove"></span>\n' +
                        '        </span>\n' +
                        '    </div>\n' +
                        '    <div class="col-3">\n' +
                        '        <input type="text" class="form-control use-coupon" name="id_product['+ id +'][coupon]" data-idsp="'+id+'" placeholder="Enter coupon" />\n' +
                        '        <p class="text-danger m-0 error-coupon"></p>\n' +
                        '    </div>\n' +
                        '    <div class="col-3">\n' +
                        '        <span class="price"></span>\n' +
                        '    </div>\n' +
                        '    <input type="hidden" name="id_product['+ id +'][quantity]" value="1" />\n' +
                        '</div>';
                if (arr_idsp.indexOf(id) === -1) {
                    arr_idsp.push(id);
                    $('.content-list-product').append(html);
                    ajaxLoadTotalPrice(this_ele, arr_idsp, arr_coupon);
                }
            }
        });
        var arr_coupon = {};
        $(document).on( 'blur', '.use-coupon', function () {
            let this_ele = $(this);
            let coupon = $(this).val();
            let idsp = $(this).attr('data-idsp');
            if (!coupon) {
                delete arr_coupon[idsp];
            } else {
                arr_coupon[idsp] = coupon;
            }
            ajaxLoadTotalPrice(this_ele, arr_idsp, arr_coupon);
        });
        $(document).on('click', '.tag .remove',function () {
            let this_ele = $(this);
            let id = $(this).parents('.item').find('input.use-coupon').attr('data-idsp');
            let index = arr_idsp.indexOf(id);
            if (index > -1) {
                arr_idsp.splice(index, 1);
                delete arr_coupon[id];
            }
            $(this).parents('.item').remove();
            ajaxLoadTotalPrice(this_ele, arr_idsp, arr_coupon);
        });
    });
</script>

