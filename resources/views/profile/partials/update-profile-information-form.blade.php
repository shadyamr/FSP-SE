<section>
    <header>
        <h2 class="fw-bold">
            {{ __('Profile Information') }}
        </h2>

        <p class="text-lead">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="mb-2">
            <label for="name" class="form-label fw-bold">{{ __('Name:') }}</label>
            <input id="name" name="name" type="text" class="form-control" value="{{ $user->name }}" required autofocus autocomplete="name">
        </div>

        @if (!empty($errors->get('name')))
            <div class="alert alert-danger alert-dismissible fade show mt-2">
                There is an error with this name! Potential block or illegal characters.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="mb-2">
            <label for="email" class="form-label fw-bold">{{ __('Email:') }}</label>
            <input id="email" name="email" type="email" class="form-control" value="{{ $user->email }}" required autocomplete="email">
        </div>

        @if (!empty($errors->get('email')))
            <div class="alert alert-danger alert-dismissible fade show mt-2">
                There is an error with this e-mail! Potential conflict or block.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <button class="btn btn-primary">{{ __('Save') }}</button>

        @if (session('status') === 'profile-updated')
        <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="alert alert-success alert-dismissible fade show mt-2">{{ __('Saved.') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    </form>
</section>