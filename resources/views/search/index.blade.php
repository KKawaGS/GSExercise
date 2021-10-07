@extends('layouts.app')

@section('content')
    <div class="container pt-4">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Book</th>
                <th scope="col">Compatibility</th>
                <th scope="col">Book Data</th>
                <th scope="col">Female AVG age</th>
                <th scope="col">Male AVG age</th>
            </tr>
            </thead>
            <tbody>

            @forelse($statData as $data)
                <tr>
                    <td>{{ $data['bookTitle'] }}</td>
                    <td>{{ round($data['compatibility'], 2) . " %"}}</td>
                    <td>{{ $data['bookDate'] }}</td>
                    <td>{{ round($data['avgFemaleReviewAge'], 2) }}</td>
                    <td>{{ round($data['avgMaleReviewAge'], 2) }}</td>
                </tr>
            @empty
                <tr>
                    <th colspan="5" class="text-center">No results...</th>
                </tr>
            @endforelse
            </tbody>
        </table>
        <a class="btn btn-outline-secondary" href="{{ route('search') }}">Back to search</a>
    </div>
@stop
