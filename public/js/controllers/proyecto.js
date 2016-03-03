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
		$(".js-example-data-array").select2();
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
				    title: "Seleccionar Cliente",
				    content: "Seleccione algún cliente que haya registrado",
				    placement: "bottom",
				    backdrop: true,
				  },
				  {
				    element: "#crear_cliente",
				    title: "Crear Cliente",
				    content: "Presione aquí si desea agregar un nuevo cliente",
				    placement: "left",
				    backdrop: true,
				  },
				  {
				    element: "#tipo_proyecto_select",
				    title: "Seleccionar Tipo de Proyecto",
				    content: "Seleccione el tipo de proyecto ó proceso de desea utilizar en el proyecto.",
				    placement: "bottom",
				    backdrop: true,
				  },
				  {
				    element: "#crear_tipo_proyecto",
				    title: "Crear Tipo Proyecto",
				    content: "Presione aquí si desea agregar un nuevo tipo de proyecto.",
				    placement: "left",
				    backdrop: true,	 
				  },
				  {
				    element: "#nombre_proyecto",
				    title: "Nombre del Proyecto",
				    content: "Ingrese el nombre con el que desee identificar el proyecto.",
				    placement: "bottom",
				    backdrop: true,
				  },
				  {
				    element: "#agrgar_equipo",
				    title: "Agregar Equipo de Trabajo",
				    content: "Presione aquí para agregar integrantes según su necesidad.",
				    placement: "left",
				    backdrop: true,
				  },
				  {
				    element: "#integrante",
				    title: "Seleccionar Integrante",
				    content: "Seleccione algún integrante ya registrado.",
				    placement: "left",
				    backdrop: true,
				  },
				  {
				    element: "#agregar_integrante",
				    title: "Agregar Integrante",
				    content: "Presione aquí para agregar nuevos integrantes al sistema.",
				    placement: "right",
				    backdrop: true,
				  },
				  {
				    element: "#rol",
				    title: "Seleccionar Rol",
				    content: "Seleccione el rol que el usuario representará en este proyecto",
				    placement: "left",
				    backdrop: true,
				  },
				  {
				    element: "#agregar_rol",
				    title: "Agregar Roles",
				    content: "Presione aquí para agregar nuevos roles al sistema.",
				    placement: "right",
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