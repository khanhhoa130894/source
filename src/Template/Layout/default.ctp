<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('main.css') ?>

    <?= $this->Html->script('jquery.min.js') ?>
    <?= $this->Html->script('bootstrap.min.js') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <a class="navbar-brand" href=".">Admin</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href=".">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop1" data-toggle="dropdown">
                        Product
                    </a>
                    <div class="dropdown-menu">
                        <?= $this->Html->link(__('Add'), [
                            'controller' => 'Products',
                            'action' => 'add'
                        ],[
                            'class' => 'dropdown-item'
                        ]) ?>
                        <?= $this->Html->link(__('List'), [
                            'controller' => 'Products',
                            'action' => 'index'
                        ],[
                            'class' => 'dropdown-item'
                        ]) ?>
                        <?= $this->Html->link(__('Coupon'), [
                            'controller' => 'ProductCoupon',
                            'action' => 'index'
                        ],[
                            'class' => 'dropdown-item'
                        ]) ?>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop1" data-toggle="dropdown">
                        Order
                    </a>
                    <div class="dropdown-menu">
                        <?= $this->Html->link(__('Add'), [
                            'controller' => 'Orders',
                            'action' => 'add'
                        ],[
                            'class' => 'dropdown-item'
                        ]) ?>
                        <?= $this->Html->link(__('List'), [
                            'controller' => 'Orders',
                            'action' => 'index'
                        ],[
                            'class' => 'dropdown-item'
                        ]) ?>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        User
                    </a>
                    <div class="dropdown-menu">
                        <?php if ($this->Session->read('Auth.User.group_account') == 1) : ?>
                        <?= $this->Html->link(__('Add'), [
                            'controller' => 'Users',
                            'action' => 'add'
                        ],[
                            'class' => 'dropdown-item'
                        ]) ?>
                        <?= $this->Html->link(__('List'), [
                            'controller' => 'Users',
                            'action' => 'index'
                        ],[
                            'class' => 'dropdown-item'
                        ]) ?>
                        <?php else : ?>
                        <?= $this->Html->link(__('My Coupon'), [
                            'controller' => 'Users',
                            'action' => 'UserCoupon'
                        ],[
                            'class' => 'dropdown-item'
                        ]) ?>
                        <?php endif; ?>
                    </div>
                </li>
            </ul>
            <div class="form-inline my-2 my-lg-0">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown float-right">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop0" data-toggle="dropdown">
                            Xin chào: <?= $this->Session->read('Auth.User.name'); ?>
                        </a>
                        <div class="dropdown-menu">
                            <?= $this->Html->link(__('Change password'), [
                                'controller' => 'Users',
                                'action' => 'changePassword'
                            ],[
                                'class' => 'dropdown-item'
                            ]) ?>
                            <?= $this->Html->link(__('Logout'), [
                                'controller' => 'Users',
                                'action' => 'logout'
                            ],[
                                'class' => 'dropdown-item'
                            ]) ?>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="mt-3">
        <div class="container clearfix">
            <?= $this->fetch('content') ?>
        </div>
    </main>

    <footer>
    </footer>
</body>
</html>
