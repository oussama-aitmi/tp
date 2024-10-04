<template>
  <div id="app">
    <ProductForm
        v-if="showForm"
        :editMode="editMode"
        :product="selectedProduct"
        @submit="handleProductSubmit"
    />
    <ProductList
        v-else
        :products="products"
        @add-to-cart="handleAddToCart"
        @edit-product="handleEditProduct"
    />
    <Cart :cartItems="cartItems" />
  </div>
</template>

<script>
import api from '@/api';

export default {
  data() {
    return {
      products: [],
      cartItems: [],
      showForm: false,
      editMode: false,
      selectedProduct: null,
    };
  },
  methods: {
    fetchProducts() {
      api.getProducts().then(response => {
        this.products = response.data;
      });
    },
    fetchCart() {
      api.getCart().then(response => {
        this.cartItems = response.data.items;
      });
    },
    handleAddToCart(product) {
      api.addToCart(product.id, 1).then(() => {
        this.fetchCart();
      });
    },
    handleEditProduct(product) {
      this.selectedProduct = {...product};
      this.editMode = true;
      this.showForm = true;
    },
    handleProductSubmit(product) {
      this.fetchProducts();
      this.showForm = false;
      this.editMode = false;
      this.selectedProduct = null;
    }
  },
  mounted() {
    this.fetchProducts();
    this.fetchCart();
  }
}
</script>
