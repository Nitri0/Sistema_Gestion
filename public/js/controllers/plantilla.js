coreApp.controller('PlantillasController', function ($scope, $log, $http, $window, clipboard) {
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
    		angular.element('#formulario').serializeArray().map(function(x){json[x.name] = x.value;});
    		json['raw_data_plantilla'] = $scope.plantilla.raw_data_plantilla.replace('&gt;','>');
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

	$scope.clientes = [
          { name: 'Nombre de Cliente',	 	valor: '{{$cliente->nombre_cliente}}'   		},
          { name: 'Correo del Cliente', 	valor: '{{$cliente->email_cliente}}'   			},
          { name: 'Persona de Contacto', 	valor: '{{$cliente->persona_contacto_cliente}}' },
          { name: 'Telefono', 				valor: '{{$cliente->telefono_cliente}}'   		},
          { name: 'Telefono 2'  , 			valor: '{{$cliente->telefono_2_cliente}}'   	},
          { name: 'Dirección de Cliente', 	valor: '{{$cliente->direccion_cliente}}'   		}
      ];

    $scope.etiquetas = [
          { name: 'Nombre de Proyecto',	 	valor: '{{$proyecto->nombre_proyecto}}'   		},
          { name: 'Nombre de Dominio', 		valor: '{{$dominio->nombre_dominio}}'   		}
      ];

    $scope.usuarios = [
          { name: 'Nombre de Usuario',	 	valor: '{{$mis_datos->fullName()}}'   		},
          { name: 'Correo de Usuario', 		valor: '{{$mi_correo}}'   		},
          { name: 'Telefono de Usuario',	valor: '{{$mis_datos->telefono_perfil}}'   		},
          { name: 'Cédula de Usuario',	 	valor: '{{$mis_datos->cedula_perfil}}'   		}
      ];

	$scope.menuCliente = [
          ['copiar', function ($itemScope) {
          		clipboard.copyText($itemScope.cliente.valor);
              	$('#modal-etiquetas').modal('hide');
          }]
      ];

    $scope.menuEtiqueta = [
          ['copiar', function ($itemScope) {
          		clipboard.copyText($itemScope.etiqueta.valor);
              	$('#modal-etiquetas').modal('hide');
          }]
      ]

    $scope.menuUsuario = [
          ['copiar', function ($itemScope) {
          		clipboard.copyText($itemScope.usuario.valor);
              	$('#modal-etiquetas').modal('hide');
          }]
      ]


});