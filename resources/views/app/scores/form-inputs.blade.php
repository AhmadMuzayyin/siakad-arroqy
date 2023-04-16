@php $editing = isset($score) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="semester_id" label="Semester" required>
            @php $selected = old('semester_id', ($editing ? $score->semester_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Pilih Semester</option>
            @foreach($semesters as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="student_id" label="Siswa" required>
            @php $selected = old('student_id', ($editing ? $score->student_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Pilih Siswa</option>
            @foreach($students as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="lesson_id" label="Mata Pelajaran" required>
            @php $selected = old('lesson_id', ($editing ? $score->lesson_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Pilih Mata Pelajaran</option>
            @foreach($lessons as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="attendance"
            label="Nilai Absen"
            :value="old('attendance', ($editing ? $score->attendance : ''))"
            max="255"
            placeholder="Nilai Absen"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="test"
            label="Nilai Ujian"
            :value="old('test', ($editing ? $score->test : ''))"
            max="255"
            placeholder="Nilai Ujian"
            required
        ></x-inputs.number>
    </x-inputs.group>
</div>
