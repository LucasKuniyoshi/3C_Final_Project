<template>
    <div class="container">
        <header>
            <router-link to="/">
                <img class="img-size-login" src="../assets/Recruta_Facil.png" alt="Recruta_Facil_Logo">
            </router-link>
        </header>
        <section>
            <div class="cardd">
                <form @submit.prevent="criarUsuario">
                    <h2>Seja bem-vindo</h2>
                    <h6>Aproveite sua vida profissional ao máximo</h6>
                        <div class="campos">
                            <div class="input-container">
                                <input
                                type="text"
                                v-model="users.name"
                                @focus="isFocusedName = true"
                                @blur="handleBlur('name')"
                                placeholder="Nome de usuário"
                                required
                                />
                                <!-- <label>Nome de usuário</label> -->

                                <!-- Exibe o span de validação somente se o campo estiver focado e vazio ao desfocar -->
                                <span v-if="isFocusedName && !users.name" class="validacao">Campo obrigatório</span>                            </div>
                            <div class="input-container">
                                <input
                                type="email"
                                v-model="users.email"
                                @focus="isFocusedEmail = true"
                                @blur="handleBlur('email')"
                                placeholder="Email"
                                required
                                />
                                <!-- <label>Email</label> -->

                                <!-- Exibe o span de validação somente se o campo estiver focado e vazio ao desfocar -->
                                <span v-if="isFocusedEmail && !isEmail(users.email)" class="validacao">Email inválido</span>
                                <!-- <span>EMAIL JÁ EXISTENTE</span> -->
                            </div>
                            <div class="input-container">
                                <input
                                type="password"
                                v-model="users.password"
                                @focus="isFocusedPassword = true"
                                @blur="handleBlur('password')"
                                placeholder="Senha"
                                minlength="8"
                                required
                                />
                                <!-- <label>Senha</label> -->

                                <!-- Exibe o span de validação somente se o campo estiver focado e vazio ao desfocar -->
                                <span v-if="isFocusedPassword && users.password.length < 8" class="validacao">Senha deve ter pelo menos 8 caracteres</span>
                                <!-- <span>EMAIL JÁ EXISTENTE</span> -->
                            </div>
                            <div class="input-container">
                                <input
                                type="password"
                                v-model="passwordConfirm"
                                @focus="isFocusedPasswordConfirm = true"
                                @blur="handleBlur"
                                placeholder="Confirmar Senha"
                                minlength="8"
                                required
                                />
                                <!-- <label>Confirmar Senha</label> -->

                                <!-- Exibe o span de validação somente se o campo estiver focado e vazio ao desfocar -->
                                <!-- <span v-if="isFocusedPasswordConfirm && !passwordConfirm" class="validacao">Senha deve ter pelo menos 8 caracteres</span> -->
                                <span v-if="isFocusedPasswordConfirm && passwordConfirm != users.password" class="validacao">Confirmar Senha diferente de Senha</span>
                            </div>
                        
                            <label class="checkbox-container">
                                <input type="checkbox">
                                Manter conectado
                            </label>
                        </div>
                    <div>
                        <div class="entrarBtn">
                            <button type="submit">
                                <h3>Registrar-se</h3>
                            </button>
                        </div>
                        <!-- <div tipe="submit" class="entrarBtn">
                            <router-link>
                                <h3>Registrar-se</h3>
                            </router-link>
                        </div> -->
                        <div class="line-container">
                            <span class="OuPosition">ou</span>
                        </div>
                        <div class="googlebtn">
                            <h4>Entrar com conta Google <font-awesome-icon :icon="['fab', 'google']" /></h4>
                        </div>
                        <!-- <div class="googlebtn">
                            <router-link>
                                <h4>Entrar com conta Google <font-awesome-icon :icon="['fab', 'google']" /></h4>
                            </router-link>
                        </div> -->
                        <div class="cookies">
                            <p>Ao clicar em Continuar, você aceita o </p>
                            <p><a href="">Contrato do Usuário</a>, a <a href="">Política de Privacidade</a> e </p>
                            <p>a <a href="">Política de Cookies</a> do Recruta Fácil.</p>
                        </div>
                        <div class="recruiter">
                            <h6>Já faz parte do Recruta Fácil? 
                                <router-link to="/login">Entrar</router-link>
                            </h6>
                        </div>
                    </div>
                </form>
            </div>
            <div class="footerCard">
                <h6>É um recrutador? 
                    <router-link to="/SigninRecruiter">Realizar cadastro como recrutador</router-link>
                </h6>
            </div>
        </section>
        <Footer />
    </div>
</template>

