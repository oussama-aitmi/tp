<template>
  <div id="app">
    <div class="navigation">
      <button @click="currentView = 'list'">Liste des produits</button>
      <button @click="currentView = 'form'">Ajouter un produit</button>
    </div>
    <ProductForm :produit="produit" v-if="currentView === 'form'"/>

    <ProduitList
        v-else-if="currentView === 'list'"
        @edit-product="handleEditProduct"
    />
    <Cart :cartItems="cartItems" />
  </div>
</template>

<script>
import api from '@/api';
import ProduitList from './components/ProductList.vue';
import ProductForm from './components/ProductForm.vue';

export default {
  data() {
    return {
      produit: null,
      cartItems: [],
      editMode: false,
      selectedProduct: null,
      currentView: 'list',
    };
  },
  methods: {
    fetchProducts() {
      api.getProducts().then(response => {
        this.products = response.data;
      });
    },
    // fetchCart() {
    //   api.getCart().then(response => {
    //     this.cartItems = response.data.items;
    //   });
    // },
    // handleAddToCart(product) {
    //   api.addToCart(product.id, 1).then(() => {
    //     this.fetchCart();
    //   });
    // },
    handleEditProduct(product) {
      this.selectedProduct = product;
      this.produit = product;
      this.currentView = 'form';
      this.showForm = true;
    },
  },
  mounted() {
    this.fetchProducts();
    this.fetchCart();
  },
  components: {
    ProduitList,
    ProductForm
  },
}
</script>
