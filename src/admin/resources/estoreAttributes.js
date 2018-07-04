zaa.directive("estoreAttributes", function() {
	return {
		restrict: "E",
		scope: {
			'model' : '=',
			'product' : '='
		},
		controller: ['$scope', '$http', function($scope, $http) {
			
			$scope.$watch('product', function(n, o) {
				if (n != null && n) {
					$scope.getArticleAttributesData(n);
				}
			});
			
			$scope.$watch('model', function(n, o) {
				if (angular.isArray(n) || n == undefined) {
					$scope.model = {};
				}
			});
			
			$scope.getArticleAttributesData = function(id) {
				$http.get('admin/api-estore-product/attributes?id=' + id).then(function(r) {
					$scope.data = r.data;
				});
			};
			
		}],
		templateUrl: 'estoreadmin/article/article-attributes'
	}
});