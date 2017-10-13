function ajaxCallItem(...args) {
    //console.log(document.getElementById(''+args[2]+''))
    if (args[1].length == 0) { 
        //document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById(''+args[1]+'').innerHTML=this.responseText;
            }
        };
        xmlhttp.open("POST", "/phplearning/index.php?c=document/update?q=" + args[0], true);

        var data = ""
        xmlhttp.send(data);
    }
}


function addNewRow(id){
    var idItem = $("#"+id+" tr:last").find('td:eq(0) input[type="number"]').data("id")+'';
    idItem=parseInt(idItem.split("-")[0])
    idItem=!idItem? 1 : idItem+1
    $("#"+id+"").find('tbody').append( "<tr>\
        <td style='width: 10%'><input type='number' class='form-control text-center' data-id='"+idItem+"'></td>\
        <td style='width: 70%'><textarea class='form-control'  onkeyup='textAreaAdjust(this)' style='overflow:hidden;resize: none;' rows='1'></textarea></td>\
        <td style='width: 20%' class='text-center'>\
            <button type='button' class='btn btn-danger' onclick='deleteRow(this)'>\
                    <span class='fa fa-remove'></span>\
            </button>\
        </td>\
        </tr>");
}

function deleteRow(row){
  //$(row).parents('tr').remove();
    id=$("#id").val()
    orderId=$(row).parents('tr').find('td:eq(0) input[type="number"]').data("id")+''

    orderId=orderId.split("-")
    console.log(orderId)
    if (orderId.length>1){
      orderId=orderId[0]
      if (id == 0 || orderId == 0) { 
          return;
      } else {
          $.ajax({
            url: "/phplearning/index.php?c=document&a=delete&i=" +id+'&i2='+orderId,
            jsonp: "callback",
            dataType: "jsonp",
            success: function( response ) {
                if(response.result===true){
                  $(row).parents('tr').remove();
                }
            }          
          });
      }
    }else{
      $(row).parents('tr').remove(); 
    }



}

  function textAreaAdjust(o) {
  o.style.height = "1px";
  o.style.height = (5+o.scrollHeight)+"px";
}

function calculatePayment(){
    var subtotal=parseFloat($('#subtotalPayment').val())
    var taxInput=parseFloat($('#taxInput').val())/100

    var tax=subtotal*taxInput
    var totalPayment=(subtotal+tax)

    $('#totalPayment').html(totalPayment)
    $('#tax').html(tax)
} 

  function cargaTabla(form){
    var TableData = new Array();
    id=$("#id").val()
  $('#tableItems tr').each(function(row, tr){
    //console.log(JSON.stringify(tr));
      TableData[row]={
            "id": id,
            "orderId": $(tr).find('td:eq(0) input[type="number"]').data("id"),
            "quantity" : $(tr).find('td:eq(0) input[type="number"]').val() ,
           "description" :$(tr).find('td:eq(1) textarea').val()
      }
  }); 
  TableData.shift();  // first row is the table header - so remove
  TableData = JSON.stringify(TableData);

  var p = document.createElement("input");
  form.appendChild(p);
  p.name = "tableItems";
  p.type = "hidden";
  p.value = TableData;
  return false;
  } 