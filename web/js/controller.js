var iAdvizeApp = angular
    .module('iAdvizeApp', ['iAdvizeFilters'])
    .config(
    function($interpolateProvider){
        $interpolateProvider.startSymbol('[[').endSymbol(']]');
    }
);

iAdvizeApp.controller('iAdvizeCtrl', ['$scope', '$http', function ($scope, $http) {

    $scope.vdms = [];
    $scope.loading = false;

    $scope.loadData = function() {
        getData();
    };

    var getData = function() {
        $scope.loading = true;
        $http.get(url.load).success(function(data) {
            $scope.vdms = data.posts;
            $scope.loading = false;
        }).error(
            function() {
                alert("Oops");
                $scope.loading = false;
            }
        );
    };

    $scope.updateVdm = function() {

        $scope.loading = true;
        $scope.vdms = [];

        $http.get(url.parse).success(function(data) {
            $scope.loadData();
        }).error(
            function() {
                alert("Oops");
                $scope.loading = false;
            }
        );
    };

    getData();
}]);