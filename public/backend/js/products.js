myApp.controller('content_users', function ($scope, $apply, $timeout, $sce) {
    $scope.data = {};
    $scope.listProducts = {};
    sv.data.getAllProducts(function (response) {
        alert(1);
        console.log(response);

        $apply(function () {
//            $scope.listProducts = response;
        });
    });
});
$(function () {

});