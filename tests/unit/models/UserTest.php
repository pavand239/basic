<?php

namespace tests\unit\models;

use app\models\User;

class UserTest extends \Codeception\Test\Unit
{
    public function testFindUserById()
    {
        expect_that($user = User::findIdentity(1));
        expect($user->username)->equals('pavand');

        expect_not(User::findIdentity(999));
    }

    public function testFindUserByAccessToken()
    {
        expect_that($user = User::findIdentityByAccessToken('1s8yLK5tzT_6HzQik-mQ4L9Ko8t1IesyRSrJj0ran_agu5Ei2CL2DpRc40COmXCmRgNDKSBh9BR8q76cmPw2m7OJ4LrGpU4qMGFWPKdrErUl-B17RpmSTXSG8t9C7nbg3dEkH_FEVXWm0OqPGk4d3iylLAwy7jlXGJwUm6CiF6blaSX-vsd_pd-qPNCb25h6Rud_3XtLYik3RSfkuscOSTSThar7NYuCXG0WH8KWvPEq12vOQlrjRDXWpYsHHnA'));
        expect($user->username)->equals('pavand');

        expect_not(User::findIdentityByAccessToken('non-existing'));        
    }

    public function testFindUserByUsername()
    {
        expect_that($user = User::findByUsername('pavand'));
        expect_not(User::findByUsername('admin'));
    }

    /**
     * @depends testFindUserByUsername
     */
    public function testValidateUser()
    {
        $user = User::findByUsername('pavand');
        expect_that($user->validateAuthKey('U9LIXcFNdRyaVGJmNyxmRAWYHIXHnTNc'));
        expect_not($user->validateAuthKey('test102key'));

        expect_that($user->validatePassword('P@ssw0rd'));
        expect_not($user->validatePassword('123456'));        
    }

    public function testCreateUser() {
        $user = User::createUser('testLogin','1234');
        expect_that($user->username == 'testLogin');
        expect_not($user->username == 'login');

        expect_that($user->validatePassword('1234'));
        expect_not($user->validatePassword('1222123'));
        $user->delete();
    }
}
