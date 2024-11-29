<template>
  <div class="dashboard-container">
    <!-- BARRA LATERAL -->
    <aside class="sidebar">
      <div class="user">
        <font-awesome-icon class="icon" icon="user" />
      </div>
      <div v-if="userCandidate">
        <h2>{{ userCandidate.name }}</h2>
        <p>{{ userCandidate.email }}</p>
      </div>
      <div v-else>
        <p>Carregando informações do usuário...</p>
      </div>
      <div>
        <ul>
          <li><router-link class="currentRouter" to="">Visão Geral</router-link></li>
          <li><router-link to="/candidate/jobs/candidateVagas">Minhas Vagas</router-link></li>
          <li><router-link to="/candidate/jobs/candidatePerfil">Perfil</router-link></li>
          <li><router-link to="/login">Sair</router-link></li>
        </ul>
      </div>
      <!--<div class="menu">
        <div>
          <ul>
            <li><router-link class="currentRouter" to="">Visão Geral</router-link></li>
            <li><router-link to="/candidate/jobs/candidateVagas">Minhas Vagas</router-link></li>
            <li><router-link to="">Vagas Salvas</router-link></li>
            <li><router-link to="">Configurações</router-link></li>
            <li><router-link to="">Perfil</router-link></li>
            <li><router-link to="/">Sair</router-link></li>
             COLOCAR UMA AÇÃO PARA SAIR (LIBERAR O LOCALSTORAGE)
          </ul>
        </div>
        <div class="menuBottom">
          <h5>É um Recrutador?</h5>
          <p>
            <router-link to="/signinRecruiter">Fazer login como recrutador</router-link>
          </p>
        </div>
      </div>-->
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
              <!-- Seção Mais Vagas -->
              <h5 class="topicos2">Vagas Disponíveis</h5>
              <div class="card-content">
                <div v-for="(vaga, index) in vagas" :key="vaga.id" class="card" @click="abrirModalDetalhes(vaga)">
                  <h4>{{ vaga.title }}</h4>
                  <p>{{ vaga.description }}</p>
                </div>
              </div>
              <div>
                <h5 class="topicos2">Vagas Inscritas</h5>
                <div class="card-content">
                  <div
                      v-for="(vaga, index) in vagasInscritas"
                      :key="vaga.id"
                      class="card"
                      @click="abrirModalDetalhesInscritas(vaga)"
                  >
                      <h4>{{ vaga.title }}</h4>
                      <p>{{ vaga.description }}</p>
                      <p><strong>Localização:</strong> {{ vaga.location }}</p>
                      <p><strong>Salário:</strong> R$ {{ vaga.salary }}</p>
                  </div>
                </div>
            </div>



              <!-- Modal de Detalhes -->
              <div v-if="modalDetalhesAberto" class="modal-overlay" @click.self="fecharModalDetalhes">
                <div class="modal-content">
                  <h2>{{ vagaAtual?.title }}</h2>
                  <div>
                    <h4>Descrição</h4>
                    <p>{{ vagaAtual?.description }}</p>

                    <h4>Salário</h4>
                    <p>R$ {{ vagaAtual?.salary }}</p>

                    <h4>Localização</h4>
                    <p>{{ vagaAtual?.location }}</p>

                    <h4>Requisitos</h4>
                    <p>{{ vagaAtual?.request }}</p>

                    <h4>Setor</h4>
                    <p>{{ vagaAtual?.department }}</p>

                    <h4>Regime de Trabalho</h4>
                    <p>{{ vagaAtual?.employment_type }}</p>

                    <div style="display: flex; justify-content: space-around;">
                      <button class="cancel-button" @click="fecharModalDetalhes">Fechar</button>
                      <button class="inscrever-button" @click="inscreverVaga(vagaAtual)">Inscrever-se</button>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Modal de Detalhes Inscritas -->
              <div v-if="modalDetalhesInscritasAberto" class="modal-overlay" @click.self="fecharModalDetalhesInscritas">
                <div class="modal-content">
                  <h2>{{ vagaAtual?.title }}</h2>
                  <div>
                    <h4>Descrição</h4>
                    <p>{{ vagaAtual?.description }}</p>

                    <h4>Salário</h4>
                    <p>R$ {{ vagaAtual?.salary }}</p>

                    <h4>Localização</h4>
                    <p>{{ vagaAtual?.location }}</p>

                    <h4>Requisitos</h4>
                    <p>{{ vagaAtual?.request }}</p>

                    <h4>Setor</h4>
                    <p>{{ vagaAtual?.department }}</p>

                    <h4>Regime de Trabalho</h4>
                    <p>{{ vagaAtual?.employment_type }}</p>

                    <div style="display: flex; justify-content: space-around;">
                      <button class="cancel-button" @click="fecharModalDetalhesInscritas">Fechar</button>
                    </div>
                  </div>
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
  </div>
