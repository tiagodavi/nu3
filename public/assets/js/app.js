$(function() {

    var negative = 0;
    var positive = 1;
    var endpoint = $('#app_url').val();
    var $message = $('#message');
  
    var showMessage = function(msg) {      
      $message.text(msg);
    };

    $('#city').autocomplete({
      source: function(request, response) {
        $.ajax({
          url: endpoint + 'home/find-cities',
          dataType: 'json',
            data: {
              term: request.term              
          },
          success: function(data) {

            if(data.status == negative) {
              showMessage(data.message);
              return false;
            }

            response($.map(data.response, function(response) {
                     
               return{
                  label: response.name,
                  name:  response.name,
                  data:  response.data                       
                }
              
            }));
          }
        });
      },
      minLength: 6,
      select: function(event, ui) {

        $('#city').val(ui.item.name);

        var $result = $('#result');
        var html = [];

        $.map(ui.item.data, function(info, date) {

          html.push('<div class="col-md-4"><h2>'+ ui.item.name +'</h2> <p> <b>Temp Min</b> <small>'+info.temp_min+' °C</small></p><p> <b>Temp Max</b> <small>'+info.temp_max+' °C</small></p><p> <b>Humidity</b> <small>'+info.humidity+'</small></p><p> <b>Weather</b> <small>'+info.weather_name+'</small> - <small>'+info.weather_desc+'</small></p> <p> <small>'+date+'</small></div>');
                            
        });

        $result.html(html.join(''));
           
        return false;
      }
    });
});  
