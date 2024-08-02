<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Book;
use app\models\UserBook;
use app\models\BookScore;

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

    $bs = new BookScore;
    $bs->book_id = $book->id;

    return $this->render('detail.tpl', ['book' => $book,
      'book_score' => $bs]);
  }

  public function actionScore() {
    $bs = new BookScore();
    if($bs->load(Yii::$app->request->post())) {
      $bs->user_id = Yii::$app->user->identity->id;
      if($bs->validate()) {
        if($bs->save()) {
          Yii::$app->session->setFlash('success', 'gracias por tu calificacion');
          return $this->redirect(['book/detail', 'id' => $bs->book_id]);
        }
      }
    }
    return $this->redirect(['book/all']);
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

  public function actionIOwnThisBook($book_id) {
    if(Yii::$app->user->isGuest) {
      return $this->goHome();
    }
    $ub = new UserBook;
    $ub->user_id = Yii::$app->user->identity->id;
    $ub->book_id = $book_id;
    $ub->save();
    Yii::$app->session->setFlash('success', 'chido!');
    return $this->redirect(['book/detail', 'id' => $book_id]);
  }

}
