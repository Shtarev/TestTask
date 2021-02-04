<div class="row">
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Статус</th>
      <th scope="col">Имя</th>
      <th scope="col">E-Mail</th>
      <th scope="col">Задача</th>
      <th scope="col">Рецензия</th>
    </tr>
  </thead>
  <tbody>
  <?php
  foreach($data['table'] as $key=>$value) {
      echo "
        <tr>
          <th scope=\"row\">".($value['status'] ? 'Выполнено' : 'Ожидание')."</th>
          <td>".$value['name']."</td>
          <td>".$value['email']."</td>
          <td>".$value['task']."</td>
          <td>".($value['redact'] ? 'Oтредактировано' : 'Исходный текст')."</td>
        </tr>
      ";
  }
  ?>
  </tbody>
</table>
</div>
<div class="row mb-5">
<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item disabled" style="display:<?=$data['startnein']?>"><a class="page-link" href="\" tabindex="-1" aria-disabled="true">Начало</a></li>
    <li class="page-item" style="display:<?=$data['startja']?>"><a class="page-link" href="" onClick="pagiGet(<?=$data['start']?>); return false;">Начало</a></li>
    <?php
    foreach($data['pagi'] as $key => $value){
        if($key == $data['key']){
            echo "
            <li class=\"page-item active\" aria-current=\"page\">
                <a class=\"page-link\" href=\"\" onClick=\"pagiGet(".$key."); return false;\">".++$key." <span class=\"sr-only\">(current)</span></a>
            </li>
        ";
        }
        else{
            echo "<li class=\"page-item\"><a class=\"page-link\" href=\"\" onClick=\"pagiGet(".$key."); return false;\">".++$key."</a></li>";
        }
    }
    ?>
    <li class="page-item disabled" style="display:<?=$data['endnein']?>"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Конец</a></li>
    <li class="page-item"  style="display:<?=$data['endja']?>"><a class="page-link" href="" onClick="pagiGet(<?=$data['end']?>); return false;">Конец</a></li>
  </ul>
</nav>
</div>
<form id="pagiGet" action="/index/index/" method="POST">
    <input type="hidden" value="" id="key" name="key">
</form>