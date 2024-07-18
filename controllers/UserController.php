<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;
use Exception;

class UserController extends Controller {

  public function actionNew() {
    if(!Yii::$app->user->isGuest) {
      Yii::$app->session->setFlash('warning', 'no puedes crear usuario estando logeado');
      return $this->goHome();
    }

    $user = new User;

    if($user->load(Yii::$app->request->post())) {
      //hay algo en POST que es para mí
      if($user->validate()) {
        //lo que cargué validó bien
        if($user->save()) {
          //lo que validé se salvó en la base de datos
          Yii::$app->session->setFlash("success", 'usuario guardado correctamente');
          return $this->redirect(['site/login']);
        } else {
          throw new Exception("error al salvar el usuario");
          return;
        }
      }
      $user->password = '';
      $user->password_repeats = '';
    }

    return $this->render('new.tpl', ['user' => $user]);
  }

}
