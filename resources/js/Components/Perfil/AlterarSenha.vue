<template>
    <div>
        <modal ref="modal">
            <template v-slot:modalHeader>
                <h5 class="modal-title">Mudar senha</h5>
            </template>
            <perfil-form :formData="formData" :errors="errors" idComponent="create_senha"></perfil-form>
            <template v-slot:modalFooter>
                <button @click="$refs.modal.close()" type="button" class="btn btn-secondary">Fechar</button>
                <button @click="confirmarSenha()" type="button" class="btn btn-primary" :disabled="loading">
                    <span v-if="loading" class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>
                    Salvar
                </button>
            </template>
        </modal>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                formData:{
                    password:null,
                    newPassword:null
                },
                errors:[],
                loading:false,
            }
        },
        created(){
            let self = this;
            this.$eventBus.on("mudar-senha", function(){
                self.$formValidation.clearAll(Object.keys(self.formData), 'create_senha');
                self.$refs.modal.open();
            });
        },
        beforeUnmount(){
            this.$eventBus.off("mudar-senha");
        },
        methods:{
            confirmarSenha(){
                this.$formValidation.clearAll(Object.keys(this.formData), 'create_senha');
                this.loading = true;
                axios.post('api/perfil/mudarSenha', this.formData)
	            .then(response => {

                    this.$refs.modal.close();
                    this.$toasty.success(response.data.message);
	            })
	            .catch(error => {
                    this.$auth.userNotAllowed(error);
                    this.errors = error.response.data.errors;
                })
                .finally(() => {
                    this.loading = false;
                });
            }
        }
    }
</script>
