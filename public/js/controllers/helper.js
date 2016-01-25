// Declare use of strict javascript
'use strict';
	
coreApp.controller('SubmitController', function ($scope, $log, $http, $window) {
	console.log("submit Controller");
	$scope.tienerif = false;
	$scope.enviando = false;
	$scope.snipper  = false;

	$scope.submit= function(formValid) {
		console.log(formValid);
		$scope.snipper = true;
		$scope.submitted=true;
		if (formValid==true && $scope.enviando==false){
			if ($scope.tienerif ){
				if($scope.invalidrif){
					return false;
				}
			}
	        var json = {};
    		angular.element('#formulario').serializeArray().map(function(x){json[x.name] = x.value;});
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
			  	$window.location.href = $scope.urlRedirect;
			  	$scope.snipper  = false;
			    // called asynchronously if an error occurs
			    // or server returns response with an error status.
			  });    		
		};
		return false;
	}

	$scope.ValidateRif =function(rif){
		$scope.tienerif = true;
        var validador = /^([JGVEPjgvep][-][0-9]{7,8}[-][0-9]{1})$/;
        console.log("validacion: ",rif, validador.test(rif));
        
        if (!validador.test(rif)){
            $scope.invalidrif = true;
            // ajax.Post("/verificacion/rif", {"rif":$scope.rif } ).$promise.then(
            //     function(data) {
            //         if (data.success == false){

            //             $scope.invalidrif = true;
            //             console.log("incorrecto");
            //             $scope.titulo = "Rif en uso";
            //             $scope.mensaje = "El rif que coloco actualmente esta siendo usado. contacte a soporte tecnico aqui.";
            //             angular.element("#validacion_modal").modal("show");
            //             $scope.rif = "";
            //         }else{
            //             $scope.invalidrif = false;
            //         }
            //     }
            // );
        }else{
            $scope.invalidrif = false;
        };
    };
});