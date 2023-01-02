@extends('layouts.app')

@section('content')

<div class="container">
    <h1><span class="badge rounded-pill bg-dark">Requests</span></h1>
    <div class="h-100 p-5 bg-light border rounded-3">
        <button type="button" class="btn btn-success float-end mb-2" data-bs-toggle="modal" data-bs-target="#makeRequestModal">
            Make Request
        </button>
        <br><br>
        @if(count($requests_all) > 0)
        <div class="table-responsive">
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
                        <td>{{ $requests->user ? $requests->user->name : 'Vacant' }}</td>
                        <td>{{ $requests->created_at }}</td>
                        <td>{{ $requests->updated_at }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#viewModal-{{ $requests->id }}">View</button>
                            <a href="{{ route('requests.edit', $requests->id) }}" class="btn btn-sm btn-secondary mb-2">Edit</a>
                            <a href="{{ route('requests.delete', $requests->id) }}" class="btn btn-sm btn-danger mb-2">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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
        <div class="alert alert-danger">{{ session('error') }}</div>
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
                        <input class="form-control" type="number" name="corporate_budget" id="corporate_budget" min="1000" max="5000000" required>
                    </div>
                    <div class="mb-3">
                        <label for="corporate_owner">Corporate Owner:</label>
                        <input class="form-control" type="text" name="corporate_owner" id="corporate_owner" required>
                    </div>
                    <div class="mb-3">
                        <label for="corporate_mobile">Corporate Mobile:</label>
                        <input class="form-control" type="tel" name="corporate_mobile" id="corporate_mobile" placeholder="01002010222" pattern="[0-9]{11}" required>
                    </div>
                    <div class="mb-3">
                        <label for="corporate_phone">Corporate Phone:</label>
                        <input class="form-control" type="tel" name="corporate_phone" id="corporate_phone" placeholder="0227715506" pattern="[0-9]{10}" required>
                    </div>
                    <div class="mb-3">
                        <label for="corporate_budget">Corporate Email:</label>
                        <input class="form-control" type="email" name="corporate_email" id="corporate_email" required>
                    </div>
                    <div class="mb-3">
                        <label for="client_extra">Additional Information:</label>
                        <textarea class="form-control" name="client_extra" id="client_extra" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" onclick="addClient()" class="mb-2 btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@if(count($requests_all) > 0)
@foreach ($requests_all as $requests)
<div class="modal fade" id="viewModal-{{ $requests->id }}" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">Viewing: {{ $requests->corporate_name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <h5 class="card-header">
                        <span class="fw-bold">Name: </span>{{ $requests->corporate_name }}
                        —
                        <span class="fw-bold">Owner: </span>{{ $requests->corporate_owner }}
                    </h5>
                    <div class="card-body">
                        <h5 class="card-title"><span class="fw-bold">Address:</span> {{ $requests->corporate_address }}</h5>
                        <p class="card-text">
                            <span class="fw-bold">Mobile: </span>
                            {{ $requests->corporate_mobile }}
                        </p>
                        <p class="card-text">
                            <span class="fw-bold">Phone: </span>
                            {{ $requests->corporate_phone }}
                        </p>
                        <p class="card-text">
                            <span class="fw-bold">Email: </span>
                            {{ $requests->corporate_email }}
                        </p>
                        <hr>
                        <p class="card-text">
                            <span class="fw-bold">Budget: </span>
                            {{ __('EGP ') . number_format($requests->corporate_budget, 2) }}
                        </p>
                        <p class="card-text">
                            <span class="fw-bold">Description:</span>
                            {{ $requests->client_extra }}
                        </p>
                        <p class="card-text">
                            <span class="fw-bold">Sales Handler:</span>
                            {{ $requests->user ? $requests->user->name : 'Vacant' }}
                        </p>
                    </div>
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
        var corporateOwner = document.getElementById('corporate_owner').value;
        var corporateMobile = document.getElementById('corporate_mobile').value;
        var corporatePhone = document.getElementById('corporate_phone').value;
        var corporateEmail = document.getElementById('corporate_email').value;
        var clientExtra = document.getElementById('client_extra').value;

        axios.post('/requests', {
                corporate_name: corporateName,
                corporate_address: corporateAddress,
                corporate_budget: corporateBudget,
                corporate_owner: corporateOwner,
                corporate_mobile: corporateMobile,
                corporate_phone: corporatePhone,
                corporate_email: corporateEmail,
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