<template>
    <div class="table-responsive">
        <table class="table" ref="table">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Data</th>
                    <th scope="col">Ativo</th>
                    <th scope="col">Ativar</th>
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
                </tr>
            </tbody>
        </table>
        <logout></logout>
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
        }
    },
    created(){
        this.getDados();
         let self = this;
         this.$eventBus.on("atualizar-tabela-tarefa", function(){
            self.getDados();
        });
    },
    beforeUnmount(){
        this.$eventBus.off("atualizar-tabela-tarefa");
    },
    methods:{
        getDados(){
            axios.get('api/tarefas')
            .then(response => {
                this.dados = response.data.data;
                this.dados.ativo;
            })
            .catch(error => {
                this.$auth.userNotAllowed(error);
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
                console.log(response.data)
            })
            .catch(error => {
                this.$auth.userNotAllowed(error);
            });
        }
    }
}
</script>
