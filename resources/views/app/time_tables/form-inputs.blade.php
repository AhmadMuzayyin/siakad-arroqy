@php $editing = isset($timeTable) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="semester_id" label="Jam Masuk" required>
            @php $selected = old('semester_id', ($editing ? $timeTable->semester_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Pilih Semester</option>
            @foreach($semesters as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="student_class_id" label="Kelas" required>
            @php $selected = old('student_class_id', ($editing ? $timeTable->student_class_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Pilih Kelas</option>
            @foreach($studentClasses as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="lesson_id" label="Mata Pelajaran" required>
            @php $selected = old('lesson_id', ($editing ? $timeTable->lesson_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Pilih Mata Pelajaran</option>
            @foreach($lessons as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="teacher_id" label="Guru" required>
            @php $selected = old('teacher_id', ($editing ? $timeTable->teacher_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Pilih Guru</option>
            @foreach($teachers as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="day"
            label="Hari"
            :value="old('day', ($editing ? $timeTable->day : ''))"
            maxlength="255"
            placeholder="Hari"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.datetime
            name="clock_in"
            label="Jam Masuk"
            value="{{ old('clock_in', ($editing ? optional($timeTable->clock_in)->format('Y-m-d\TH:i:s') : '')) }}"
            max="255"
            required
        ></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.datetime
            name="clock_out"
            label="Jam Keluar"
            value="{{ old('clock_out', ($editing ? optional($timeTable->clock_out)->format('Y-m-d\TH:i:s') : '')) }}"
            max="255"
            required
        ></x-inputs.datetime>
    </x-inputs.group>
</div>
