$(document).ready(function(){
    $('#srchBtn').click(function(e){
        e.preventDefault();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        
        var title = $('#title').val();
        var date = $('#date').val();
        var state = $('#state').val();

        $.ajax({
            url:'/postajax',
            type:'POST',
            data: {_token: CSRF_TOKEN, title:title, date:date, state:state},
            dataType:'JSON',
            success: function(response) {
                var tr = "";

                for(var i = 0; i < response.length; i++){
                    var title = response[i].title;
                    var date = response[i].publication;
                    var state = response[i].description;
                    var id = response[i].id;

                    var td1 = "<td><a href='/news/"+id+"'>"+title+"</a></td>";
                    var td2 = "<td>"+date+"</td>";
                    var td3 = "<td>"+state+"</td>";
                    var ed = '<td><a href="/news/'+id+'/edit"><i class="fas fa-edit fa-lg"></i></a></td>';

                    tr += "<tr>" + td1 + td2 + td3 + ed + "</tr>";
                }
                $('.pagination').hide();
                if(tr != ""){
                    $('tbody').html(tr);
                } else {
                    var nope = "<tr><td colspan='4' class='alert alert-warning text-center'>No Results Found</td></tr>";
                    $('tbody').html(nope);
                }
            }
        });
    });
});