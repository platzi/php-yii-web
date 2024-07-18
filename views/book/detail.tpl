{use class="yii\helpers\Html"}
{use class="Yii"}

{title}{$book->title}{/title}
<h1>{$this->title}</h1>

<p>Un libro de {$book->author->name}.</p>

{if Yii::$app->user->identity->hasBook($book->id)}
  {Html::a('ya no lo tengo')}
  //formulario -> ['book/score']
  // 1-5
  // cierro formulario
{else}
  <p>
    {Html::a('tengo este libro',
    ['book/i-own-this-book', 'book_id' => $book->id])}
  </p>
{/if}
