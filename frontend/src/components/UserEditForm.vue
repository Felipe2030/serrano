<template>
  <div class="container">
    <!-- Adiciona/remove a classe "show" -->
    <div v-bind:class="modalClass" class="modal-container">
      <div class="user-modal">
        <h3 class="text-info">Editar Usuário</h3>
        <form id="formUpdateUser">
          <div class="form-group">
            <label for="">Nome</label>
            <input v-bind:value="user.nome" required type="text" id="nomeEdit" class="form-control"/>
          </div>
  
          <div class="form-group">
            <label for="">Sexo</label>
            <select required type="text" id="sexoEdit" class="form-control">
              <option :selected="user.sexo === 'M'">M</option>
              <option :selected="user.sexo === 'F'">F</option>
              <option :selected="user.sexo === 'O'">O</option>
            </select>
          </div>
          
          <div class="form-group">
            <label for="">Data Nascimento</label>
            <input v-bind:value="user.datanascimento" required type="date" id="datanascimentoEdit" class="form-control"/>
          </div>

          <div class="form-group">
            <label for="">Idade</label>
            <input v-bind:value="user.idade" required type="number" id="idadeEdit" class="form-control"/>
          </div>

          <!-- ao clicar, "showModal" passa a ser false -->
          <button v-on:click.prevent="showModal = !showModal" class="btn btn-secondary mr-1">Fechar</button>
          <button v-on:click="updateUser(user.id)" type="submit" class="btn btn-primary">Salvar</button> 
        </form>
      </div>
    </div>

  </div>
</template>

<script>
import { EventBus } from '../main.js';

export default {
  name: 'UserEditForm',
  data() {
    return {
      users: [],
      user: '',
      showModal: false
    }
  },
  methods: {
    // Requisição PUT para atualizar informações do usuário
    async updateUser(id) {
        let formulario = document.getElementById('formUpdateUser');
        formulario.addEventListener('submit',() => {
       
        let formData = new FormData();
        formData.append('nome', document.getElementById('nomeEdit').value);
        formData.append('sexo', document.getElementById('sexoEdit').value);
        formData.append('datanascimento', document.getElementById('datanascimentoEdit').value);
        formData.append('idade', document.getElementById('idadeEdit').value);
        fetch(`http://localhost:8080/users/${id}`,{
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
  // Ao criar o componente, recebemos os dados emitidos do 'EventBus' aqui nesse componente
  created() {
    // evento de click
    EventBus.$on('click', (modal, user) => {
      this.showModal = !modal;
      this.user = user;
      console.log('showModal', this.showModal);
      console.log('modal', modal)
    })
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
/* Esta usando a mesma estilização do modal de cadastro */
</style>
