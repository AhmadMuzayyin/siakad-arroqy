@php $editing = isset($teacher) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Nama Guru"
            :value="old('name', ($editing ? $teacher->name : ''))"
            maxlength="255"
            placeholder="Nama Guru"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="phone"
            label="Nomor Telepon"
            :value="old('phone', ($editing ? $teacher->phone : ''))"
            maxlength="255"
            placeholder="Nomor Telepon"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="gender" label="Jenis Kelamin">
            @php $selected = old('gender', ($editing ? $teacher->gender : '')) @endphp
            <option value="male" {{ $selected == 'male' ? 'selected' : '' }} >Male</option>
            <option value="female" {{ $selected == 'female' ? 'selected' : '' }} >Female</option>
            <option value="other" {{ $selected == 'other' ? 'selected' : '' }} >Other</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="address"
            label="Alamat"
            maxlength="255"
            required
            >{{ old('address', ($editing ? $teacher->address : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>
</div>
