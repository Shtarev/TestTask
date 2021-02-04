<?php
foreach($data as $key=>$value) {
    echo '
    <li class="nav-item">
      <a class="nav-link" href="'.$value['url'].'">'.$value['title'].'</a>
    </li>
    ';
}