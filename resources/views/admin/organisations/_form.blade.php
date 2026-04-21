<div class="row g-3">
    <div class="col-md-6 input-margin mt-4">
        <label class="form-label" for="name">Organisation Name</label>
        <input
            class="form-control @error('name') is-invalid @enderror"
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $organisation->name) }}"
            required
        >
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 input-margin mt-4">
        <label class="form-label" for="code">Code</label>
        <input
            class="form-control @error('code') is-invalid @enderror"
            type="text"
            id="code"
            name="code"
            value="{{ old('code', $organisation->code) }}"
        >
        @error('code')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 input-margin ">
        <label class="form-label" for="email">Email</label>
        <input
            class="form-control @error('email') is-invalid @enderror"
            type="email"
            id="email"
            name="email"
            value="{{ old('email', $organisation->email) }}"
            required
        >
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 input-margin ">
        <label class="form-label" for="phone">Phone</label>
        <input
            class="form-control @error('phone') is-invalid @enderror"
            type="text"
            id="phone"
            name="phone"
            value="{{ old('phone', $organisation->phone) }}"
        >
        @error('phone')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 input-margin ">
        <label class="form-label" for="website">Website</label>
        <input
            class="form-control @error('website') is-invalid @enderror"
            type="url"
            id="website"
            name="website"
            value="{{ old('website', $organisation->website) }}"
            placeholder="https://example.com"
        >
        @error('website')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 input-margin ">
        <label class="form-label" for="logo">Logo</label>
        <input
            class="form-control @error('logo') is-invalid @enderror"
            type="file"
            id="logo"
            name="logo"
            accept=".jpg,.jpeg,.png,.webp,.svg"
        >
        @error('logo')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        @if ($organisation->logo_url)
            <div class="mt-2">
                <img src="{{ $organisation->logo_url }}" alt="{{ $organisation->name }} logo" style="max-height: 64px;">
            </div>
        @endif
    </div>

    <div class="col-md-6 input-margin ">
        <label class="form-label" for="status">Status</label>
        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required data-choices data-choices-multiple-remove="true" data-choices-search-true>
            <option value="1" @selected(old('status', (int) $organisation->status) === 1)>Active</option>
            <option value="0" @selected((string) old('status', (int) $organisation->status) === 0)>Inactive</option>
        </select>
        @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 input-margin ">
        <label class="form-label" for="address">Address</label>
        <input
            class="form-control @error('address') is-invalid @enderror"
            type="text"
            id="address"
            name="address"
            value="{{ old('address', $organisation->address) }}"
        >
        @error('address')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
