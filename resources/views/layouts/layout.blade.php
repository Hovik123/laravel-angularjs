<!doctype html>
<html lang="en" ng-app="App">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link href="./assets/vendor/bootstrap/dist/css/bootstrap.css" type="text/css" rel="stylesheet"/>
    <link href="./assets/css/main.css" type="text/css" rel="stylesheet"/>
</head>
<body ng-controller="AppCtrl">
<!--INJECT VIEW HERE-->
<div ng-view></div>

<script src="./assets/vendor/angular/angular.min.js" type="text/javascript"></script>
<script src="./assets/vendor/angular-route/angular-route.js" type="text/javascript"></script>
<script src="./assets/vendor/jquery/dist/jquery.min.js" type="text/javascript"></script>
<script src="./assets/vendor/bootstrap/dist/js/bootstrap.js" type="text/javascript"></script>
<script src="./assets/vendor/angular-bootstrap/ui-bootstrap.min.js" type="text/javascript"></script>
<script src="./app/app.js" type="text/javascript"></script>
<script src="./assets/js/main.js" type="text/javascript"></script>
</body>
</html>