<template>
    <div class="container">
        <header>
            <img class="img-size-login" src="../assets/Recruta_facil.png" alt="Recruta_Facil_Logo">
        </header>
        <section>
            <div class="card">
                <h2>Realizando Login</h2>
                <p>Fique em dia com suas notícias profissionais</p>
                <div class="campos">
                    <input type="text" placeholder="Email">
                    <input type="text" placeholder="Senha">
                </div>
                <div>
                    <h6><a href="">Esqueceu a senha ?</a></h6>
                    <p>Manter concetado</p>
                </div>
                <div>
                    <router-link>
                        <h3>Entrar</h3>
                    </router-link>
                    <p>ou</p>
                    <router-link>
                        <h4>Entrar com conta Google</h4>
                    </router-link>
                </div>
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

    .card{
        margin-top: 5%;
        /* box-shadow: ; */
    }

    .card h2, p{
        text-align: center;
    }

    a h3{
        text-align: center;
    }

    h6 a:hover{
        text-decoration: underline;
    }
</style>