<script>
    import Footer from '@/components/Footer.vue';
    import axios from "axios";

    export default {
        data() {
            return {
                users: {
                    name: "",  // Valor do input
                    email: "",
                    password: "",
                    user_type: "candidate",
                },
            passwordConfirm: "",
            isFocusedName: false, // Controla o estado de foco
            isFocusedEmail: false, 
            isFocusedPassword: false,
            isFocusedPasswordConfirm: false,
            };
        },
        methods: {
            handleBlur(field) {
                if (field === 'name' && this.users.name) {
                    this.isFocusedName = false;
                }
                if (field === 'email' && this.users.email) {
                    this.isFocusedEmail = false;
                }
                if (field === 'password' && this.users.password) {
                    this.isFocusedPassword = false;
                }
                if (field === 'passwordConfirm' && this.passwordConfirm) {
                    this.isFocusedPasswordConfirm = false;
                }
            },
            criarUsuario() {
                // Verifica se as senhas coincidem antes de enviar a requisição
                if (this.users.password !== this.passwordConfirm) {
                    alert("As senhas não coincidem.");
                    return;
                }

                // Envia os dados do usuário para a API
                axios
                    .post('http://localhost:8000/api/users', this.users)
                    .then(response => {
                        console.log('Usuário criado com sucesso:', response.data);
                        // Redireciona para a tela de login após o registro bem-sucedido
                        this.redirecionarLogin();
                    })
                    .catch(error => {
                        console.error('Erro ao criar usuário:', error);
                        alert('Erro ao criar usuário. Verifique os dados e tente novamente.');
                    });
            },
            redirecionarLogin() {
                this.$router.push({ name: 'login' });
            },
            isEmail(value) {
                // Regex simples para validar o formato de email
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(value);
            },
        },
    };
</script>

<style scoped>
    *{
        margin: 0;
        padding: 0;
        text-decoration: none;
    }

    .container{
        display: flex;
        flex-direction: column;
        align-items: center;
        /* background-color: aqua; */
        margin: 0 auto;
        /* text-align: center; */
    }

    .img-size-login{
        width: 100%;
        height: 10rem;
    }

    .cardd{
        margin-top: 5%;
        margin-bottom: 7%;
        width: 30vw;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), 0 6px 20px rgba(0, 0, 0, 0.1);
        border-radius: 8px; /* opcional, para bordas arredondadas */
        padding: 5.5%;      /* opcional, para espaçamento interno */
        background-color: #fff; /* fundo branco */
    }

    .cardd h2, h6,span{
        text-align: center;
    }

    .cardd h6{
        margin-top: 2%;
    }

    .campos{
        margin-top: 10%;
        /* display: flex;
        flex-direction: column;
        align-items: center; */
    }

    /* Estilo do contêiner campos */
    .input-container {
        position: relative;
        margin-top: 3%;
    }

    /* Estilo do input */
    .input-container input {
        width: 100%;
        padding: 10px 5px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
        outline: none;
    }

    /* Estilo do label */
    .input-container label {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        background-color: white;
        color: #aaa;
        transition: 0.3s;
        padding: 0 5px;
        pointer-events: none;
    }

    /* Quando o input é focado ou preenchido, o label sobe */
    .input-container input:focus + label,
    .input-container input:not(:placeholder-shown) + label {
        top: -22%;
        font-size: small;
        color: #333;
    }

    /* Estilo do span */
    .validacao {
        color: #666;
        font-size: 12px;
        /* visibility: hidden; */
        /* margin-bottom: 5px; */
    }

    .entrarBtn button{
        border: none;
        width: 100%;
        background-color: #fff;
    }

    .entrarBtn h3{
        margin-top: 4%;
        padding: 1.5%;
        background-color: #114FEE;
        border: 2px solid #114FEE;
        color: #FFF;
        border-radius: 25px;
        font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        font-size: medium;
        padding: 2%;
        /* color: #FFF; */
    }

    .entrarBtn h3:hover{
        /* color: #FFF; */
        background-color: #0f3cad;
        transition: .35s;
    }

    .googlebtn{
        border: 2px solid #333;
        border-radius: 25px;
        padding: 2%;
        cursor: pointer;
        
    }

    .googlebtn:hover{
        background-color: #ebe7e7;
        transition: .4s;
    }

    .googlebtn h4{
        color: #333;
        font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        font-size: medium;
    }

    a h3, h4{
        text-align: center;
    }

    .cardd h6{
        font-weight: 400;
    }
    
    h6 a:hover{
        text-decoration: underline;
    }

    /* CHECKBOX */
    .checkbox-container{
        margin-top: 4%;
        cursor: pointer;
    }
    /* SEPARADOR */

    .line-container {
        display: flex;
        align-items: center;
        width: 80%;
        margin: 4% auto 4% auto;
    }

    .line-container::before,
    .line-container::after {
        content: "";
        flex: 1;
        border-top: 1px solid #DBDBDB;
    }

    .OuPosition {
        margin: 0 10px;
        color: #BBB;
        background-color: #FFF;
        padding: 0 5px;
    }

    .cookies{
        margin-top: 3%;
    }

    .cookies p{
        /* margin-left: 5%; */
        font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        font-weight: 400;
        font-size: small;
        /* font-style: normal; */
    }
    .cookies a:hover{
        /* text-align: start; */
        text-decoration: underline;
        transition: .5s;
    }

    .footerCard{
        margin-top: 3.5%;
        margin-bottom: 8%;
        /*margin-bottom: 10%;*/
    }

    .footerCard h6{
        font-weight: 500;
    }

    .recruiter{
        margin-top: 5%;
    }
</style>