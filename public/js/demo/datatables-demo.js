// Call the dataTables jQuery plugin

$(document).ready(function () {
  $('#tbl_lista').DataTable();
  });

  $(document).ready(function(){

    $('#id_centro_computo').change(function(){

        var id_centro_computo = $('#id_centro_computo').val();
        var action = 'obtener_dispositivo';

        if(id_dispositivo != '')
        {
            $.ajax({
                url:"http://admincomputo.test/incidente/action",
                method:"POST",
                data:{id_centro_computo:id_centro_computo, action:action},
                dataType:"JSON",
                success:function(data)
                {
                    var html = '<option value="" class="form-control disabled" selected disabled>seleccione:</option>';
                    console.log(data)
                    for(var count = 0; count < data.length; count++)
                    {
                        html += '<option value="'+data[count].id+'">'+data[count].nombre+'</option>';

                    }
                    $('#id_dispositivo').html(html);
                }
            });
        }
        else
        {
            $('#id_dispositivo').val('');
        }
    });
});

$(function () {
    bsCustomFileInput.init();
  });

  
