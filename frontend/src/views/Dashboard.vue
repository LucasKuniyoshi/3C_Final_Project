<template>
    <div class="dashboard-container">
      <!-- BARRA LATERAL -->
      <aside class="sidebar">
        <div class="user">
          <font-awesome-icon class="icon" icon="user" />
        </div>
        <h2>Lucas</h2>
        <p>lucasTeste@gmail.com</p>
        <ul>
          <li><router-link to="#">Visão Geral</router-link></li>
          <li><router-link to="#">Minhas Vagas</router-link></li>
          <li><router-link to="#">Configurações</router-link></li>
          <li><router-link to="#">Perfil</router-link></li>
          <li><router-link to="/">Sair</router-link></li>
        </ul>
      </aside>
  
      <div class="border-main-content">
        <div class="main-content">
          <header class="header">
            <h1>Visão Geral</h1>
            <div class="search-bar">
              <font-awesome-icon icon="magnifying-glass" class="searchIcon" />
              <input type="text" placeholder="Pesquisar..." class="search-input" />
            </div>
          </header>
          
          <section class="body">
            <div class="vagas-content">
                <h5 class="topicos">Nova vaga</h5>
                <div class="card-content">
                    <!-- <div class="card" @click="openModalNewVaga('Dev Front-End', 'Vaga para desenvolvedor FRONT-END Junior com foco em mobile', 'salario', 'localização', 'requisitos')"> -->
                    <div class="card" @click="abrirModal">
                    <div class="newCard">
                        <h3><font-awesome-icon class="plusIcon" icon="plus" /></h3>
                        <h5>Adicionar nova vaga</h5>
                    </div>
                    </div>
                </div> 
                <div>
                  <h3>Última vaga criada</h3>
                  <div v-if="ultimaVaga">
                    <p><strong>Nome:</strong> {{ ultimaVaga.nome }}</p>
                    <p><strong>Descrição:</strong> {{ ultimaVaga.descricao }}</p>
                    <p><strong>Salário:</strong> {{ ultimaVaga.salario }}</p>
                    <p><strong>Localização:</strong> {{ ultimaVaga.localizacao }}</p>
                    <p><strong>Requisitos:</strong> {{ ultimaVaga.requisitos }}</p>
                  </div>
                </div> 
                <!-- <h5 class="topicos2">Última vaga criada</h5>
                <div class="card-content">
                    <div class="card" @click="openModal(this.title, this.description, 'salario', 'localização', 'requisitos')">
                    <h3>{{ title }}</h3>
                    <p>{{ description }}</p>
                    </div>
                </div>   -->
                <h5 class="topicos2">Minhas vagas</h5>
                <div class="card-content">
                    <div class="card" @click="openModal('Título 2', 'Descrição completa do card 2', 'salario', 'localização', 'requisitos')">
                    <h3>Estagio</h3>
                    <p>Vaga para estágiario que busca se aventurar no mundo TECH</p>
                    </div>
                    <div class="card" @click="openModal('Título 3', 'Descrição completa do card 3', 'salario', 'localização', 'requisitos')">
                    <h3>DevOps</h3>
                    <p>Vaga para Infra com experiência em servidores e domínios</p>
                    </div>
                    <div class="card" @click="openModal('Título 3', 'Descrição completa do card 3', 'salario', 'localização', 'requisitos')">
                    <h3>DevOps</h3>
                    <p>Vaga para Infra com experiência em servidores e domínios</p>
                    </div>
                </div>
            </div>
            <div class="activities">
                <div class="calendar">
                    <div class="calendar-header">
                    <button>&#10094;</button>
                    <h2>Novembro 2024</h2>
                    <button>&#10095;</button>
                    </div>

                    <div class="calendar-days">
                    <div>Dom</div>
                    <div>Seg</div>
                    <div>Ter</div>
                    <div>Qua</div>
                    <div>Qui</div>
                    <div>Sex</div>
                    <div>Sáb</div>
                    </div>

                    <div class="calendar-dates">
                    <div>
                        <div class="day">1</div>
                        <div class="day">8</div>
                        <div class="day">15</div>
                        <div class="day">22</div>
                        <div class="current-day">29</div>
                    </div>
                    <div>
                        <div class="day">2</div>
                        <div class="day">9</div>
                        <div class="day">16</div>
                        <div class="day">23</div>
                        <div class="day">30</div>
                    </div>
                    <div>
                        <div class="day">3</div>
                        <div class="day">10</div>
                        <div class="day">17</div>
                        <div class="day">24</div>
                    </div>
                    <div>
                        <div class="day">4</div>
                        <div class="day">11</div>
                        <div class="day">18</div>
                        <div class="day">25</div>
                    </div>
                    <div>
                        <div class="day">5</div>
                        <div class="day">12</div>
                        <div class="day">19</div>
                        <div class="day">26</div>
                    </div>
                    <div>
                        <div class="day">6</div>
                        <div class="day">13</div>
                        <div class="day">20</div>
                        <div class="day">27</div>
                    </div>
                    <div>
                        <div class="day">7</div>
                        <div class="day">14</div>
                        <div class="day">21</div>
                        <div class="day">28</div>
                    </div>
                    </div>
                </div>
                <div class="insights">
                    <h5>Total de vagas inscritas</h5>
                    <div class="insights-position">
                    <p>11</p>
                    <div class="arrowUp">
                        12.85%
                        <font-awesome-icon icon="arrow-trend-up" />                
                    </div>
                    </div>
                </div>
                <div class="insights">
                    <h5>Networking</h5>
                    <div class="insights-position">
                    <img src="../assets/CircleGrafic.png" alt="CircleGrafic">
                    <div class="arrowUp">
                        +2
                        <font-awesome-icon icon="comments" />                
                    </div>
                    </div>
                </div>
                <div class="insights">
                    <h5>Retornos recebidos</h5>
                    <div class="insights-position">
                    <p>7</p>
                    <div class="doubleArrow">
                        -0.35%
                        <font-awesome-icon icon="arrow-right-arrow-left" />                
                    </div>
                    </div>
                </div>
            </div>
          </section>
        </div>
      </div>
  
      <!-- MODAL DE ADICIONAR NOVA VAGA-->
      <!-- <div v-if="showModal" class="modal-overlay" @click.self="closeModalNewVaga"> -->
      <div v-if="modalAberto" class="modal-overlay" @click.self="fecharModal">
        <div class="modal-content">
          <h2>Adicionar nova Vaga</h2>
          <form @submit.prevent="adicionarVaga">
            <div class="campos">
              <div class="input-container">
                <input type="text" v-model="novaVaga.nome" @focus="isFocusedTitle = true" @blur="handleBlur('Nome da vaga')" placeholder=" " required />
                <label>Nome da vaga</label>
                <span v-if="isFocusedTitle && !novaVaga.nome" class="validacao">Campo obrigatório</span>
              </div>
              <input type="text" v-model="novaVaga.descricao" placeholder="Descrição" required />
              <input type="text" v-model="novaVaga.salario" placeholder="Salário" />
              <input type="text" v-model="novaVaga.localizacao" placeholder="Localização" />
              <input type="text" v-model="novaVaga.requisitos" placeholder="Requisitos" />
            </div>
              <button type="submit" class="confirm-button" >Confirmar</button>
              <button type="button" class="cancel-button" @click="fecharModal">Cancelar</button>
          </form>
          <!-- <div class="campos">
              <div class="input-container">
              <input
                  type="text"
                  v-model="title"
                  @focus="isFocusedTitle = true"
                  @blur="handleBlur('title')"
                  placeholder=" "
                  required
              />
              <label>Nome da vaga</label>
              <span v-if="isFocusedTitle && !title" class="validacao">Campo obrigatório</span>
              </div>
              <div class="input-container">
              <input
                  type="text"
                  v-model="description"
                  @focus="isFocusedDescription = true"
                  @blur="handleBlur('description')"
                  placeholder=" "
                  required
              />
              <label>Descrição</label>
              <span v-if="isFocusedDescription && !description" class="validacao">Campo obrigatório</span>
              </div>
              <div class="input-container">
              <input
                  type="text"
                  v-model="salary"
                  @focus="isFocusedSalary = true"
                  @blur="handleBlur('salary')"
                  placeholder=" "
                  required
              />
              <label>Salário</label>
              <span v-if="isFocusedSalary && !salary" class="validacao">Campo obrigatório</span>
              </div>
              <div class="input-container">
              <input
                  type="text"
                  v-model="location"
                  @focus="isFocusedLocation = true"
                  @blur="handleBlur('location')"
                  placeholder=" "
                  required
              />
              <label>Localização</label>
              <span v-if="isFocusedLocation && !location" class="validacao">Campo obrigatório</span>
              </div>
              <div class="input-container">
              <input
                  type="text"
                  v-model="request"
                  @focus="isFocusedRequest = true"
                  @blur="handleBlur('request')"
                  placeholder=" "
                  required
              />
              <label>Requisitos</label>
              <span v-if="isFocusedRequest && !request" class="validacao">Campo obrigatório</span>
              </div>
            </div> -->
          <!-- <button class="confirm-button" @click="confirmModal">Confirmar</button>
          <button class="cancel-button" @click="closeModalNewVaga">Cancelar</button> -->
        </div>
      </div>
    </div>
