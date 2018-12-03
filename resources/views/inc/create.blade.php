
{!! Form::open(['action' => 'NewsController@storeNews', 'method' => 'POST']) !!}
<div id="leftdiv">
    <div class="form-group row">
        {{Form::label('title', 'Title', ['class' => 'col-sm-2 col-form-label'])}}
        {{Form::text('title', '', ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Title'])}}
    </div>
    
    <div class="form-group row">
        {{Form::label('state', 'State', ['class' => 'col-sm-2 col-form-label'])}}
        {{Form::select('state', array('1' => 'Published', '2' => 'Unpublished'), null, ['class' => 'form-control', 'id' => 'state'])}}
    </div>
</div>

<div id="rightDiv">
    <a href="#modalPreview" id="prev" data-toggle="modal"><i class="btn btn-info far fa-eye"></i></a>
    {{-- <br id="removable"> --}}
    <small>Preview</small>
</div>

<div class="clearfix"></div>

<div class="form-group row">
    {{Form::textarea('body', '', ['class' => 'form-control', 'id' => 'body'])}}
</div>


<div class="form-group row float-right">
    {{Form::Submit('Submit', ['class' => 'btn btn-primary'])}}
</div>

{!! Form::close() !!}




<div class="modal fade" id="modalPreview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> News preview </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h1 id="mTitle"></h1>
                <p id="mBody"></p>
                <hr>
            <small>Created at {{date('Y-m-d H:i:s')}} , by {{Auth::user()->name}}</small>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>