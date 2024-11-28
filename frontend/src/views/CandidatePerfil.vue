<template>
    <div class="dashboard-container">
      <!-- BARRA LATERAL -->
      <aside class="sidebar">
        <div class="user">
          <font-awesome-icon class="icon" icon="user" />
        </div>
        <h2>{{userCandidate.name}}</h2>
        <p>{{userCandidate.email}}</p>
        <div>
          <ul>
            <li><router-link to="/candidate/jobs">Visão Geral</router-link></li>
            <li><router-link to="/candidate/jobs/candidateVagas">Minhas Vagas</router-link></li>
            <li><router-link class="currentRouter">Perfil</router-link></li>
            <li><router-link to="/">Sair</router-link></li>
          </ul>
        </div>
      </aside>
  
      <div class="border-main-content">
        <div class="main-content">
          <header class="header">
            <h1>Perfil</h1>
          </header>
          
          <section class="body">
            <div class="vagas-content">
              <div class="profile-card">
                <div class="profile-card-header">
                  <img class="profile-avatar" src="../assets/profileLogo.webp" alt="Avatar" />
                  <h3>{{ userCandidate.name }}</h3>
                  <p>{{ userCandidate.email }}</p>
                </div>
                <div class="profile-card-body">
                  <h4>Informações Adicionais</h4>
                  <ul>
                    <li><strong>Tipo de Usuário:</strong> Candidato</li>
                    <li><strong>Data de Criação:</strong> {{ new Date(userCandidate.created_at).toLocaleDateString() }}</li>
                  </ul>
                </div>
              </div>

            </div>
          </section>
        </div>
      </div>
    </div>
</template>

<script>
import { userService } from "../services/userService";

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

      novaVaga: {
        nome: '',
        descricao: '',
        salario: '',
        localizacao: '',
        requisitos: '',
        department: '',
        employment_type: '',
      },
      ultimaVaga: null,
      modalUltimaVagaAberto: false, // Controle do modal de última vaga
      modalAberto: false,
      modalDetalhesAberto: false,
      modalDetalhesEncerradasAberto: false, // Controle do modal de detalhes de Vagas Encerradas
      vagaTemp: null, // Dados temporários para edição
      vagas: JSON.parse(localStorage.getItem('vagas')) || [], // Carrega todas as vagas do localStorage
      endVagas: JSON.parse(localStorage.getItem('endVagas')) || [], // Carrega vagas encerradas do localStorage
      vagaAtual: null, // Vaga sendo editada atualmente
    };
  },
  mounted() {
    const user = JSON.parse(localStorage.getItem("user"));
    if (!user || user.user_type !== "candidate") {
        this.$router.push({ name: "login" });
    }
    this.carregarVagas();
    this.carregarEndVagas();
  },
  created() {
    this.userCandidate = userService.getUser();
  },
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
    encerrarVaga() {
      // Encontra o índice da vaga atual na lista de vagas
      const index = this.vagas.findIndex(v => v.nome === this.vagaAtual.nome && v.descricao === this.vagaAtual.descricao);
      
      if (index !== -1) {
        // Remove a vaga da lista de vagas e a adiciona à lista de vagas encerradas
        const vagaEncerrada = this.vagas.splice(index, 1)[0];
        this.endVagas.push(vagaEncerrada);

        // Atualiza o localStorage
        localStorage.setItem('vagas', JSON.stringify(this.vagas));
        localStorage.setItem('endVagas', JSON.stringify(this.endVagas));
        
        // Fecha o modal
        this.fecharModalDetalhes();
      }
    },
    deletarVagaEncerrada() {
      // Exibe uma confirmação antes de deletar a vaga
      if (confirm("Tem certeza de que deseja deletar esta vaga? Esta ação não pode ser desfeita.")) {
        const index = this.endVagas.findIndex(v => v.nome === this.vagaAtual.nome && v.descricao === this.vagaAtual.descricao);
        if (index !== -1) {
          this.endVagas.splice(index, 1);

          // Atualiza o localStorage
          localStorage.setItem('endVagas', JSON.stringify(this.endVagas));

          this.fecharModalEncerradas();
        }
      }
    },
    carregarVagas() {
      // Carrega as vagas do localStorage ao montar o componente
      const vagasSalvas = localStorage.getItem("vagas");
      if (vagasSalvas) {
        this.vagas = JSON.parse(vagasSalvas);
      }
    },
    abrirModalEncerradas(vaga) {
      this.vagaAtual = { ...vaga };
      this.modalDetalhesEncerradasAberto = true;
    },
    fecharModalEncerradas() {
      this.modalDetalhesEncerradasAberto = false;
      this.vagaAtual = null;
    },
    recriarVaga() {
      const index = this.endVagas.findIndex(v => v.nome === this.vagaAtual.nome && v.descricao === this.vagaAtual.descricao);
      if (index !== -1) {
        const vagaRecriada = this.endVagas.splice(index, 1)[0];
        this.vagas.push(vagaRecriada);

        localStorage.setItem('vagas', JSON.stringify(this.vagas));
        localStorage.setItem('endVagas', JSON.stringify(this.endVagas));

        this.fecharModalEncerradas();
      }
    },
    carregarEndVagas() {
      const endVagasSalvas = localStorage.getItem("endVagas");
      if (endVagasSalvas) {
        this.endVagas = JSON.parse(endVagasSalvas);
      }
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
    justify-content: center;
  }

  .vagas-content{
    /* background-color: lightcoral; */
    max-width: 65%;
    /*margin-left: 2%;*/
  }

  .profile-card {
  
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  background-color: #fff;
  text-align: center;
  font-family: Arial, sans-serif;
}

.profile-card-header {
  margin-bottom: 1.1em;
}

.profile-avatar {
  width: 50%;
  height: 50%;
  border-radius: 50%;
  margin-bottom: 10px;
}

.profile-card-body h4 {
  margin-bottom: 10px;
  color: #333;
}

.profile-card-body ul {
  list-style: none;
  padding: 0;
}

.profile-card-body ul li {
  margin-bottom: 10px;
  font-size: 14px;
}

.profile-card-body ul li strong {
  color: #555;
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
    /* background-color: blue; */
  }
  
  .card {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 1.8%;
    width: 23.2vw;
    /* max-width: 45%; */
    /* min-width: 60%; */
    /* width: 100%; */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    cursor: pointer;
    margin: 0.3%;
  }

  /* Estilo dos Cards */
  .EndCard {
    background-color: #f0f0f0;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 1.8%;
    width: 23.2vw;
    /* max-width: 45%; */
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
  