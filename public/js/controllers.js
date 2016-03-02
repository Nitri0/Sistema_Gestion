// Declare use of strict javascript
'use strict';

coreApp.controller('AvanceController', function ($scope, $log, $http, $window) {
	console.log("Avance");
	$scope.submitted = false;
	$scope.avance={};
	$scope.comentario=[];
	$scope.Comentarioflow=[];
	$scope.check=0;
	$scope.viewBolean=true;
	$scope.enviando = false;
	$scope.snipper  = false;
	$scope.initCommentForm=function(avance){
		if(avance){
			$scope.comentario.id_avance=avance;
		}else{
			$scope.viewBolean=false;
		}
		
	}
	$scope.submitCommentForm=function(){
		var json = {};
		var re1 = new RegExp('&gt;', 'g');	        
		var re2 = new RegExp('&quot;', 'g');	        
		$scope.comentario.contenido_avance_comentario = $scope.comentario.contenido_avance_comentario.replace(re1,'>');
		$scope.comentario.contenido_avance_comentario = $scope.comentario.contenido_avance_comentario.replace(re2,'&#39;');
		angular.element('#formulario').serializeArray().map(function(x){json[x.name] = x.value;});
		json['contenido_avance_comentario'] = $scope.comentario.contenido_avance_comentario;
		//console.log(json);
		$scope.enviando = true;
			$http({
			    method: 'POST',
			    url: $scope.urlAction,
			    data: json,
			    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			}).then(function successCallback(response) {
				$scope.subirAdjuntosComentario(response.data);
				//console.log(response);
			    //$window.location.href = 
			    //$scope.snipper  = false;
			    //$scope.viewBolean=false;
			  }, function errorCallback(response) {
			  	//console.log("error");
			  	//$scope.snipper  = false;
			  });    		
	}
	$scope.submit= function(formValid) {
		//console.log('PRUEBA');
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
				//console.log(response);
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
    	//console.log(check);
    	$(".js-example-data-array").select2();
	}
	$scope.adjuntoComentario=function(flow){
		$scope.Comentarioflow=flow;
	}
	$scope.subirAdjuntosComentario=function(id){
		var flow = $scope.Comentarioflow;
		//console.log(Object.keys(flow).length);
		if(Object.keys(flow).length>0){
			//console.log('aqui');
			flow.id_actividad=$scope.arrayKeySelected;
			flow.opts.testChunks=false;
			flow.opts.target="adjuntar";
			flow.opts.query.id_avance_comentario=id;
			flow.on('fileSuccess', function(file,message,chunk){
				    //console.log( JSON.parse(message));
			    //var data=JSON.parse(message);
			    //console.log(guardado);
			    $scope.viewBolean=false;

			    //console.log($scope.actividades[$scope.arrayKeySelected]['adjuntos']);
			});
			flow.upload();
		}else{
			$scope.viewBolean=false;
		}		
	}

});

coreApp.controller('PerfilController', function ($scope, $log) {
	console.log("perfil");
	$scope.submitted = false;
	$scope.perfil={};
});


coreApp.controller('AdminUsuariosController', function ($scope, $log) {
	//console.log("AdminUsuariosController");
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
});

coreApp.controller('EmpresaController', function ($scope, $log) {
	console.log("EmpresaController");


});
