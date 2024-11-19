<template>
    <div class="backgroundGeral">
        <div class="container">
            <header>
                <router-link to="/">
                    <img class="img-size-login" src="../assets/Recruta_Facil.png" alt="Recruta_Facil_Logo">
                </router-link>
            </header>
            <section>
                <div class="cardd">
                    <form @submit.prevent="criarCompany">
                        <h2>Entrar como Recrutador</h2>
                        <h6>Aproveite sua vida profissional ao máximo</h6>
                        <div class="campos">
                            <div class="input-container">
                                <input
                                type="text"
                                v-model="companies.name"
                                @focus="isFocusedName = true"
                                @blur="handleBlur('name')"
                                placeholder=" "
                                required
                                />
                                <label for="input">Nome da empresa</label>
                                <!-- <span>CAMPO OBRIGATÓRIO</span> -->
                            </div>
                            <div class="input-container">
                                <input
                                type="text"
                                v-model="companies.email"
                                @focus="isFocusedEmail = true"
                                @blur="handleBlur('email')"
                                placeholder=" "
                                required
                                />
                                <label for="input">Email</label>
                            </div>
                            <div class="input-container">
                                <input
                                type="text"
                                v-model="companies.cnpj"
                                @focus="isFocusedCnpj = true"
                                @blur="handleBlur('cnpj')"
                                placeholder=" "
                                required
                                />
                                <label for="input">CNPJ</label>
                            </div>
                            <div class="input-container">
                                <input
                                type="text"
                                v-model="companies.description"
                                @focus="isFocusedDescription = true"
                                @blur="handleBlur('description')"
                                placeholder=" "
                                required
                                />
                                <label for="input">Descrição</label>
                            </div>
                            <!-- <span>CAMPO OBRIGATÓRIO E EMAIL JA EXISTENTE</span> -->
                            <div class="input-container">
                                <input
                                type="password"
                                v-model="companies.password"
                                @focus="isFocusedPassword = true"
                                @blur="handleBlur('password')"
                                placeholder=" "
                                minlength="8"
                                required
                                />
                                <label for="input">Senha</label>
                            </div>
                            <!-- <span>MIN-WITDH DA SENHA</span> -->
                            <div class="input-container">
                                <input
                                type="password"
                                v-model="passwordConfirm"
                                @focus="isFocusedPasswordConfirm = true"
                                @blur="handleBlur"
                                placeholder=" "
                                minlength="8"
                                required
                                />
                                <label for="input">Confirmar senha</label>
                                <span v-if="isFocusedPasswordConfirm && passwordConfirm != companies.password" class="validacao">Confirmar Senha diferente de Senha</span>
                            </div>
                            <!-- <span>CONFIRMACAO DE SENHAS</span> -->
                        </div>
                        <div>
                            <label class="checkbox-container">
                                <input type="checkbox">
                                Manter conectado
                            </label>
                        </div>
                        <div>
                            <button type="submit" class="entrarBtn">
                                <h3>Registrar-se</h3>
                            </button>
                            <!--<div class="entrarBtn">
                                <router-link>
                                    <h3>Registrar-se</h3>
                                </router-link>
                            </div> -->
                            <div class="line-container">
                                <span class="OuPosition">ou</span>
                            </div>
                            <div class="googlebtn">
                                <router-link>
                                    <h4>Entrar com conta Google <font-awesome-icon :icon="['fab', 'google']" /></h4>
                                </router-link>
                            </div>
                            <div class="cookies">
                                <p>Ao clicar em Continuar, você aceita o </p>
                                <p><a href="#">Contrato do Usuário</a>, a <a href="">Política de Privacidade</a> e </p>
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
                    <h6>Não é um recrutador? 
                        <router-link to="/signin">Realizar cadastro como canditato</router-link>
                    </h6>
                </div>
            </section>
            <Footer />
        </div>
    </div>
</template>

<script>
    import Footer from '@/components/Footer.vue';
    import axios from "axios";

    export default {
        data() {
            return {
                companies: {
                    name: "",  // Valor do input
                    email: "",
                    cnpj: "",
                    description: "",
                    password: "",
                    //user_type: "recruiter",
                },
            passwordConfirm: "",
            isFocusedName: false, // Controla o estado de foco
            isFocusedEmail: false, 
            isFocusedCnpj: false, 
            isFocusedDescription: false, 
            isFocusedPassword: false,
            isFocusedPasswordConfirm: false,
            };
        },
        methods: {
            handleBlur(field) {
            if (field === 'name' && this.companies.name) {
                this.isFocusedName = false;
            }
            if (field === 'email' && this.companies.email) {
                this.isFocusedEmail = false;
            }
            if (field === 'cnpj' && this.companies.cnpj) {
                this.isFocusedCnpj = false;
            }
            if (field === 'description' && this.companies.description) {
                this.isFocusedDescription = false;
            }
            if (field === 'password' && this.companies.password) {
                this.isFocusedPassword = false;
            }
            if (field === 'passwordConfirm' && this.passwordConfirm) {
                this.isFocusedPasswordConfirm = false;
            }
        },
            criarCompany() {
                // Verifica se as senhas coincidem antes de enviar a requisição
                if (this.companies.password !== this.passwordConfirm) {
                    alert("As senhas não coincidem.");
                    return;
                }

                // Envia os dados do usuário para a API
                axios
                    .post('http://localhost:8000/api/companies', this.companies)
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
                this.$router.push({ name: 'dashboard' });
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

    .backgroundGeral{
        background-color: lightcyan;
    }

    .container{
        display: flex;
        flex-direction: column;
        align-items: center;
        /* background-color: lightcyan; */
        margin: 0 auto;
        /* text-align: center; */
    }

    .img-size-login{
        width: 100%;
        height: 10rem;
    }

    .cardd{
        margin-top: 5%;
        width: 33vw;
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
        margin: 20px 0;
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

    .entrarBtn a h3{
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

    .entrarBtn a h3:hover{
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

    .googlebtn a h4{
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
        margin-top: 5%;
    }

    .footerCard h6{
        font-weight: 500;
    }

    .recruiter{
        margin-top: 5%;
    }
</style>