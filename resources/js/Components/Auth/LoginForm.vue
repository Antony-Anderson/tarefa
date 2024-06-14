<template>
    <div class="page">
        <div class="formLogin">
            <h1>Entrar</h1>
            <p>Digite os seus dados de acesso no campo abaixo.</p>
            <div class="formBox">
                <label for="email">E-mail</label>
                <input v-model="formData.email" type="email" placeholder="Digite seu e-mail" autofocus="true" class="is-invalid"/>
                <span v-if="errors.email" class="invalid-feedback">{{ errors.email[0] }}</span>
            </div>
            <div class="formBox">
                <label for="password">Senha</label>
                <input v-model="formData.password" type="password" placeholder="Digite seu e-mail" class="is-invalid"/>
                <span v-if="errors.password" class="invalid-feedback">{{ errors.password[0] }}</span>
            </div>
            <button @click="login()" class="btn">Acessar</button>
            <hr>
            <div class="link-group">
                <a :href="urlRegister">Cadastrar</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                formData:{
                    email:null,
                    password:null,
                },
                errors:[],
                urlRegister: window.location.origin+"/register",
            }
        },
        methods:{
            login(){
                axios.post('api/login', this.formData)
	            .then(response => {
                    localStorage.setItem('token', response.data.data.token)
                    window.location.href = window.location.origin+"/";
	            })
	            .catch(error => {
                    this.errors = error.response.data.errors;
                });
            }
        }
    }
</script>
