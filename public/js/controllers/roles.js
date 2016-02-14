coreApp.controller('RolesController', function ($scope, $log) {
	console.log("roles");
	$scope.dominio={};
	$scope.submitted = false;
	$scope.sort = "name";
	$scope.reverse = false;

	$scope.compare = function(asignado,usado) {
		if (usado > asignado){
			return true;
		}
		return false;
	}
	$scope.changeSort = function(value){
	    if ($scope.sort == value){
	      $scope.reverse = !$scope.reverse;
	      return;
	    }

	    $scope.sort = value;
	    $scope.reverse = false;
	}

	$scope.mensaje_emilinar = "¿Esta seguro que desea eliminar este Rol?, no podrá ser recuperado";

	$scope.eliminar = function(url_eliminar){
		console.log(url_eliminar);
		$scope.eliminar_url = url_eliminar;
	};
	
});