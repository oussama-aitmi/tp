<template>
  <div>
    <h2>Panier</h2>
    <div v-for="item in cartItems" :key="item.id" class="cart-item">
      <h3>{{ item.name }}</h3>
      <p>Prix: {{ item.price }} €</p>
      <p>Quantité: {{ item.quantity }}</p>
    </div>
  </div>
</template>

<script>
import api from '@/api';

export default {
  data() {
    return {
      cartItems: [],
    };
  },
  methods: {
    fetchCart() {
      api.getCart().then(response => {
        this.cartItems = response.data.items;
      }).catch(error => {
        console.error("Erreur lors de la récupération du panier:", error);
      });
    }
  },
  mounted() {
    this.fetchCart();
  }
}
</script>

<style scoped>
.cart-item {
  border: 1px solid #ccc;
  padding: 10px;
  margin-bottom: 10px;
}
</style>
