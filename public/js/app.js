var app = angular.module('app', ['ngRoute', 'infinite-scroll']);

app.config(['$routeProvider', function($routeProvider){
	$routeProvider
		.when('/login', {
			templateUrl: '/js/views/login.html',
			controller: 'LoginController'
		})
		.when('/posts', {
			templateUrl: '/js/views/posts.html',
			controller: 'PostController'
		})
}]);