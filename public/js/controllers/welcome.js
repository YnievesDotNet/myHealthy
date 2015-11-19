angular.module('findaproApp').controller('welcomeController', function($scope, $http) {
    $scope.init = function() {
        $http.get('/api/categories').
        success(function(data, status, headers, config) {
            $scope.categories = data.categories;
            $scope.selectedCategory = data.selectedCategory;
        });
        $scope.provinces = [{"id":1,"slug":"dc","name":"Capital"}];
        $scope.selectedProvince = {"id":1,"slug":"dc","name":"Capital"};
        $scope.cities = [{"id":1,"slug":"quito","name":"Quito"}];
        $scope.selectedCity = {"id":1,"slug":"quito","name":"Quito"};
        $scope.churches = [{"id":1,"slug":"primera","name":"Primera"}];
        $scope.selectedChurch = {"id":1,"slug":"primera","name":"Primera"};

    }
    $scope.init();
});