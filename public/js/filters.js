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

coreApp.filter("formatSize", function(){
    return function(text) {

        var text = parseInt(text);
        console.log(text)
        if (text < 0){
            return "N/A";
        }
        var kb = 1024;
        var mb = kb * 1024;
        var gb = mb * 1024;
        var tb = gb * 1024;

        if ((text >= 0) && (text < kb)) {
            return text+' B';

        } else if ((text >= kb) && (text < mb)) {
            return ceil(text / kb)+' KB';

        } else if ((text >= mb) && (text < gb)) {
            return ceil(text / mb) + ' MB';

        } else if ((text >= gb) && (text < tb)) {
            return ceil(text / gb) + ' GB';

        } else if (text >= tb) {
            return ceil(text / tb) + ' TB';
        } else {
            return +text + ' B';
        }
    }
})