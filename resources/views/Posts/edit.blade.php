@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit comment!</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}

                            </div>
                        @endif

                        @if(session()->has('message'))
                            @if(session()->get('message') == 'Invalid file format!')
                                    <div class="alert alert-danger">
                                        {{ session()->get('message') }}
                                    </div>
                            @else
                                    <div class="alert alert-success">
                                        {{ session()->get('message') }}
                                    </div>
                            @endif
                            @endif

                                <form class="form-horizontal" method="POST" action="{{ route('edit.apply') }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <label for="content">Content:</label>
                                        <textarea class="form-control" rows="5" id="content" name="content" required>{{$comment}}</textarea>
                                    </div>

                                    <input type="hidden" value="{{ csrf_token() }}" name="_token">

                                    <input type="hidden" value="{{$type}}" name="type">
                                    <input type="hidden" value="{{$id}}" name="id">


                                    <button type="submit" class="btn btn-success" name="submit">Submit</button>
                                </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
