<template>
    <div>
        <modal ref="modal">
            <template v-slot:modalHeader>
                <h5 class="modal-title">Cadastrar tarefa</h5>
            </template>
            <tarefa-form :formData="formData" :errors="errors" idComponent="create_tarefa"></tarefa-form>
            <template v-slot:modalFooter>
                <button @click="$refs.modal.close()" type="button" class="btn btn-secondary">Fechar</button>
                <button @click="enviar()" type="button" class="btn btn-primary" :disabled="loading">
                    <span v-if="loading" class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>
                    Salvar
                </button>
            </template>
        </modal>
    </div>
</template>

<script>
    export default{
        data(){
            return{
                formData:{
                    nome:null,
                    descricao:null,
                    data:null,
                    ativo:false
                },
                loading:false,
                errors:[]
            }
        },
        mounted(){
            let self = this;
            self.$eventBus.on("criar-tarefa", function(){
                self.$refs.modal.open();
                self.$formValidation.clearAll(Object.keys(self.formData), 'create_tarefa');
            });
        },
        beforeUnmount(){
            this.$eventBus.off("criar-tarefa");
        },
        methods:{
            enviar(){
                this.$formValidation.clearAll(Object.keys(this.formData), 'create_tarefa');
                this.loading = true;
                axios.post('api/tarefas/store', this.formData)
	            .then(response => {
                    this.$refs.modal.close();
                    this.$toasty.success(response.data.message);
                    this.$eventBus.emit("atualizar-tabela-tarefa");
	            })
	            .catch(error => {
                    this.$auth.userNotAllowed(error);
                    this.errors = error.response.data.errors;
                })
                .finally(() => {
                    this.loading = false;
                });
            },
        }
    }
</script>
