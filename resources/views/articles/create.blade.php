@extends('app')
@section('content')
	<h1>撰写新的文章</h1>
	{!! Form::open(['url'=>'article/store']) !!}
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
			{!! Form::submit('发表文章', ['class'=>'btn btn-success form-control'])!!}
		</div>
	{!! Form::close() !!}
	@if($errors->any())
        <ul class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
	@endif
@endsection