@extends('layouts.app')

@section('content')

<div class="container">
    <div class="h-100 p-5 bg-light border rounded-3">
        <h2 class="fw-bold">Requests</h2>
        <div class="d-inline">
            <p>Corporate requests for fire protection services</p>
            <button type="button" class="btn btn-success float-end mb-2" data-bs-toggle="modal" data-bs-target="#makeRequestModal">
                Make Request
            </button>
        </div>
        @if(count($requests_all) > 0)
        <table class="table table-hover table-striped table-dark table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Corporate Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Sales Handler</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($requests_all as $requests)
                <tr>
                    <td scope="row">{{ $requests->id }}</td>
                    <td>{{ $requests->corporate_name }}</td>
                    <td>{{ $requests->corporate_address }}</td>
                    <td>{{ $requests->user->name ?? "Vacant" }}</td>
                    <td>{{ $requests->created_at }}</td>
                    <td>{{ $requests->updated_at }}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewModal-{{ $requests->requestID }}">View</button>
                        <a href="{{ route('requests.edit', $requests->id) }}" class="btn btn-sm btn-secondary">Edit</a>
                        <a href="{{ route('requests.delete', $requests->id) }}" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <table class="table table-hover table-striped table-dark table-bordered">
            <thead>
                <tr>
                    <th scope="col">Empty Data</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="row">There are no requests available at the moment.</td>
                </tr>
            </tbody>
        </table>
        @endif
        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @elseif (session('error'))
        <div class="alert alert-success">{{ session('error') }}</div>
        @endif
    </div>
</div>
<div class="modal fade" id="makeRequestModal" tabindex="-1" aria-labelledby="makeRequestModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="makeRequestModalLabel">Make Request</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('requests.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="corporate_name">Corporate Name:</label>
                        <input class="form-control" type="text" name="corporate_name" id="corporate_name" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="corporate_address">Corporate Address:</label>
                        <input class="form-control" type="text" name="corporate_address" id="corporate_address" required>
                    </div>
                    <div class="mb-3">
                        <label for="corporate_budget">Corporate Budget:</label>
                        <input class="form-control" type="number" name="corporate_budget" id="corporate_budget" required>
                    </div>
                    <div class="mb-3">
                        <label for="client_extra">Additional Information:</label>
                        <textarea class="form-control" name="client_extra" id="client_extra" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" onclick="addClient()" class="mb-2 btn btn-primary">Add Client</button>
                </div>
            </form>
        </div>
    </div>
</div>
@if(count($requests_all) > 0)
@foreach ($requests_all as $requests)
<div class="modal fade" id="viewModal-{{ $requests->requestID }}" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">Viewing: {{ $requests->corporate_name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6 col-sm-4">
                        s
                    </div>
                    <div class="col-6 col-sm-4">
                        s
                    </div>

                    <div class="w-100 d-none d-md-block"></div>

                    <div class="col-6 col-sm-4">
                        s
                    </div>
                    <div class="col-6 col-sm-4">
                        s
                    </div>

                    <div class="w-100 d-none d-md-block"></div>

                    <div class="col-6 col-sm-4 justify-content-center">
                        s
                    </div>
                    <div class="col-6 col-sm-4 justify-content-center">
                        s
                    </div>

                    <div class="w-100 d-none d-md-block"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endif

@endsection
@section('scripts')

<script>
    function addClient() {
        var corporateName = document.getElementById('corporate_name').value;
        var corporateAddress = document.getElementById('corporate_address').value;
        var corporateBudget = document.getElementById('corporate_budget').value;
        var clientExtra = document.getElementById('client_extra').value;

        axios.post('/requests', {
                corporate_name: corporateName,
                corporate_address: corporateAddress,
                corporate_budget: corporateBudget,
                client_extra: clientExtra
            })
            .then(function(response) {
                console.log(response);
            })
            .catch(function(error) {
                console.log(error);
            });
    }
</script>

@endsection