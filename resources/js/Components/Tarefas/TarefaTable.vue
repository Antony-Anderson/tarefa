<template>
    <div class="table-responsive">
        <table-skeleton v-if="loading"></table-skeleton>
        <table class="table" ref="table" v-else>
            <thead class="table-dark">
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Data</th>
                    <th scope="col">Ativo</th>
                    <th scope="col">Concluida</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="dado in dados" :key="'tarefa_item'+dado.id">
                    <th scope="row">{{dado.nome}}</th>
                    <td>{{dado.descricao}}</td>
                    <td>{{$formater.data(dado.data)}}</td>
                    <td v-html="formaterAtivo(dado.ativo)"></td>
                    <td>
                        <VueToggles v-model="dado.ativo" @click="ativo(dado.id)" :height="21" :width="44"/>
                    </td>
                    <td>
                        <button @click="editar(dado.id)" class="btn btn-primary me-2">
                            <i class="fa-solid fa-pencil"></i>
                        </button>
                        <button @click="destroy(dado.id)" class="btn btn-danger">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>
                <tr v-if="!dados.length">
                    <td colspan="6">Nenhuma tarefa encontrada</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import { VueToggles } from "vue-toggles";
export default{
    components:{
        VueToggles
    },
    data(){
        return{
            dados:[],
            loading:true
        }
    },
    created(){
        this.getDados();
        let self = this;
        this.$eventBus.on("atualizar-tabela-tarefa", function(){
            self.getDados();
        });
    },
    mounted(){
        let self = this;
        self.$eventBus.on("selecionar-tarefas", function(){
            self.confirmDestroy();
        });
    },
    beforeUnmount(){
        this.$eventBus.off("atualizar-tabela-tarefa");
    },
    methods:{
        getDados(){
            this.loading = true
            axios.get('api/tarefas')
            .then(response => {
                this.dados = response.data.data;
                this.dados.ativo;
            })
            .catch(error => {
                this.$auth.userNotAllowed(error);
            }).finally(() => {
                this.loading = false
            })
        },
        formaterAtivo(ativo){
            if(ativo == true){
                return '<span class="badge bg-success">Ativo</span>';
            }else{
                return '<span class="badge bg-danger">Desativo</span>';
            }
        },
        ativo(id) {
            axios.post(`api/tarefas/${id}/ativo`)
            .then(response => {
                this.getDados();
                this.$toasty.success(response.data.message);
            })
            .catch(error => {
                this.$auth.userNotAllowed(error);
            });
        },
        editar(id){
            this.$eventBus.emit("editar-tarefa", id);
        },
        destroy(id){
            this.$eventBus.emit("remover-tarefa", id);
        },
        destroyAll(){
            axios.delete('api/tarefas/destroyAll')
            .then(response => {
                this.$toasty.success(response.data.message);
                this.$eventBus.emit("atualizar-tabela-tarefa");
            })
            .catch(error => {
                this.$auth.userNotAllowed(error);
                this.$toasty.error(response.data.message);
            });
        },
        confirmDestroy(){
            this.$swal.fire({
                title: "Deseja remover todas as tarefas?",
                showCancelButton: true,
                confirmButtonText: "Remover",
                reverseButtons: true,
                confirmButtonColor: "#198754",
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        this.destroyAll()
                    }
            });
        }
    }
}
</script>
