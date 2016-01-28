var app = angular.module('App', ['ngRoute']);
var API_URL = "http://laravel.loc/api/v1";
app.config(function ($routeProvider) {
    $routeProvider

    // route for the home page
        .when('/', {
            templateUrl: 'app/views/index.html',
            controller: 'AppCtrl'
        })
});
app.controller('AppCtrl', function ($scope, $http) {
    $scope.posts = [];
    $scope.editpost = {};
    $scope.addpost = {};
    $scope.showModal = false;
    $http({
        method: 'POST',
        url: API_URL + '/posts'
    }).then(function successCallback(response) {
        $scope.posts = response.data.posts;
    }, function errorCallback(response) {
        console.log(response);
    });
    $scope.editPost = function (id) {

    };

    /**
     * add post
     */
    $scope.add = function () {
        var data = [];
        $scope.addpost.published = $scope.addpost.published == true ? 1 : 0;
        //console.log($scope.addpost);
        $http.post(API_URL + '/post/add', $scope.addpost)
            .then(function successCallback(response) {
                //console.log(response);
                $scope.posts = response.data.posts;
                $scope.addpost = {};
            }, function errorCallback(response) {
                $scope.error = response.data;
                console.log(response);
            });
    };
    /**
     * delete action
     * @param id
     */
    $scope.deletePost = function (id) {
        $http({
            method: 'POST',
            url: API_URL + '/post/delete/' + id
        }).then(function successCallback(response) {
            $scope.posts = response.data.posts;
        }, function errorCallback(response) {
        });
    };
    /**
     * edit action
     * @param id
     */

    $scope.edit = function (id) {
        $http({
            method: 'POST',
            url: API_URL + '/post/get/' + id
        }).then(function successCallback(response) {
            $scope.editpost = response.data.post;
            console.log($scope.editpost);
        }, function errorCallback(response) {
            console.log(response);
        });
    };
    /**
     * update action
     * @param id
     */
    $scope.update = function (id) {
        $http({
            method: 'POST',
            url: API_URL + '/post/update/' + id,
            data: $scope.editpost
        }).then(function successCallback(response) {
            $scope.posts = response.data.posts;
            $(function () {
                $('#EditModal').modal('toggle');
            });
            $scope.editpost = response.data.post;
            console.log(response);
        }, function errorCallback(response) {
            console.log(response);
        });
    }
});