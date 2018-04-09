@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add new books</div>

                    <div class="panel-body table-responsive">

                        {!! Form::open(['method' => 'POST', 'route' => ['admin.books.store']]) !!}
                        <div class="row">
                            <div class="col-xs-12 form-group">
                                {!! Form::label('title', 'Title', ['class' => 'control-label']) !!}
                                {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '']) !!}
                                <p class="help-block"></p>
                                @if($errors->has('title'))
                                    <p class="help-block">
                                        {{ $errors->first('title') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-xs-12 form-group">
                                {!! Form::label('address', 'Address', ['class' => 'control-label']) !!}
                                {!! Form::text('address', old('address'), ['class' => 'form-control', 'placeholder' => '']) !!}
                                <p class="help-block"></p>
                                @if($errors->has('address'))
                                    <p class="help-block">
                                        {{ $errors->first('address') }}
                                    </p>
                                @endif
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="col-xs-12 form-group">
                                {!! Form::label('synopsis', 'Synopsis', ['class' => 'control-label']) !!}
                                {!! Form::text('synopsis', old('synopsis'), ['class' => 'form-control', 'placeholder' => '']) !!}
                                <p class="help-block"></p>
                                @if($errors->has('synopsis'))
                                    <p class="help-block">
                                        {{ $errors->first('synopsis') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-xs-12 form-group">
                                {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
                                {!! Form::text('email', old('email'), ['class' => 'form-control', 'placeholder' => '']) !!}
                                <p class="help-block"></p>
                                @if($errors->has('email'))
                                    <p class="help-block">
                                        {{ $errors->first('email') }}
                                    </p>
                                @endif
                            </div>
                        </div> --}}

                        {!! Form::submit('Save', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop

