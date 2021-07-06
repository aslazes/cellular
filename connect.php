<?php
require 'db.php';

$data = $_POST;
if ( isset($data['add_it']) ){
  $number = $data['number'];
  $tarif = $data['tarif'];
  $balance= $data['balance'];
  $date= $data['date'];
  $query = "INSERT INTO `connect`(`number`, `tarif`, `balance`, `date`) VALUES ('$number','$tarif','$balance','$date')";
  $result2 = mysqli_query($connect, $query);
}

$query = 'SELECT * FROM `connect` WHERE 1';
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

    <p>Номер <br /><input type = "text" name="number"></p>
    <p>Тариф <br /><input type = "text" name="tarif"></p>
    <p>Баланс <br /><input type = "text" name="balance"></p>
    <p>Дата подключения <br /><input type = "text" name="date"></p>
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
  				<th>Номер</th>
  				<th>Тариф</th>
  				<th>Баланс</th>
          <th>Дата подключения</th>
          	<th></th>
        </thead>
        <tbody>
            <?php while($row1 = mysqli_fetch_array($result1)):;?>
            <tr>
                <td align="center"><?php echo $row1[0];?></td>
				<td align="center"><a pk-id ="<?php echo $row1[0];?>" pole = 'number' id = "number" href = "#"> <?php echo $row1[1];?></a> </td>
        <td align="center"><a pk-id ="<?php echo $row1[0];?>" pole = 'tarif' id = "tarif" href = "#"> <?php echo $row1[2];?></a> </td>
				<td align="center"><a pk-id ="<?php echo $row1[0];?>" pole = 'balance' id = "balance" href = "#"> <?php echo $row1[3];?></a> </td>
        <td align="center"><a pk-id ="<?php echo $row1[0];?>" pole = 'date' id = "date" href = "#"> <?php echo $row1[4];?></a> </td>
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
  table:'connect',
  param:'del'
  },
  onAjaxSuccess
);
function onAjaxSuccess(data)
{


}
 $(this).parent().parent().remove();

});
$(document).on('click', '#number', function() {
  var pk = $(this).attr("pk-id")
  var name = $(this).html()
  var pole = $(this).attr("pole")
  $("<input pole = '"+pole+"' id = 'change' type= 'text' value = '"+ name +"'>&nbsp;<button pk-id = '"+ pk + "'id = 'ok' class='btn btn-success btn-sm fas fa-check'></button>&nbsp;<button pk-id = '"+ pk + "' id = 'cancel' class='btn btn-danger btn-sm fas fa-times'></button>").replaceAll($(this));

});

$(document).on('click', '#cancel', function() {
  var pk = $(this).attr("pk-id")
  var name = $('#change').val()
  var pole = $('#change').attr("pole")
  $("<a pk-id='"+pk+"' pole= '"+pole+"' id='number' href='#'>"+name + "</a>").replaceAll($('#change'));
	 $('#ok').remove();
	 $(this).remove();

});

$(document).on('click', '#ok', function() {
  var pk = $(this).attr("pk-id")
  var pole = $('#change').attr("pole")
  var name = $('#change').val()
  $("<a pk-id='"+pk+"' pole= '"+pole+"' id='number' href='#'>"+name + "</a>").replaceAll($('#change'));
	 $(this).remove();
	 $('#cancel').remove();
	 $.post(
  "ajax.php",
  {
   id:pk,
   name:name,
   pole:pole,
   table:'connect',
   param:'change'
  },
  onAjaxSuccess
);
function onAjaxSuccess(data)
{


}
});

$(document).on('click', '#tarif', function() {
  var pk = $(this).attr("pk-id")
  var name = $(this).html()
  var pole = $(this).attr("pole")
  $("<input pole = '"+pole+"' id = 'changetarif' type= 'text' value = '"+ name +"'>&nbsp;<button pk-id = '"+ pk + "'id = 'oktarif' class='btn btn-success btn-sm fas fa-check'></button>&nbsp;<button pk-id = '"+ pk + "' id = 'canceltarif' class='btn btn-danger btn-sm fas fa-times'></button>").replaceAll($(this));

});

