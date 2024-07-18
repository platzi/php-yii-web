{use class="yii\helpers\Html"}
{use class="yii\widgets\ActiveForm" type="block"}
{use class="Yii"}

{title}{$book->title}{/title}
<h1>{$this->title}</h1>

<p>Un libro de {$book->author->name}.</p>

{if Yii::$app->user->identity->hasBook($book->id)}
  {Html::a('ya no lo tengo')}
  {ActiveForm id="new-score" assign="forma" action=['book/score']}
    {$forma->field($book_score, 'score')
      ->dropDownList([
        1 => '⭐️',
        2 => '⭐️⭐️',
        3 => '⭐️⭐️⭐️',
        4 => '⭐️⭐️⭐️⭐️',
        5 => '⭐️⭐️⭐️⭐️⭐️'
      ])}
    {$forma->field($book_score, 'book_id')->hiddenInput()->label(false)}
    <input type="submit" value="calificar">
  {/ActiveForm}
{else}
  <p>
    {Html::a('tengo este libro',
    ['book/i-own-this-book', 'book_id' => $book->id])}
  </p>
{/if}
