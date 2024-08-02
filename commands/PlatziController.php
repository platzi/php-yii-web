<?php

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;

use app\models\Book;
use app\models\Author;

/**
 * Comando para clase, de prueba
 */
class PlatziController extends Controller {

  /**
   * Suma los valores de los dos parámetros
   */
  public function actionSuma($a, $b = 17) {
    $result = $a + $b;
    printf("%0.2f\n", $result);
    return ExitCode::OK;
  }

  public function actionBooks($file) {
    $f = fopen($file, "r");
    while(!feof($f)) {
      $data = fgetcsv($f);
      if(!empty($data[1]) && !empty($data[2])) {
        $author = Author::find()
          ->where(['name' => $data[2]])
          ->one();
        if(empty($author)) {
          $author = new Author;
          $author->name = $data[2];
          $author->save();
        }

        $book = new Book;
        $book->title = $data[1];
        $book->author_id = $author->id;
        $book->save();
        printf("%s\n", $book->toString());
      }
    }
    fclose($f);
    return ExitCode::OK;
  }

  public function actionAuthor($author_id) {
    //$author = Author::find()->where(['author_id' => $author_id])->one();
    $author = Author::findOne($author_id);
    if(empty($author)) {
      printf("no existe el author\n");
      return ExitCode::DATAERR;
    }
    printf("%s:\n", $author->toString());
    foreach($author->books as $book) {
      printf(" - %s\n", $book->toString());
    }
    return ExitCode::OK;
  }

  public function actionBook($book_id) {
    $book = Book::findOne($book_id);
    if(empty($book)) {
      printf("No existe el libro\n");
      return ExitCode::DATAERR;
    }
    printf("%s\n", $book->toString());
    return ExitCode::OK;
  }
}
