<?php

namespace app\models;

use yii\db\ActiveRecord;

class Author extends ActiveRecord {

  public static $nationalities =  [
    'mx' => 'méxico',
    'us' => 'estados unidos',
    'ca' => 'canadá',
    'co' => 'colombia',
    'pe' => 'perú',
    'ar' => 'argentina',
    'es' => 'españa',
    'de' => 'alemania',
    'uk' => 'reino unido',
    'gr' => 'grecia',
    'it' => 'italia',
    'fr' => 'francia',
    'ie' => 'irlanda',
  ];

  public static function tableName() {
    return 'authors';
  }

  public function rules() {
    return [
      ['name', 'required'],
      ['name', 'filter', 'filter' => function($v) {
        $v = trim($v);
        $v = ucwords($v);
        return $v;
      }],
      ['name', 'string', 'length' => [4, 100]],
      ['nationality', 'default'],
      ['nationality', 'filter', 'filter' => function($v) {
        if($v == '--') {
          $v = null;
        }
        return $v;
      }],
      ['nationality', 'string', 'length' => [2,2]],
    ];
  }

  public function getId() {
    return $this->author_id;
  }

  public function toString() {
    return sprintf("%s (%s)", $this->name, count($this->books));
  }

  public function getBooks() {
    return $this
      ->hasMany(Book::class, ['author_id' => 'author_id'])
      ->all();
  }

  public static function getAuthorList() {
    $authors = self::find()->orderBy('name')->all();
    $ret = [];
    foreach($authors as $author) {
      $ret[$author->id] = $author->name;
    }
    return $ret;
  }

  public static function getNationalitiesList() {
    return array_merge(
      ['--' => 'nacionalidad'],
      self::$nationalities
    );
  }
}
