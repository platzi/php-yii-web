{use class="yii\widgets\ActiveForm" type="block"}
{use class="app\models\Author"}

<h1>nuevo autor</h1>

{ActiveForm id="new-author" assign="form"}
  {$form->field($author, 'name')}
  {$form->field($author, 'nationality')
    ->dropDownList(Author::getNationalitiesList())}
  <input type="submit" value="guardar">
{/ActiveForm}
