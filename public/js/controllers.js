// Declare use of strict javascript
'use strict';

coreApp.controller('ClienteController', function ($scope, $log) {
	console.log("cliente");
	$scope.submitted = false;
	$scope.cliente = {};
});

coreApp.controller('DominioController', function ($scope, $log) {
	console.log("dominio");
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

});

coreApp.controller('ProveedorController', function ($scope, $log) {
	console.log("proveedor");
	$scope.submitted = false;
	$scope.proveedor={};
});

coreApp.controller('AvanceController', function ($scope, $log) {
	console.log("Avance");
	$scope.submitted = false;
	$scope.avance={};
	$scope.check=0;
});

coreApp.controller('ProyectoController', function ($scope, $log) {
	console.log("Proyecto");
	$scope.submitted = false;
	$scope.personas=[];
	$scope.cantidad=0;
	$scope.proyecto={};

	$scope.sort = "name";
	$scope.reverse = false;

	$scope.changeSort = function(value){
	    if ($scope.sort == value){
	      $scope.reverse = !$scope.reverse;
	      return;
	    }

	    $scope.sort = value;
	    $scope.reverse = false;
	}
	
	$scope.agregar_integrantes= function(argument) {
		var persona = {
			usuario : "",
			rol : "",
		};
		$scope.personas.push(persona);
		$scope.cantidad = $scope.personas.length;
	};

	$scope.eliminar_integrantes= function(argument) {
		$scope.personas.pop();
		if ($scope.personas.length>0){
			$scope.cantidad = $scope.personas.length;
		}else{
			$scope.cantidad = 0;
		}
	};
	$scope.submit= function(formValid) {
		console.log(formValid);
		$scope.submitted=true;
		if (formValid==true){
			if ($scope.cantidad >0){
		        var json = {};
		        var element = angular.element('#formulario').context
        		angular.element('#formulario').serializeArray().map(function(x){json[x.name] = x.value;});
        		console.log(element);
        		return	
		        ajax.Post($scope.posturl , datos ).$promise.then(
		            function(data) {
		                if (data.success){
		                    $window.location.href = data.redirecto; 
		                }else{
		                    $scope.titulo        = data.titulo;
		                    $scope.mensaje      = data.mensaje;
		                    $scope.redirecto    = function() {
		                        $window.location.href = data.redirecto; 
		                    };
		                    angular.element("#validacion_modal").modal("show");
		                }
		            },
		            //error (400,500)
		            function(data) {
		                $scope.titulo = "Error (7776)";
		                $scope.mensaje = "Disculpe, Intentelo nuevamente. Si el error continua contacte a soporte técnico.";
		                $scope.redirecto = function() {
		                    $window.location.reload();
		                } 
		                angular.element("#validacion_modal").modal("show");
		            });        		
			}
		}
		return false;
	}
/*
	$scope.$watch('cantidad', function(val){
	    if(val>0){
	        $scope.formulario.$setValidity('$valid');
	    }else{
	    	$scope.formulario.$setValidity('$invalid');
	    }
	})*/

});

coreApp.controller('PerfilController', function ($scope, $log) {
	console.log("perfil");
	$scope.submitted = false;
	$scope.perfil={};
});

coreApp.controller('PlantillasController', function ($scope, $log) {
	console.log("plantillas");
	$scope.submitted = false;
	$scope.plantilla={};

});


coreApp.controller('AdminUsuariosController', function ($scope, $log) {
	console.log("AdminUsuariosController");
	$scope.submitted = false;
	$scope.print = function(argument) {
		console.log(argument);
	}
});

coreApp.controller('GrupoEtapasController', function ($scope, $log) {
	console.log("Grupo de etapas");
	$scope.etapas=[];
	$scope.cantidad=0;
	$scope.GrpEtapas={};
	$scope.submitted = false;

	$scope.agregar_etapa= function(argument) {
		$scope.etapas.push(1);
		$scope.cantidad = $scope.etapas.length;
	};

	$scope.eliminar_etapa= function(argument) {
		$scope.etapas.pop();
		$scope.cantidad = $scope.etapas.length;
	};
});

coreApp.controller('EmpresaController', function ($scope, $log) {
	console.log("EmpresaController");

	
});

