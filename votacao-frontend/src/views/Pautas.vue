<template>
  <div class="pautas-container">
    <h2>Pautas</h2>
    <button @click="abrirModalCriarPauta" class="btn-criar-pauta">Criar Nova Pauta</button>
    <ul v-if="pautas.length > 0" class="lista-pautas">
      <li v-for="pauta in pautas" :key="pauta.id" class="pauta-item">
        <div class="pauta-info">
          <h3>{{ pauta.nome }}</h3>
          <p>{{ pauta.descricao }}</p>
        </div>
      </li>
    </ul>
    <p v-else class="sem-pautas">Nenhuma pauta cadastrada.</p>

    <!-- Modal para criar nova pauta -->
    <div v-if="modalAberto" class="modal">
      <div class="modal-conteudo">
        <h3>Criar Nova Pauta</h3>
        <form @submit.prevent="criarPauta">
          <div class="form-group">
            <label for="titulo">Título:</label>
            <input v-model="novaPauta.nome" id="nome" type="text" required />
          </div>
          <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea v-model="novaPauta.descricao" id="descricao" required></textarea>
          </div>
          <div class="form-botoes">
            <button type="button" @click="fecharModal" class="btn-cancelar">Cancelar</button>
            <button type="submit" class="btn-salvar">Salvar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'PautasView',
  data() {
    return {
      pautas: [], // Lista de pautas
      modalAberto: false, // Controla a abertura do modal
      novaPauta: {
        nome: '',
        descricao: '',
      },
    }
  },
  async created() {
    // Busca a lista de pautas ao carregar o componente
    await this.carregarPautas()
  },
  methods: {
    // Carrega as pautas do back-end
    async carregarPautas() {
      try {
        const response = await axios.get('http://localhost:8000/api/pautas')
        this.pautas = response.data
      } catch (error) {
        console.error('Erro ao carregar pautas:', error)
      }
    },
    // Abre o modal para criar uma nova pauta
    abrirModalCriarPauta() {
      this.modalAberto = true
    },
    // Fecha o modal
    fecharModal() {
      this.modalAberto = false
      this.novaPauta = { nome: '', descricao: '' }
    },
    // Cria uma nova pauta
    async criarPauta() {
      try {
        const response = await axios.post('http://localhost:8000/api/pautas', this.novaPauta)
        this.pautas.push(response.data) // Adiciona a nova pauta à lista
        this.fecharModal() // Fecha o modal
      } catch (error) {
        console.error('Erro ao criar pauta:', error)
      }
    },
    // Exclui uma pauta
    async excluirPauta(id) {
      try {
        await axios.delete(`http://localhost:8000/api/pautas/${id}`)
        this.pautas = this.pautas.filter((pauta) => pauta.id !== id) // Remove a pauta da lista
      } catch (error) {
        console.error('Erro ao excluir pauta:', error)
      }
    },
  },
}
</script>

<style scoped>
.pautas-container {
  padding: 20px;
}

.pautas-container h2 {
  font-size: 24px;
  margin-bottom: 10px;
}

.btn-criar-pauta {
  padding: 10px 20px;
  background: #3498db;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background 0.3s ease;
  margin-bottom: 20px;
}

.btn-criar-pauta:hover {
  background: #2980b9;
}

.lista-pautas {
  list-style-type: none;
  padding: 0;
}

.pauta-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 15px;
  margin-bottom: 10px;
  background: rgba(255, 255, 255, 0.1);
  border-radius: 8px;
  transition: background 0.3s ease;
}

.pauta-item:hover {
  background: rgba(255, 255, 255, 0.2);
}

.pauta-info h3 {
  margin: 0;
  font-size: 18px;
  color: #fff;
}

.pauta-info p {
  margin: 5px 0 0;
  color: rgba(255, 255, 255, 0.8);
}

.btn-excluir {
  padding: 5px 10px;
  background: #e74c3c;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background 0.3s ease;
}

.btn-excluir:hover {
  background: #c0392b;
}

.sem-pautas {
  color: rgba(255, 255, 255, 0.8);
}

/* Estilos do modal */
.modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}

.modal-conteudo {
  background: #2c3e50;
  padding: 20px;
  border-radius: 10px;
  width: 400px;
}

.modal-conteudo h3 {
  margin-top: 0;
}

.form-group {
  margin-bottom: 15px;
}

.form-group label {
  display: block;
  margin-bottom: 5px;
  color: rgba(255, 255, 255, 0.8);
}

.form-group input,
.form-group textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid rgba(255, 255, 255, 0.2);
  border-radius: 5px;
  background: rgba(255, 255, 255, 0.1);
  color: #fff;
}

.form-botoes {
  display: flex;
  justify-content: flex-end;
  gap: 10px;
}

.btn-cancelar {
  padding: 10px 20px;
  background: #e74c3c;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background 0.3s ease;
}

.btn-cancelar:hover {
  background: #c0392b;
}

.btn-salvar {
  padding: 10px 20px;
  background: #3498db;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background 0.3s ease;
}

.btn-salvar:hover {
  background: #2980b9;
}
</style>
