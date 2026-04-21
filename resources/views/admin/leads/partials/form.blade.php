<div class="row g-3">
    @if (! $readonlyMode)
        <div class="col-md-6 input-margin mt-4">
            <label class="form-label" for="lead-name-{{ $lead->id ?: 'new' }}">Name</label>
            <input class="form-control @error('name') is-invalid @enderror" type="text" id="lead-name-{{ $lead->id ?: 'new' }}" name="name" value="{{ old('name', $lead->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 input-margin mt-4">
            <label class="form-label" for="lead-phone-{{ $lead->id ?: 'new' }}">Phone</label>
            <input class="form-control @error('phone') is-invalid @enderror" type="text" id="lead-phone-{{ $lead->id ?: 'new' }}" name="phone" value="{{ old('phone', $lead->phone) }}">
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 input-margin">
            <label class="form-label" for="lead-source-{{ $lead->id ?: 'new' }}">Source</label>
            <select class="form-select @error('source') is-invalid @enderror" id="lead-source-{{ $lead->id ?: 'new' }}" name="source" data-choices data-choices-multiple-remove="true" data-choices-search-true>
                <option value="">Select source</option>
                @foreach ($sources as $source)
                    <option value="{{ $source }}" @selected(old('source', $lead->source) === $source)>{{ $source }}</option>
                @endforeach
            </select>
            @error('source')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 input-margin">
            <label class="form-label" for="lead-assigned-{{ $lead->id ?: 'new' }}">Assigned To</label>
            <select class="form-select @error('assigned_user_id') is-invalid @enderror" id="lead-assigned-{{ $lead->id ?: 'new' }}" name="assigned_user_id" data-choices data-choices-multiple-remove="true" data-choices-search-true>
                <option value="">{{ $lead->exists ? 'Select staff' : 'Auto assign equally' }}</option>
                @foreach ($assignableStaffs as $staffOption)
                    <option value="{{ $staffOption->id }}" @selected((string) old('assigned_user_id', $lead->assigned_user_id) === (string) $staffOption->id)>
                        {{ $staffOption->name }}
                    </option>
                @endforeach
            </select>
            @error('assigned_user_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 input-margin">
            <label class="form-label" for="lead-date-{{ $lead->id ?: 'new' }}">Lead Date</label>
            <input class="form-control @error('lead_date') is-invalid @enderror" type="date" id="lead-date-{{ $lead->id ?: 'new' }}" name="lead_date" value="{{ old('lead_date', optional($lead->lead_date)->format('Y-m-d')) }}">
            @error('lead_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    @endif

    <div class="col-md-{{ $readonlyMode ? '12' : '6' }} input-margin">
        <label class="form-label" for="lead-status-{{ $lead->id ?: 'new' }}">Status</label>
        <select class="form-select @error('status') is-invalid @enderror" id="lead-status-{{ $lead->id ?: 'new' }}" name="status" data-choices data-choices-multiple-remove="true" data-choices-search-true required>
            @foreach ($statuses as $status)
                <option value="{{ $status }}" @selected(old('status', $lead->status ?: 'new') === $status)>{{ ucfirst($status) }}</option>
            @endforeach
        </select>
        @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12 input-margin">
        <label class="form-label" for="lead-notes-{{ $lead->id ?: 'new' }}">Notes</label>
        <textarea class="form-control @error('notes') is-invalid @enderror" id="lead-notes-{{ $lead->id ?: 'new' }}" name="notes" rows="4">{{ old('notes', $lead->notes) }}</textarea>
        @error('notes')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
