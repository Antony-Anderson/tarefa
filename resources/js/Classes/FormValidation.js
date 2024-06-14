export default class FormValidation {
    valide(elementos, errors, formName){
		this.clearAll(elementos, formName);
        for(var erro in errors) {
            var elementInvalid = document.getElementById(formName+erro+'-invalid-feedback');
            elementInvalid.innerHTML = null;
            for(let item in errors[erro]){
                var element = document.getElementById(formName+erro);
                element.classList.add("is-invalid");
                elementInvalid.innerHTML += errors[erro][item] + '</br>';
            }
        }
	}
    
    clear(elemento, formName){
        if($('#'+formName+elemento).hasClass('is-invalid')){
            document.getElementById(formName+elemento).classList.remove("is-invalid");
        }
    }

	clearAll(elementos, formName){
		for (var i=0; i<elementos.length; i++) {
            if($('#'+formName+elementos[i]).hasClass('is-invalid')){
                document.getElementById(formName+elementos[i]).classList.remove("is-invalid");
            }
        }
    }
}