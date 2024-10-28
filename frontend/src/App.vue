<script setup>
import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
  <header>
    <figure>
      <RouterLink to="/">
        <img class="img-size" src="../img/Recruta_Facil.png">
      </RouterLink>
    </figure>
    <div class="items">
      <RouterLink to="/about">Entrar</RouterLink>
      <RouterLink to="/login">Cadastrar</RouterLink>
    </div>
  </header>

  <main>
    <RouterView />
  </main>
</template>

<style scoped>
* {
  margin: 0;
  padding: 0;
}

header {
  display: flex;
  background-color: lightcyan;
  justify-content: space-between;
  border-bottom-left-radius: 10px;
  border-bottom-right-radius: 10px;
}

.img-size{
  width: 100%;
  height: 70px;
  margin: 15% 15% 15% 20%;
}

.items{
  margin: 2% 7% 2% 2%;
  
  /* background-color: aquamarine; */
}

.items a{
  margin: 10%;
  padding: 9%;
  color: #FFF;
  text-decoration: none;
  background-color: blue;
  /* border: 2px solid #FFF; */
  border-radius: 25px;
  font-size: large;
  /* font-weight: bold; */
}

main {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  flex: 1;
  width: 100%;
  margin-top: 5%;
}

@media (min-width: 1024px) {
  .greetings h1,
  .greetings h3 {
    text-align: left;
  }
}
</style>
