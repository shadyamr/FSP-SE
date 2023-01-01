@extends('layouts.app')

@section('content')

<div class="container">
    <h1><span class="badge rounded-pill bg-dark">Inspections</span></h1>
    <div class="h-100 p-5 bg-light border rounded-3">
        <button type="button" class="btn btn-success float-end mb-2" data-bs-toggle="modal" data-bs-target="#makeRequestModal" disabled>
            Make Inspection
        </button>
        <br><br>
        @if(count($inspections_all) > 0)
        <div class="table-responsive">
            <table class="table table-hover table-striped table-dark table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Request ID</th>
                        <th scope="col">Corporate</th>
                        <th scope="col">Inspector</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Updated At</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inspections_all as $inspection)
                    <tr>
                        <td scope="row">{{ $inspection->id }}</td>
                        <td><a href="{{ route('requests') }}">Request #{{ $inspection->request_id }}</a></td>
                        <td>{{ $inspection->requests->corporate_name ?? 'Unknown' }}</td>
                        <td>
                            {{ $inspection->inspector ? $inspection->inspector->name : 'Unknown' }}
                        </td>
                        <td>{{ $inspection->created_at }}</td>
                        <td>{{ $inspection->updated_at }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#viewModal-{{ $inspection->id }}">View</button>
                            <button href="" class="btn btn-sm btn-secondary mb-2" disabled>Edit</button>
                            <a href="{{ route('inspections.delete', $inspection->id) }}" class="btn btn-sm btn-danger mb-2">Delete</a>
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
                    <td scope="row">There are no inspections available at the moment.</td>
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
            <form method="POST" action=""> <!-- {{-- route('inspections.store') --}} -->
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
@if(count($inspections_all) > 0)
@foreach ($inspections_all as $inspection)
<div class="modal fade" id="viewModal-{{ $inspection->id }}" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">Inspection #{{ $inspection->id }} — Request #{{ $inspection->request_id }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <h5 class="card-header">
                        Viewing Inspection of <span class="fw-bold">{{ $inspection->requests->corporate_name }}</span>
                    </h5>
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Description:</h5>
                        <p class="card-text">
                            {{ $inspection->inspection_information }}
                        </p>
                        <h5 class="card-title fw-bold">Image(s):</h5>
                        <p class="card-text">
                            <img src="{{ asset($inspection->inspection_image) }}" width="300">
                        </p>
                        <hr>
                        <p class="card-text">
                            <span class="fw-bold">Sales Handler:</span>
                            {{ $inspection->requests->user->name }}
                        </p>
                        <p class="card-text">
                            <span class="fw-bold">Inspector:</span>
                            {{ $inspection->inspector ? $inspection->inspector->name : 'Unknown' }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-target="#viewModalImg-{{ $inspection->id }}" data-bs-toggle="modal">View Full Image</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="viewModalImg-{{ $inspection->id }}" aria-hidden="true" aria-labelledby="viewModalImg" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="viewModalImg">Inspection #{{ $inspection->id }} — Request #{{ $inspection->request_id }}: Image</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <img src="{{ asset($inspection->inspection_image) }}" width="1000">
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" data-bs-target="#viewModal-{{ $inspection->id }}" data-bs-toggle="modal">Back to Inspection</button>
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

        axios.post('/inspections', {
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