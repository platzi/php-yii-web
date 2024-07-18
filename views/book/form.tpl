{use class="yii\widgets\ActiveForm" type="block"}
{use class="app\models\Author"}

{title}crear libro{/title}

<h1>{$this->title}</h1>

{ActiveForm assign="form" id="new-book"}
{$form->field($book, 'title')}
{$form->field($book, 'author_id')->dropDownList(Author::getAuthorList())}
<input type="submit">
{/ActiveForm}
