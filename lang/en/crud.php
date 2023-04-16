<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'attach' => 'Attach',
        'detach' => 'Detach',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'wali_kelas' => [
        'name' => 'Wali Kelas',
        'index_title' => 'Data Wali Kelas',
        'new_title' => 'Data Wali Kelas Baru',
        'create_title' => 'Tambah Data Wali Kelas',
        'edit_title' => 'Edit Data Wali Kelas',
        'show_title' => 'Detail Wali Kelas',
        'inputs' => [
            'teacher_id' => 'Nama Guru',
            'student_class_id' => 'Kelas',
        ],
    ],

    'raport' => [
        'name' => 'Raport',
        'index_title' => 'Data Raport',
        'new_title' => 'Data Raport Baru',
        'create_title' => 'Tambah Data Raport',
        'edit_title' => 'Edit Data Raport',
        'show_title' => 'Detail Data Raport',
        'inputs' => [
            'score_id' => 'Nilai',
            'signature' => 'Tanda Tangan Wali Kelas',
            'principal_signature' => 'Tanda Tangan Kepala Sekolah',
            'status' => 'Status',
        ],
    ],

    'nilai' => [
        'name' => 'Nilai',
        'index_title' => 'Data Nilai',
        'new_title' => 'Data Nilai Baru',
        'create_title' => 'Tambah Data Nilai',
        'edit_title' => 'Edit Data Nilai',
        'show_title' => 'Detail Data Nilai',
        'inputs' => [
            'semester_id' => 'Semester',
            'student_id' => 'Siswa',
            'lesson_id' => 'Mata Pelajaran',
            'attendance' => 'Nilai Absen',
            'test' => 'Nilai Ujian',
        ],
    ],

    'jadwal' => [
        'name' => 'Jadwal',
        'index_title' => 'Data Jadwal',
        'new_title' => 'Data Jadwal Baru',
        'create_title' => 'Tambah Data Jadwal',
        'edit_title' => 'Edit Data Jadwal',
        'show_title' => 'Detail Data Jadwal',
        'inputs' => [
            'semester_id' => 'Jam Masuk',
            'student_class_id' => 'Kelas',
            'lesson_id' => 'Mata Pelajaran',
            'teacher_id' => 'Guru',
            'day' => 'Hari',
            'clock_in' => 'Jam Masuk',
            'clock_out' => 'Jam Keluar',
        ],
    ],

    'siswa' => [
        'name' => 'Siswa',
        'index_title' => 'Data Siswa',
        'new_title' => 'Data Siswa Baru',
        'create_title' => 'Tambah Data Siswa',
        'edit_title' => 'Edit Data Siswa',
        'show_title' => 'Detail Data Siswa',
        'inputs' => [
            'student_class_id' => 'Kelas',
            'name' => 'Nama Lengkap',
            'gender' => 'Jenis Kelamin',
            'date_birth' => 'Tanggal Lahir',
            'address_birth' => 'Tempat Lahir',
            'address' => 'Alamat',
            'phone' => 'Nomor Telepon',
        ],
    ],

    'guru' => [
        'name' => 'Guru',
        'index_title' => 'Data Guru',
        'new_title' => 'Data Guru Baru',
        'create_title' => 'Tambah Data Guru',
        'edit_title' => 'Edit Data Guru',
        'show_title' => 'Detail Data Guru',
        'inputs' => [
            'name' => 'Nama Guru',
            'phone' => 'Nomor Telepon',
            'gender' => 'Jenis Kelamin',
            'address' => 'Alamat',
        ],
    ],

    'kelas' => [
        'name' => 'Kelas',
        'index_title' => 'Data Kelas',
        'new_title' => 'Data Kelas Baru',
        'create_title' => 'Tambah Data Kelas',
        'edit_title' => 'Edit Data Kelas',
        'show_title' => 'Edit Data Kelas',
        'inputs' => [
            'name' => 'Nama Kelas',
        ],
    ],

    'semester' => [
        'name' => 'Semester',
        'index_title' => 'Data Semester',
        'new_title' => 'Data Semester baru',
        'create_title' => 'Tambah Data Semester',
        'edit_title' => 'Edit Data Semester',
        'show_title' => 'Detail Data Semester',
        'inputs' => [
            'name' => 'Nama',
            'start' => 'Mulai',
            'end' => 'Selesai',
            'academic_year' => 'Tahun Akademik',
            'status' => 'Status',
        ],
    ],

    'pengguna' => [
        'name' => 'Pengguna',
        'index_title' => 'Data Pengguna',
        'new_title' => 'Data Pengguna Baru',
        'create_title' => 'Tambah Data Pengguna',
        'edit_title' => 'Edit Data Pengguna',
        'show_title' => 'Detail Data Pengguna',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
        ],
    ],

    'mata_pelajaran' => [
        'name' => 'Mata Pelajaran',
        'index_title' => 'Data Mata Pelajaran',
        'new_title' => 'Data Mata Pelajaran Baru',
        'create_title' => 'Tambah Data Mata Pelajaran',
        'edit_title' => 'Edit Data Mata Pelajaran',
        'show_title' => 'Detail  Data Mata Pelajaran',
        'inputs' => [
            'name' => 'Nama Mata Pelajaran',
            'student_class_id' => 'Kelas',
            'teacher_id' => 'Guru',
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Roles List',
        'create_title' => 'Create Role',
        'edit_title' => 'Edit Role',
        'show_title' => 'Show Role',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'permissions' => [
        'name' => 'Permissions',
        'index_title' => 'Permissions List',
        'create_title' => 'Create Permission',
        'edit_title' => 'Edit Permission',
        'show_title' => 'Show Permission',
        'inputs' => [
            'name' => 'Name',
        ],
    ],
];
