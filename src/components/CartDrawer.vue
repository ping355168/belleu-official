<template>
    <div class="cart-drawer" v-if="visible">
        <div class="drawer-header">
            <h3>🛒 購物車</h3>
            <button class="close-btn" @click="close">✕</button>
        </div>

        <ul class="cart-list">
            <li v-for="item in items" :key="item.id" class="cart-item">
                <img :src="item.image" alt="商品圖片" class="item-image" />
                <div class="item-info">
                    <h4>{{ item.name }}</h4>
                    <p>數量：{{ item.quantity }}</p>

                    <!-- 尺寸 -->
                    <label>
                        尺寸：
                        <select v-model="item.selectedSize">
                            <option disabled value="">請選擇</option>
                            <option v-for="size in item.sizes" :key="size">{{ size }}</option>
                        </select>
                    </label>

                    <!-- 顏色 -->
                    <label>
                        顏色：
                        <select v-model="item.selectedColor">
                            <option disabled value="">請選擇</option>
                            <option v-for="color in item.colors" :key="color.color_name">
                                {{ color.color_name }}
                            </option>
                        </select>
                    </label>

                    <button class="remove-btn" @click="removeItem(index)">移除</button>
                </div>
            </li>
        </ul>
        <button class="clear-btn" @click="clearCart">清空購物車</button>
        <router-link to="/order">
            <button class="checkout-btn">前往結帳</button>
        </router-link>
    </div>
</template>

<script setup>
import { computed, watch } from 'vue'
import { useCartStore } from '@/stores/cartStore'
import Swal from 'sweetalert2'

const props = defineProps({ visible: Boolean })
const emit = defineEmits(['close'])

const close = () => emit('close')

const cart = useCartStore()
const items = computed(() => cart.items)

const removeItem = (index) => {
    cart.removeItem(index)
}

const clearCart = async () => {
    const result = await Swal.fire({
        title: '確定要清空購物車嗎？',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '清空',
        cancelButtonText: '取消',
        confirmButtonColor: '#e57c7c'
    })

    if (result.isConfirmed) {
        cart.clear()
        Swal.fire('已清空', '你的購物車已被清空', 'success')
    }
}

watch(items, () => {
    cart.save()
}, { deep: true })
const saveCart = () => {
    cart.save()
}

</script>

<style scoped>
.cart-drawer {
    position: fixed;
    right: 0;
    bottom: 0;
    width: 360px;
    height: 80vh;
    background-color: #fff;
    box-shadow: -4px 0 16px rgba(0, 0, 0, 0.1);
    padding: 20px;
    z-index: 999;
    display: flex;
    flex-direction: column;
}

.drawer-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
}

.close-btn {
    background: none;
    border: none;
    font-size: 20px;
    cursor: pointer;
}

.cart-list {
    flex: 1;
    overflow-y: auto;
    padding: 0;
    list-style: none;
}

.cart-item {
    display: flex;
    gap: 12px;
    padding: 36px 24px;
    transition: background-color 0.3s ease;
    border-radius: 8px;
    padding: 12px;
    border-bottom: 1px solid #ddd;
}

.item-image {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 6px;
    background: #eee;
}

.item-info {
    flex: 1;
}

.item-info h4 {
    margin: 0 0 6px;
    font-size: 15px;
    color: #4B4237;
}

label {
    display: block;
    font-size: 13px;
    margin-top: 6px;
}

select {
    width: 50%;
    box-sizing: border-box;
    padding: 4px;
    margin-top: 2px;
    border-radius: 6px;
    border: 1px solid #ccc;
}

.checkout-btn {
    width: 100%;
    padding: 12px;
    background-color: #E5AAA3;
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    font-size: 16px;
    cursor: pointer;
    margin-top: 16px;
}

.remove-btn {
    background-color: #f8d7da;
    color: #721c24;
    border: none;
    padding: 6px 12px;
    margin-top: 10px;
    border-radius: 6px;
    font-size: 13px;
    cursor: pointer;
}

.remove-btn:hover {
    background-color: #f5c6cb;
}

.cart-item:hover {
    background-color: #fef7f6;
}

.clear-btn {
    padding: 12px;
    background-color: #ddd;
    color: #333;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    font-size: 15px;
    cursor: pointer;
    margin-top: 8px;
}

.clear-btn:hover {
    background-color: #ccc;
}
</style>