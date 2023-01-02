@extends('layouts.app')

@section('content')

<div class="container">
    <div class="h-100 p-5 bg-light border rounded-3">
        <h2 class="fw-bold">Edit Request — (ID: {{ $edit_requests->id }})</h2>
        <div class="d-inline">
            <p>Editing the request of {{ $edit_requests->corporate_name }}</p>
        </div>

        <form method="POST" action="{{ route('requests.store.edit', $edit_requests->id) }}">
        @csrf
            <div class="mb-3">
                <label for="corporate_name" class="form-label">Corporate Name</label>
                <input type="text" class="form-control" id="corporate_name" name="corporate_name" value="{{ $edit_requests->corporate_name }}" required autofocus>
            </div>
            <div class="mb-3">
                <label for="corporate_address" class="form-label">Corporate Address</label>
                <input type="text" class="form-control" id="corporate_address" name="corporate_address" value="{{ $edit_requests->corporate_address }}" required>
            </div>
            <div class="mb-3">
                <label for="corporate_budget">Corporate Budget:</label>
                <input class="form-control" type="number" name="corporate_budget" id="corporate_budget" min="1000" max="5000000" value="{{ $edit_requests->corporate_budget }}" required>
            </div>
            <div class="mb-3">
                <label for="corporate_owner">Corporate Owner:</label>
                <input class="form-control" type="text" name="corporate_owner" id="corporate_owner" value="{{ $edit_requests->corporate_owner }}" required>
            </div>
            <div class="mb-3">
                <label for="corporate_mobile">Corporate Mobile:</label>
                <input class="form-control" type="tel" name="corporate_mobile" id="corporate_mobile" placeholder="01002010222" pattern="[0-9]{11}" value="{{ $edit_requests->corporate_mobile }}" required>
            </div>
            <div class="mb-3">
                <label for="corporate_phone">Corporate Phone:</label>
                <input class="form-control" type="tel" name="corporate_phone" id="corporate_phone" placeholder="0227715506" pattern="[0-9]{10}" value="{{ $edit_requests->corporate_phone }}" required>
            </div>
            <div class="mb-3">
                <label for="corporate_budget">Corporate Email:</label>
                <input class="form-control" type="email" name="corporate_email" id="corporate_email" value="{{ $edit_requests->corporate_email }}" required>
            </div>
            <div class="mb-3">
                <label for="client_extra" class="form-label">Additional Information</label>
                <textarea class="form-control" id="client_extra" name="client_extra" rows="3" required>{{ $edit_requests->client_extra }}</textarea>
            </div>
            <div class="mb-3">
                <label for="handler" class="form-label">Sales Handler</label>
                <select class="form-select" name="handler" id="handler">
                    @foreach($users as $user)
                        @if(!empty($edit_requests->user->id))
                            @if($edit_requests->user->id == $user->id)
                                <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                            @else
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endif
                        @else
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="d-inline">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href=".." class="btn btn-secondary">Go Back</a>
            </div>
        </form>

        @if (session('success'))
        <div class="mt-2 alert alert-success">{{ session('success') }}</div>
        @elseif (session('error'))
        <div class="mt-2 alert alert-danger">{{ session('error') }}</div>
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
        var corporateOwner = document.getElementById('corporate_owner').value;
        var corporateMobile = document.getElementById('corporate_mobile').value;
        var corporatePhone = document.getElementById('corporate_phone').value;
        var corporateEmail = document.getElementById('corporate_email').value;
        var clientExtra = document.getElementById('client_extra').value;
        var handler = document.getElementById('handler').value;

        axios.post('/edit_requests', {
                corporate_name: corporateName,
                corporate_address: corporateAddress,
                corporate_budget: corporateBudget,
                corporate_owner: corporateOwner,
                corporate_mobile: corporateMobile,
                corporate_phone: corporatePhone,
                corporate_email: corporateEmail,
                client_extra: clientExtra,
                handler: handler
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