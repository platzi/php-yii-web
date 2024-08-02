{use class='yii\helpers\Html'}
<h1>todos los autores</h1>

<ol>
  {foreach $authors as $author}
  <li>{Html::a($author->name, ['author/detail', 'id' => $author->id])}
  {/foreach}
</ol>
