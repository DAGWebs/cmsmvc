<?php 

$this->start("body");


$form = new Form('http://api.cms.test/user/login');

$form->setFormAttributes([
    'class' => 'container p-4 border rounded text-white bg-dark',
    'style' => 'max-width: 400px; margin-top: 100px;'
]);

$header = new Component('div', ['class' => 'text-center'], 'Login To Your Account');
$form->addGeneralComponent($header);

$lableUsername = new Component('label', ['for' => 'username'], 'Username: ');
$form->addCustomComponent('username', $lableUsername);

$lablePassword = new Component('label', ['for' => 'password'], 'Password: ');
$form->addCustomComponent('password', $lablePassword);


$form->addInput('username', 'text', [
    'id' => 'username',
    'placeholder' => 'EnterUsername',
    'class' => 'form-control mb-2',
]);

$form->addInput('Reset password', '', [
    'href' => 'http://api.cms.test/reset',
], 'link');

$form->addInput('password', 'password', [
    'id' => 'password',
    'placeholder' => '**********',
    'class' => 'form-control mb-2',
]);



$form->addInput('submit', 'submit', [
    'value' => 'Login Now',
    'class' => 'btn btn-primary w-100',
]);

$form->setFormGroupWrapping('submit', true);
$form->setFormGroupWrapping('username', true);
$form->setFormGroupWrapping('password', true);

echo $form->render();