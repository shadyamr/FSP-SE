@extends('layouts.app')

@section('content')

            <div class="container">
                <div class="h-100 p-5 bg-light border rounded-3">
                    <h2 class="fw-bold">Requests</h2>
                    <div class="d-flex">
                        <p>Corporate requests for fire protection services</p>
                        <button class="btn btn-success d-flex-block justify-content-end mb-2">Make Request</button>
                    </div>
                    @if(count($requests_all) > 0)
                        <table class="table table-hover table-striped table-dark table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Corporate Name</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Budget</th>
                                    <th scope="col">Additional Information</th>
                                    <th scope="col">Sales Handler</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Updated At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($requests_all as $requests)
                                    <tr>
                                        <td scope="row">{{ $requests->requestID }}</td>
                                        <td>{{ $requests->corporate_name }}</td>
                                        <td>{{ $requests->corporate_address }}</td>
                                        <td>{{ __('EGP ') . number_format($requests->corporate_budget, 2) }}</td>
                                        <td>{{ $requests->client_extra }}</td>
                                        <td>{{ $requests->handlerName ?? "Vacant" }}</td>
                                        <td>{{ $requests->requestCreated }}</td>
                                        <td>{{ $requests->requestUpdated }}</td>
                                        <td>s</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>There are no requests available at the moment.</p>
                    @endif
                    <form method="POST" action="{{ route('requests.store') }}">
                        @csrf
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
                        <button type="submit" onclick="addClient()" class="mb-2 btn btn-primary">Add Client</button>
                    </form>
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @elseif (session('error'))
                        <div class="alert alert-success">{{ session('error') }}</div>
                    @endif
                </div>
            </div>

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