angular.module('findaproApp').controller('welcomeController', function($scope, $http) {
    $scope.init = function() {
        $http.get('/api/categories').
        success(function(data, status, headers, config) {
            $scope.categories = data.categories;
            $scope.selectedCategory = data.selectedCategory;
        });
        $http.get('/api/countries').
        success(function(data, status, headers, config) {
            $scope.countries= data.countries;
            $scope.selectedCountry = data.selectedCountry;
        });
        $http.get('/api/regions').
        success(function(data, status, headers, config) {
            $scope.regions = data.regions;
            $scope.selectedRegion = data.selectedRegion;
        });
        $http.get('/api/locations').
        success(function(data, status, headers, config) {
            $scope.locations = data.locations;
            $scope.selectedLocation = data.selectedLocation;
        });
    }
    $scope.init();
});