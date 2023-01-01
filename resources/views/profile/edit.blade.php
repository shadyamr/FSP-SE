@extends('layouts.app')

@section('content')

<div class="container">
    <h1><span class="badge rounded-pill bg-dark">Profile</span></h1>
    <div class="h-100 p-5 bg-light border rounded-3">
        @include('profile.partials.update-profile-information-form')
        <hr>
        @include('profile.partials.delete-user-form')
    </div>
</div>
@endsection