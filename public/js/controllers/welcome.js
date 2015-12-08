angular.module('findaproApp').controller('welcomeController', function($scope, $http) {
    $scope.init = function() {
        var xhr;
        var select_category, $select_category;
        var select_country, $select_country;
        var select_region, $select_region;
        var select_location, $select_location;
        $select_category = $('#select-category').selectize({
            valueField: 'id',
            labelField: 'name',
            searchField: ['name'],
            load: function(query, callback) {
                if (!query.length) return callback();
                $.ajax({
                    url: '/api/categories?q=' + encodeURIComponent(query),
                    type: 'GET',
                    dataType: 'json',
                    error: function() {
                        callback();
                    },
                    success: function(res) {
                        callback(res.categories.slice(0, 10));
                    }
                });
            },
        });
        $select_country = $('#select-country').selectize({
            valueField: 'id_country',
            labelField: 'name',
            searchField: 'name',
            options: [],
            create: false,
            render: {
                option: function(item, escape) {
                    return '<div>' +
                        '<span class="title">' +
                        '<span class="name">' + escape(item.name) + '</span>' +
                        '</span>' +
                        '</div>';
                }
            },
            load: function(query, callback) {
                if (!query.length) return callback();
                $.ajax({
                    url: '/api/countries?q=' + encodeURIComponent(query),
                    type: 'GET',
                    dataType: 'json',
                    error: function() {
                        callback();
                    },
                    success: function(res) {
                        callback(res.countries.slice(0, 10));
                    }
                });
            },
            onChange: function(value) {
                if (!value.length) return;
                select_region.disable();
                select_region.clearOptions();
                select_location.disable();
                select_location.clearOptions();
                select_region.load(function(callback) {
                    makeMap('countries', value);
                    xhr && xhr.abort();
                    xhr = $.ajax({
                        url: '/api/regions?q=' + value,
                        type: 'GET',
                        dataType: 'json',
                        success: function(results) {
                            select_region.enable();
                            callback(results.regions);
                        },
                        error: function() {
                            callback();
                        }
                    })
                });
            }
        });
        $select_region = $('#select-region').selectize({
            valueField: 'id_region',
            labelField: 'name',
            searchField: ['name'],
            onChange: function(value) {
                if (!value.length) return;
                select_location.disable();
                select_location.clearOptions();
                select_location.load(function(callback) {
                    makeMap('regions', value);
                    xhr && xhr.abort();
                    xhr = $.ajax({
                        url: '/api/locations?q=' + value,
                        type: 'GET',
                        dataType: 'json',
                        success: function(results) {
                            select_location.enable();
                            callback(results.locations);
                        },
                        error: function() {
                            callback();
                        }
                    })
                });
            }
        });
        $select_location = $('#select-location').selectize({
            valueField: 'id_location',
            labelField: 'name',
            searchField: ['name'],
            onChange: function(value) {
                makeMap('locations', value);
            }
        });
        select_category  = $select_category[0].selectize;
        select_country  = $select_country[0].selectize;
        select_location  = $select_location[0].selectize;
        select_region  = $select_region[0].selectize;
        select_category.enable();
        select_country.enable();
        select_location.disable();
        select_region.disable();
    }
    $scope.init();
    makeMap = function (ent, id) {
        $.ajax({
            url: '/api/'+ent+'?id=' + encodeURIComponent(id),
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                var map = new GMaps({
                    el: '#map',
                    lat: res.lat,
                    lng: res.long
                });
            }
        });
    }
});