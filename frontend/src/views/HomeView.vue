<script setup>
import HelloWorld from '@/components/HelloWorld.vue';
import Footer from '@/components/Footer.vue';

</script>

<template>
  <!-- <header>
    <NavBar/>
  </header> -->
  <main>
    <div>
      <section>
        <div class="container">
          <div class="login-elements">
            <h1>Conheça sua Comunidade Profissional</h1>
            <div>
              <h3>Continue com Google<font-awesome-icon icon="google" /></h3>
              <!-- <img class="img-size" src="../assets/google-logo.png" alt="google-logo"> -->
            </div>
            <h4>Entrar com email</h4>
            <p>Ainda não conhece o Recruta Fácil? <router-link to="/about">Cadastre-se agora</router-link></p>
          </div>
          <img class="templateImg" src="../assets/template-logo.webp" alt="templateImg">
        </div>
      </section>
    </div>
    <Footer />
  </main>
</template>

<style scoped>
  *{
    margin: 0;
    padding: 0;
    text-decoration: none;
  }

  .container{
    margin-top: 10%;
    display: flex;
    flex-direction: row;
  }

  .login-elements{
    display: flex;
    flex-direction: column;
    text-align: center;
  }

  .login-elements a:hover{
    text-decoration: underline;
  }

  .img-size{
    width: 5%;
    height: 50%;
  }

  .templateImg{
    width: 50%;
    height: 50%;
    border-radius: 10px;
  }
</style>