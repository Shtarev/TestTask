{notice}
<br>
<form method="POST" action="/admin/red">
  <input type="hidden" name="id" value="{id}">
  <div class="form-row">
    <div class="col">
      <label for="name">Имя</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Имя" value="{name}" required>
    </div>
    <div class="col">
      <label for="email">E-Mail</label>
      <input type="email" class="form-control" name="email" placeholder="E-Mail" value="{email}" required>
    </div>
  </div>
  <br>
  <div class="form-group">
    <label for="task">Задание</label>
    <textarea class="form-control" id="task" name="task" rows="3" required>{task}</textarea>
    <textarea style="display: none" name="task_hidden">{task}</textarea>
  </div>
  <div class="form-check">
    <label class="form-check-label">
      <input type="checkbox" name="status" class="form-check-input" {status}>
      Если голочка, то статус "Выполнено"
    </label>
  </div>
  <button type="submit" class="btn btn-primary" onClick="scripRep(this)">Редактировать</button>
</form>