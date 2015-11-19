angular.module('findaproApp').controller('welcomeController', function($scope, $http) {
    $scope.categories = {};
    $scope.init = function() {
        $http.get('/api/categories').
        success(function(data, status, headers, config) {
            $scope.categories = data.categories;
        });
    }
    //$scope.init();
});