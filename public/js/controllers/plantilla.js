coreApp.controller('PlantillasController', function ($scope, $log, $http, $window) {
	console.log("plantillas");
	$scope.submitted = false;
	$scope.plantilla={};
	$scope.enviando = false;
	$scope.snipper  = false;
	$scope.submit= function(formValid) {
		console.log('PRUEBA');
		$scope.submitted=true;
		$scope.snipper = true;
		if (formValid==true && $scope.enviando==false){
	        var json = {};
			var re1 = new RegExp('&gt;', 'g');	        
			var re2 = new RegExp('&#39;', 'g');	        	        
    		$scope.plantilla.raw_data_plantilla = $scope.plantilla.raw_data_plantilla.replace(r1,'>');
    		$scope.plantilla.raw_data_plantilla = $scope.plantilla.raw_data_plantilla.replace(r2,'&quot;');
    		angular.element('#formulario').serializeArray().map(function(x){json[x.name] = x.value;});
    		json['raw_data_plantilla'] = $scope.plantilla.raw_data_plantilla;
    		$scope.enviando = true;
			$http({
			    method: 'POST',
			    url: $scope.urlAction,
			    data: json,
			    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			}).then(function successCallback(response) {
				console.log(response);
			    $window.location.href = $scope.urlRedirect;
			    $scope.snipper  = false;
			  }, function errorCallback(response) {
			  	console.log("error");
			  	$scope.snipper  = false;
			  });    		
		}
		else{
			$scope.snipper  = false;
		};
		return false;
	}

	$scope.mensaje_emilinar = "¿Esta seguro que desea eliminar esta plantilla?, no podrá ser recuperado";

	$scope.eliminar = function(url_eliminar){
		console.log(url_eliminar);
		$scope.eliminar_url = url_eliminar;
	};	
});