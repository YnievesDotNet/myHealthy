<?php
/**
 * The MIT License (MIT)
 *
 * Copyright (c) 2007-2015 YnievesDotNet <yoinier.hn@gmail.com>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

// Home
Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push(trans('breadcrumbs.home'), route("home"));
});

// Home > Wizard > Pricing
Breadcrumbs::register('wizard.welcome', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('breadcrumbs.wizard'), route("wizard.welcome"));
});

// Home > Wizard > Pricing
Breadcrumbs::register('wizard.pricing', function ($breadcrumbs) {
    $breadcrumbs->parent('wizard.welcome');
    $breadcrumbs->push(trans('breadcrumbs.pricing'), route("wizard.pricing"));
});

// Home > My business
Breadcrumbs::register('manager.business.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('breadcrumbs.myBusinesses'), route('manager.business.index'));
});

// Home > My business > Create
Breadcrumbs::register('manager.business.create', function ($breadcrumbs) {
    $breadcrumbs->parent('manager.business.index');
    $breadcrumbs->push(trans('breadcrumbs.create'), route('manager.business.create'));
});

// Home > My business > ID
Breadcrumbs::register('manager.business.show', function ($breadcrumbs, $business) {
    $breadcrumbs->parent('manager.business.index');
    $breadcrumbs->push($business->name, route('manager.business.show', $business->id));
});

// Home > My business > ID > Preferences
Breadcrumbs::register('manager.business.preferences', function ($breadcrumbs, $business) {
    $breadcrumbs->parent('manager.business.show', $business);
    $breadcrumbs->push(trans('breadcrumbs.preferences'), route('manager.business.preferences'));
});

// Home > My business > ID > Edit
Breadcrumbs::register('manager.business.edit', function ($breadcrumbs, $business) {
    $breadcrumbs->parent('manager.business.show', $business);
    $breadcrumbs->push(trans('breadcrumbs.edit'), route('manager.business.edit'));
});

// Home > My business > ID > Services
Breadcrumbs::register('manager.business.service.index', function ($breadcrumbs, $business) {
    $breadcrumbs->parent('manager.business.show', $business);
    $breadcrumbs->push(trans('breadcrumbs.services'), route('manager.business.service.index', $business->id));
});

// Home > My business > ID > Services > Create
Breadcrumbs::register('manager.business.service.create', function ($breadcrumbs, $business) {
    $breadcrumbs->parent('manager.business.service.index', $business);
    $breadcrumbs->push(trans('breadcrumbs.agregate'), route('manager.business.service.create'));
});

// Home > My business > ID > Services > ID
Breadcrumbs::register('manager.business.service.show', function ($breadcrumbs, $business, $service) {
    $breadcrumbs->parent('manager.business.service.index', $business);
    $breadcrumbs->push($service->name, route('manager.business.service.show', $service->id));
});

// Home > My business > ID > Services > ID > Edit
Breadcrumbs::register('manager.business.service.edit', function ($breadcrumbs, $service) {
    $breadcrumbs->parent('manager.business.service.index', $service);
    $breadcrumbs->push(trans('breadcrumbs.edit'), route('manager.business.service.edit'));
});

// Home > My business > ID > Vacancy > Calendar
Breadcrumbs::register('manager.business.vacancy.index', function ($breadcrumbs, $business) {
    $breadcrumbs->parent('manager.business.show', $business);
    $breadcrumbs->push(trans('breadcrumbs.vacancies'), route('manager.business.vacancy.index'));
});

// Home > My business > ID > Vacancy > Create
Breadcrumbs::register('manager.business.vacancy.create', function ($breadcrumbs, $business) {
    $breadcrumbs->parent('manager.business.show', $business);
    $breadcrumbs->push(trans('breadcrumbs.vacancies'), route('manager.business.vacancy.create'));
});

// Home > My business > ID > Schedule > ID
Breadcrumbs::register('manager.business.schedule.index', function ($breadcrumbs, $business) {
    $breadcrumbs->parent('manager.business.show', $business);
    $breadcrumbs->push(trans('breadcrumbs.schedule'), route('manager.business.schedule.index'));
});

// Home > My business > ID > Contacts
Breadcrumbs::register('manager.business.contact.index', function ($breadcrumbs, $business) {
    $breadcrumbs->parent('manager.business.show', $business);
    $breadcrumbs->push(trans('breadcrumbs.contact'), route('manager.business.contact.index', $business->id));
});

// Home > My business > ID > Contacts > Create
Breadcrumbs::register('manager.business.contact.create', function ($breadcrumbs, $business) {
    $breadcrumbs->parent('manager.business.contact.index', $business);
    $breadcrumbs->push(trans('breadcrumbs.agregate'), route('manager.business.contact.create'));
});

// Home > My business > ID > Contacts > ID
Breadcrumbs::register('manager.business.contact.show', function ($breadcrumbs, $business, $contact) {
    $breadcrumbs->parent('manager.business.contact.index', $business);
    $breadcrumbs->push($contact->fullname, route('manager.business.contact.show'));
});

// Home > My business > ID > Contacts > ID > Edit
Breadcrumbs::register('manager.business.contact.edit', function ($breadcrumbs, $service) {
    $breadcrumbs->parent('manager.business.contact.index', $service);
    $breadcrumbs->push(trans('breadcrumbs.edit'), route('manager.business.contact.edit'));
});

// Home > Users > ID > Business
Breadcrumbs::register('user.businesses.list', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('breadcrumbs.businesses'), route('user.businesses.list'));
});

// Home > Users > ID > Business > ID
Breadcrumbs::register('user.businesses.home', function ($breadcrumbs, $business) {
    $breadcrumbs->parent('user.businesses.list');
    $breadcrumbs->push($business->name, route('user.businesses.home', $business->id));
});

// Home > Users > ID > Contacts
Breadcrumbs::register('user.business.contact', function ($breadcrumbs) {
    $breadcrumbs->parent('user.business.list');
    $breadcrumbs->push(trans('breadcrumbs.businesses'), route('user.business.contact'));
});

// Home > Users > ID > Contacts
Breadcrumbs::register('user.business.contact.create', function ($breadcrumbs, $business) {
    $breadcrumbs->parent('user.businesses.home', $business);
    $breadcrumbs->push(trans('breadcrumbs.create'), route('user.business.contact.create'));
});

// Home > Users > ID > Contacts
Breadcrumbs::register('user.business.contact.show', function ($breadcrumbs, $business, $contact) {
    $breadcrumbs->parent('user.businesses.home', $business);
    $breadcrumbs->push($contact->fullname, route('user.business.contact.show'));
});

// Home > Users > ID > Subscriptions
Breadcrumbs::register('user.businesses.subscriptions', function ($breadcrumbs) {
    $breadcrumbs->parent('user.businesses.list');
    $breadcrumbs->push(trans('breadcrumbs.businesses'), route('user.businesses.subscriptions'));
});

// Home > Users > Appointments
Breadcrumbs::register('user.booking.list', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('breadcrumbs.appointments'), route('user.booking.list'));
});

// Home > Users > Booking
Breadcrumbs::register('user.booking.book', function ($breadcrumbs, $business) {
    $breadcrumbs->parent('user.businesses.home', $business);
    $breadcrumbs->push(trans('breadcrumbs.booking'), route('user.booking.book'));
});


// Root > Dashboard
Breadcrumbs::register('root.dashboard', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('breadcrumbs.dashboard'), route('root.dashboard'));
});