<?php

use Livewire\Livewire;
use ProdigyPHP\Prodigy\Livewire\PageSettingsEditor;
use ProdigyPHP\Prodigy\Models\Page;
use ProdigyPHP\Prodigy\Models\User;
use ProdigyPHP\Prodigy\ProdigyPage;
use function Pest\Livewire\livewire;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNull;

it('can edit a page', function () {
    $this->actingAs(User::factory()->create(['name' => 'Stephen', 'email' => 'stephen@bate-man.com']));

    $page = Page::factory()->create(['title' => 'Hey You', 'slug' => 'hey-you']);

    Livewire::withQueryParams(['editing' => true])
        ->test(ProdigyPage::class, ['wildcard' => 'hey-you'])
        ->assertSet('editing', true)
        ->assertSee('Publish');

});

it('cannot edit a page without a user', function () {

    $page = Page::factory()->create(['title' => 'Hey You', 'slug' => 'hey-you']);

    Livewire::withQueryParams(['editing' => true])
        ->test(ProdigyPage::class, ['wildcard' => 'hey-you'])
        ->assertNotSet('editing', true);

});

it('creates a draft when editing a page', function () {
    $this->actingAs(User::factory()->create(['name' => 'Stephen', 'email' => 'stephen@bate-man.com']));

    $page = Page::factory()->create(['title' => 'Hey You', 'slug' => 'hey-you']);

    Livewire::withQueryParams(['editing' => true])
        ->test(ProdigyPage::class, ['wildcard' => 'hey-you'])
        ->assertSet('editing', true);

    assertEquals(Page::all()->count(), 2);

});