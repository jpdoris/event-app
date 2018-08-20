@extends('layouts.app')

@section('content')
    <div class="container-fluid center">
        <div class="row">
            <div class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-success save-success" role="alert">
                        {{ session('success') }}
                    </div>2
                @endif

                <div class="card">
                    <div class="card-header">
                        <h2>Manage Events</h2>
                    </div>

                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                <tr>
                                    <th scope="col" class="d-none d-xl-block">Event ID</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Venue</th>
                                    <th scope="col">Start Date</th>
                                    <th scope="col">End Date</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($events as $event)
                                    <tr data-id="{{ $event->id }}">
                                        <td>{{ $event->id }}</td>
                                        <td>{{ $event->title }}</td>
                                        <td>{{ $event->description }}</td>
                                        <td>{{ $event->venue->title }}</td>
                                        <td>{{ date('F d, Y', strtotime($event->startdate)) }}</td>
                                        <td>{{ date('F d, Y', strtotime($event->enddate)) }}</td>
                                        <td></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
