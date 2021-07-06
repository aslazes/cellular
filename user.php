<?php
require 'db.php';

$data = $_POST;
if ( isset($data['add_it']) ){
  $passport = $data['passport'];
  $fio = $data['fio'];
  $adress = $data['adres'];
  $query = "INSERT INTO `user`(`pasport`, `fio`, `adress`) VALUES ('$passport','$fio','$adress')";
  $result2 = mysqli_query($connect, $query);
}

$query = 'SELECT * FROM `user` WHERE 1';
$result1 = mysqli_query($connect, $query);
?>
<html>
 <meta charset="utf-8">
    <head>

		<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src ="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js" ></script>

       <link rel="stylesheet" href="css/style.css">
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="css/left-nav-style.css">
    <script src="https://kit.fontawesome.com/9fb570b56f.js" crossorigin="anonymous"></script>
	   <script >
     $(document).ready( function () {
         $('#example').DataTable({

       language: {
            "processing": "Подождите...",
         "search": "Поиск:",
         "lengthMenu": "Показать _MENU_ записей",
         "info": "Записи с _START_ до _END_ из _TOTAL_ записей",
         "infoEmpty": "Записи с 0 до 0 из 0 записей",
         "infoFiltered": "(отфильтровано из _MAX_ записей)",
         "infoPostFix": "",
         "loadingRecords": "Загрузка записей...",
         "zeroRecords": "Записи отсутствуют.",
         "emptyTable": "В таблице отсутствуют данные",
         "paginate": {
           "first": "Первая",
           "previous": "Предыдущая",
           "next": "Следующая",
           "last": "Последняя"
         },
         "aria": {
           "sortAscending": ": активировать для сортировки столбца по возрастанию",
           "sortDescending": ": активировать для сортировки столбца по убыванию"
         },
         "select": {
           "rows": {
             "_": "Выбрано записей: %d",
             "0": "Кликните по записи для выбора",
             "1": "Выбрана одна запись"
           }
         }
         }

       });
       $(".popup_bg").click(function(){
     		$(".popup").fadeOut(800);
     	});
     });
     function showPopup() {
     	$(".popup").fadeIn(800);
     }

        </script>
    </head>

    <body>

      <div class="popup">
      <div class="popup_bg"></div>
      <div class="form">
        <form method="POST" id = "form-mess">

    <p>Паспортные данные <br /><input type = "text" name="passport"></p>
    <p>ФИО <br /><input type = "text" name="fio"></p>
    <p>Адрес <br /><input type = "text" name="adres"></p>
    <input class = "btn-primary"  type="submit" name="add_it" value="Добавить" />
    </form>
    </div>
    </div>

<input type="checkbox" id="nav-toggle" hidden>
    <nav class="nav">

        <label for="nav-toggle" class="nav-toggle" onclick></label>

        <h2 class="logo">
            <a href="#1">Кабинет Оператора связи</a>
        </h2>
        <ul>
            <li><a href="user.php">Абоненты</a>
            <li><a href="oper.php">Оператор</a>
            <li><a href="connect.php">Подключение</a>
        </ul>


    </nav>

                  <div class="card-body">
                      <button onclick = "showPopup();" style=" float: right;" class="btn btn-info btn-sm far fa-edit" ></button>
                      <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">


    <table id="example" class="display" cellspacing="0" width="100%">
        <thead>
          <th>ID</th>
  				<th>Паспортные данные</th>
  				<th>ФИО</th>
  				<th>Адрес</th>
          	<th></th>
        </thead>
        <tbody>
            <?php while($row1 = mysqli_fetch_array($result1)):;?>
            <tr>
                <td align="center"><?php echo $row1[0];?></td>
				<td align="center"><a pk-id ="<?php echo $row1[0];?>" pole = 'pasport' id = "passport" href = "#"> <?php echo $row1[1];?></a> </td>
        <td align="center"><a pk-id ="<?php echo $row1[0];?>" pole = 'fio' id = "fio" href = "#"> <?php echo $row1[2];?></a> </td>
				<td align="center"><a pk-id ="<?php echo $row1[0];?>" pole = 'adress' id = "adr" href = "#"> <?php echo $row1[3];?></a> </td>
        <td> <button id="del" pk-id = "<?php echo $row1[0]; ?>"class="btn btn-danger btn-sm fas fa-trash" ></button> </td>
                </tr>
            <?php endwhile;?>
        </tbody>
        </table>
      </div>
      </div>

    </body>

</html>
</div>
<script>

$(document).on('click', '#del', function() {
  var pk = $(this).attr("pk-id")
  $.post(
  "ajax.php",
  {
  id:pk,
  table:'user',
  param:'del'
  },
  onAjaxSuccess
);
function onAjaxSuccess(data)
{


}
 $(this).parent().parent().remove();

});
$(document).on('click', '#passport', function() {
  var pk = $(this).attr("pk-id")
  var name = $(this).html()
  var pole = $(this).attr("pole")
  $("<input pole = '"+pole+"' id = 'change' type= 'text' value = '"+ name +"'>&nbsp;<button pk-id = '"+ pk + "'id = 'ok' class='btn btn-success btn-sm fas fa-check'></button>&nbsp;<button pk-id = '"+ pk + "' id = 'cancel' class='btn btn-danger btn-sm fas fa-times'></button>").replaceAll($(this));

});

