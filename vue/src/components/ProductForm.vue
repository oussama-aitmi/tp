<template>
  <div style="width: 50%; margin: 0 auto">
    <h2>{{ isEditMode ? 'Modifier le produit' : 'Ajouter un nouveau produit' }}</h2>

    <div v-if="showForm">
    <form @submit.prevent="submitProduit">
      <div class="form-group">
        <label for="code">Code</label>
        <input v-model="produit.code" type="text" id="code" required />
      </div>

      <div class="form-group">
        <label for="name">Nom</label>
        <input v-model="produit.name" type="text" id="name" required />
      </div>

      <!-- Champ Description -->
      <div class="form-group">
        <label for="description">Description</label>
        <textarea v-model="produit.description" id="description" required></textarea>
      </div>

      <div class="form-group">
        <label for="image">Image (URL)</label>
        <input v-model="produit.image" type="text" id="image" required />
      </div>

      <div class="form-group">
        <label for="category">Catégorie</label>
        <input v-model="produit.category" type="text" id="category" required />
      </div>

      <div class="form-group">
        <label for="price">Prix</label>
        <input v-model="produit.price" type="number" id="price" step="0.01" required />
      </div>

      <div class="form-group">
        <label for="quantity">Quantité</label>
        <input v-model="produit.quantity" type="number" id="quantity" required />
      </div>

      <div class="form-group">
        <label for="internalReference">Référence interne</label>
        <input v-model="produit.internalReference" type="text" id="internalReference" required />
      </div>

      <div class="form-group">
        <label for="shellId">Shell ID</label>
        <input v-model="produit.shellId" type="number" id="shellId" required />
      </div>

      <div class="form-group">
        <label for="inventoryStatus">Statut d'inventaire</label>
        <select v-model="produit.inventoryStatus" id="inventoryStatus" multiple required>
          <option value="INSTOCK">En stock</option>
          <option value="LOWSTOCK">Stock faible</option>
          <option value="OUTOFSTOCK">Rupture de stock</option>
        </select>
      </div>

      <div class="form-group">
        <label for="rating">Évaluation</label>
        <input v-model="produit.rating" type="number" id="rating" step="0.1" min="0" max="5" />
      </div>

      <button type="submit">Ajouter le produit</button>
    </form>
  </div>

    <div v-if="message" class="message">{{ message }}</div>
    <div v-if="error" class="error">{{ error }}</div>
  </div>
</template>

<script>
import api from '@/api';

export default {
  data() {
    return {
      produit: {
        code:  '',
        name: '',
        description: '',
        image: '',
        category: '',
        price: null,
        quantity: null,
        internalReference: '',
        shellId: null,
        inventoryStatus: [], // Multiple choices
        rating: null
      },
      message: null,
      error: null,
      showForm: true,
      formData: { ...this.produit },
    };
  },
  computed: {
    // Si un ID de produit existe, on est en mode modification
    isEditMode() {
      console.log(this.produit)
      return !!this.produit.id;
    }
  },
  methods: {
    submitProduit() {
      api.createProduct(this.produit).then(() => {
        this.message = 'Produit ajouté avec succès !';
        this.error = null;
        this.$emit('submit');
        this.resetForm();
        this.showForm = false;
      }).catch(error => {
        this.error = 'Erreur lors de l\'ajout du produit.';
        this.message = null;
        console.error("Erreur lors de l'ajout du produit:", error);
        this.showForm = false;
      });
    },
    resetForm() {
      // this.produit = {
      //   code: '',
      //   name: '',
      //   description: '',
      //   image: '',
      //   category: '',
      //   price: null,
      //   quantity: null,
      //   internalReference: '',
      //   shellId: null,
      //   inventoryStatus: [],
      //   rating: null
      // };
    }
  }
};
</script>

<style scoped>
/* Style du formulaire */
.form-group {
  margin-bottom: 15px;
}

label {
  display: block;
  margin-bottom: 5px;
}

input,
textarea,
select {
  width: 100%;
  padding: 8px;
  margin-bottom: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

button {
  padding: 10px 15px;
  background-color: #4CAF50;
  color: white;
  border: none;
  cursor: pointer;
}

button:hover {
  background-color: #45a049;
}

.message {
  color: green;
}

.error {
  color: red;
}
</style>
