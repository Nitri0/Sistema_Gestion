coreApp.controller('ActividadController', function ($scope, $log, $http, $window) {
	$scope.tituloModal="Agregar actividad";
	$scope.proyectos={};
	$scope.usuarios={};
	$scope.actividades=[];
	$scope.actividad={};
	$scope.adjuntos={};
	$scope.formulario={};
	$scope.usuario_actividad={};
	$scope.urlAction='actividades';
	$scope.usuarios_actividad=[];
	$scope.activitySelected={};
	$scope.sub_actividad={};
	$scope.arrayKeySelected=0;
	$scope.usuario=0;
	$scope.id_proyecto=null;
	$scope.activityType=true;
	$scope.initProyectos=function(Proyectos,usuario){
		/*Carga la lista de actividades apenas inicia el sistema*/
		$scope.usuario=usuario;
		$scope.proyectos=Proyectos;
	}
	$scope.initActividades=function(id_proyecto){
		/*Carga la lista de actividades apenas inicia el sistema*/
		$scope.actividades=$scope.proyectos[id_proyecto].actividades;
		$scope.id_proyecto=$scope.proyectos[id_proyecto].id_proyecto;
		$scope.usuarios=$scope.proyectos[id_proyecto].usuarios;
		//console.log($scope.usuarios);
		//console.log($scope.id_proyecto);
	}
	$scope.agregarTarea=function(){
		/*registra una actividad y la carga en la vista*/		
		$scope.enviando = false;
		$scope.snipper  = false;
		//console.log($scope.actividad);
		/*if (formValid==true && $scope.enviando==false){*/
			if($scope.id_proyecto!=null){
				var json = {};
		    	angular.element('#formulario').serializeArray().map(function(x){json[x.name] = x.value;});
		    	json.typeActivity=true;
		    	console.log(json);
		    	var usuarios={};
		    	for(usuario in $scope.usuarios_actividad){
		    		usuarios[usuario]=$scope.usuarios_actividad[usuario]['usuario']['id_usuario'];
		    	}
		    	json.usuarios=usuarios;
		    	//console.log(json);
		    	$http({
				    method: 'POST',
				    url: $scope.urlAction,
				    data: json,
				    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
				}).then(function successCallback(response) {
					$('#myModal').modal('hide');
					$scope.actividades.push(response.data);
				  }, function errorCallback(response) {
				  	//console.log("error");
				  	$scope.snipper  = false;
				  }); 
			}else{
				alert('debe seleccionar un proyecto antes de agregar una actividad');
			}
			
		/*}else{
			$scope.snipper  = false;
		}*/
		return false;
	}
	$scope.datosActividad=function(idActividad){
		/*
			carga los datos de la actividad principal seleccionada en el panel derecho del sistema 
			el parametro clave indica el valor dentro del array $scope.actividades seleccionado por el usuario 
		*/
		////console.log($scope.actividades);
		var clave=$scope.getActivityKey(idActividad);
		$scope.arrayKeySelected=clave;
		$scope.activitySelected.id_actividad=$scope.actividades[clave].id_actividad;
		$scope.activitySelected.id_proyecto=$scope.actividades[clave].id_proyecto;
		$scope.activitySelected.nombre=$scope.actividades[clave].nombre_actividad;
		$scope.activitySelected.descripcion=$scope.actividades[clave].descripcion_actividad;
		$scope.activitySelected.adjuntos=$scope.actividades[clave].adjuntos;
		$scope.activitySelected.usuarios=$scope.actividades[clave].usuarios;
		$scope.activitySelected.subActividades=$scope.actividades[clave].sub_actividades;
		$scope.activitySelected.comentarios=$scope.actividades[clave].comentarios;
		
	}
	$scope.destruir=function(tipo,id){
		var dataArray={
			'tipo':tipo,
			'id_actividad':id,
		};
		
		//console.log(seleccionado+' '+);
		//$scope.actividades[].splice(seleccionado, 1);
		$http({
			    method: 'POST',
			    url: $scope.urlAction+'/destruir',
			    data: dataArray,
			    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			}).then(function successCallback(response) {
				$('#myModal').modal('hide');
				if(tipo){
					var keySubActividad=$scope.getActivityKey(id);
					$scope.actividades.splice(keySubActividad, 1);
				}else{
					var keySubActividad=$scope.getSubActivityKey(id);
					$scope.actividades[$scope.arrayKeySelected]['sub_actividades'].splice(keySubActividad, 1);
				}
			  }, function errorCallback(response) {
			  	//console.log("error");
			  	$scope.snipper  = false;
			  }); 
	}
	$scope.editarActividad=function(clave){

		var json = {};
    	angular.element('#formulario').serializeArray().map(function(x){json[x.name] = x.value;});
    	json.typeActivity=true;
    	console.log(json);
    	$http({
		    method: 'POST',
		    url: $scope.urlAction+'/update',
		    data: json,
		    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).then(function successCallback(response) {
			$scope.actividades[clave].nombre_actividad=response.data.nombre_actividad;
			$scope.actividades[clave].descripcion_actividad=response.data.descripcion_actividad;
			$scope.actividades[clave].fecha_inicio_actividad=new Date(response.data.fecha_inicio_actividad);
			$scope.actividades[clave].fecha_aproximada_entrega_actividad=new Date(response.data.fecha_aproximada_entrega_actividad);
		  	$('#myModal').modal('hide');
		  	$scope.datosActividad(clave);
		  }, function errorCallback(response) {
		  	//console.log("error");
		  	$scope.snipper  = false;
		  }); 
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
			$scope.sub_actividad={};
		  }, function errorCallback(response) {
		  	//console.log("error");
		  	$scope.snipper  = false;
		  }); 
	}
	$scope.ediarSubActividad=function(clave){
		//console.log($scope.actividades[clave]);
	}
	$scope.guardarSubActividad=function(clave){
		//console.log($scope.actividades[clave]);
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
		  	//console.log("error");
		  	$scope.snipper  = false;
		  });
		$scope.contenido_comentario='';
	}
	$scope.editModal=function(idActividad){
		var clave=$scope.getActivityKey(idActividad);
		$scope.activityType=false;
		$scope.tituloModal='Editar actividad';
		$scope.id_proyecto=$scope.actividades[clave].id_proyecto;
		$scope.actividad.id_actividad=$scope.actividades[clave].id_actividad;
		$scope.actividad.nombre_actividad=$scope.actividades[clave].nombre_actividad;
		$scope.actividad.descripcion_actividad=$scope.actividades[clave].descripcion_actividad;
		var inicio=new Date($scope.actividades[clave].fecha_inicio_actividad);
		$scope.actividad.fecha_inicio_actividad=inicio.getDate()+'/'+(inicio.getMonth()+1)+'/'+inicio.getFullYear();
		var fin=new Date($scope.actividades[clave].fecha_aproximada_entrega_actividad);
		$scope.actividad.fecha_aproximada_entrega_actividad=fin.getDate()+'/'+(fin.getMonth()+1)+'/'+fin.getFullYear();

		$('#myModal').modal('show');
	}
	$scope.addModal=function(clave){
		$scope.tituloModal='Agregar actividad';
		$scope.actividad={};
		$scope.usuarios_actividad=[];
		$scope.activityType=true;		
		$('#myModal').modal('show');
	}
	$scope.finishTask=function(tipo, clave){
		var tarea=[];
		if(tipo){
			tarea['tipo_tarea']=tipo;
			tarea['keyA']=clave;
			tarea['id_tarea']= $scope.getActivityKey(clave);;

		}else{	
			var keySubActividad=$scope.getSubActivityKey(clave);
			tarea['tipo_tarea']=tipo;
			tarea['keyA']=$scope.arrayKeySelected;
			tarea['keyB']=keySubActividad;
			tarea['id_tarea']= $scope.actividades[$scope.arrayKeySelected].sub_actividades[keySubActividad]['id_sub_actividad'];
		}
		$http({
		    method: 'POST',
		    url: $scope.urlAction+'/finalizartarea',
		    data: tarea,
		    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).then(function successCallback(response) {
			if(response.data['tipo_tarea']=='true'){
				$scope.actividades[response.data['keyA']]['estatus_actividad']=1;
			}else{
				console.log($scope.actividades);
				$scope.actividades[response.data['keyA']].sub_actividades[response.data['keyB']]['estatus_sub_actividad']=1;
			}

		  }, function errorCallback(response) {
		  	//console.log("error");
		  	$scope.snipper  = false;
		  });
	}
	$scope.subirAdjuntos=function(flow){
		flow.id_actividad=$scope.arrayKeySelected;
		flow.opts.testChunks=false;
		flow.opts.target="actividades/adjuntar";
		flow.opts.query.activiti_id=$scope.actividades[$scope.arrayKeySelected].id_actividad;
		flow.on('fileSuccess', function(file,message,chunk){
		    //console.log( JSON.parse(message));
		    var data=JSON.parse(message);
		    if(!$scope.findIndArray($scope.actividades[$scope.arrayKeySelected]['adjuntos'],data['id_adjunto'])){
				$scope.actividades[$scope.arrayKeySelected]['adjuntos'].push(data);
		    }
		    
		    //console.log($scope.actividades[$scope.arrayKeySelected]['adjuntos']);
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
		if(usuario.perfil.nombre_perfil==undefined || usuario.perfil.apellido_perfil==undefined || usuario.perfil.nombre_perfil=="" || usuario.perfil.apellido_perfil==""||usuario.perfil.nombre_perfil==null || usuario.perfil.apellido_perfil==null){
			return usuario.correo_usuario;
		}else{
			return usuario.perfil.nombre_perfil+" "+usuario.perfil.apellido_perfil;
		}
	}
	$scope.filterSubTask = function(subTarea) {
	  return (subTarea['estatus_sub_actividad'] != 1 && subTarea['id_usuario']==$scope.usuario);
	}
	$scope.filterTask=function(tarea){
		//console.log(tarea.usuarios);
		for (keytarea in tarea.usuarios) {
			if(tarea.usuarios[keytarea]['id_usuario']==$scope.usuario){
				return true;
			}
		};
		//return (tarea['estatus_actividad'] != 1 && tarea['id_usuario']==$scope.usuario);
	}
	$scope.getActivityKey = function(idActividad) {
		//var clave=0;		
		for(keyActividad in $scope.actividades){
			if($scope.actividades[keyActividad]['id_actividad']==idActividad){
				return keyActividad;
				break;
			}
		}
	}
	$scope.getSubActivityKey = function(idSubActividad) {
		for(keyActividad in $scope.actividades[$scope.arrayKeySelected].sub_actividades){
			console.log($scope.actividades[$scope.arrayKeySelected].sub_actividades[keyActividad]);
			if($scope.actividades[$scope.arrayKeySelected].sub_actividades[keyActividad]['id_sub_actividad']==idSubActividad){
				return keyActividad;
				break;
			}
		}
	}
});
$(document).ready(function(){
        $('#activityInitDate').datepicker({
        	format: "dd-mm-yyyy",
        });
        $('#activityEndDate .input-group .date').datepicker({
        	format: "dd-mm-yyyy",
        });
        $('#subActivityInitDate').datepicker();
        $('#subActivityEndDate').datepicker();
});