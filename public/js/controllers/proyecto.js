coreApp.controller('ProyectoController',function($scope, $log, $http, $window) {
	console.log("Proyecto");
	$scope.submitted = false;
	$scope.personas=[
		{
			usuario : "",
			rol : "",
		},
		];
	$scope.cantidad=0;
	$scope.proyecto={};
	$scope.enviando = false;
	$scope.sort = "name";
	$scope.reverse = false;
	$scope.snipper  = false;

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
		$scope.snipper  = true;
		
		if (formValid==true && $scope.enviando ==false){
			if ($scope.cantidad >0){
		        var json = {};
        		angular.element('#formulario').serializeArray().map(function(x){json[x.name] = x.value;});
        		$scope.enviando=true;
				$http({
				    method: 'POST',
				    url: $scope.urlAction,
				    data: json,
				    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
				}).then(function successCallback(response) {
				    $window.location.href = $scope.urlRedirect;
				    $scope.snipper  = false;
				  }, function errorCallback(response) {
				  	$window.location.href = $scope.urlRedirect;
				  	$scope.snipper  = false;
				    // called asynchronously if an error occurs
				    // or server returns response with an error status.
				  });    		
			}
		}
		else{
			$scope.snipper  = false;
		};
		return false;
	};

	$scope.tour_ayuda = function(){
		console.log("init TourController");
		var tour = new Tour({
		  	steps: [
				  {
				    element: "#cliente_select",
				    title: "Cliente",
				    content: "Aquí podrá encontrar las opciones relacionadas a notificaciones, opciones de usuarios, búsqueda y mucho más...",
				    placement: "bottom",
				    backdrop: true,
				  },
				  {
				    element: "#crear_cliente",
				    title: "Configuración",
				    content: "Aquí podrás realizar configuraciones de tu cuenta y compartir con tus amigos.",
				    placement: "left",
				    backdrop: true,
				  },
				  {
				    element: "#tipo_proyecto_select",
				    title: "Configuración",
				    content: "Aquí podrás realizar configuraciones de tu cuenta y compartir con tus amigos.",
				    placement: "bottom",
				    backdrop: true,
				  },
				  {
				    element: "#crear_tipo_proyecto",
				    title: "Buscador",
				    content: "Aquí podrás realzar la búsqueda relacionada a la pantalla donde estes ubicado.",
				    placement: "left",
				    backdrop: true,
				  },
				  {
				    element: "#nombre_proyecto",
				    title: "Buscador",
				    content: "Aquí podrás realzar la búsqueda relacionada a la pantalla donde estes ubicado.",
				    placement: "bottom",
				    backdrop: true,
				  },
				  {
				    element: "#agrgar_equipo",
				    title: "Menu de Opciones",
				    content: "Aquí dispondrás de todas las opciones disponibles que tienes en el sistema.",
				    placement: "left",
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