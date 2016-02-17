coreApp.controller('ActividadController', function ($scope, $log, $http, $window) {
	$scope.tituloModal="Agregar actividad";
	$scope.proyectos={};
	$scope.usuarios={};
	$scope.actividades={};
	$scope.actividad={};
	$scope.adjuntos={};
	$scope.formulario={};
	$scope.usuario_actividad={};
	$scope.urlAction='actividades';
	$scope.activitySelected={};
	$scope.arrayKeySelected=0;
	$scope.id_proyecto=null;
	$scope.activityType=true;
	$scope.initProyectos=function(Proyectos){
		/*Carga la lista de actividades apenas inicia el sistema*/
		$scope.proyectos=Proyectos;
		
	}
	$scope.initActividades=function(id_proyecto){
		/*Carga la lista de actividades apenas inicia el sistema*/
		$scope.actividades=$scope.proyectos[id_proyecto].actividades;
		$scope.id_proyecto=$scope.proyectos[id_proyecto].id_proyecto;
		$scope.usuarios=$scope.proyectos[id_proyecto].usuarios;
		console.log($scope.usuarios);
		console.log($scope.id_proyecto);
	}
	$scope.agregarTarea=function(){
		/*registra una actividad y la carga en la vista*/		
		$scope.enviando = false;
		$scope.snipper  = false;
		console.log($scope.actividad);
		/*if (formValid==true && $scope.enviando==false){*/
			var json = {};
	    	angular.element('#formulario').serializeArray().map(function(x){json[x.name] = x.value;});
	    	json.typeActivity=true;
	    	console.log(json);
	    	$http({
			    method: 'POST',
			    url: $scope.urlAction,
			    data: json,
			    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			}).then(function successCallback(response) {
				$('#myModal').modal('hide');
				$scope.actividades.push(response.data);
			  }, function errorCallback(response) {
			  	console.log("error");
			  	$scope.snipper  = false;
			  }); 
		/*}else{
			$scope.snipper  = false;
		}*/
		return false;
	}
	$scope.datosActividad=function(clave){
		/*
			carga los datos de la actividad principal seleccionada en el panel derecho del sistema 
			el parametro clave indica el valor dentro del array $scope.actividades seleccionado por el usuario 
		*/
		console.log($scope.actividades);
		$scope.arrayKeySelected=clave;
		$scope.activitySelected.id_actividad=$scope.actividades[clave].id_actividad;
		$scope.activitySelected.id_proyecto=$scope.actividades[clave].id_proyecto;
		$scope.activitySelected.nombre=$scope.actividades[clave].nombre_actividad;
		$scope.activitySelected.descripcion=$scope.actividades[clave].descripcion_actividad;
		$scope.activitySelected.adjuntos=$scope.actividades[clave].adjuntos;
		$scope.activitySelected.subActividades=$scope.actividades[clave].sub_actividades;
		$scope.activitySelected.comentarios=$scope.actividades[clave].comentarios;
		console.log($scope.activitySelected);
	}
	$scope.editarActividad=function(clave){
		console.log($scope.actividades[clave]);
	}
	$scope.guardarActividad=function(clave){
		console.log($scope.actividades[clave]);
	}

	$scope.agregarSubActividad=function(clave){
		/*agrega una sub actividad al sistema y actualiza la lista de sub tareas correspondiente*/
		var json = {};
		var ClaveActual=clave;
    	angular.element('#formularioNuevo').serializeArray().map(function(x){json[x.name] = x.value;});
    	json.typeActivity=false;
    	$http({
		    method: 'POST',
		    url: $scope.urlAction,
		    data: json,
		    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).then(function successCallback(response) {
			$('#sub_actividad').modal('hide');
			$scope.actividades[clave]['sub_actividades'].push(response.data);
		  }, function errorCallback(response) {
		  	console.log("error");
		  	$scope.snipper  = false;
		  }); 
	}
	$scope.ediarSubActividad=function(clave){
		console.log($scope.actividades[clave]);
	}
	$scope.guardarSubActividad=function(clave){
		console.log($scope.actividades[clave]);
	}
	$scope.comentarActividad=function(clave){
		/*crea un comentario en la actividad principal*/
		var comentario={
			'id_actividad': $scope.actividades[clave]['id_actividad'],
			'contenido_comentario': $scope.contenido_comentario
		};
		$http({
		    method: 'POST',
		    url: $scope.urlAction+'/comentario',
		    data: comentario,
		    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).then(function successCallback(response) {
			$scope.actividades[clave]['comentarios'].push(response.data);
		  }, function errorCallback(response) {
		  	console.log("error");
		  	$scope.snipper  = false;
		  });
		$scope.contenido_comentario='';
	}
	$scope.editModal=function(clave){
		$scope.activityType=false;
		$scope.tituloModal='Editar actividad';
		$scope.id_proyecto=$scope.actividades[clave].id_proyecto;
		$scope.actividad.id_actividad=$scope.actividades[clave].id_actividad;
		$scope.actividad.nombre_actividad=$scope.actividades[clave].nombre_actividad;
		$scope.actividad.descripcion_actividad=$scope.actividades[clave].descripcion_actividad;
		$scope.actividad.fecha_inicio_actividad=new Date($scope.actividades[clave].fecha_inicio_actividad);
		$scope.actividad.fecha_aproximada_entrega_actividad=new Date($scope.actividades[clave].fecha_aproximada_entrega_actividad);

		$('#myModal').modal('show');
	}
	$scope.addModal=function(clave){
		$scope.tituloModal='Agregar actividad';
		$scope.actividad={};
		$scope.activityType=true;		
		$('#myModal').modal('show');
	}
	$scope.subirAdjuntos=function(flow){
		flow.id_actividad=$scope.arrayKeySelected;
		flow.opts.testChunks=false;
		flow.opts.target="actividades/adjuntar";
		flow.opts.query.activiti_id=$scope.actividades[$scope.arrayKeySelected].id_actividad;
		flow.on('fileSuccess', function(file,message,chunk){
		    console.log( JSON.parse(message));
		    var data=JSON.parse(message);
		    if(!$scope.findIndArray($scope.actividades[$scope.arrayKeySelected]['adjuntos'],data['id_adjunto'])){
				$scope.actividades[$scope.arrayKeySelected]['adjuntos'].push(data);
		    }
		    
		    console.log($scope.actividades[$scope.arrayKeySelected]['adjuntos']);
		});
		flow.upload();
	}
	$scope.findIndArray=function(adjuntos,id){
		for(adjunto in adjuntos){
			if(adjuntos[adjunto]['id_adjunto']==id){
				return true;
			}else{
				continue;
			}
		}
		return false;

	}
	$scope.fullName=function(usuario){
		if(usuario.perfil.nombre_perfil=="" || usuario.perfil.apellido_perfil==""){
			return usuario.correo_usuario;
		}else{
			return usuario.perfil.nombre_perfil+" "+usuario.perfil.apellido_perfil;
		}
	}
});