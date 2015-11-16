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
            return "N/A"
        }
        return text;
    }
})

coreApp.filter("compareSize", function($sce){
    return function(text, espacio_asignado) {
        var text = parseInt(text);
        var espacio_asignado = parseInt(espacio_asignado);
        var resultado;
        
        if (!espacio_asignado || espacio_asignado==0){
            return $sce.trustAsHtml( "<br><strong class='btn btn-sm btn-info'>Espacio no asignado</strong>");        
        }
        if (text > espacio_asignado){
            return $sce.trustAsHtml( "<br><strong class='btn btn-sm btn-danger'>Excedio el límite</strong>");
        }
        return "";

    }
})

coreApp.filter("formatSize", function(){
    return function(text, espacio_asignado) {
        var text = parseInt(text);
        var resultado;
        if (text < 0){
            return "N/A";
        }
        var kb = 1024;
        var mb = kb * 1024;
        var gb = mb * 1024;
        var tb = gb * 1024;

        if ((text >= 0) && (text < kb)) {
            resultado= text+' B';

        } else if ((text >= kb) && (text < mb)) {
            resultado= Math.ceil(text / kb)+' KB';

        } else if ((text >= mb) && (text < gb)) {
            resultado= Math.ceil(text / mb) + ' MB';

        } else if ((text >= gb) && (text < tb)) {
            resultado= Math.ceil(text / gb) + ' GB';

        } else if (text >= tb) {
            resultado= Math.ceil(text / tb) + ' TB';
        } else {
            resultado= +text + ' B';
        }

        return resultado;

    }
})