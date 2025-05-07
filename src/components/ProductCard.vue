<template>
    <!-- 整張卡片是個連結，導向商品詳細頁 -->
    <router-link :to="`/product/${product.id}`" class="product-card-link">
        <div class="product-card" @mouseenter="isHover = true" @mouseleave="isHover = false">

            <!-- 商品圖片區（主圖／hover圖切換） -->
            <div class="image-wrapper">
                <img :src="isHover ? product.hoverImage : product.image" :alt="product.name" class="product-image" />
                <span class="product-cta">查看詳情</span>
            </div>

            <!-- 商品資訊 -->
            <h3 class="product-name">{{ product.name }}</h3>
            <p class="product-price">NT${{ product.price }}</p>

            <!-- 加入購物車按鈕，阻止跳頁 -->
            <button class="add-to-cart" @click.prevent.stop="addToCart">加入購物車</button>
        </div>
    </router-link>
</template>

<script setup>
import { ref } from 'vue'
import Swal from 'sweetalert2'
import { useCartStore } from '@/stores/cartStore' // ← 引入購物車 store

const isHover = ref(false)

const { product } = defineProps({
    product: {
        type: Object,
        required: true
    }
})

const cart = useCartStore() // ← 使用購物車 store

const addToCart = () => {
    const item = {
        id: product.id,
        name: product.name,
        image: product.image,
        price: product.price,
        sizes: product.sizes || [],
        colors: product.colors || [],
    }

    console.log('🛒 加入 Pinia 的商品資料：', item)  // ← 加在這！

    cart.addItem(item)

    Swal.fire({
        icon: 'success',
        title: '加入購物車成功！',
        text: `${product.name} 已加入購物車`,
        timer: 1500,
        showConfirmButton: false
    })
}

</script>


<style scoped>
.product-card {
    background: white;
    border: 1px solid #eee;
    border-radius: 12px;
    padding: 16px;
    text-align: center;
    transition: box-shadow 0.3s ease;
}

.image-wrapper {
    position: relative;
    overflow: hidden;
}

.product-card:hover {
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
}

.product-image {
    background-color: #4B4237;
    width: 100%;
    object-fit: cover;
    border-radius: 8px;
    margin-bottom: 12px;
}

.product-name {
    font-size: 18px;
    margin: 8px 0;
    color: #4B4237;
}

.product-price {
    font-weight: bold;
    color: #E57C7C;
    margin-bottom: 12px;
}

.add-to-cart {
    background-color: #E5AAA3;
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.add-to-cart:hover {
    background-color: #d9908e;
}

.product-card:hover {
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    background-color: #fff4f2;
    transform: translateY(-2px);
}

.product-card:hover img {
    filter: brightness(60%);
    transition: filter 0.3s ease;
}

/* CTA 預設不顯示 */
.product-cta {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: rgba(75, 66, 55, 0.9);
    color: #fff;
    padding: 8px 16px;
    border-radius: 6px;
    font-size: 14px;
    opacity: 0;
    white-space: nowrap;
    transition: opacity 0.3s ease;
    box-sizing: border-box;
}

/* hover 時浮出 CTA */
.image-wrapper:hover .product-cta {
    opacity: 1;
}

.product-card-link {
    text-decoration: none;
}
</style>