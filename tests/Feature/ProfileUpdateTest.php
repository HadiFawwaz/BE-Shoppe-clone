<?php

use App\Models\User;

test('profile model has new properties', function () {
    $user = User::factory()->create();

    $user->update([
        'alamat' => 'Jl. Test No. 123',
        'no_hp' => '081234567890',
        'sosmed' => '@testuser',
    ]);

    $user->refresh();

    expect($user->alamat)->toBe('Jl. Test No. 123')
        ->and($user->no_hp)->toBe('081234567890')
        ->and($user->sosmed)->toBe('@testuser');
});

test('profile fields are nullable', function () {
    $user = User::factory()->create();

    expect($user->alamat)->toBeNull()
        ->and($user->no_hp)->toBeNull()
        ->and($user->sosmed)->toBeNull();
});
