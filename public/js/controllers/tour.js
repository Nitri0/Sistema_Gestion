// Declare use of strict javascript
'use strict';

coreApp.controller('TourController', function ($scope, $log, $http, $window) {
	$scope.tour = function(){
		console.log("init TourController");
		var tour = new Tour({
		  	steps: [
				  {
				    element: ".navbar-brand",
				    title: "Title of my step",
				    content: "Content of my step vcxnv cnx vncx vncxv ncx vncxvn",
				    duration: 5000
				  },
				  {
				    element: ".navbar-user",
				    title: "Title of my step",
				    content: "Content of my step",
				    placement: "left",
				    backdrop: true
				  },
				  {
				  	path: "/perfil",
				    element: ".editar-perfil",
				    title: "Title of my step",
				    content: "Content of my step",
				    placement: "right",
				    backdrop: true
				  }
				],
			storage: false,
			template: "<div class='popover tour'>"+
					    "<div class='arrow'></div>"+
					    "<h3 class='popover-title'></h3>"+
					    "<div class='popover-content'></div>"+
					    "<div class='popover-navigation'>"+
					        "<button class='btn btn-white' data-role='prev'>« Atras</button>"+
					        "<span data-role='separator'>|</span>"+
					        "<button class='btn btn-white' data-role='next'>Siguiente »</button>"+
					        "<button class='btn btn-white' data-role='end'>Cerrar</button>"+
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
