$(document).ready(function(){
    $('#srchBtn').click(function(e){
        e.preventDefault();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        var url ='/postajax';
        
        var [title, date, state] = values();

        data = {
            _token: CSRF_TOKEN,
            title:title,
            date:date,
            state:state
        };

        ajaxRequest(url, data);
    });

    // to preview the news before posting
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

$(document).on('click', '.pagination a', function(e){
    e.preventDefault();
    if($(this).attr('href').includes("ajax")){

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var data = {_token:CSRF_TOKEN};

        var [title, date, state] = values();

        var t = "title";
        var d = "date";
        var s = "state";

        var url ="/ajax/search?";

        var href = $(this).attr('href');

        // checks if href in pagination contains search criteria and modifies data and url accordingly
        if(href.includes(t)){
            url += "title="+title;
            data.title = title;
        }
        if(href.includes(d)){
            url += "&date="+date;
            data.date = date;
        }
        if(href.includes(s)){
            url += "&state="+state;
            data.state = state;
        }

        var page = href.split('page=')[1];

        url += "&page="+page;

        ajaxRequest(url, data);
    } else {
        var href = $(this).attr('href');
        var page = href.split('page=')[1];

        getNews(page);
    };
});

function getNews(page){
    $.ajax({
        url: '/jax/news?page='+page,
        success:function(response){
            $('#tables').html(response);
        }
    });
}

function ajaxRequest(url, data){
    $.ajax({
        url:url,
        data:data,
        success:function(response) {
            $('#tables').html(response);
        },
        error: function(response){
            console.log(response);
            alert("Some error ocurred");
        }
    });
};

// returns array with field values
function values(){
    var title = $('#title').val();
    var date = $('#date').val();
    var state = $('#state').val();

    return [title, date, state];
};

// confirm if user wants to delete news
function confunction(){
    if (confirm('Are you sure? You can not undo this action!')){
        return true;
    } else {
        return false;
    }
};

// confirm if user wants to delete account
function userConfunction(){
    if (confirm('Are you sure you want to delete you account? You can not undo this action!')){
        return true;
    } else {
        return false;
    }
};

// to strip input passed as argument from tags
function stripHTML(text){
    var regex = /(<([^>]+)>)/ig;
    return text.replace(regex, "");
};