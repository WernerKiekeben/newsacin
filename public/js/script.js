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

                console.log(response);

                for(var i = 0; i < response.data.length; i++){
                    var title = response.data[i].title;
                    var date = response.data[i].publication;
                    var state = response.data[i].description;
                    var id = response.data[i].id;

                    var td1 = "<td>"+title+"</td>";
                    var td2 = "<td>"+date+"</td>";
                    var td3 = "<td>"+state+"</td>";
                    var ed  = '<td><a class="btn btn-outline-info" href="/news/'+id+'/edit"><i class="fas fa-edit fa-lg"></i></a></td>';
                    var del = `
                    <td>
                    <form method="POST" action="destroy/${id}" accept-charset="UTF-8" class="float-right">
                        <input name="_token" type="hidden" value="`+CSRF_TOKEN+`">
                        <input name="_method" type="hidden" value="DELETE">
                        <button type="submit" class="btn btn-outline-danger" onclick="return confunction();"><i class="fa fa-trash"></i></button>
                    </form>
                    </td>
                    `;

                    td4 = ed + del;

                    tr += "<tr>" + td1 + td2 + td3 + td4 + "</tr>";
                }
                // $('.pagination').hide();
                if(tr != ""){
                    $('tbody').html(tr);
                } else {
                    var nope = "<tr><td colspan='4' class='alert alert-warning text-center'>No Results Found</td></tr>";
                    $('tbody').html(nope);
                }
            }
        });
    });

    $('.firstTd').click(function(){
        var id = $(this).closest('tr').data('id');
        var href = "/news/" + id;
        window.open(href, '_self');
    });
});

function confunction(){
    if (confirm('Are you sure? You can not undo this action!')){
        return true;
    } else {
        return false;
    }
};

function userConfunction(){
    if (confirm('Are you sure you want to delete you account? You can not undo this action!')){
        return true;
    } else {
        return false;
    }
};