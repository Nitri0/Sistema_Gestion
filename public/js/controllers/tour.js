// Declare use of strict javascript
'use strict';

coreApp.controller('TourController', function ($scope, $log, $http, $window) {
	$scope.tour = function(){
		console.log("init TourController");
		var tour = new Tour({
		  	steps: [
				  {
				    element: ".navbar-brand",
				    title: "Barra de Navegación",
				    content: "Aquí podrá encontrar las opciones relacionadas a notificaciones, opciones de usuarios, búsqueda y mucho más...",
				  },
				  {
				    element: ".navbar-user",
				    title: "Configuración",
				    content: "Aquí podrás realizar configuraciones de tu cuenta y compartir con tus amigos.",
				    placement: "left",
				  },
				  {
				    element: "#buscar",
				    title: "Buscador",
				    content: "Aquí podrás realzar la búsqueda relacionada a la pantalla donde estes ubicado.",
				    placement: "left",
				  },
				  {
				    element: "#sidebar",
				    title: "Menu de Opciones",
				    content: "Aquí dispondrás de todas las opciones disponibles que tienes en el sistema.",
				    placement: "right",
				  },
				  {
				    element: "#mis_proyectos",
				    title: "Mis Proyectos",
				    content: "Aquí tendrás el listado de proyectos asignados a ti.",
				    placement: "right",
				  },
				  {
				    element: ".sidebar-minify-btn",
				    title: "Minimizar Menu de Navegación",
				    content: "Aquí podrás mejorar el uso del espacio de trabajo.",
				    placement: "right",
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
