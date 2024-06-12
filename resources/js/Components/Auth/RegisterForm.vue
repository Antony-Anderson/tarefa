<template>
    <div class="page">
        <div class="formLogin">
            <h1>Cadastrar</h1>
            <p>Digite os dados de cadastro no campo abaixo.</p>
            <div class="formBox">
                <label for="nome">Nome</label>
                <input v-model="formData.name" type="text" placeholder="Digite seu nome" autofocus="true" class="is-invalid" />
                <span v-if="errors.name" class="invalid-feedback is-invalid">{{ errors.name[0] }}</span>
            </div>
            <div class="formBox">
                <label for="email">E-mail</label>
                <input v-model="formData.email" type="email" placeholder="Digite seu e-mail" autofocus="true" class="is-invalid" />
                <span v-if="errors.email" class="invalid-feedback is-invalid">{{ errors.email[0] }}</span>
            </div>
            <div class="formBox">
                <label for="password">Senha</label>
                <input v-model="formData.password" type="password" placeholder="Digite sua senha" class="is-invalid" />
                <span v-if="errors.password" class="invalid-feedback">{{ errors.password[0] }}</span>
            </div>
            <button @click="register()" class="btn">Cadastrar</button>
            <hr>
            <div class="link-group">
                <a :href="urlLogin">Entrar</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                formData: {
                    name: null,
                    email: null,
                    password: null,
                },
                errors: {},
                urlLogin: window.location.origin + "/login",
            };
        },
        methods:{
            register(){
                axios.post('api/register', this.formData)
                    .then(response => {
                        localStorage.setItem('token', response.data.data.token)
                        window.location.href = window.location.origin + "/";
                    })
                    .catch(error => {
                        if (error.response && error.response.data && error.response.data.errors) {
                            this.errors = error.response.data.errors;
                            console.log('erro: ', this.erros)
                        }
                    });
            }
        },
    }
</script>
