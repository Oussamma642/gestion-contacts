@extends('dashboard-layouts.app')

@section('content')
<div class="container">
    <h2>Related Persons</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Person B</th>
                <th>Relation Type</th>
            </tr>
        </thead>
        <tbody>
            @foreach($relatedPersons as $relation)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $relation->personB->name ?? 'Unknown' }}</td>
                <td>{{ $relation->typeRelation->type ?? 'N/A' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection