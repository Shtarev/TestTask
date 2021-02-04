// JavaScript Document

function pagiGet(key) {
    document.getElementById('key').value = key;
    document.getElementById('pagiGet').method = 'GET';
    document.getElementById('pagiGet').submit();
}

function getInPostSort(i) {
    var text = 'Нажмите ДА, для сортировки по возростанию и НЕТ для сортировки в обратном порядке';
    if(i == 'status') {
        text = 'Нажмите ДА, для отображения начала невыполненных заданий или НЕТ для показа сначала выполненных';
    }
    
    var ergebnis = confirm(text);
    if(ergebnis) {
        document.getElementById('tip').value = 'ASC';
    }
    else {
        document.getElementById('tip').value = 'DESC';
    }
    document.getElementById('getInPostSort').method = 'GET';
    document.getElementById('sort').value = i;
    document.getElementById('getInPostSort').submit();
}

// удаляет js из инпутов или меняет на сущности    
function scripRep(item, rep=true, losch=true) {    
    var form = item.parentNode; // находим родителя    
    if(rep) {  
        var i = 0;  
        while(i < form.length){  
            var str = form[i].value;  
            var a = str.toLowerCase();  
            var erst = a.indexOf('<script>');  
            if(erst != -1) {  
                var end = a.lastIndexOf('<\/script>');  
                var scrip = str.substring(erst, end+9);  
                if(losch) {  
                    form[i].value = str.replace(scrip, ''); // замена скрипта на ''
                    form[i].value = str.replace(/<script>/g, '').replace(/<\/script>/g, ''); // убираем если есть хвосты
                }  
                else {  
                    form[i].value = str.replace(scrip, ' !- JS-SCRIPT -! '); // замена скрипта на ' !- JS-SCRIPT -! '
                    form[i].value = str.replace(/<script>/g, '').replace(/<\/script>/g, ''); // убираем если есть хвосты
                }  
            }  
            i++;   
        }   
    }  
    else {  
        var i = 0;  
        while(i < form.length){      
            var  str = form[i].value    
            form[i].value = str.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');  // угловых скобок на сущности  
            i++;    
        }  
    }  
    form.submit();  
}

function delTask(id) {
    var result = confirm("Вы хотите удалить данные?");  
    if(result){  
        document.getElementById('del').value = id;
        document.getElementById('delTask').submit();
    } 
}

function redTask(id) { 
    document.getElementById('red').value = id;
    document.getElementById('redTask').submit();
}

function aus() {
    document.getElementById('aus').submit();
}