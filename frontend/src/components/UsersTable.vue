<template>
  <div class="container">
    <h3 class="mt-2 mb-3 float-left text-primary">Usuários</h3>
    <!-- Tabela de Usuários -->
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Usuario ID</th>
          <th scope="col">Nome</th>
          <th scope="col">Sexo</th>
          <th scope="col">Data Nascimento</th>
          <th scope="col">Idade</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <!-- Diretiva "v-for" para pegar os usuários da API -->
        <tr v-for="(user, index) in users" :key="user._id" class="m-5">
          <th scope="row">{{ index + 1 }}</th>
          <td>{{ user.id }}</td>
          <td>{{ user.nome }}</td>
          <td>{{ user.sexo }}</td>
          <td>{{ user.datanascimento }}</td>
          <td>{{ user.idade }}</td>
          <td>
            <form>
              <button v-on:click.prevent="emitShowModal(user)" class="btn btn-sm btn-info mr-1">Editar</button>
              <button v-on:click="deleteUser(user.id)" type="submit" class="btn btn-sm btn-danger">Deletar</button>
            </form>
          </td>
        </tr>
        <!-- Fim "v-for" -->
      </tbody>
    </table>
    <!-- Fim tabela -->
  </div>
</template>

<script>
import { EventBus } from '../main.js';

export default {
  name: 'UsersTable',
  data() {
    return {
      users: [],
      showModal: false
    }
  },
  // Ao criar o componente, é feito uma requisição GET para a API do backend
  async created() {
    let response = await fetch('http://localhost:8080/users');
    let person = await response.json();
    this.users = person;
  },
  methods: {
    // Requisição DELETE para excluir o usuário
    async deleteUser(id) {
      await fetch(`http://localhost:8080/users/${id}`, {
        method: 'DELETE'
      })
      .then((response) => response.json())
      .catch((err) => {
        console.error(err);
      });
    },
    // Metodo usa o 'EventBus' para poder emitir dados de forma global
    // --> Emite dados de "user" e "showModal"
    emitShowModal(user) {
      this.user = user;
      EventBus.$emit('click', this.showModal, this.user);
      
      console.log(this.user);
      console.log('UsersTable:', this.showModal);
    }
  }
}
</script>

<style scoped>
th {
  padding-left: 1.2rem;
}
</style>
