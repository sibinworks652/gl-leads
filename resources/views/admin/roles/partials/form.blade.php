@php
    $selectedGuard = old('guard_name', $roleModel?->guard_name ?? 'admin');
    $selectedPermissions = collect(old('permissions', $roleModel?->permissions->pluck('name')->all() ?? []));
    $formKey = $formKey ?? 'role';
    $guardFieldId = 'guard_name_'.$formKey;
    $adminPermissionsFieldId = 'permissions_admin_'.$formKey;
    $webPermissionsFieldId = 'permissions_web_'.$formKey;
@endphp

<div class="row g-3">
    <div class="col-md-6 input-margin mt-4">
        <label class="form-label" for="name">Role Name</label>
        <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" value="{{ old('name', $roleModel?->name) }}" required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 input-margin mt-4">
        <label class="form-label" for="{{ $guardFieldId }}">Guard</label>
        <select class="form-select @error('guard_name') is-invalid @enderror" id="{{ $guardFieldId }}" name="guard_name" required>
            <option value="admin" @selected($selectedGuard === 'admin')>Admin</option>
            <option value="web" @selected($selectedGuard === 'web')>Web</option>
        </select>
        <div class="form-text">Select guard to load matching permissions.</div>
        @error('guard_name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12 input-margin">
        <label class="form-label">Permissions</label>

        <div id="permissions_wrap_admin_{{ $formKey }}" class="{{ $selectedGuard === 'admin' ? '' : 'd-none' }}">
            <select class="form-select @error('permissions') is-invalid @enderror @error('permissions.*') is-invalid @enderror" id="{{ $adminPermissionsFieldId }}" name="permissions[]" data-choices data-choices-multiple-remove="true" multiple>
                @foreach ($permissionsByGuard->get('admin', collect()) as $permission)
                    <option value="{{ $permission->name }}" @selected($selectedPermissions->contains($permission->name))>
                        {{ $permission->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div id="permissions_wrap_web_{{ $formKey }}" class="{{ $selectedGuard === 'web' ? '' : 'd-none' }}">
            <select class="form-select @error('permissions') is-invalid @enderror @error('permissions.*') is-invalid @enderror" id="{{ $webPermissionsFieldId }}" data-choices data-choices-multiple-remove="true" name="permissions[]" multiple>
                @foreach ($permissionsByGuard->get('web', collect()) as $permission)
                    <option value="{{ $permission->name }}" @selected($selectedPermissions->contains($permission->name))>
                        {{ $permission->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-text">Choose guard, then select permissions from that guard only.</div>
        @error('permissions')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
        @error('permissions.*')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
</div>

<script>
    (function () {
        const guardSelect = document.getElementById(@json($guardFieldId));
        const adminWrap = document.getElementById(@json('permissions_wrap_admin_'.$formKey));
        const webWrap = document.getElementById(@json('permissions_wrap_web_'.$formKey));
        const adminSelect = document.getElementById(@json($adminPermissionsFieldId));
        const webSelect = document.getElementById(@json($webPermissionsFieldId));

        if (!guardSelect || !adminWrap || !webWrap || !adminSelect || !webSelect) {
            return;
        }

        const resolveChoicesUi = (selectEl, wrapEl) => {
            if (!selectEl || !wrapEl) {
                return null;
            }

            if (selectEl.nextElementSibling?.classList.contains('choices')) {
                return selectEl.nextElementSibling;
            }

            return wrapEl.querySelector('.choices');
        };

        const togglePermissionSelect = () => {
            const selectedGuard = guardSelect.value;
            const adminChoicesUi = resolveChoicesUi(adminSelect, adminWrap);
            const webChoicesUi = resolveChoicesUi(webSelect, webWrap);

            if (selectedGuard === 'admin') {
                adminWrap.classList.remove('d-none');
                webWrap.classList.add('d-none');
                if (adminChoicesUi) {
                    adminChoicesUi.classList.remove('d-none');
                }
                if (webChoicesUi) {
                    webChoicesUi.classList.add('d-none');
                }
                Array.from(webSelect.options).forEach((option) => {
                    option.selected = false;
                });
            } else {
                webWrap.classList.remove('d-none');
                adminWrap.classList.add('d-none');
                if (webChoicesUi) {
                    webChoicesUi.classList.remove('d-none');
                }
                if (adminChoicesUi) {
                    adminChoicesUi.classList.add('d-none');
                }
                Array.from(adminSelect.options).forEach((option) => {
                    option.selected = false;
                });
            }
        };

        guardSelect.addEventListener('change', togglePermissionSelect);
        document.addEventListener('DOMContentLoaded', togglePermissionSelect);
        setTimeout(togglePermissionSelect, 0);
    })();
</script>

