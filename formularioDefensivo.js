$(document).ready(function(){
    $.ajax({
        cache: false,
        type: 'GET',
        url: 'databaseJQuery.php',
        data: {'getNicks' : ""},
        dataType: 'json',
        success: function(data)
        {
        var alfa = JSON.stringify(data);
        var stringify = JSON.parse(alfa);
        for (var i = 0; i < stringify.length; i++) {
            $('#enemy-name').append('<option value="' + stringify[i]['PName'] + '">' + stringify[i]['PName'] + '</option>');
        }
        }
    })
});

$(document).ready(function(){
    $('#off-account').on('change',function(event){
        $('#villages').find('option').remove();
        cache: false,
        event.preventDefault();
        $.ajax({
            url: "databaseJQuery.php",
            type:"GET",
            data:{'getUserInfo' : this.value},
            dataType: "json",
            success: function(result){
              var alfa = JSON.stringify(result);
              var stringify = JSON.parse(alfa);
              $('#Alliance').text(stringify[0]['Alliance']);
              for (var i = 0; i < stringify.length; i++) {
                var VplusC = stringify[i]['VName'] + " (" + stringify[i]['X'] + "|" + stringify[i]['Y'] + ")";
                $('#villages').append('<option value="' + VplusC + '">' + VplusC + '</option>');
              }
            }
        });
    })
});

$(document).ready(function(){
    $.ajax({
        cache: false,
        type: 'GET',
        url: 'databaseJQuery.php',
        data: {'getAllyNicks' : ""},
        dataType: 'json',
        success: function(datas)
        {
        console.log(datas);
        var alfa = JSON.stringify(datas);
        var stringify = JSON.parse(alfa);
        for (var i = 0; i < stringify.length; i++) {
            $('#ally-name').append('<option value="' + stringify[i]['PName'] + '">' + stringify[i]['PName'] + '</option>');
        }
        }
    })
});

$(document).ready(function(){
    $('#deff-account').on('change',function(event){
        $('#ourVillages').find('option').remove();
        cache: false,
        event.preventDefault();
        $.ajax({
            url: "databaseJQuery.php",
            type:"GET",
            data:{'getUserInfo' : this.value},
            dataType: "json",
            success: function(result){
              var alfa = JSON.stringify(result);
              var stringify = JSON.parse(alfa);
              $('#My-Alliance').text(stringify[0]['Alliance']);
              for (var i = 0; i < stringify.length; i++) {
                var VplusC = stringify[i]['VName'] + " (" + stringify[i]['X'] + "|" + stringify[i]['Y'] + ")";
                $('#ourVillages').append('<option value="' + VplusC + '">' + VplusC + '</option>');
              }
            }
        });
    })
});

$(document).ready(function() {
    $('#arrival-date').datepicker({minDate:0, dateFormat: 'dd/mm/yy'});
});

$(document).ready(function() {
    $("#train").change(function() 
    {
        if(this.checked)
        {
            // document.getElementById('n-vagones').style.display = 'inline';
            // document.getElementById('n-vagones-label').style.display = 'inline';
            $('#vagones-input').append('<label for="n-vagones" id="n-vagones-label">Numero de vagones:</label>');
            $('#vagones-input').append('<input type="text" name="n-vagones" class="border mb-2" id="n-vagones" size="2">');
        }
        if(!this.checked)
        {
            $('#vagones-input').empty();
            $('#trains').empty();
        }
    })
});


$('#vagones-input').change(function(){
    $('#trains').empty();
    var arrivalHour = document.getElementById('arrival-hour');
    arrivalHour = arrivalHour.value;
    var trainString = "";
    var nTrains = document.getElementById('n-vagones');

    for(var x = 1; x <= nTrains.value; x++)
    {
        trainString = "train" + String(x);
        $('#trains').append('<input type="time" name="' + trainString + '" class="mb-2" id="' + trainString + '" step="1" value="' + arrivalHour + '">');
    }
    
})
