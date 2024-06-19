<template>
    <div>
        <modal ref="modal">
            <template v-slot:modalHeader>
                <h5 class="modal-title">Editar tarefa</h5>
            </template>
            <tarefa-form :formData="formData" :errors="errors" idComponent="update_tarefa"></tarefa-form>
            <template v-slot:modalFooter>
                <button @click="$refs.modal.close()" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button @click="enviar()" type="button" class="btn btn-primary" :disabled="loading">
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
                    nome:null,
                    descricao:null,
                    data:null,
                    ativo:null
                },
                tarefaId:null,
                loading:false,
                errors:[]
            }
        },
        created(){
            let self = this;
            this.$eventBus.on("editar-tarefa", function(id){
                self.$formValidation.clearAll(Object.keys(self.formData), 'update_tarefa');
                self.tarefaId = id;
                self.getDados();
            });
        },
        beforeUnmount(){
            this.$eventBus.off("editar-tarefa");
        },
        methods:{
            enviar(){
                this.$formValidation.clearAll(Object.keys(this.formData), 'update_tarefa');
                this.loading = true;
                axios.put('api/tarefas/'+this.tarefaId+'/update', this.formData)
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
            getDados(){
                axios.get('api/tarefas/'+this.tarefaId+'/show')
                .then(response => {
                    this.formData = response.data.data;
                    this.$refs.modal.open()
                })
                .catch(error => {
                    this.$auth.userNotAllowed(error);
                });
            }
        }
    }
</script>