$(document).on('click', '#canceltarif', function() {
  var pk = $(this).attr("pk-id")
  var name = $('#changetarif').val()
  var pole = $('#changetarif').attr("pole")
  $("<a pk-id='"+pk+"' pole= '"+pole+"' id='tarif' href='#'>"+name + "</a>").replaceAll($('#changetarif'));
	 $('#oktarif').remove();
	 $(this).remove();

});
$(document).on('click', '#oktarif', function() {
  var pk = $(this).attr("pk-id")
  var pole = $('#changetarif').attr("pole")
  var name = $('#changetarif').val()
  $("<a pk-id='"+pk+"' pole= '"+pole+"' id='tarif' href='#'>"+name + "</a>").replaceAll($('#changetarif'));
	 $(this).remove();
	 $('#canceltarif').remove();
	 $.post(
  "ajax.php",
  {
   id:pk,
   name:name,
   pole:pole,
   table:'connect',
   param:'change'
  },
  onAjaxSuccess
);
function onAjaxSuccess(data)
{


}
});

$(document).on('click', '#balance', function() {
  var pk = $(this).attr("pk-id")
  var name = $(this).html()
  var pole = $(this).attr("pole")
  $("<input pole = '"+pole+"' id = 'changebalance' type= 'text' value = '"+ name +"'>&nbsp;<button pk-id = '"+ pk + "'id = 'okbalance' class='btn btn-success btn-sm fas fa-check'></button>&nbsp;<button pk-id = '"+ pk + "' id = 'cancelbalance' class='btn btn-danger btn-sm fas fa-times'></button>").replaceAll($(this));

});
$(document).on('click', '#cancelbalance', function() {
  var pk = $(this).attr("pk-id")
  var name = $('#changebalance').val()
  var pole = $('#changebalance').attr("pole")
  $("<a pk-id='"+pk+"' pole= '"+pole+"' id='balance' href='#'>"+name + "</a>").replaceAll($('#changebalance'));
	 $('#okbalance').remove();
	 $(this).remove();

});
$(document).on('click', '#okbalance', function() {
  var pk = $(this).attr("pk-id")
  var pole = $('#changebalance').attr("pole")
  var name = $('#changebalance').val()
  $("<a pk-id='"+pk+"' pole= '"+pole+"' id='balance' href='#'>"+name + "</a>").replaceAll($('#changebalance'));
	 $(this).remove();
	 $('#cancelbalance').remove();
	 $.post(
  "ajax.php",
  {
   id:pk,
   name:name,
   pole:pole,
   table:'connect',
   param:'change'
  },
  onAjaxSuccess
);
function onAjaxSuccess(data)
{


}
});

$(document).on('click', '#date', function() {
  var pk = $(this).attr("pk-id")
  var name = $(this).html()
  var pole = $(this).attr("pole")
  $("<input pole = '"+pole+"' id = 'changedate' type= 'text' value = '"+ name +"'>&nbsp;<button pk-id = '"+ pk + "'id = 'okdate' class='btn btn-success btn-sm fas fa-check'></button>&nbsp;<button pk-id = '"+ pk + "' id = 'canceldate' class='btn btn-danger btn-sm fas fa-times'></button>").replaceAll($(this));

});
$(document).on('click', '#canceldate', function() {
  var pk = $(this).attr("pk-id")
  var name = $('#changedate').val()
  var pole = $('#changedate').attr("pole")
  $("<a pk-id='"+pk+"' pole= '"+pole+"' id='date' href='#'>"+name + "</a>").replaceAll($('#changedate'));
	 $('#okdate').remove();
	 $(this).remove();

});
$(document).on('click', '#okdate', function() {
  var pk = $(this).attr("pk-id")
  var pole = $('#changedate').attr("pole")
  var name = $('#changedate').val()
  $("<a pk-id='"+pk+"' pole= '"+pole+"' id='count' href='#'>"+name + "</a>").replaceAll($('#changedate'));
	 $(this).remove();
	 $('#canceldate').remove();
	 $.post(
  "ajax.php",
  {
   id:pk,
   name:name,
   pole:pole,
   table:'connect',
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
