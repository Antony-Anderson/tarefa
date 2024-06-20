<template>
    <div>
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input :id="idComponent+'nome'" v-model="formData.nome" type="text" class="form-control" @input="$formValidation.clear('nome', idComponent)">
            <div class="invalid-feedback" :id="idComponent+'nome-invalid-feedback'"></div>
        </div>
        <div class="mb-3">
            <label class="form-label">Descrição</label>
            <input v-model="formData.descricao" type="text" class="form-control" @input="$formValidation.clear('descricao', idComponent)">
        </div>
        <div class="mb-3">
            <label class="form-label">Data</label>
            <input :id="idComponent+'data'" v-model="formData.data" type="date" class="form-control" @input="$formValidation.clear('date', idComponent)">
            <div class="invalid-feedback" :id="idComponent+'data-invalid-feedback'"></div>
        </div>
         <div class="mb-3">
            <label class="form-label">Ativo</label>
            <VueToggles v-model="formData.ativo" :id="idComponent+'ativo'" :height="21" :width="44" @input="$formValidation.clear('ativo', idComponent)"/>
        </div>
    </div>
</template>

<script>
    import { VueToggles } from "vue-toggles";
    export default {
        components:{
            VueToggles
        },
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