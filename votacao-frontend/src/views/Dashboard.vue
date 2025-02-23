<template>
  <div class="dashboard-container">
    <h1>Dashboard</h1>
    <p v-if="usuario">Bem-vindo, {{ users.nome }}!</p>
    <nav class="tab-nav">
      <router-link to="/dashboard/pautas" class="tab-link">Pautas</router-link>
      <router-link to="/dashboard/sessoes" class="tab-link">Sessões</router-link>
      <router-link to="/dashboard/votos" class="tab-link">Votos</router-link>
    </nav>
    <div class="tab-content">
      <router-view />
    </div>
  </div>
</template>

<script>
export default {
  name: 'DashboardView',
}
</script>

<style scoped>
.dashboard-container {
  max-width: 1200px;
  margin: 20px auto;
  padding: 20px;
  background: linear-gradient(135deg, #2c3e50, #34495e); /* Gradiente azul escuro */
  border-radius: 15px;
  color: #ffffff; /* Texto branco para contraste */
}

h1 {
  font-size: 28px;
  margin-bottom: 20px;
  text-align: center;
}

.tab-nav {
  display: flex;
  justify-content: center;
  margin-bottom: 20px;
  border-bottom: 2px solid rgba(255, 255, 255, 0.1); /* Borda sutil */
}

.tab-link {
  padding: 10px 20px;
  margin: 0 10px;
  font-size: 18px;
  color: rgba(255, 255, 255, 0.7); /* Texto branco semi-transparente */
  text-decoration: none;
  border-radius: 8px 8px 0 0;
  transition: all 0.3s ease;
}

.tab-link:hover {
  background: rgba(255, 255, 255, 0.1); /* Fundo semi-transparente ao passar o mouse */
  color: #ffffff; /* Texto branco */
}

.tab-link.router-link-exact-active {
  color: #ffffff; /* Texto branco */
  border-bottom: 3px solid #3498db; /* Azul claro para aba ativa */
  font-weight: bold;
}

.tab-content {
  padding: 20px;
  background: rgba(255, 255, 255, 0.1); /* Fundo semi-transparente */
  border-radius: 8px;
}
</style>
