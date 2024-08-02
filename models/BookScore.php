<?php

namespace app\models;

use yii\db\ActiveRecord;

class BookScore extends ActiveRecord {

  public static function tableName() {
    return 'book_scores';
  }

  public function getId() {
    return $this->book_score_id;
  }

  public function rules() {
    return [
      ['score', 'required'],
      ['score', 'integer'],
      ['book_id', 'default'],
    ];
  }
}
