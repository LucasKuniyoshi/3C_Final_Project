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
                    <form @submit.prevent="criarEmpresaEUsuario">
                        <h2>Entrar como Recrutador</h2>
                        <h6>Aproveite sua vida profissional ao máximo</h6>
                        <div class="campos">
                            <div class="input-container">
                                <input
                                type="text"
                                v-model="users.name"
                                @focus="isFocusedName = true"
                                @blur="handleBlur('name')"
                                placeholder="Nome"
                                required
                                />
                                <!-- <label for="input">Nome</label> -->
                                <span v-if="isFocusedName && !users.name" class="validacao">Campo obrigatório</span>
                            </div>
                            <div class="input-container">
                                <input
                                type="text"
                                v-model="companies.name"
                                @focus="isFocusedCompanyName = true"
                                @blur="handleBlur('name')"
                                placeholder="Nome da empresa"
                                required
                                />
                                <!-- <label for="input">Nome da empresa</label> -->
                                <span v-if="isFocusedCompanyName && !companies.name" class="validacao">Campo obrigatório</span>
                                <!-- <span>CAMPO OBRIGATÓRIO</span> -->
                            </div>
                            <div class="input-container">
                                <input
                                    type="text"
                                    :value="companies.email"
                                    @input="updateEmails"
                                    @focus="isFocusedEmail = true"
                                    @blur="handleBlur('email')"
                                    placeholder="Email"
                                    required
                                />
                                <!-- <label for="input">Email</label> -->
                                <span v-if="isFocusedEmail && !isEmail(companies.email)" class="validacao">Email inválido</span>
                            </div>
                            <div class="input-container">
                                <input
                                type="text"
                                v-model="companies.cnpj"
                                @keypress="validateCnpjInput"
                                @focus="isFocusedCnpj = true"
                                @blur="handleBlur('cnpj')"
                                placeholder="CNPJ"
                                required
                                />
                                <span v-if="isFocusedCnpj && !companies.cnpj" class="validacao">Campo obrigatório</span>
                                <!-- <label for="input">CNPJ</label> -->
                            </div>
                            <div class="input-container">
                                <input
                                type="text"
                                v-model="companies.description"
                                @focus="isFocusedDescription = true"
                                @blur="handleBlur('description')"
                                placeholder="Descrição"
                                required
                                />
                                <span v-if="isFocusedDescription && !companies.description" class="validacao">Campo obrigatório</span>
                                <!-- <label for="input">Descrição</label> -->
                            </div>
                            <!-- <span>CAMPO OBRIGATÓRIO E EMAIL JA EXISTENTE</span> -->
                            <div class="input-container">
                                <input
                                type="password"
                                :value="companies.password"
                                @input="updatePassword"
                                @focus="isFocusedPassword = true"
                                @blur="handleBlur('password')"
                                placeholder="Senha"
                                minlength="8"
                                required
                                />
                                <span v-if="isFocusedPassword && companies.password.length < 8" class="validacao">Senha deve ter pelo menos 8 caracteres</span>
                                <!-- <label for="input">Senha</label> -->
                            </div>
                            <!-- <span>MIN-WITDH DA SENHA</span> -->
                            <div class="input-container">
                                <input
                                type="password"
                                v-model="passwordConfirm"
                                @focus="isFocusedPasswordConfirm = true"
                                @blur="handleBlur"
                                placeholder="Confirmar senha"
                                minlength="8"
                                required
                                />
                                <!-- <label for="input">Confirmar senha</label> -->
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
                            <div class="entrarBtn">
                                <button type="submit">
                                    <h3>Registrar-se</h3>
                                </button>
                            </div>
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
                                <h6>Já possui conta de Recrutador? 
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
        </div>
    </div>
</template>

<script>
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
                users: {
                    name: "",
                    email: "",
                    password: "",
                    user_type: "recruiter"
                },
            passwordConfirm: "",
            isFocusedName: false, // Controla o estado de foco
            isFocusedCompanyName: false, 
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
            criarEmpresaEUsuario() {
                // Primeiro, cria a empresa
                axios.post('http://localhost:8000/api/companies', this.companies)
                    .then(response => {
                        console.log('Empresa criada:', response.data);

                        // Atualiza os dados do usuário para incluir informações da empresa, se necessário
                        //this.users.company_id = response.data.company.id; // Exemplo, ajuste conforme seu backend

                        // Cria o usuário associado à empresa
                        return axios.post('http://localhost:8000/api/users', this.users);
                    })
                    .then(response => {
                        console.log('Usuário criado:', response.data);
                        this.redirecionarLogin();
                        //alert('Empresa e usuário criados com sucesso!');
                    })
                    .catch(error => {
                        console.error('Erro ao criar empresa ou usuário:', error.response?.data || error.message);
                        alert('Ocorreu um erro ao criar a empresa ou o usuário. Tente novamente.');
                    });
            },
            redirecionarLogin() {
                this.$router.push({ name: 'login' });
            },
            updateEmails(event) {
                const value = event.target.value;
                this.companies.email = value;
                this.users.email = value;
            },
            updatePassword(event) {
                const value = event.target.value;
                this.companies.password = value;
                this.users.password = value;
            },
            isEmail(value) {
                // Regex simples para validar o formato de email
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(value);
            },
            validateCnpjInput(event) {
                // Permite apenas números e os caracteres específicos
                const allowedCharacters = /[0-9./-]/;
                const key = event.key;

                // Se a tecla pressionada não for permitida, impede o evento
                if (!allowedCharacters.test(key)) {
                    event.preventDefault();
                }
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
        width: 32vw;
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
        margin-bottom: 2%;
        /* display: flex;
        flex-direction: column;
        align-items: center; */
    }

    /* Estilo do contêiner campos */
    .input-container {
        position: relative;
        margin-top: 3.5%;
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
        margin-bottom: 7%;
    }

    .footerCard h6{
        font-weight: 500;
    }

    .recruiter{
        margin-top: 5%;
    }
</style>