{use class="Yii"}
{use class='yii\helpers\Html'}
{use class="app\models\Book"}

<h1>Índice de sitio.</h1>

{if Yii::$app->user->isGuest}
  hola invitado, {Html::a('login', ['site/login'])}
{else}
  {assign "user" Yii::$app->user->identity}
  <p>hola {$user->username} 👋</p>
  <p>has votado {$user->votesCount} veces y
    promedio de {$user->votesAvg}</p>
{/if}


<p>
  Hay {Html::a("{$book_count} libros", ['book/all'])} y
  {Html::a("{$author_count} autores", ['author/all'])}
  registrados en el sistema.
</p>
<h3>acciones:</h3>
<ul>
  <li>{Html::a('crear libro', ['book/new'])}</li>
  <li>{Html::a('agregar autor', ['author/new'])}</li>
</ul>
