@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">News dashboard</div>

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

                        <form class="form-horizontal" method="POST" action="{{ route('news.submit') }}"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>

                            <div class="form-group">
                                <label for="content">Content:</label>
                                <textarea class="form-control" rows="5" id="content" name="content" required></textarea>
                            </div>

                            <label>Select image to upload:</label>
                            <input type="file" name="image" id="image" required>
                            <input type="hidden" value="{{ csrf_token() }}" name="_token">

                            <input type="hidden" value="{{ Auth::user()->id}}" name="user">

                            <button type="submit" class="btn btn-success" name="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
