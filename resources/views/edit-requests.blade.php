@extends('layouts.app')

@section('content')

            <div class="container">
                <div class="h-100 p-5 bg-light border rounded-3">
                    <h2 class="fw-bold">Edit Request</h2>
                    <div class="d-inline">
                        <p>Editing the request of </p>
                    </div>
       
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
                                @foreach($requests as $requesta)
                                    <tr>
                                        <td scope="row">{{ $requesta->requestID }}</td>
                                        <td>{{ $requesta->corporate_name }}</td>
                                        <td>{{ $requesta->corporate_address }}</td>
                                        <td>{{ $requesta->handlerName ?? "Vacant" }}</td>
                                        <td>{{ $requesta->requestCreated }}</td>
                                        <td>{{ $requesta->requestUpdated }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                   
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