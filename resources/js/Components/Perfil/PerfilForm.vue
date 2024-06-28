<template>
    <div>
        <div class="mb-3">
            <label class="form-label">Senha Atual</label>
            <input :id="idComponent+'password'" v-model="formData.password" type="text" class="form-control" @input="$formValidation.clear('password', idComponent)">
            <div class="invalid-feedback" :id="idComponent+'password-invalid-feedback'"></div>
        </div>
        <div class="mb-3">
            <label class="form-label">Nova senha</label>
            <input v-model="formData.newPassword" type="text" class="form-control" @input="$formValidation.clear('newPassword', idComponent)">
            <div class="invalid-feedback" :id="idComponent+'newPassword-invalid-feedback'"></div>
        </div>
    </div>
</template>

<script>
    export default {
        props:[
            'formData',
            'idComponent',
            'errors'
        ],
        data(){
			return {
				elementos: Object.keys(this.formData)
			}
		},
        watch: {
            errors: function() {
                this.$formValidation.valide(this.elementos, this.errors, this.idComponent);
            },
        }
    }
</script>