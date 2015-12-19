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

// Home > My business
Breadcrumbs::register('manager.business.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('breadcrumbs.myBusinesses'), route('manager.business.index'));
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