<script setup>
import HelloWorld from '@/components/HelloWorld.vue';
import Footer from '@/components/Footer.vue';

</script>

<template>
  <header>
    <figure>
      <RouterLink to="/">
        <img class="img-newSize" src="../assets/Recruta_Facil.png">
      </RouterLink>
    </figure>
    <div class="items">
      <RouterLink to="/login">Entrar</RouterLink>
      <RouterLink to="/signin">Cadastrar</RouterLink>
    </div>
  </header>
  <main>
    <div>
      <section>
        <div class="container">
          <div class="login-elements">
            <h1>Conheça sua Comunidade Profissional</h1>
            <div>
              <h3>Continue com Google <font-awesome-icon :icon="['fab', 'google']" /></h3>
            </div>
            <h4>Entrar com e-mail <font-awesome-icon icon="envelope" /></h4>
            <p>Ainda não conhece o Recruta Fácil? <router-link to="/signin">Cadastre-se agora</router-link></p>
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

  header {
    display: flex;
    background-color: lightcyan;
    justify-content: space-between;
    align-items: center;
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
  }

  .img-newSize{
    width: 100%;
    height: 70px;
    margin: 15% 15% 15% 20%;
  }

  .items{
    margin: 0% 7% 0% 2%;
    
    /* background-color: aquamarine; */
  }

  .items a{
    margin: 10%;
    padding: 9%;
    color: #FFF;
    text-decoration: none;
    background-color: skyblue;
    /* border: 2px solid #FFF; */
    border-radius: 25px;
    font-size: large;
    /* font-weight: bold; */
  }

  .items a:hover{
    background-color: rgb(119, 184, 209);
    transition: .5s;
  }

  .container{
    margin-top: 10%;
    display: flex;
    flex-direction: row;
    /* flex-wrap: wrap; */
  }

  .login-elements{
    display: flex;
    flex-direction: column;
    text-align: center;
  }

  .login-elements h3{
    background-color: lightblue;
    color: #FFF;
    padding: 1.2%;
    margin: 5% 15% 1% 15%;
    border: 1px solid #FFF;
    border-radius: 10px;
    cursor: pointer;
  }

  .login-elements h3:hover{
    background-color: rgb(163, 201, 213);
    /* color: lightblue;
    border: 2px solid lightblue; */
    transition: .4s;
  }

  .login-elements h4{
    background-color:#FFF;
    color:lightblue;
    padding: 1.2%;
    margin: 0% 15% 7% 15%;
    border: 1px solid #FFF;
    border-radius: 10px;
    border: 2px solid lightblue;
    cursor: pointer;
  }

  .login-elements h4:hover{
    background-color: lightblue;
    color: #FFF;
    transition: .5s;
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

  @media (min-width: 1024px) {
    .greetings h1,
    .greetings h3 {
      text-align: left;
    }
  }
</style>