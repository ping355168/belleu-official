<template>
    <div>
        <div class="floating-cart" @click="showDrawer = true">
            🛒 <span class="count">{{ itemCount }}</span>
        </div>

        <div v-if="showDrawer" class="cart-backdrop" @click="closeDrawer"></div>

        <CartDrawer :visible="showDrawer" @close="closeDrawer" />
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { useCartStore } from '@/stores/cartStore'
import { computed } from 'vue'
import CartDrawer from './CartDrawer.vue'

const cart = useCartStore()
const showDrawer = ref(false)

const cartItems = computed(() => cart.items)
const itemCount = computed(() => cart.itemCount)

const closeDrawer = () => {
    showDrawer.value = false
}
</script>

<style scoped>
.floating-cart {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #E5AAA3;
    color: white;
    padding: 12px 16px;
    border-radius: 50px;
    font-weight: bold;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    transition: background-color 0.3s ease;
    z-index: 999;
}

.floating-cart:hover {
    background-color: #d88f88;
}

.count {
    margin-left: 8px;
}

.cart-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background-color: rgba(0, 0, 0, 0.2);
    z-index: 999;
}
</style>