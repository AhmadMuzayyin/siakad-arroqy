@php $editing = isset($raport) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="score_id" label="Nilai" required>
            @php $selected = old('score_id', ($editing ? $raport->score_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Pilih Data Nilai</option>
            @foreach($scores as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <div
            x-data="imageViewer('{{ $editing && $raport->signature ? \Storage::url($raport->signature) : '' }}')"
        >
            <x-inputs.partials.label
                name="signature"
                label="Tanda Tangan Wali Kelas"
            ></x-inputs.partials.label
            ><br />

            <!-- Show the image -->
            <template x-if="imageUrl">
                <img
                    :src="imageUrl"
                    class="object-cover rounded border border-gray-200"
                    style="width: 100px; height: 100px;"
                />
            </template>

            <!-- Show the gray box when image is not available -->
            <template x-if="!imageUrl">
                <div
                    class="border rounded border-gray-200 bg-gray-100"
                    style="width: 100px; height: 100px;"
                ></div>
            </template>

            <div class="mt-2">
                <input
                    type="file"
                    name="signature"
                    id="signature"
                    @change="fileChosen"
                />
            </div>

            @error('signature') @include('components.inputs.partials.error')
            @enderror
        </div>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <div
            x-data="imageViewer('{{ $editing && $raport->principal_signature ? \Storage::url($raport->principal_signature) : '' }}')"
        >
            <x-inputs.partials.label
                name="principal_signature"
                label="Tanda Tangan Kepala Sekolah"
            ></x-inputs.partials.label
            ><br />

            <!-- Show the image -->
            <template x-if="imageUrl">
                <img
                    :src="imageUrl"
                    class="object-cover rounded border border-gray-200"
                    style="width: 100px; height: 100px;"
                />
            </template>

            <!-- Show the gray box when image is not available -->
            <template x-if="!imageUrl">
                <div
                    class="border rounded border-gray-200 bg-gray-100"
                    style="width: 100px; height: 100px;"
                ></div>
            </template>

            <div class="mt-2">
                <input
                    type="file"
                    name="principal_signature"
                    id="principal_signature"
                    @change="fileChosen"
                />
            </div>

            @error('principal_signature')
            @include('components.inputs.partials.error') @enderror
        </div>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="status" label="Status">
            @php $selected = old('status', ($editing ? $raport->status : '')) @endphp
            <option value="already_printed" {{ $selected == 'already_printed' ? 'selected' : '' }} >Already printed</option>
            <option value="not_printed_yet" {{ $selected == 'not_printed_yet' ? 'selected' : '' }} >Not printed yet</option>
            <option value="confirmed" {{ $selected == 'confirmed' ? 'selected' : '' }} >Confirmed</option>
            <option value="not_confirmed" {{ $selected == 'not_confirmed' ? 'selected' : '' }} >Not confirmed</option>
        </x-inputs.select>
    </x-inputs.group>
</div>
