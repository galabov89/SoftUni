function ErrorInformation(array){
    var obj = array;
   // console.log(obj);
    var length = obj.length;
    for(var i=0; i< length; i++){

        noty({
                text: obj[i],
                type: 'error',
                layout: 'topCenter',
                timeout: 5000}
        );

    }
}

ErrorInformation(array);


