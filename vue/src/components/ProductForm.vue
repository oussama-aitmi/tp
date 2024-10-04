<template>
  <div>
    <h2>{{ editMode ? 'Modifier le Produit' : 'Ajouter un Produit' }}</h2>
    <form @submit.prevent="submitForm">
      <input v-model="product.name" placeholder="Nom du produit" required />
      <input v-model="product.description" placeholder="Description" required />
      <input type="number" v-model="product.price" placeholder="Prix" required />
      <input type="number" v-model="product.quantity" placeholder="Quantité" required />
      <button type="submit">{{ editMode ? 'Modifier' : 'Ajouter' }}</button>
    </form>
  </div>
</template>

<script>
import api from '@/api';

export default {
  props: ['editMode', 'product'],
  methods: {
    submitForm() {
      if (this.editMode) {
        api.updateProduct(this.product.id, this.product).then(() => {
          alert("Produit modifié avec succès !");
          this.$emit('submit', this.product);
        }).catch(error => {
          console.error("Erreur lors de la modification du produit:", error);
        });
      } else {
        api.createProduct(this.product).then(() => {
          alert("Produit ajouté avec succès !");
          this.$emit('submit', this.product);
        }).catch(error => {
          console.error("Erreur lors de l'ajout du produit:", error);
        });
      }
    }
  }
}
</script>
