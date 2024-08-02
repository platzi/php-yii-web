{use class="yii\widgets\ActiveForm" type="block"}
<h1>crear usuario</h1>

{ActiveForm id="new-user" assign="form"}
  {$form->field($user, 'username')}
  {$form->field($user, 'email')}
  {$form->field($user, 'password')->passwordInput()}
  {$form->field($user, 'password_repeats')}
  {$form->field($user, 'bio')->textArea()}
  <input type="submit" value="guardar">
{/ActiveForm}
