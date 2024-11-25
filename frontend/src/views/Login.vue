<script>
import axios from "axios";

export default {
    data() {
        return {
            email: "",
            password: "",
            errorMessage: "",
        };
    },
    methods: {
        login() {
        axios
            .post("http://localhost:8000/api/login", {
                email: this.email,
                password: this.password,
            })
            .then((response) => {
                console.log(response);
                // Extraindo dados do retorno
                const { token, user, applications } = response.data;

                // Armazenando no localStorage
                localStorage.setItem("token", token); // Token de autenticação
                localStorage.setItem("user", JSON.stringify(user)); // Dados do usuário
                localStorage.setItem("applications", JSON.stringify(applications)); // Vagas ligadas ao candidato
                localStorage.setItem("company_id", company_id);

                // Redirecionando com base no tipo de usuário
                if (user.user_type === "candidate") {
                    this.$router.push("/candidate/jobs");
                } else if (user.user_type === "recruiter") {
                    this.$router.push("/recruiter/dashboard");
                } else {
                    alert("Tipo de usuário inválido.");
                }
            })
            .catch((error) => {
                this.errorMessage = error.response?.data.message || "Erro ao realizar login.";
                console.error("Erro no login:", error);
            });
    },
    },
};
</script>

<template>
    <div class="container">
        <header>
            <router-link to="/">
                <img class="img-size-login" src="../assets/Recruta_Facil.png" alt="Recruta_Facil_Logo">
            </router-link>
        </header>
        <section>
            <div class="cardd">
                <h2>Entrar</h2>
                <h6>Fique em dia com suas notícias profissionais</h6>
                <form @submit.prevent="login">
                    <div class="campos">
                        <div class="input-container">
                            <input
                                type="email"
                                v-model="email"
                                placeholder=""
                                required
                            />
                            <label for="input">Email</label>
                            <!-- <span class="error-message">Este campo é obrigatório</span> -->
                        </div>
                        <div class="input-container">
                            <input
                                type="password"
                                v-model="password"
                                placeholder=""
                                minlength="8"
                                required
                            />
                            <label for="input">Senha</label>
                            <!-- <span class="error-message">A senha deve ter no mínimo 8 caracteres</span> -->
                        </div>
                        </div>
                        <div>
                        <label class="checkbox-container">
                            <input type="checkbox">
                            Manter conectado
                        </label>
                    </div>
                    <div v-if="errorMessage" class="error-message">
                        {{ errorMessage }}
                    </div>
                    <div>
                        <div class="entrarBtn">
                            <button type="submit">
                                <h3>Entrar</h3>
                            </button>
                        </div>
                        <!--<div class="entrarBtn" type="submit">
                            <router-link>
                                <h3>Entrar</h3>
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
                        <div class="forgotPassword">
                            <h6><a href="">Esqueceu a senha ?</a></h6>
                        </div>
                    </div>
                </form>
            </div>
            <div class="footerCard">
                <h6>Ainda não faz parte do Recruta Fácil? 
                    <router-link to="/signin">Cadastre-se agora</router-link>
                </h6>
            </div>
        </section>
    </div>
</template>

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
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), 0 6px 20px rgba(0, 0, 0, 0.1);
        border-radius: 8px; /* opcional, para bordas arredondadas */
        padding: 20px;      /* opcional, para espaçamento interno */
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
        margin-top: 7%;
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

    .error-message {
        color: red;
        font-size: 12px;
        visibility: hidden;
        margin-top: 5px;
        position: absolute;
        left: 0;
        top: 100%;
    }

    /* Mostra a mensagem de erro se o input for inválido */
    .input-container input:invalid + label + .error-message {
        visibility: visible;
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
        margin-top: 8%;
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

    .forgotPassword{
        margin-top: 5%;
    }
</style>