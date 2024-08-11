<?php

test('Jobs Route contains Jobs Listings', function () {
    $response = $this->get('/jobs');

    $response->assertStatus(200);

    $response->assertSee('Jobs Listings');
});


