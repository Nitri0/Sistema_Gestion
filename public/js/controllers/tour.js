// Declare use of strict javascript
'use strict';

coreApp.controller('TourController', function ($scope, $log, $http, $window) {
	console.log("TourController");
	
	$scope.tour = function(){
		$(function () {
			var intro = $.hemiIntro({
				debug: false,
				steps: [
					{
						selector: ".navbar-brand",
						placement: "bottom",
						content: "Barra de Actividades.",
					},
					{
						selector: ".navbar-user",
						placement: "bottom",
						content: "Aquí podrás encontrar todas tus configuraciones de usuario.",
						offsetTop: 100
					},
					{
						selector: ".btn-search",
						placement: "right",
						content: "El buscador te ayudara a filtrar tus listas."
					},
					{
						selector: ".sidebar",
						placement: "right",
						content: "SideBar de Opciones. "
					},
				],
				startFromStep: 0,
				backdrop: {
					element: $("<div>"),
					class: "hemi-intro-backdrop"
				},
				popover: {
					template: '<div class="popover hemi-intro-popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'
				},
				buttons: {
					holder: {
						element: $("<div>"),
						class: "hemi-intro-buttons-holder"
					},
					next: {
						element: $("<button>Siguiente</button>"),
						class: "btn btn-success pull-right"
					},
					finish: {
						element: $("<button>Finalizar</button>"),
						class: "btn btn-success pull-right"
					}
				},
				scroll: {
					anmationSpeed: 500
				},
				currentStep: {
					selectedClass: "hemi-intro-selected"
				},
				init: function (plugin) {
					console.log("init:");
				},
				onLoad: function (plugin) {
					console.log("onLoad:");
				},
				onStart: function (plugin) {
					console.log("onStart:");
				},
				onBeforeChangeStep: function () {
					console.log("onBeforeChangeStep:");
				},
				onAfterChangeStep: function () {
					console.log("onAfterChangeStep:");
				},
				onShowModalDialog: function (plugin, modal) {
					console.log("onShowModalDialog:");
				},
				onHideModalDialog: function (plugin, modal) {
					console.log("onHideModalDialog:");
				},
				onComplete: function (plugin) {
					console.log("onComplete:");
				}
			});
			intro.start();
		});
//-->
	};
});
