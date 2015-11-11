'use strict';



coreApp.filter("DateForHumans", function(){
    return function(date) {
    	var now = new Date();
    	var fecha = new Date(date);
    	var result = parseInt((now-fecha)/(24*3600*1000));
        if (result<1){
            return "Menos de un día";
        }else if(result==1){
            return result+" día";
        }
        return result+" días";
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