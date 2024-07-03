<template>
    <div>
        
    </div>
</template>

<script>
export default {
    data(){
        return{
            pomodoroId:null
        }
    },
    created(){
        let self = this;
        this.$eventBus.on("remover-pomodoro", function(id){
            self.pomodoroId = id;
            self.destroy();
        });
    },
    beforeUnmount(){
        this.$eventBus.off("remover-pomodoro");
    },
    methods:{
        destroy(){
            axios.delete('api/pomodoro/'+this.pomodoroId+'/destroy')
            .then(response => {
                this.$toasty.success(response.data.message);
                this.$eventBus.emit("atualizar-tabela-pomodoro");
            })
            .catch(error => {
                this.$auth.userNotAllowed(error);
                this.$toasty.error(response.data.message);
            });
        }
    }
}
</script>