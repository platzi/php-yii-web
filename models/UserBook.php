<?php

namespace app\models;

use yii\db\ActiveRecord;

class UserBook extends ActiveRecord {

  public static function tableName() {
    return 'user_books';
  }

  public function getId() {
    return $this->user_book_id;
  }
}
