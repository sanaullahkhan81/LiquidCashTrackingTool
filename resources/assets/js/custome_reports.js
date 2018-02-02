/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



$("#getreportBtn").click(function() {

//      alert($("#datepicker").datepicker("getDate"));

var date = new Date();
var date = ($.datepicker.formatDate("yy-mm-dd", date));

$.ajax({
        url: 'getreport/'+date,
        type: "POST",
        data: {_token:$('#token').val()},
        success: function(data)
            {
               $('#showresults').html(data);
            }
    });

    });
    