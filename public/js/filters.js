'use strict';



coreApp.filter("DateForHumans", function(){
    return function(date) {
    	var now = new Date();
    	var fecha = new Date(date);
    	
		return parseInt((now-fecha)/(24*3600*1000));
    }
})
coreApp.filter("noAsignado", function(){
    return function(text) {

    	if (!text){
			return "No Asignado"
    	}
    	return text;
    }
})