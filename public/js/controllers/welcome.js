angular.module('findaproApp').controller('welcomeController', function($scope, $http) {
    $scope.init = function() {
        $http.get('/api/categories').
        success(function(data, status, headers, config) {
            $scope.categories = data.categories;
            $scope.selectedCategory = data.selectedCategory;
        });
        var xhr;
        var select_country, $select_country;
        var select_region, $select_region;
        var select_location, $select_location;
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
            searchField: ['name']
        });

        select_location  = $select_location[0].selectize;
        select_region  = $select_region[0].selectize;
        select_country = $select_country[0].selectize;

        select_location.disable();
        select_region.disable();
    }
    $scope.init();
});