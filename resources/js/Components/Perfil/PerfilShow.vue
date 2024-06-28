<template>
    <div style="margin-left: 50px;">
        <div class="card border-success mb-3" style="max-width: 18rem;">
            <div class="card-header"><strong>Nome:</strong> {{dados.nome}}</div>
            <div class="card-body text-dark">
                <p class="card-text"><strong>Email:</strong> {{dados.email}}</p>
            </div>
        </div>
    </div>
</template>

<script>

export default{
    data(){
        return{
            dados:[],
            loading:true,
        }
    },
    created(){
        this.getData();
    },
    methods:{
        getData(){
            this.loading = true;
            axios.get('api/perfil')
            .then(response => {
                this.dados = response.data.data;
                console.log(response.data.data)
            })
            .catch(error => {
                this.$auth.userNotAllowed(error);
            })
            .finally(() => {
                this.loading = false;
            });
        }
    }
}
</script>
