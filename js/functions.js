function ajaxCall(...args) {
    console.log(document.getElementById(''+args[2]+''))
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
        xmlhttp.open("POST", "../includes/functions_ajax.php?q=" + args[0], true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
        var data = ""
        if(args[2]){
            var data = $('#'+args[2]+'').serialize();
        }
        xmlhttp.send(data);
    }
}

function getSessionParameters(...args) {
console.log(args);
}

function addNewRow(id){
    $("#"+id+"").find('tbody').append( "<tr>\
        <td style='width: 10%'><input type='number' class='form-control text-center'></td>\
        <td style='width: 70%'><textarea class='form-control'  onkeyup='textAreaAdjust(this)'' style='overflow:hidden;resize: none;' rows='1'></textarea></td>\
        <td style='width: 20%' class='text-center'>\
            <button type='button' class='btn btn-info'>\
                    <span class='fa fa-pencil'></span>\
            </button>\
            <button type='button' class='btn btn-danger'>\
                    <span class='fa fa-remove'></span>\
            </button>\
        </td>\
        </tr>");
}
