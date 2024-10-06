<!--<template>-->
<!--  <div>-->
<!--    <h2>Liste des Produits</h2>-->
<!--    <div v-for="product in products" :key="product.id" class="product-item">-->
<!--      <h3>{{ product.name }}</h3>-->
<!--      <p>{{ product.description }}</p>-->
<!--      <p>Prix: {{ product.price }} €</p>-->
<!--      <p>Quantité: {{ product.quantity }}</p>-->
<!--      <p>Quantité: {{ product.quantity }}</p>-->
<!--      <p>Quantité: {{ product.quantity }}</p>-->
<!--      <p>Quantité: {{ product.quantity }}</p>-->
<!--      <p>Quantité: {{ product.quantity }}</p>-->
<!--    </div>-->
<!--  </div>-->
<!--</template>-->

<template>
  <div>
    <h1>Liste des produits</h1>
    <div>
      <table>
        <thead>
        <tr>
          <th>ID</th>
          <th>Code</th>
          <th>Nom</th>
          <th>description</th>
          <th>Prix</th>
          <th>Quantité</th>
          <th>InternalReference</th>
          <th>Shell Id</th>
          <th>Status d'inventaire</th>
          <th >Action</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="produit in products" :key="produit.id">
          <td>{{ produit.id }}</td>
          <td>{{ produit.code }}</td>
          <td>{{ produit.name }}</td>
          <td>{{ produit.description }}</td>
          <td>{{ produit.price }} Dh</td>
          <td  style="padding-left: 10px;">{{ produit.quantity }}</td>
          <td  style="padding-left: 10px;">{{ produit.internalReference }}</td>
          <td  style="padding-left: 10px;">{{ produit.shellId }}</td>
          <td>{{ produit.inventoryStatus}}</td>
          <td style="padding-left: 15px;">
            <button @click="addToCart(produit)">Ajouter au panier</button>
            <button @click="editProduct(produit)">Modifier</button>
          </td>
        </tr>
        </tbody>
      </table>
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
    editProduct(produit) {
      this.$emit('edit-product', produit);
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
