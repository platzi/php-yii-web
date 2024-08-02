<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Author;

class AuthorController extends Controller {

  public function actionDetail($id) {
    $author = Author::findOne($id);
    if(empty($author)) {
      Yii::$app->session->setFlash('warning', 'no existe ese autor');
      return $this->redirect(['author/all']);
    }
    return $this->render('detail', ['author' => $author]);
  }

  public function actionAll($search = null) {
    if($search !=  null) {
      $authors = Author::find()
        ->where(['like', 'name', $search])
        ->all();
    } else {
      $authors = Author::find()->orderBy('name')->all();
    }

    return $this->render('all.tpl', ['authors' => $authors]);
  }

  public function actionNew() {
    if(Yii::$app->user->isGuest) {
      return $this->goHome();
    }

    $author = new Author;
    if($author->load(Yii::$app->request->post())) {
      if($author->validate()) {
        if($author->save()) {
          Yii::$app->session->setFlash(
            'success',
            sprintf('%s ha sido guardado como autor', $author->name)
          );
        }
      }
    }
    return $this->render('new.tpl', ['author' => $author]);
  }

}
