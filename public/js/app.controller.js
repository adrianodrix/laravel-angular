app.controller('LoginController', 
	['$scope', '$http', '$rootScope', '$location',
	function($scope, $http, $rootScope, $location){
	
	$scope.formData = {
		email: "a@com1",
		password: "123456"
	};

	$scope.error = {
		valid: false,
		title: "",
		message: ""
	};

	$scope.login = function(){
		$http.post('http://laravel-angular.app/oauth/access_token',{
			username: $scope.formData.email,
			password: $scope.formData.password,
			client_id: 1,
			client_secret: 'secret',
			grant_type: 'password'
		}).success(function(data){
			if (typeof data.access_token != 'undefined' && data.access_token != ""){
				$rootScope.token = data.access_token;
				$location.path('posts');
			}
		}).error(function(data){
			$scope.error.valid = true;
			$scope.error.title = data.error;
			$scope.error.message = data.error_description;			
		});

		return false;
	};
}]);

app.controller('PostController',['$scope', 'Posts',function($scope, Posts){
	$scope.posts = new Posts();		
}]);

app.factory('Posts', ['$http', '$rootScope', '$location', function($http, $rootScope, $location){
	var Posts = function(){
		this.items = [];
		this.busy = false;
		this.page = 1;		
	};

	Posts.prototype.nextPage = function(){
		if(this.busy) return;

		this.busy = true;

		var url = 'http://laravel-angular.app/posts/paginate?page='+ this.page;

		$http({
			method: 'GET',
			url: url,
			headers: {
				Authorization: 'Bearer '+ $rootScope.token
			}
		}).success(function(data){
			console.log(url);
			
			for(var i = 0; i < data.length; i++){
				this.items.push(data[i]);
			};
			this.page++;
			this.busy = false;
		}.bind(this)).error(function(data){
			$location.path('login');
		});		
	};

	return Posts;
}]);