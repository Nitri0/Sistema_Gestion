
// Declare use of strict javascript
'use strict';


coreApp.factory("ajax", function($resource){
    return {
        Post: function(url, params){
            return $resource(url, params, {
            Post:{
                method: "POST",
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                }

            }).Post();
        }
    }
});