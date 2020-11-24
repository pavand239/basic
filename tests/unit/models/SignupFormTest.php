<?php

namespace tests\unit\models;

use app\models\SignupForm;

class SignupFormTest extends \Codeception\Test\Unit
{
    private $model;

    protected function _after()
    {
        \Yii::$app->user->logout();
    }

    public function testExistingUser()
    {
        $this->model = new SignupForm([
            'username' => 'pavand239',
            'password' => '111111'
        ]);
        $this->assertFalse($this->model->validate());
        expect($this->model->errors)->hasKey('username');
    }
    public function testEmptyUsername()
    {
        $this->model = new SignupForm([
            'username' => '',
            'password' => '111111'
        ]);
        $this->assertFalse($this->model->validate());
        expect($this->model->errors)->hasKey('username');
    }
    public function testEmptyPassword()
    {
        $this->model = new SignupForm([
            'username' => 'testLogin',
            'password' => ''
        ]);
        $this->assertFalse($this->model->validate());
        expect($this->model->errors)->hasKey('password');
    }
    public function testCorrectSignup()
    {
        $this->model = new SignupForm([
            'username' => 'testLogin',
            'password' => 'P@ssw0rd'
        ]);
        $this->assertTrue($this->model->validate());
    }
}