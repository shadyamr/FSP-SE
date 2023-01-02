@extends('layouts.app')

@section('content')

<div class="container">
    <h1><span class="badge rounded-pill bg-dark">Inspections</span></h1>
    <div class="h-100 p-5 bg-light border rounded-3">
        <button type="button" class="btn btn-success float-end mb-2" data-bs-toggle="modal" data-bs-target="#makeInspectionModal">
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
                            <a href="{{ route('inspections.edit', $inspection->id) }}" class="btn btn-sm btn-secondary mb-2">Edit</a>
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
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
    </div>
</div>
<div class="modal fade" id="makeInspectionModal" tabindex="-1" aria-labelledby="makeInspectionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="makeInspectionModalLabel">Make Inspection</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('inspections.store') }}" enctype="multipart/form-data"> <!--  -->
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="requests_id">Corporate Name (Request):</label>
                        <select class="form-select" name="requests_id" id="requests_id" required>
                            @foreach($list_requests as $arequests)
                                <option value="{{ $arequests->id }}">{{ $arequests->corporate_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="inspection_info">Inspection Description:</label>
                        <textarea class="form-control" name="inspection_info" id="inspection_info" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="corporate_budget">Inspection Images:</label>
                        <input class="form-control" type="file" name="image" id="image" required>
                    </div>
                </div>
                <div class="modal-footer">
                    @if(count($list_requests) > 0)
                    <button type="submit" class="mb-2 btn btn-primary">Submit</button>
                    @else
                    <button type="button" class="mb-2 btn btn-primary" disabled>Submit</button>
                    @endif
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
                        Viewing Inspection of <span class="fw-bold">{{ $inspection->requests ? $inspection->requests->corporate_name : 'Vacant'}}</span>
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
                            {{ $inspection->requests ? $inspection->requests->user->name : 'Vacant' }}
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