</template>

<script>
import axios from "axios";
import { userService } from "../services/userService"; //guarda os dadosr na service

export default {
data() {
  return {
    userCandidate: null,
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
    vagasInscritas: [],

    novaVaga: {
      nome: '',
      descricao: '',
      salario: '',
      localizacao: '',
      requisitos: '',
      department: '',
      employment_type: '',
    },
    // departments: ["Tecnologia", "Vendas", "Marketing", "Recursos Humanos", "Financeiro"],
    ultimaVaga: null,
    modalUltimaVagaAberto: false, // Controle do modal de última vaga
    modalAberto: false,
    modalDetalhesAberto: false,
    modalDetalhesInscritasAberto: false,
    vagaTemp: null, // Dados temporários para edição
    vagas: JSON.parse(localStorage.getItem('vagas')) || [], // Carrega todas as vagas do localStorage
    vagaAtual: null, // Vaga sendo editada atualmente
  };
},
mounted() {
  const user = JSON.parse(localStorage.getItem("user"));
  if (!user || user.user_type !== "candidate") {
    this.$router.push({ name: "login" });
  }
  this.carregarVagas();
  this.carregarVagasInscritas();

  const vagas = JSON.parse(localStorage.getItem("vagasInscritas"));
  if (vagas) {
      this.vagasInscritas = vagas; // Preenche o array de vagas
  } else {
      console.error("Nenhuma vaga encontrada para o candidato.");
  }
},
created() {
  this.userCandidate = userService.getUser();
},
/*mounted() {
  this.carregarVagas();
},*/
methods: {
  abrirModal() {
    this.modalAberto = true; // Abre o modal
  },
  fecharModal() {
    this.modalAberto = false;
  },
  handleBlur(field) {
    // Desfoca o campo se ele estiver preenchido
    if (field === 'title' && this.title) this.isFocusedTitle = false;
    if (field === 'description' && this.description) this.isFocusedDescription = false;
    if (field === 'salary' && this.salary) this.isFocusedSalary = false;
    if (field === 'location' && this.location) this.isFocusedLocation = false;
    if (field === 'request' && this.request) this.isFocusedRequest = false;
  },  
  fecharModalUltimaVaga() {
    // Fecha o modal da última vaga
    this.modalUltimaVagaAberto = false;
    this.vagaAtual = null;
  },
  salvarAlteracoesUltimaVaga() {
    // Salva as alterações na última vaga e atualiza o localStorage
    this.ultimaVaga = { ...this.vagaAtual }; // Atualiza `ultimaVaga` com as alterações
    localStorage.setItem('ultimaVaga', JSON.stringify(this.ultimaVaga));
    this.fecharModalUltimaVaga(); // Fecha o modal após salvar
  },
  abrirModalDetalhes(vaga) {
    // Define a vaga selecionada para edição
    this.indexAtual = this.vagas.indexOf(vaga);
    this.vagaAtual = { ...vaga }; // Faz uma cópia para edição
    this.modalDetalhesAberto = true;
  },
  abrirModalDetalhesInscritas(vaga) {
    // Define a vaga selecionada para edição
    this.indexAtual = this.vagas.indexOf(vaga);
    this.vagaAtual = { ...vaga }; // Faz uma cópia para edição
    this.modalDetalhesInscritasAberto = true;
  },
  fecharModalDetalhesInscritas() {
    // Fecha o modal de detalhes sem salvar alterações
    this.modalDetalhesInscritasAberto = false;
    this.vagaAtual = null;
  },
  fecharModalDetalhes() {
    // Fecha o modal de detalhes sem salvar alterações
    this.modalDetalhesAberto = false;
    this.vagaAtual = null;
  },
  salvarAlteracoes() {
    // Salva as alterações feitas na vaga atual
    this.vagas[this.indexAtual] = { ...this.vagaAtual };
    localStorage.setItem("vagas", JSON.stringify(this.vagas));
    this.modalDetalhesAberto = false;
  },
  carregarVagas() {
    const token = localStorage.getItem("token");

    if (!token) {
      alert("Erro: Token de autenticação não encontrado. Faça login novamente.");
      this.$router.push("/login");
      return;
    }

    axios
      .get("http://localhost:8001/api/jobs", {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((response) => {
        console.log("Vagas carregadas:", response.data);
        this.vagas = response.data; // Atribui as vagas recebidas à lista local
      })
      .catch((error) => {
        console.error("Erro ao carregar vagas:", error.response?.data || error);
        alert("Erro ao carregar vagas. Tente novamente mais tarde.");
      });
  },
  inscreverVaga(vaga) {
    const token = localStorage.getItem("token");
    const user = JSON.parse(localStorage.getItem("user"));

    if (!user || user.user_type !== "candidate") {
      alert("Somente candidatos podem se inscrever em vagas.");
      return;
    }

    if (!vaga || !vaga.id) {
      alert("Erro: Detalhes da vaga não encontrados.");
      return;
    }

    const inscricao = {
      user_id: String(user.id), // Converte o ID do candidato para string
      job_id: String(vaga.id), // Converte o ID da vaga para string
      name: `Inscrição para ${vaga.title}`, // Nome descritivo da inscrição
      recruiter_id: String(vaga.recruiter_id), // Converte o ID do recrutador para string
    };

    axios
      .post("http://localhost:8001/api/applications", inscricao, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((response) => {
            console.log("Inscrição realizada com sucesso:", response.data);

            // Armazena as vagas inscritas no localStorage
            const vagasInscritas = JSON.parse(localStorage.getItem("vagasInscritas")) || [];
            vagasInscritas.push(vaga); // Adiciona a nova vaga à lista
            localStorage.setItem("vagasInscritas", JSON.stringify(vagasInscritas));

            this.carregarVagasInscritas(); // Atualiza a lista exibida
            this.fecharModalDetalhes();
        })
        .catch((error) => {
            console.error("Erro ao realizar inscrição:", error.response?.data || error);
            alert("Erro ao realizar inscrição. Tente novamente.");
        });
  },
  carregarVagasInscritas() {
    const vagasInscritas = JSON.parse(localStorage.getItem("vagasInscritas")) || [];
    this.vagasInscritas = vagasInscritas;
    console.log("Vagas inscritas carregadas do localStorage:", this.vagasInscritas);
  },

  carregarVagas() {
    // Lógica existente para carregar as vagas disponíveis
  },

  limparVagas() {
    // Remove as chaves 'vagas' e 'ultimaVaga' do localStorage
    localStorage.removeItem('vagas');
    localStorage.removeItem('ultimaVaga');

    // Limpa os dados locais
    this.vagas = [];
    this.ultimaVaga = null;
    this.vagaAtual = null;

    // Opcional: Fechar modais se estiverem abertos
    this.modalUltimaVagaAberto = false;
    this.modalDetalhesAberto = false;
  },
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

.sidebar .currentRouter{
  color: #fff;
} 

.sidebar li a {
  color: #ccc;
  text-decoration: none;
  font-size: 1.1em;
}

.sidebar li a:hover {
  color: #fff;
}

.sidebar .menu{
  display: flex;
  height: 80vh;
  flex-direction: column;
  justify-content: space-between
}

.menuBottom a{
  text-decoration: none;
  color: #ccc;
}

.menuBottom a:hover{
  text-decoration: underline;
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
  justify-content: space-between;
}

.vagas-content{
  /* background-color: lightcoral; */
  max-width: 65%;
  margin-left: 2%;
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
  width: 52vw;
}

/* Estilo dos Cards */
.card {
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 8px;
  padding: 1.8%;
  /* max-width: 45%; */
  width: 23.2vw;
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
  /* min-width: 5vw; */
}

.card .newCard h4{
  margin-left: 10%;
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
  background-color: #555;
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

.activities{
  margin-right: 4.2%;
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
