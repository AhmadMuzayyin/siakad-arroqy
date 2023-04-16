@php $editing = isset($student) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="student_class_id" label="Kelas" required>
            @php $selected = old('student_class_id', ($editing ? $student->student_class_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Pilih Kelas Siswa</option>
            @foreach($studentClasses as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Nama Lengkap"
            :value="old('name', ($editing ? $student->name : ''))"
            maxlength="255"
            placeholder="Nama Lengkap"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="gender" label="Jenis Kelamin">
            @php $selected = old('gender', ($editing ? $student->gender : '')) @endphp
            <option value="male" {{ $selected == 'male' ? 'selected' : '' }} >Male</option>
            <option value="female" {{ $selected == 'female' ? 'selected' : '' }} >Female</option>
            <option value="other" {{ $selected == 'other' ? 'selected' : '' }} >Other</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="date_birth"
            label="Tanggal Lahir"
            value="{{ old('date_birth', ($editing ? optional($student->date_birth)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="address_birth"
            label="Tempat Lahir"
            :value="old('address_birth', ($editing ? $student->address_birth : ''))"
            maxlength="255"
            placeholder="Tempat Lahir"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="address"
            label="Alamat"
            maxlength="255"
            required
            >{{ old('address', ($editing ? $student->address : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="phone"
            label="Nomor Telepon"
            :value="old('phone', ($editing ? $student->phone : ''))"
            maxlength="255"
            placeholder="Nomor Telepon"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
