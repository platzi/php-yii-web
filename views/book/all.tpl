{use class="yii\helpers\Html"}

<h1>todos los libros
  {if $titulo > 2}muchos{else}pocos{/if}
</h1>

<ol>
  {foreach $books as $book}
  <li>{Html::a($book->toString(),
    ['book/detail', 'id' => $book->id])}
  </li>
  {/foreach}
</ol>
