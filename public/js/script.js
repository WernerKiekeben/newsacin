$(document).ready(function(){

    /* $('.pagination a').click(function(e){
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];

        getNews(page);
    });

    function getNews(page){
        console.log('getting page: '+page);
    }
 */
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

                for(var i = 0; i < response.data.length; i++){
                    var title = response.data[i].title;
                    var date = response.data[i].publication;
                    var state = response.data[i].description;
                    var id = response.data[i].id;

                    var td1 = "<td class='firstTd' scope='row'><a href='/news/"+id+"'><strong>"+title+"</strong></a> </td>";
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

                    tr += "<tr data-id="+id+">" + td1 + td2 + td3 + td4 + "</tr>";
                }
                // $('.pagination').hide();
                if(tr != ""){
                    $('tbody').html(tr);
                } else {
                    var noRes = "<tr><td colspan='4' class='alert alert-warning text-center'>No Results Found</td></tr>";
                    $('tbody').html(noRes);
                }
            },
            error: function(){
                alert("Some error ocurred");
            }
        });
    
    });

    $('.firstTd').click(function(){
        var id = $(this).closest('tr').data('id');
        var href = "/news/" + id;
        window.open(href, '_self');
    });

    $('#prev').click(function(){
        var title = stripHTML($('#title').val());
        console.log(title);

        if(title == null || title == ""){
            title="<em>\"No Title\"</em>";
        }

        var body = tinyMCE.activeEditor.getContent({format : 'raw'});

        $('#modalPreview').on('show.bs.modal', function(){
            $('#mTitle').html(title);
            $('#mBody').html(body);
        });
    });
});

$("td").on("click", "td.firstTd", function(){
    alert('you clicked me!');
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

function stripHTML(text){
    var regex = /(<([^>]+)>)/ig;
    return text.replace(regex, "");
}