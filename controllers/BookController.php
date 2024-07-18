<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Book;

class BookController extends Controller {

  public function actionAll() {
    $books = Book::find()->all();
    return $this->render('all.tpl', ['books' => $books, 'titulo' => 1]);
  }

  public function actionDetail($id) {
    $book = Book::findOne($id);
    if(empty($book)) {
      //return $this->redirect(['site/index']);
      Yii::$app->session->setFlash('success', 'ese libro no existe');
      return $this->goHome();
    }
    return $book->toString();
  }

  public function actionNew() {
    if(Yii::$app->user->isGuest) {
      return $this->goHome();
    }


    $book = new Book;

    if($book->load(Yii::$app->request->post())) {
      if($book->validate()) {
        if($book->save()) {
          Yii::$app->session->setFlash('succes', 'libro creado');
          return $this->redirect(['book/all']);
        }
      }
    }

    return $this->render('form.tpl', ['book' => $book]);
  }

}
