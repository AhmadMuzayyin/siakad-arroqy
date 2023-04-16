@php $editing = isset($semester) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Nama"
            :value="old('name', ($editing ? $semester->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="start"
            label="Mulai"
            value="{{ old('start', ($editing ? optional($semester->start)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="end"
            label="Selesai"
            value="{{ old('end', ($editing ? optional($semester->end)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="academic_year"
            label="Tahun Akademik"
            :value="old('academic_year', ($editing ? $semester->academic_year : ''))"
            max="255"
            placeholder="Tahun Akademik"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="status" label="Status">
            @php $selected = old('status', ($editing ? $semester->status : '')) @endphp
            <option value="Aktif" {{ $selected == 'Aktif' ? 'selected' : '' }} >Aktif</option>
            <option value="Tidak Aktif" {{ $selected == 'Tidak Aktif' ? 'selected' : '' }} >Tidak aktif</option>
        </x-inputs.select>
    </x-inputs.group>
</div>
