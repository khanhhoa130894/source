<script>
    $(document).ready(function () {
        $(document).on('change', '#change-status', function () {
            let status = $(this).val();
            $.ajax({
                type: 'post',
                url: '<?= $this->Url->build(['controller' => 'Orders', 'action' => 'ajaxChangeStatusOrder']) ?>',
                cache: false,
                data: {
                    _csrfToken: '<?= $this->request->getParam('_csrfToken') ?>',
                    id: '<?= $order->id ?>',
                    status: status
                },
                success: function (result) {
                    alert(result);
                }
            })
        });
    });
</script>
