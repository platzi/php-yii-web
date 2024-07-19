<?php

use yii\helpers\Html;

?>

<h1><?= $author->toString() ?></h1>

<p>El promedio de todas sus obras es:
  <?= $author->score ?>
</p>

<h2>Libros:</h2>
<ol>
<?php foreach($author->books as $book) {?>
  <li>
    <?= Html::a($book->title, ['book/detail', 'id' => $book->id]) ?>
    <?= $book->author->getScore($book->id) ?>
  </li>
<?php } ?>
</ol>
