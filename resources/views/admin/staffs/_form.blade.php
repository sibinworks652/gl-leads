@php
    $canSelectOrganisation = $canSelectOrganisation ?? true;
@endphp

<div class="row g-3">
    <div class="col-md-6 input-margin mt-4">
        <label class="form-label" for="name">Name</label>
        <input class="form-control @error('name') error-input-bottom @enderror" type="text" id="name" name="name" value="{{ old('name', $staff->name) }}" required>
        @error('name')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 input-margin mt-4">
        <label class="form-label" for="username">Username</label>
        <input class="form-control @error('username') error-input-bottom @enderror" type="text" id="username" name="username" value="{{ old('username', $staff->username) }}" required>
        @error('username')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 input-margin">
        <label class="form-label" for="email">Email</label>
        <input class="form-control @error('email') error-input-bottom @enderror" type="email" id="email" name="email" value="{{ old('email', $staff->email) }}" required>
        @error('email')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 input-margin">
        <label class="form-label" for="phone">Phone</label>
        <input class="form-control @error('phone') error-input-bottom @enderror" type="text" id="phone" name="phone" value="{{ old('phone', $staff->phone) }}">
        @error('phone')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    @if ($canSelectOrganisation)
        <div class="col-md-6 input-margin">
            <label class="form-label" for="organisation_id">Organisation</label>
            <select class="form-select @error('organisation_id') error-input-bottom @enderror" id="organisation_id" name="organisation_id" >
                <option value="">Select organisation</option>
                @foreach ($organisations as $organisation)
                    <option value="{{ $organisation->id }}" @selected((string) old('organisation_id', $staff->organisation_id) === (string) $organisation->id)>
                        {{ $organisation->name }}
                    </option>
                @endforeach
            </select>
            @error('organisation_id')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
    @endif

    <div class="col-md-6 input-margin">
        <label class="form-label" for="roles">Roles</label>
        @php
            $selectedRoles = collect(old('roles', $staff->roles->pluck('name')->all()));
        @endphp
        <select class="form-select @error('roles') error-input-bottom @enderror @error('roles.*') error-input-bottom @enderror" id="roles" name="roles[]" multiple data-choices data-choices-multiple-remove="true" data-choices-search-false required>
            @foreach ($roles as $role)
                <option value="{{ $role }}" @selected($selectedRoles->contains($role))>
                    {{ ucwords(str_replace('_', ' ', $role)) }}
                </option>
            @endforeach
        </select>
        @error('roles')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
        @error('roles.*')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 input-margin">
        <label class="form-label" for="password">Password</label>
        <input class="form-control @error('password') error-input-bottom @enderror" type="password" id="password" name="password" {{ $staff->exists ? '' : 'required' }}>
        @error('password')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
        @if ($staff->exists)
            <div class="form-text">Leave blank to keep the current password.</div>
        @endif
    </div>

    <div class="col-md-6 input-margin">
        <label class="form-label" for="status">Status</label>
        <select class="form-select @error('status') error-input-bottom @enderror" id="status" name="status" required data-choices data-choices-multiple-remove="true" data-choices-search-true>
            <option value="1" @selected(old('status', (int) $staff->status) === 1)>Active</option>
            <option value="0" @selected((string) old('status', (int) $staff->status) === 0)>Inactive</option>
        </select>
        @error('status')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
</div>
