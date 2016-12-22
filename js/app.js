(function() {

    var app = angular.module('Lodge', []);

    app.controller('LodgeController', [ '$http', function($http){
	var lodge = this;
	lodge.officers = [];
	$http.get('/services/officers.php').success(function(data){
	    lodge.officers = data;
	});
    }]);

})();
