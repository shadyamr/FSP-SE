@extends('layouts.app')

@section('content')

<div class="container">
    <div class="h-100 p-5 bg-light border rounded-3">
        <h2 class="fw-bold">Edit Inspection — (ID: {{ $edit_inspection->id }})</h2>
        <div class="d-inline">
            <p>Editing the inspection of {{ $edit_inspection->requests ? $edit_inspection->requests->corporate_name : 'Vacant' }} — Request #{{ $edit_inspection->requests ? $edit_inspection->requests->id : '0'}}</p>
        </div>

        <form method="POST" action="{{ route('inspections.store.edit', $edit_inspection->id) }}" enctype="multipart/form-data">
        @csrf
            <div class="mb-3">
                <label for="corporate_name" class="form-label">Corporate Name (Request):</label>
                <select class="form-select" name="requests_id" id="requests_id" required>
                    @foreach($list_requests as $arequests)
                        @if(!empty($edit_inspection->requests->id))
                            @if($edit_inspection->requests->id == $arequests->id)
                                <option value="{{ $arequests->id }}" selected>{{ $arequests->corporate_name }} — Request #{{ $arequests->id }}</option>
                            @else
                                <option value="{{ $arequests->id }}">{{ $arequests->corporate_name }}  — Request #{{ $arequests->id }}</option>
                            @endif
                        @else
                            <option value="{{ $arequests->id }}">{{ $arequests->corporate_name }}  — Request #{{ $arequests->id }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="inspection_info" class="form-label">Inspection Information:</label>
                <textarea class="form-control" id="inspection_info" name="inspection_info" rows="3" required>{{ $edit_inspection->inspection_information }}</textarea>
            </div>
            <div class="mb-3">
                <label for="corporate_budget">Inspection Images:</label>
                <input class="form-control" type="file" name="image" id="image">
            </div>
            <div class="mb-3">
                <label for="inspector_id" class="form-label">Inspector:</label>
                <select class="form-select" name="inspector_id" id="inspector_id">
                    @foreach($users as $user)
                        @if(!empty($edit_inspection->inspector->id))
                            @if($edit_inspection->inspector->id == $user->id)
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
    function editInspection() {
        var corporateName = document.getElementById('corporate_name').value;
        var corporateAddress = document.getElementById('corporate_address').value;
        var corporateBudget = document.getElementById('corporate_budget').value;
        var corporateOwner = document.getElementById('corporate_owner').value;
        var corporateMobile = document.getElementById('corporate_mobile').value;
        var corporatePhone = document.getElementById('corporate_phone').value;
        var corporateEmail = document.getElementById('corporate_email').value;
        var clientExtra = document.getElementById('client_extra').value;
        var handler = document.getElementById('handler').value;

        axios.post('/edit_inspection', {
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