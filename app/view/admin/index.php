<div class="row">
{notice}
<div class="col-lg-12 col-12">
  <div class="row mb-3">
    <div class="col-lg-4 col-12">
      <h3 class="text-left mt-3">Имеющиеся задачи</h3>
    </div>
    <div class="col-lg-8 col-12">
      <h5 class="text-right pr-3">Сортировать по:</h5>
      <div class="col text-right">
        <button type="button" class="btn btn-primary" onClick="getInPostSort('status')">Статусу</button>
        <button type="button" class="btn btn-primary" onClick="getInPostSort('name')">Имени</button>
        <button type="button" class="btn btn-primary" onClick="getInPostSort('email')">E-Mail</button>
      </div>
    </div>
  </div>
  <form id="getInPostSort" action="/admin/index/" method="POST">
    <input type="hidden" value="" id="sort" name="sort">
    <input type="hidden" value="" id="tip" name="tip">
  </form>
  {blocks_table}
</div>
</div>