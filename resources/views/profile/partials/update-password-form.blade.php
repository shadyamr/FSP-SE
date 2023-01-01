<section>
    <header>
        <h2 class="fw-bold">
            {{ __('Update Password') }}
        </h2>

        <p class="text-lead">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="mb-2">
            <label for="current_password" class="form-label fw-bold">{{ __('Current Password') }}</label>
            <input id="current_password" name="current_password" type="password" class="form-control" autocomplete="current-password" />
            
        </div>

        <div class="mb-2">
            <label for="password" class="form-label fw-bold">{{ __('New Password') }}</label>
            <input id="password" name="password" type="password" class="form-control" autocomplete="new-password" />
            
        </div>

        <div class="mb-2">
            <label for="password_confirmation" class="form-label fw-bold">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password" />
            
        </div>

        <button class="btn btn-primary">{{ __('Save') }}</button>

        @if (session('status') === 'password-updated')
        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
        @endif
    </form>
</section>