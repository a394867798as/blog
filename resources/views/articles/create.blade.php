@extends('layouts.app')
@section('content')
	<h1>撰写新的文章</h1>
	{!! Form::open(['url'=>'article/store', 'id'=>'createArticle']) !!}
		<div class="form-group">
			{!! Form::label('title', '标题')!!}
			{!! Form::text('title',null,['class'=>'form-control'])!!}
		</div>
		<div class="form-group">
			{!! Form::label('content', '正文:')!!}
			{!! Form::textarea('content',null,['class'=>'form-control'])!!}
		</div>
		<div class="form-group">
            {!! Form::label('published_at','发布日期') !!}
            {!! Form::input('date','published_at',date('Y-m-d'),['class'=>'form-control']) !!}
        </div>
		<div class="form-group">
			{!! Form::submit('发表文章', ['class'=>'btn btn-success form-control',
			 'onclick'=>'return submitForm(this);',
			 'data-toggle'=>"modal", 'data-target'=>".bs-example-modal-sm"])!!}
		</div>
	{!! Form::close() !!}
	@if($errors->any())
        <ul class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        @else()
        <ul class="alert alert-danger" style="display: none;">
        </ul>
	@endif
<script type="text/javascript">
function submitForm(ev){
    $(".alert").hide().html("");
    var title = $("#title").val();
    var content = $("#content").val();
    var published_at = $("#published_at").val();
    var url = $("#createArticle").attr("action");
    var data = {};
    data.title = title;
    data.content = content;
    data.published_at = published_at;
    $.ajax({
        url:url,
        data:data,
        type:'POST',
        dataType:'JSON',
        beforeSend: function(xhr, settings){
             xhr.setRequestHeader('X-CSRF-TOKEN', $("input[name='_token']").val());
        },
        async:true,
        statusCode:{
            422:function(json,message){
                $(".alert").show();
                for(key in json.responseJSON){
                    $(".alert").append("<li>"+key+":"+json.responseJSON[key]+"</li>");
                }
                return false;
            }
        },
        success:function(json){
            window.location.href = json.url;
        }
    });
    return false;
}
</script>
@endsection