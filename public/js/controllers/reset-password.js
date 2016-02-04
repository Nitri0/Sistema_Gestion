// Declare use of strict javascript
'use strict';
	
coreApp.controller('ResetPasswordController', function ($scope, $log, $http, $window) {
	console.log('ResetPasswordController');

	$scope.pw = '';

	$scope.checkMe = function(){
	  	if (document.formulario.pw.value == document.formulario.pw2.value){
	    	document.formulario._token.value=document.formulario.pw.value;
	    	document.formulario.submit();
	  	}else
	    	$scope.error = 1;
	}
	
	$scope.ocultar_error = function(){
		$scope.error = 0;
	}

});