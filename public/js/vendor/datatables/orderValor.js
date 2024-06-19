jQuery.extend(jQuery.fn.dataTableExt.oSort, {
    "currency-pre": function (a) {
        var aux = a;
        let isPositive = true;
        if(a.indexOf('-R$') > -1){
            isPositive = false;
        }
        a = a.split('R$&nbsp;');
        if(a.length > 1){
            a = a[1];
        } else{
            a = a[0];
        }
        a = a.replace(".", "");
        a = a.replace(",", ".");
        a = a.trim();
        a = parseFloat(a);
        a = a * (isPositive ? 1 : -1);
        if(isNaN(a)){
            return aux;
        } 
        return a;
    },
    "currency-asc": function (a, b) {
        return a - b;
    },
    "currency-desc": function (a, b) {
        return b - a;
    }
});
