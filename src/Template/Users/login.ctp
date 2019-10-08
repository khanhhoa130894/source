<?php
    $this->layout = false;
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('style-login.css') ?>
    <link href="https://fonts.googleapis.com/css?family=Raleway:500i|Roboto:300,400,700|Roboto+Mono" rel="stylesheet">

    <?php $this->fetch('css') ?>
</head>
<body>
    <div class="container">
        <div class="wrapper">
            <div class="card text-center">
                <div class="card-header">Đăng nhập</div>
                <div class="card-body">
                    <div class="error text-danger mb-2">
                        <?= $this->Flash->render() ?>
                    </div>
                    <?= $this->Form->create() ?>
                    <div class="form-group">
                        <?= $this->Form->control('username', [
                            'type' => 'text',
                            'class' => 'form-control',
                            'required' => true,
                            'label' => [
                                'class' => 'd-block text-left'
                            ]
                        ]); ?>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->control('password', [
                            'type' => 'password',
                            'class' => 'form-control',
                            'required' => true,
                            'label' => [
                                'class' => 'd-block text-left'
                            ]
                        ]); ?>
                    </div>
                    <?= $this->Form->button('Login', [
                        'class' => 'btn btn-success',
                        'type' => 'submit'
                    ]) ?>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
