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
			var re1 = new RegExp('&gt;', 'g');	        
			var re2 = new RegExp('&quot;', 'g');	        	       
    		$scope.plantilla.raw_data_plantilla = $scope.plantilla.raw_data_plantilla.replace(r1,'>');
    		$scope.plantilla.raw_data_plantilla = $scope.plantilla.raw_data_plantilla.replace(r2,'&#39;');
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
	$scope.tour_ayuda = function(){
		console.log("init TourController");
		var tour = new Tour({
		  	steps: [{
					    element: "#nombre_plantilla",
					    title: "Nombre",
					    content: "Ingrese el nombre de la plantilla que desee crear.",
					    placement: "bottom",
					    backdrop: true,
				  	},
				  	{
					    element: "#descripcion_plantilla",
					    title: "Descripción",
					    content: "Ingrese un recordatorio del uso de dicha plantilla.",
					    placement: "bottom",
					    backdrop: true,
				  	},
				  	{
					    element: "#etiqueta_plantilla",
					    title: "Etiquetas",
					    content: "Presione aquí para utilizar las etiquetas del sistema donde podrá agregar los datos del cliente",
					    placement: "bottom",
					    backdrop: true,
				  	},
				  	{
					    element: "#texto_enriquecido",
					    title: "Cuerpo del Mensaje",
					    content: "Ingrese el cuerpo del mensaje que desea dejar preestablecido en su plantilla",
					    placement: "top",
					    backdrop: true,
				  	}
				],
			storage: false,
			template: "<div class='popover tour'>"+
					    "<div class='arrow'></div>"+
					    "<h3 class='popover-title'></h3><button class='btn btn-link btn-cerrar-paseo' data-role='end'><i class='fa fa-times'></i></button>"+
					    "<div class='popover-content'></div>"+
					    "<div class='popover-navigation'>"+
					        "<button class='btn btn-link' data-role='prev'>« Atras</button>"+
					        "<span data-role='separator'>|</span>"+
					        "<button class='btn btn-link' data-role='next'>Siguiente »</button>"+
					    "</div>"+
					    
					    "</nav>"+
					  "</div>"

		});

		// Initialize the tour
		tour.init(true);

		// Start the tour
		tour.start(true);
	};

});