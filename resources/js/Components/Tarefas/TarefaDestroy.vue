<template>
    <div>

    </div>
</template>

<script>
export default {
    data(){
        return{
            tarefaId:null
        }
    },
    created(){
        let self = this;
        this.$eventBus.on("remover-tarefa", function(id){
            self.tarefaId = id;
            self.confirmDestroy();
        });
    },
    beforeUnmount(){
        this.$eventBus.off("remover-tarefa");
    },
    methods:{
        destroy(){
            axios.delete('api/tarefas/'+this.tarefaId+'/destroy')
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
                title: "Deseja remover esta tarefa?",
                showCancelButton: true,
                confirmButtonText: "Remover",
                reverseButtons: true,
                confirmButtonColor: "#d33",
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        this.destroy()
                    }
            });
        }
    }
}
</script>