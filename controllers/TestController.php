<?php
namespace app\controllers;

use app\models\Country;

use app\models\SignupForm;
use app\models\User;
use yii\data\Pagination;
use yii\web\Controller;

class TestController extends Controller
{
    public function actionIndex() {
        return $this->render('index');
    }

    public function actionSignup() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new SignupForm();
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $user = new User();
            $user->username = $model->username;
            $user->password = \Yii::$app->security->generatePasswordHash($model->password);
//            echo '<pre>';
//
//            $user->validate();
//            var_dump($user->firstErrors);
//            exit;

            if ($user->save()) {
                \Yii::$app->user->login($user, 0);
                return $this->goHome();
            }
            die;
        } else if (\Yii::$app->request->post() && !$model->validate()) {
            echo '<pre>';
            var_dump($model->errors);
            echo '</pre>';
        }
        return $this->render('signup', compact('model'));
    }

    public function actionCountry() {
        $query = Country::find();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count()
        ]);

        $countries = $query->orderBy('name')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('country', compact('countries', 'pagination'));
    }
}