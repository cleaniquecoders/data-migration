<?php

use Illuminate\Support\Facades\Artisan;

it('has config', function () {
    expect(! empty(config('data-migration')))->toBeTrue();
});

it('has data:migrate command', function () {
    expect(in_array('data:migrate', array_keys(Artisan::all())))->toBeTrue();
});
