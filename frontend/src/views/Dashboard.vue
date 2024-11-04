<template>
    <div class="dashboard-container">
      <!-- BARRA LATERAL -->
      <aside class="sidebar">
        <h2>Menu</h2>
        <ul>
          <li><router-link to="/overview">Visão Geral</router-link></li>
          <li><router-link to="/reports">Relatórios</router-link></li>
          <li><router-link to="/settings">Configurações</router-link></li>
          <li><router-link to="/profile">Perfil</router-link></li>
        </ul>
      </aside>
  
      <div class="main-content">
        <header class="header">
          <h1>Olá "Username"</h1>
          <div class="search-bar">
            <font-awesome-icon icon="magnifying-glass" class="searchIcon" />
            <input type="text" placeholder="Pesquisar..." class="search-input" />
          </div>
        </header>
  
        <section class="content">
          <div class="card" @click="openModal('Título 1', 'Descrição completa do card 1', 'salario', 'localização', 'requisitos')">
            <h3>Título 1</h3>
            <p>Descrição do card 1.</p>
          </div>
          <div class="card" @click="openModal('Título 2', 'Descrição completa do card 2', 'salario', 'localização', 'requisitos')">
            <h3>Título 2</h3>
            <p>Descrição do card 2.</p>
          </div>
          <div class="card" @click="openModal('Título 3', 'Descrição completa do card 3', 'salario', 'localização', 'requisitos')">
            <h3>Título 3</h3>
            <p>Descrição do card 3.</p>
          </div>
        </section>
      </div>
  
      <!-- Modal -->
      <div v-if="showModal" class="modal-overlay" @click.self="closeModal">
        <div class="modal-content">
          <h2>{{ modalTitle }}</h2>
          <p>{{ modalDescription }}</p>
          <h5>Localização: <p>Curitiba, PR</p></h5>
          <h5>Salário: <p>R$:2000.00</p></h5>
          <h5>Requisitos:</h5>
          <ul>
            <li>Conhecimento SQL</li>
            <li>Vue.js</li>
            <li>Laravel</li>
          </ul>
          <button class="confirm-button" @click="closeModal">Inscrever-se</button>
          <button class="cancel-button" @click="closeModal">Cancelar</button>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  
  const showModal = ref(false);
  const modalTitle = ref('');
  const modalDescription = ref('');
  const modalSalary = ref('');
  const modalLocation = ref('');
  const modalRequest = ref('');
  
  function openModal(title, description, salary, location, request) {
    modalTitle.value = title;
    modalDescription.value = description;
    modalSalary.value = salary;
    modalLocation.value = location;
    modalRequest.value = request;
    showModal.value = true;
  }
  
  function closeModal() {
    showModal.value = false;
  }
  </script>
  
  <style scoped>
  /* Estilo do Container do Dashboard */
  .dashboard-container {
    display: flex;
    height: 100vh;
    overflow: hidden;
  }
  
  /* Estilo da Barra Lateral */
  .sidebar {
    width: 250px;
    background-color: #333;
    color: #fff;
    padding: 20px;
    box-sizing: border-box;
  }
  
  .sidebar h2 {
    font-size: 1.5em;
    margin-bottom: 20px;
  }
  
  .sidebar ul {
    list-style: none;
    padding: 0;
  }
  
  .sidebar li {
    margin-bottom: 15px;
  }
  
  .sidebar li a {
    color: #ccc;
    text-decoration: none;
    font-size: 1.1em;
  }
  
  .sidebar li a:hover {
    color: #fff;
  }
  
  /* Estilo da barra de pesquisa */
  .search-bar {
    display: flex;
    align-items: center;
    background-color: #f0f0f0;
    border: 1px solid #ddd;
    border-radius: 25px;
    padding: 0.2%;
    width: 100%;
    max-width: 300px;
  }
  
  /* Estilo do campo de input */
  .search-input {
    flex: 1;
    border: none;
    outline: none;
    padding: 2.2%;
    font-size: 1em;
    background-color: transparent;
  }
  
  .searchIcon {
    color: #757575;
    margin-left: 3.5%;
  }
  
  /* Estilo do Conteúdo Principal */
  .main-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    background-color: #f4f4f9;
  }
  
  /* Estilo do Cabeçalho */
  .header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    background-color: skyblue;
    color: #fff;
  }
  
  .header h1 {
    margin: 0;
  }
  
  /* Estilo da Área de Conteúdo */
  .content {
    padding: 20px;
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    overflow-y: auto;
  }
  
  /* Estilo dos Cards */
  .card {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    width: calc(50% - 10px);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    cursor: pointer;
  }
  
  .card h3 {
    margin-top: 0;
  }
  
  .card p {
    margin: 0;
  }
  
  /* Estilo do Modal */
  .modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 10;
  }
  
  .modal-content {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    width: 90%;
    max-width: 400px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  }
  
  .modal-content h2 {
    margin-top: 0;
  }
  
  .modal-content button{
    margin-top: 20px;
    padding: 10px;
    color: #fff;
    border: none;
    cursor: pointer;
    border-radius: 7px;
  }
  .modal-content .confirm-button{
      background-color: skyblue;
   }

  .modal-content .confirm-button:hover {
    background-color: rgb(99, 197, 236);
    transition: 0.3s;
  }
  
  .modal-content .cancel-button{
      background-color: #ff6b6b;
    }

  .modal-content .cancel-button:hover {
    background-color: #ff4b4b;
  }
  </style>
  