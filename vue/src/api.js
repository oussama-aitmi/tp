// src/api.js
import axios from 'axios';

const apiClient = axios.create({
    baseURL: 'http://localhost:8000/api',
    headers: {
        'Content-Type': 'application/json',
    },
});

export default {
    // Récupérer tous les produits
    getProducts() {
        return apiClient.get('/produits');
    },
    // Créer un nouveau produit
    createProduct(product) {
        return apiClient.post('/produits', product);
    },
    // Mettre à jour un produit
    updateProduct(id, product) {
        return apiClient.put(`/produits/${id}`, product);
    },
    // Ajouter un produit au panier
    addToCart(productId, quantity) {
        return apiClient.post('/paniers', { productId, quantity });
    },
    // Récupérer le panier
    getCart() {
        return apiClient.get('/paniers/current');
    }
};
