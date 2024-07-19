{use class="yii\helpers\Html"}
{use class="yii\widgets\ActiveForm" type="block"}
{use class="Yii"}

{title}{$book->title}{/title}
<h1>{$this->title}</h1>

<p>Un libro de {Html::a($book->author->name, ['author/detail', 'id' => $book->author->id])}.</p>

<p>El promedio de este libro es de: {$book->getScore()}</p>

{assign "user" Yii::$app->user->identity}
{if $user->hasBook($book->id)}
  <p>{Html::a('ya no lo tengo', ['book/all'])} (no hace nada)<p>
  {if $user->hasVotedFor($book->id)}
    Ya votaste, tu voto fue de: {$user->getVoteForBook($book->id)->score}.
  {else}
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
  {/if}
{else}
  <p>
    {Html::a('tengo este libro',
    ['book/i-own-this-book', 'book_id' => $book->id])}
  </p>
{/if}
