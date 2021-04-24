<?php

// Home
Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push('Beranda', route('admin.dashboard'));
});

// Index
Breadcrumbs::for('admin.bus.index', function ($trail) {
    $trail->push('Beranda', route('admin.dashboard'));
    $trail->push('Bisnis Unit', route('admin.bus.index'));
});

Breadcrumbs::for('admin.kjpps.index', function ($trail) {
    $trail->push('Beranda', route('admin.dashboard'));
    $trail->push('KJPP', route('admin.kjpps.index'));
});


Breadcrumbs::for('admin.users.index', function ($trail) {
    $trail->push('Beranda', route('admin.dashboard'));
    $trail->push('PIC', route('admin.users.index'));
});


Breadcrumbs::for('admin.reviews.index', function ($trail) {
    $trail->push('Beranda', route('admin.dashboard'));
    $trail->push('Review LPA', route('admin.reviews.index'));
});

Breadcrumbs::for('admin.developer.index', function ($trail) {
    $trail->push('Beranda', route('admin.dashboard'));
    $trail->push('Developer', route('admin.developer.index'));
});

Breadcrumbs::for('admin.flpps.index', function ($trail) {
    $trail->push('Beranda', route('admin.dashboard'));
    $trail->push('Inspeksi FLPP', route('admin.flpps.index'));
});

Breadcrumbs::for('admin.internal.index', function ($trail) {
    $trail->push('Beranda', route('admin.dashboard'));
    $trail->push('Penilaian Internal', route('admin.internal.index'));
});

Breadcrumbs::for('admin.vercall.index', function ($trail) {
    $trail->push('Beranda', route('admin.dashboard'));
    $trail->push('Verifikasi Progress', route('admin.vercall.index'));
});

Breadcrumbs::for('admin.kerjareview.index', function ($trail) {
    $trail->push('Beranda', route('admin.dashboard'));
    $trail->push('Review on process', route('admin.kerjareview.index'));
});

Breadcrumbs::for('admin.holidays.index', function ($trail) {
    $trail->push('Beranda', route('admin.dashboard'));
    $trail->push('Daftar Hari Libur', route('admin.holidays.index'));
});

// Tambah
Breadcrumbs::for('admin.bus.create', function ($trail) {
    $trail->push('Beranda', route('admin.dashboard'));
    $trail->push('Bisnis Unit', route('admin.bus.index'));
    $trail->push('Tambah Bisnis Unit', route('admin.bus.create'));
});

Breadcrumbs::for('admin.kjpps.create', function ($trail) {
    $trail->push('Beranda', route('admin.dashboard'));
    $trail->push('KJPP', route('admin.kjpps.index'));
    $trail->push('Tambah KJPP', route('admin.kjpps.create'));
});

Breadcrumbs::for('admin.users.create', function ($trail) {
    $trail->push('Beranda', route('admin.dashboard'));
    $trail->push('PIC', route('admin.users.index'));
    $trail->push('Tambah PIC', route('admin.users.create'));
});

Breadcrumbs::for('admin.reviews.create', function ($trail) {
    $trail->push('Beranda', route('admin.dashboard'));
    $trail->push('Review LPA', route('admin.reviews.index'));
    $trail->push('Tambah Order', route('admin.reviews.create'));
});

Breadcrumbs::for('admin.developer.create', function ($trail) {
    $trail->push('Beranda', route('admin.dashboard'));
    $trail->push('Developer', route('admin.developer.index'));
    $trail->push('Tambah Developer', route('admin.developer.create'));
});

Breadcrumbs::for('admin.flpps.create', function ($trail) {
    $trail->push('Beranda', route('admin.dashboard'));
    $trail->push('Inspeksi FLPP', route('admin.flpps.index'));
    $trail->push('Tambah Order', route('admin.flpps.create'));
});

Breadcrumbs::for('admin.internal.create', function ($trail) {
    $trail->push('Beranda', route('admin.dashboard'));
    $trail->push('Penilaian Internal', route('admin.internal.index'));
    $trail->push('Tambah Order', route('admin.internal.create'));
});

Breadcrumbs::for('admin.vercall.create', function ($trail) {
    $trail->push('Beranda', route('admin.dashboard'));
    $trail->push('Verifikasi Progress', route('admin.vercall.index'));
    $trail->push('Tambah Order', route('admin.vercall.create'));
});

Breadcrumbs::for('admin.holidays.create', function ($trail) {
    $trail->push('Beranda', route('admin.dashboard'));
    $trail->push('Verifikasi Progress', route('admin.holidays.index'));
    $trail->push('Tambah Hari Libur', route('admin.holidays.create'));
});

// Edit
Breadcrumbs::for('admin.bus.edit', function ($trail, $bu) {
    $trail->push('Beranda', route('admin.dashboard'));
    $trail->push('Bisnis Unit', route('admin.bus.index'));
    $trail->push('Edit Bisnis Unit', route('admin.bus.edit', $bu));
});

Breadcrumbs::for('admin.kjpps.edit', function ($trail, $kjpp) {
    $trail->push('Beranda', route('admin.dashboard'));
    $trail->push('KJPP', route('admin.kjpps.index'));
    $trail->push('Edit KJPP', route('admin.kjpps.edit', $kjpp));
});



Breadcrumbs::for('admin.users.edit', function ($trail, $user) {
    $trail->push('Beranda', route('admin.dashboard'));
    $trail->push('PIC', route('admin.users.index'));
    $trail->push('Edit PIC', route('admin.users.edit', $user));
});


Breadcrumbs::for('admin.reviews.edit', function ($trail, $review) {
    $trail->push('Beranda', route('admin.dashboard'));
    $trail->push('Review LPA', route('admin.reviews.index'));
    $trail->push('Edit Order Review', route('admin.reviews.edit', $review));
});

Breadcrumbs::for('admin.developer.edit', function ($trail, $developer) {
    $trail->push('Beranda', route('admin.dashboard'));
    $trail->push('Developer', route('admin.developer.index'));
    $trail->push('Edit Data Developer', route('admin.developer.edit', $developer));
});

Breadcrumbs::for('admin.flpps.edit', function ($trail, $flpp) {
    $trail->push('Beranda', route('admin.dashboard'));
    $trail->push('Developer', route('admin.flpps.index'));
    $trail->push('Edit Data Inspeksi FLPP', route('admin.flpps.edit', $flpp));
});

Breadcrumbs::for('admin.internal.edit', function ($trail, $internal) {
    $trail->push('Beranda', route('admin.dashboard'));
    $trail->push('Penilaian Internal', route('admin.internal.index'));
    $trail->push('Edit Data Penilaian Internal', route('admin.internal.edit', $internal));
});

Breadcrumbs::for('admin.vercall.edit', function ($trail, $vercall) {
    $trail->push('Beranda', route('admin.dashboard'));
    $trail->push('Penilaian Internal', route('admin.vercall.index'));
    $trail->push('Edit Data Verifikasi Progress', route('admin.vercall.edit', $vercall));
});

Breadcrumbs::for('admin.holidays.edit', function ($trail, $holiday) {
    $trail->push('Beranda', route('admin.dashboard'));
    $trail->push('Hari Libur', route('admin.holidays.index'));
    $trail->push('Edit Data Hari Libur', route('admin.holidays.edit', $holiday));
});