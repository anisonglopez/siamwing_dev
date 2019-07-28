var ipx = document.getElementById('pp').value;
$.ajax({
    type: "POST",
    url: "http://anisong-programing.com/license/ecn_license.php",
    dataType: 'json',
    data: {ipx:ipx},
    success: function(data)
    {
        if (data.status == 'Ok'){
            window.location.href = 'views/home/';
        }else{
            window.location.href = 'error.php';
            $.ajax({
                type: "POST",
                url: "views/login/logout.php"
            });
        }
    },
    error: function (jqXHR, textStatus, errorThrown) {
        if (jqXHR.status == 500) {
            alert('Internal error: ' + jqXHR.responseText);
        } else {
            alert('ระบบหมดอายุ กรุณาติดต่อผู้พัฒนาระบบ');
        }
    }
  });