$(document).on('click', '#cancel', function() {
  var pk = $(this).attr("pk-id")
  var name = $('#change').val()
  var pole = $('#change').attr("pole")
  $("<a pk-id='"+pk+"' pole= '"+pole+"' id='passport' href='#'>"+name + "</a>").replaceAll($('#change'));
	 $('#ok').remove();
	 $(this).remove();

});

$(document).on('click', '#ok', function() {
  var pk = $(this).attr("pk-id")
  var pole = $('#change').attr("pole")
  var name = $('#change').val()
  $("<a pk-id='"+pk+"' pole= '"+pole+"' id='passport' href='#'>"+name + "</a>").replaceAll($('#change'));
	 $(this).remove();
	 $('#cancel').remove();
	 $.post(
  "ajax.php",
  {
   id:pk,
   name:name,
   pole:pole,
   table:'user',
   param:'change'
  },
  onAjaxSuccess
);
function onAjaxSuccess(data)
{


}
});

$(document).on('click', '#fio', function() {
  var pk = $(this).attr("pk-id")
  var name = $(this).html()
  var pole = $(this).attr("pole")
  $("<input pole = '"+pole+"' id = 'changefio' type= 'text' value = '"+ name +"'>&nbsp;<button pk-id = '"+ pk + "'id = 'okfio' class='btn btn-success btn-sm fas fa-check'></button>&nbsp;<button pk-id = '"+ pk + "' id = 'cancelfio' class='btn btn-danger btn-sm fas fa-times'></button>").replaceAll($(this));

});

$(document).on('click', '#cancelfio', function() {
  var pk = $(this).attr("pk-id")
  var name = $('#changefio').val()
  var pole = $('#changefio').attr("pole")
  $("<a pk-id='"+pk+"' pole= '"+pole+"' id='fio' href='#'>"+name + "</a>").replaceAll($('#changefio'));
	 $('#okfio').remove();
	 $(this).remove();

});
$(document).on('click', '#okfio', function() {
  var pk = $(this).attr("pk-id")
  var pole = $('#changefio').attr("pole")
  var name = $('#changefio').val()
  $("<a pk-id='"+pk+"' pole= '"+pole+"' id='fio' href='#'>"+name + "</a>").replaceAll($('#changefio'));
	 $(this).remove();
	 $('#cancelfio').remove();
	 $.post(
  "ajax.php",
  {
   id:pk,
   name:name,
   pole:pole,
   table:'user',
   param:'change'
  },
  onAjaxSuccess
);
function onAjaxSuccess(data)
{


}
});

$(document).on('click', '#adr', function() {
  var pk = $(this).attr("pk-id")
  var name = $(this).html()
  var pole = $(this).attr("pole")
  $("<input pole = '"+pole+"' id = 'changeadr' type= 'text' value = '"+ name +"'>&nbsp;<button pk-id = '"+ pk + "'id = 'okadr' class='btn btn-success btn-sm fas fa-check'></button>&nbsp;<button pk-id = '"+ pk + "' id = 'canceladr' class='btn btn-danger btn-sm fas fa-times'></button>").replaceAll($(this));

});
$(document).on('click', '#canceladr', function() {
  var pk = $(this).attr("pk-id")
  var name = $('#changeadr').val()
  var pole = $('#changeadr').attr("pole")
  $("<a pk-id='"+pk+"' pole= '"+pole+"' id='fio' href='#'>"+name + "</a>").replaceAll($('#changeadr'));
	 $('#okadr').remove();
	 $(this).remove();

});
$(document).on('click', '#okadr', function() {
  var pk = $(this).attr("pk-id")
  var pole = $('#changeadr').attr("pole")
  var name = $('#changeadr').val()
  $("<a pk-id='"+pk+"' pole= '"+pole+"' id='adr' href='#'>"+name + "</a>").replaceAll($('#changeadr'));
	 $(this).remove();
	 $('#canceladr').remove();
	 $.post(
  "ajax.php",
  {
   id:pk,
   name:name,
   pole:pole,
   table:'user',
   param:'change'
  },
  onAjaxSuccess
);
function onAjaxSuccess(data)
{


}
});
</script>
<style>
.popup {
	position: absolute;
	height:100%;
	width:100%;
	top:0;
	left:0;
	display:none;
}


	.popup_bg {
		background:rgba(0,0,0,0.4);
		position:absolute;
		z-index:1;
		height:100%;
		width:100%;
	}
  .form {
    position: relative;
    margin:4px auto;
    z-index:2;
    width:500px;
    padding:40px 20px;
    background:#FFFFFF;
    border:1px solid #666666;
    border-radius:20px;
    box-shadow:0 0 2px rgba(0,0,0,0.5);
  }

    .form input {
      width:96%;
      padding:5px 2%;
      margin:10px 0;
      border-radius:4px;
    }
  p.clip {

    -ms-text-overflow: ellipsis;
  text-overflow: ellipsis;
  overflow: hidden;
  -ms-line-clamp: 1;
  -webkit-line-clamp: 1;
  line-clamp: 1;
  display: -webkit-box;
  display: box;
  word-wrap: break-word;
  -webkit-box-orient: vertical;
  box-orient: vertical;
  font-size: 15px;
  line-height: 19px;
   }
</style>
