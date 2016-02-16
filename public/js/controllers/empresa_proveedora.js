coreApp.controller('ProveedorController', function ($scope, $log) {
	console.log("proveedor");
	$scope.submitted = false;
	$scope.proveedor={};

	$scope.mensaje_emilinar = "¿Esta seguro que desea eliminar esta Empresa Proveedora?, no podrá ser recuperado";

	$scope.eliminar = function(url_eliminar){
		console.log(url_eliminar);
		$scope.eliminar_url = url_eliminar;
	};	
});