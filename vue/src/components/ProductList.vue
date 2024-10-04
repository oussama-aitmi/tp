<template>
  <div>
    <h2>Liste des Produits</h2>
    <div v-for="product in products" :key="product.id" class="product-item">
      <h3>{{ product.name }}</h3>
      <p>{{ product.description }}</p>
      <p>Prix: {{ product.price }} €</p>
      <p>Quantité: {{ product.quantity }}</p>
      <button @click="addToCart(product)">Ajouter au panier</button>
      <button @click="editProduct(product)">Modifier</button>
    </div>
  </div>
</template>

<script>
import api from '@/api';

export default {
  data() {
    return {
      products: [],
    };
  },
  methods: {
    fetchProducts() {
      api.getProducts().then(response => {
        this.products = response.data;
      }).catch(error => {
        console.error("Erreur lors de la récupération des produits:", error);
      });
    },
    addToCart(product) {
      api.addToCart(product.id, 1).then(() => {
        alert("Produit ajouté au panier");
      }).catch(error => {
        console.error("Erreur lors de l'ajout au panier:", error);
      });
    },
    editProduct(product) {
      this.$emit('edit-product', product);
    }
  },
  mounted() {
    this.fetchProducts();
  }
}
</script>

<style scoped>
.product-item {
  border: 1px solid #ccc;
  padding: 10px;
  margin-bottom: 10px;
}
</style>
