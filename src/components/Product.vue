<template>
  <!-- 商品存在時才渲染 -->
  <section v-if="product" class="product-detail">

    <!-- 商品圖片區 -->
    <div class="product-detail__images">
      <!-- 主圖片 -->
      <img :src="currentImage" :alt="product.name" class="main-image" />

      <!-- 縮圖切換區 -->
      <div class="thumbnail-group">
        <img v-for="img in product.images" :key="img.image_url" :src="img.image_url" class="thumbnail"
          :class="{ active: currentImage === img.image_url }" @click="currentImage = img.image_url" />
      </div>
    </div>

    <!-- 商品資訊區 -->
    <div class="product-detail__info">
      <h1>{{ product.name }}</h1>
      <p class="product-price">NT${{ product.price }}</p>
      <p>{{ product.description }}</p>

      <!-- 尺寸選擇 -->
      <div class="options">
        <label>尺寸：</label>
        <select v-model="selectedSize">
          <option v-for="size in product.sizes" :key="size">{{ size }}</option>
        </select>
      </div>

      <!-- 顏色選擇 -->
      <div class="options">
        <label>顏色：</label>
        <select v-model="selectedColor">
          <option v-for="color in product.colors" :key="color">{{ color.color_name }}</option>
        </select>
      </div>

      <!-- 加入購物車按鈕 -->
      <button class="add-to-cart" @click="addToCart">加入購物車</button>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import axios from 'axios'
import { useCartStore } from '@/stores/cartStore'
import Swal from 'sweetalert2'

const cart = useCartStore()

const route = useRoute()
const product = ref(null)
const currentImage = ref('')
const selectedSize = ref('')
const selectedColor = ref('')

onMounted(async () => {
  const productId = route.params.id
  const res = await axios.get(`http://localhost/belleu/api/getProduct.php?id=${productId}`)
  product.value = res.data

  // 設定初始圖、尺寸與顏色. 

  currentImage.value = product.value.images.find(img => img.is_main)?.image_url || product.value.images[0].image_url
  selectedSize.value = product.value.sizes[0] || ''
  selectedColor.value = product.value.colors[0]?.color_name || ''
})

const addToCart = () => {
  const item = {
    id: product.value.id,
    name: product.value.name,
    image: currentImage.value,
    price: product.value.price,
    quantity: 1,
    sizes: product.value.sizes || [],
    colors: product.value.colors || [],
    selectedSize: selectedSize.value,
    selectedColor: selectedColor.value
  }

  console.log('🧾 加入購物車資料：', item) // ← 加這行！
  cart.addItem(item)
  cart.save() 

  Swal.fire({
    icon: 'success',
    title: '已加入購物車',
    text: `${item.name}（${item.selectedSize} / ${item.selectedColor}）`,
    timer: 1500,
    showConfirmButton: false
  })
}
</script>


<style scoped>
.product-detail {
  display: flex;
  gap: 60px;
  padding: 80px 150px;
  background-color: white;
  flex-wrap: wrap;
}

.product-detail__images {
  flex: 0.8;
  min-width: 300px;
}

.main-image {
  width: 100%;
  border-radius: 12px;
  margin-bottom: 16px;
  object-fit: cover;
  transition: all 0.3s ease;
}

.thumbnail-group {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 10px;
}

.thumbnail {
  width: 100%;
  aspect-ratio: 1 / 1;
  object-fit: cover;
  border-radius: 6px;
  border: 2px solid transparent;
  cursor: pointer;
  transition: border 0.2s ease;
}

.thumbnail:hover {
  border-color: #E5AAA3;
}

.thumbnail.active {
  border-color: #E57C7C;
}

.product-detail__info {
  flex: 1;
  min-width: 300px;
  display: flex;
  flex-direction: column;
  gap: 20px;
  padding: 200px 50px;
}

.product-name {
  font-size: 24px;
  font-weight: bold;
  color: #4B4237;
}

.product-price {
  font-size: 20px;
  color: #E57C7C;
  font-weight: bold;
}

.product-description {
  line-height: 1.6;
  font-size: 16px;
  color: #4B4237;
}

.options select {
  padding: 8px;
  border-radius: 4px;
  border: 1px solid #aaa;
}

.add-to-cart {
  margin-top: 16px;
  background-color: #E5AAA3;
  color: white;
  padding: 10px 20px;
  border-radius: 8px;
  font-weight: 600;
  border: none;
  cursor: pointer;
}

.add-to-cart:hover {
  background-color: #d28d89;
}

@media (max-width: 768px) {
  .product-detail {
    flex-direction: column;
    padding: 40px 24px;
  }
}
</style>
