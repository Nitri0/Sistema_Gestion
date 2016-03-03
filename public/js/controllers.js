// Declare use of strict javascript
'use strict';

coreApp.controller('AvanceController', function ($scope, $log, $http, $window) {
	console.log("Avance");
	$scope.submitted = false;
	$scope.avance={};
	$scope.check=0;
	$scope.enviando = false;
	$scope.snipper  = false;
	$scope.submit= function(formValid) {
		console.log('PRUEBA');
		$scope.submitted=true;
		$scope.snipper = true;
		if (formValid==true && $scope.enviando==false){
	        var json = {};
			var re1 = new RegExp('&gt;', 'g');	        
			var re2 = new RegExp('&quot;', 'g');	        
    		$scope.avance.descripcion_avance = $scope.avance.descripcion_avance.replace(re1,'>');
    		$scope.avance.descripcion_avance = $scope.avance.descripcion_avance.replace(re2,'&#39;');
    		angular.element('#formulario').serializeArray().map(function(x){json[x.name] = x.value;});
    		json['descripcion_avance'] = $scope.avance.descripcion_avance;
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

	$scope.pantilla = function(check) {
    	console.log(check);
    	$(".js-example-data-array").select2();
	}

});

coreApp.controller('PerfilController', function ($scope, $log) {
	console.log("perfil");
	$scope.submitted = false;
	$scope.perfil={};
});


coreApp.controller('AdminUsuariosController', function ($scope, $log) {
	console.log("AdminUsuariosController");
	$scope.submitted = false;
	$scope.permisos_user = {};
	$scope.selects = {};

	$scope.metodos = {
			'proyectos' : 
					[
						'index',
						'create',
						'show',
						'store',
						'edit',
						'update',
						'destroy',
						'indexProyectosFinalizados',
						'finalizarProyecto',
						'reiniciarProyecto',
						'agregarIntegrante',
						'eliminarIntegrante',
					],
			'clientes' :
					[
						'index',
						'create',
						'show',
						'store',
						'edit',
						'update',
						'destroy',
					],
			'tipo_proyectos' :
					[
						'index',
						'create',
						'show',
						'store',
						'edit',
						'update',
						'destroy',
					],
			'roles' :
					[
						'index',
						'create',
						'show',
						'store',
						'edit',
						'update',
						'destroy',
					],
			'plantillas' :
					[
						'index',
						'create',
						'show',
						'store',
						'edit',
						'update',
						'destroy',
						'previewPlantillas',
					],
	};
	var i;
	$scope.setSelectAll = function(argument) {
		$scope.permisos_user = argument;
		for (i in argument){
			$scope.selects[i.split(".")[0]]=true;
		}
	};
	$scope.selectAll = function(modulo, value) {
		console.log(value, modulo, $scope.metodos[modulo]);
		for (i in $scope.metodos[modulo]){
			console.log($scope.permisos_user);
			$scope.permisos_user[modulo + "." + $scope.metodos[modulo][i]]=value;
		};
	}

	$scope.submitted = false;
	$scope.enviando = false;
	$scope.snipper  = false;
	$scope.submit= function(formValid) {
		$scope.submitted=true;
		$scope.snipper = true;
		if (formValid==true && $scope.enviando==false){

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
			  	$scope.snipper  = false;
			  });    		
		}
		else{
			$scope.snipper  = false;
		};
		return false;
	}

});

coreApp.controller('EmpresaController', function ($scope, $log) {
	console.log("EmpresaController");


});
