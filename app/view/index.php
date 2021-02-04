<div class="row">
<div class="col-lg-8 col-12">
  <div class="row mb-3">
    <div class="col-lg-6 col-12">
      <h3 class="text-center mt-3">Имеющиеся задачи</h3>
    </div>
    <div class="col-lg-6 col-12">
      <h5 class="text-center">Сортировать по:</h5>
      <div class="col text-center">
        <button type="button" class="btn btn-primary" onClick="getInPostSort('status')">Статусу</button>
        <button type="button" class="btn btn-primary" onClick="getInPostSort('name')">Имени</button>
        <button type="button" class="btn btn-primary" onClick="getInPostSort('email')">E-Mail</button>
      </div>
    </div>
  </div>
  <form id="getInPostSort" action="/index/index/" method="POST">
    <input type="hidden" value="" id="sort" name="sort">
    <input type="hidden" value="" id="tip" name="tip">
  </form>
  {blocks_table}
</div>
<hr>
<div class="col-lg-4 col-12">
  <div class="row mx-0">
    <div class="col-12 card bg-light mx-auto">
      <h3 class="text-center card-header">Новая задача</h3>
      <form class="card-body" action="/" method="POST">
        <div class="form-group row">
          <label for="staff_name" class="col-form-label">Сотрудник</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text" id="basic-addon2">⚤</div>
            </div>
            <input type="text" class="form-control" name="staff_name" id="staff_name" aria-describedby="basic-addon2" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="staff_email" class="col-form-label">E-Mail</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text" id="basic-addon1">✉</div>
            </div>
            <input type="email" class="form-control" name="staff_email" id="staff_email" aria-describedby="basic-addon1" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="staff_task" class="col-form-label">Задача</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text" id="basic-addon2">⚒</div>
            </div>
            <textarea class="form-control" name="staff_task" id="staff_task" aria-describedby="basic-addon2" required></textarea>
          </div>
        </div>
        <input type="hidden" name="token" value="{token}">
        <input type="hidden" name="action" value="submit">
        <input type="submit" class="btn btn-info form-control" value="Отправить задачу" onClick="scripRep(this)">
      </form>
    </div>
  </div>
  {notice}
</div>
</div>