</template>

<script>
export default {
  data() {
    return {
      showModal: false,
      title: "",  
      description: "",
      salary: "",
      location: "",
      request: "",
      isFocusedTitle: false,
      isFocusedDescription: false,
      isFocusedSalary: false,
      isFocusedLocation: false,
      isFocusedRequest: false,

      novaVaga: {
        nome: '',
        descricao: '',
        salario: '',
        localizacao: '',
        requisitos: ''
      },
      ultimaVaga: null,
      modalAberto: false
    };
  },
  mounted() {
    this.carregarUltimaVaga();
  },
  methods: {
    abrirModal() {
      this.modalAberto = true; // Abre o modal
    },
    fecharModal() {
      this.modalAberto = false;
    },
    // openModalNewVaga() {
    //   this.showModal = true;
    // },
    // closeModalNewVaga() {
    //   this.showModal = false;
    // },
    // confirmModal() {
    //   // Adicione a lógica para enviar os dados do formulário ou processá-los
    //   console.log("Dados da nova vaga:", {
    //     title: this.title,
    //     description: this.description,
    //     salary: this.salary,
    //     location: this.location,
    //     request: this.request,
    //   });
    //   this.closeModalNewVaga();
    // },
    handleBlur(field) {
      // Desfoca o campo se ele estiver preenchido
      if (field === 'title' && this.title) this.isFocusedTitle = false;
      if (field === 'description' && this.description) this.isFocusedDescription = false;
      if (field === 'salary' && this.salary) this.isFocusedSalary = false;
      if (field === 'location' && this.location) this.isFocusedLocation = false;
      if (field === 'request' && this.request) this.isFocusedRequest = false;
    },
    // openModal(title, description, salary, location, request) {
    //     modalTitle.value = title;
    //     modalDescription.value = description;
    //     modalSalary.value = salary;
    //     modalLocation.value = location;
    //     modalRequest.value = request;
    //     showModal.value = true;
    // },
    // closeModal() {
    //     showModal.value = false;
    // },

    adicionarVaga() {
      // Armazena a nova vaga no localStorage
      localStorage.setItem('ultimaVaga', JSON.stringify(this.novaVaga));
      
      // Atualiza o campo da última vaga criada
      this.ultimaVaga = { ...this.novaVaga };
      
      // Limpa o formulário
      this.novaVaga = {
        nome: '',
        descricao: '',
        salario: '',
        localizacao: '',
        requisitos: ''
      };
      
      // Fecha o modal
      this.modalAberto = false;
    },  
    carregarUltimaVaga() {
      // Carrega a última vaga do localStorage, se disponível
      const vaga = localStorage.getItem('ultimaVaga');
      if (vaga) {
        this.ultimaVaga = JSON.parse(vaga);
      }
    }
  },
};
</script>
  
  <style scoped>
  /* Estilo do Container do Dashboard */
  .dashboard-container {
    display: flex;
    height: 100vh;
    overflow: hidden;
    margin: 0.7%;
    border-radius: 10px;
  }
  
  /* Estilo da Barra Lateral */
  .sidebar {
    width: 16.7%;
    background-color: #333;
    color: #fff;
    padding: 20px;
    box-sizing: border-box;
  }

  .sidebar .user {
    /* background-color: #a3a3a3; */
    margin-left: 0.7%;
  }

  .sidebar .user .icon {
    /* background-color: #a3a3a3; */
    height: 3.18vh;
  }

  .sidebar p{
    color: #757575;
    margin-bottom: 10%;
  }
  
  .sidebar h2 {
    font-size: 1.5em;
    margin-bottom: 0.5%;
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
    background-color: #f4f4f9;
    border: 1px solid #d1d0d0;
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
  .border-main-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    background-color: #333;
    /* background-color: #f4f4f9; */
    /* padding: 0.7%; */
    border: 10px solid #333;
  }

  .main-content{
    border-radius: 10px;
    background-color: #f4f4f9;
    height: 100vh;
  }
  
  /* Estilo do Cabeçalho */
  .header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    /* background-color: skyblue; */
    color: #333;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
  }
  
  .header h1 {
    margin: 0;
  }

  .body{
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
  }

  .vagas-content{
    /* background-color: lightcoral; */
    max-width: 65%;
    margin-left: -3%;
  }
  
  /* Estilo da Área de Conteúdo */
  .content {
    padding: 1%;
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    overflow-y: auto;
  }

  .topicos{
    margin-left: 1.5%;
    color: #555;
  }

  .topicos2{
    margin-left: 1.5%;
    margin-top: 1.5%;
    color: #555;
  }

  .card-content{
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
  }
  
  /* Estilo dos Cards */
  .card {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 1.8%;
    max-width: 45%;
    /* width: 100%; */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    cursor: pointer;
    margin: 0.3%;
  }
  
  .card h3 {
    margin-top: 0;
  }
  
  .card p {
    margin: 0;
  }

  .card .newCard .plusIcon{
    background-color: #d3d1d1;
    padding: 30%;
    border-radius: 10px;
  }

  .card .newCard{
    display: flex;
    align-items: center;
  }

  .card .newCard h5{
    margin-left: 18%;
    /* font-weight: 500; */
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
    max-width: 26.5%;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  }
  
  .modal-content h2 {
    margin-top: 0;
  }
  
  .modal-content button{
    margin-top: 5%;
    padding: 2.8%;
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
      background-color: #FFF;
      color: #a3a3a3;
    }

  .modal-content .cancel-button:hover {
    background-color: #b8b8b8;
    color: #FFF;
    transition: .4s;
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
        margin-top: 7.4%;
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
        margin-bottom: 5px;
    }

  /* Estilo do container do calendário */
  .calendar {
    width: 100%;
    max-width: 100%;
    margin: 0 auto;
    padding: 1.5%;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    font-family: Arial, sans-serif;
  }

  /* Cabeçalho do calendário */
  .calendar-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 4%;
  }

  .calendar-header h2 {
    font-size: 1.5em;
    margin: 0;
  }

  .calendar-header button {
    /* background-color: #007bff; */
    /* color: #fff; */
    border: none;
    padding: 1%;
    border-radius: 4px;
    cursor: pointer;
  }

  /* Dias da semana */
  .calendar-days {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    font-weight: bold;
    text-align: center;
    margin-bottom: 3.2%;
    color: #555;
  }

  /* Dias do mês */
  .calendar-dates {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    text-align: center;
  }

  .current-day {
    padding: 4% 0;
    border-radius: 50px;
    cursor: pointer;
    transition: background-color 0.3s;
    color: #f0f0f0;
    background-color: darkviolet;
  }

  .day {
    padding: 4% 0;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
  }
 
  .insights{
    margin-top: 5%;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    padding: 3%;
  }

  .insights p{
    padding-left: 2%;
    font-weight: 600;
    font-size: large;
  }

  .insights-position{
    display: flex;
    justify-content: space-around;
  }
  .insights .arrowUp{
    color: green;
  }

  .insights .doubleArrow{
    color: red;
  }

  .insights .insights-position img{
    height: 18vh;
    width: 8.7vw;
  }
  </style>
  