<template>
    <div>
        <button @click="startTime()" class="btn btn-primary" v-if="!clicado"><i class="fa-solid fa-play"></i> Iniciar</button>
        <button @click="pauseTime()" class="btn btn-danger" v-else><i class="fa-solid fa-pause"></i> Pausar</button>
        <button @click="endTime()" class="btn btn-danger"><i class="fa-solid fa-stop"></i> Parar</button>
        <span>{{ formatTime(this.formData.tempo) }}</span>
        <div class="col-md-3">
            <div class="form-floating">
                <input type="text" class="form-control" id="floatingInputGrid" v-model="tarefa">
                <label for="floatingInputGrid">Tarefa</label>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Descrição</th>
                    <th scope="col">Tempo</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="dado in dados" :key="'tarefa_item'+dado.id">
                    <td>{{dado.descricao}}</td>
                    <td>{{formatTime(dado.tempo)}}</td>
                    <td>
                        <button @click="destroy(dado.id)" class="btn btn-danger">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                timer: null,
                clicado: false,
                tarefa: '',
                concluida: false,
                formData:{
                    descricao:null,
                    tempo:null
                },
                dados:[]
            }
        },
        created(){
            this.getDados();
            let self = this;
            this.$eventBus.on("atualizar-tabela-pomodoro", function(){
                self.getDados();
            });
        },
        beforeUnmount(){
            this.$eventBus.off("atualizar-tabela-pomodoro");
        },
        methods: {
            getDados(){
                this.loading = true;
                axios.get('api/pomodoro')
                .then(response => {
                    this.dados = response.data.data;
                    console.log(this.dados)
                })
                .catch(error => {
                    this.$auth.userNotAllowed(error);
                })
            },
            startTime() {
                if(this.concluida == true){
                    this.formData.tempo = 0;
                    this.concluida = false;
                    this.tarefa = '';
                }
                this.clicado = true;
                this.concluida = false;
                this.timer = setInterval(() => {
                    this.formData.tempo += 1;
                }, 1000);
            },
            pauseTime() {
                clearInterval(this.timer);
                this.clicado = false;
            },
            endTime() {
                if(this.tarefa == ''){
                    this.tarefa = 'Tarefa sem descrição';
                }
                this.formData.descricao = this.tarefa;
                clearInterval(this.timer);
                axios.post('api/pomodoro/store', this.formData)
                .then(response => {
                    this.dados = response.data.data;
                    this.$toasty.success(response.data.message);
                    this.$eventBus.emit("atualizar-tabela-pomodoro");
                })
                .catch(error => {
                    this.$auth.userNotAllowed(error);
                    this.errors = error.response.data.errors;
                })
                .finally(() => {
                    this.clicado = false;
                    this.concluida = true;
                });
            },
            destroy(id){
                this.$eventBus.emit("remover-pomodoro", id);
            },
            formatTime(seconds) {
                let horas = Math.floor(seconds / 3600);
                let minutos = Math.floor((seconds % 3600) / 60);
                let segundos = seconds % 60;

                return `${horas.toString().padStart(2, '0')}:${minutos.toString().padStart(2, '0')}:${segundos.toString().padStart(2, '0')}`;
            }
        }
    }
</script>

<style scoped>
    .btn {
        margin-top: 15px;
        margin-bottom: 15px;
        margin-left: 10px;
    }
    span{
        margin-left: 10px;
    }
    input{
        margin-top: 20px;
    }
</style>
