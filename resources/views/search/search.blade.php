@extends('layouts.app')

@section('content')
    <div class="container vh-100">
        <div class="d-flex justify-content-center h-75">
            <div class="align-self-center">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('search') }}" method="get">
                    @csrf
                    <input type="text" name="search" value="{{ old('search') }}">
                    <button type="submit">Search</button>
                </form>
            </div>
        </div>
    </div>
@stop
