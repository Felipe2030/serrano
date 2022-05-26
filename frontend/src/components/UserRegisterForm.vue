<template>
  <div class="container">
    <!-- "showModal" passa a ser true -->
    <button v-on:click="showModal = !showModal" class="btn btn-lg btn-outline-primary float-right">Cadastrar Usuário</button>
    
    <!-- Adiciona/remove a classe "show" -->
    <div v-bind:class="modalClass" class="modal-container">
      <div class="user-modal">
        <h3 class="text-primary">Cadastro de Usuário</h3>
        <form id="formCreateUser">
          <div class="form-group">
            <label for="">Nome</label>
            <input required type="text" id="nomeRegister" class="form-control"/>
          </div>
  
          <div class="form-group">
            <label for="">Sexo</label>
            <select required type="text" id="sexoRegister" class="form-control">
              <option selected>M</option>
              <option>F</option>
              <option>O</option>
            </select>
          </div>
          
          <div class="form-group">
            <label for="">Data Nascimento</label>
            <input required type="date" id="datanascimentoRegister" class="form-control"/>
          </div>

          <div class="form-group">
            <label for="">Idade</label>
            <input required type="number" id="idadeRegister" class="form-control"/>
          </div>
          
          <!-- ao clicar, "showModal" passa a ser false -->
          <button v-on:click.prevent="showModal = !showModal" class="btn btn-secondary mr-1">Fechar</button>
          <button v-on:click="createUser()" type="submit" class="btn btn-primary">Salvar</button> 
        </form>
      </div>
    </div>

  </div>
</template>

<script>
export default {
  name: 'UserRegisterForm',
  data() {
    return {
      users: [],
      showModal: false,
    };
  },
  methods: {
    // Requisição POST para criar um novo usuário
    async createUser() {
      let formulario = document.getElementById('formCreateUser');
      formulario.addEventListener('submit',() => {
        let formData = new FormData();
        formData.append('nome', document.getElementById('nomeRegister').value);
        formData.append('sexo', document.getElementById('sexoRegister').value);
        formData.append('datanascimento', document.getElementById('datanascimentoRegister').value);
        formData.append('idade', document.getElementById('idadeRegister').value);
        fetch('http://localhost:8080/users',{
          method: 'POST',
          body: formData
        })  
        .then((response) => response.json())
        .then((data) => {
          this.users = data;
        })
        .catch((err) => {
          console.error(err);
        });
      })
    }
  },
  // Função para colocar ou tirar a classe "show" no Modal
  computed: {
    modalClass() {
      return this.showModal ? 'show' : '';
    }
  }
};
</script>

<style>
.modal-container {
  position: fixed;
  background-color: rgba(0, 0, 0, 0.3);
  top: 0;
  left: 0;
  height: 100vh;
  width: 100vw;

  display: flex;
  align-items: center;
  justify-content: center;
  
  opacity: 0;
  pointer-events: none;
  transition: opacity 0.3s ease-in-out;
}

.modal-container.show {
  opacity: 1;
  pointer-events: auto;
}

.user-modal {
  color: #535353;
  background-color: #fff;
  background-image: url("../assets/background.jpg");
  width: 450px;
  padding: 40px 50px;
  max-width: 100%;
  border-radius: 10px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.user-modal h1 {
  margin: 0;
}

.user-modal p {
  opacity: 0.9;
}
</style>
