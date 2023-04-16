@php $editing = isset($studentClass) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Nama Kelas"
            :value="old('name', ($editing ? $studentClass->name : ''))"
            maxlength="255"
            placeholder="Nama Kelas"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
