<template>
    <main>
        <section>
            <header>
                <h2>Belleu比露為您推薦</h2>
                <p>我們為你精選的新品！⛱️</p>
            </header>

            <ul class="product-list" :style="{ minHeight: minHeight + 'px' }">
                <li v-for="item in paginatedProducts" :key="item.id">
                    <ProductCard :product="item" />
                </li>
            </ul>

            <div class="pagination">
                <button @click="goPrev" :disabled="currentPage === 1">上一頁</button>
                <span>第 {{ currentPage }} / {{ totalPages }} 頁</span>
                <button @click="goNext" :disabled="currentPage === totalPages">下一頁</button>
            </div>
        </section>
    </main>
</template>


<script setup>
import { ref, computed, onMounted , onUnmounted   } from 'vue'
import ProductCard from '@/components/ProductCard.vue'

const products = ref([
    { id: 1, name: '今夏新品襯衫', price: 890, image: '/image/product1-1.jpg', hoverImage: '/image/product1-2.jpg' },
    { id: 2, name: '今夏新品襯衫', price: 890, image: '/image/product2-1.jpg', hoverImage: '/image/product2-2.jpg' },
    { id: 3, name: '今夏新品襯衫', price: 890, image: '/image/product3-1.jpg', hoverImage: '/image/product3-2.jpg' },
    { id: 4, name: '今夏新品襯衫', price: 890, image: '/image/product4-1.jpg', hoverImage: '/image/product4-2.jpg' },
    { id: 5, name: '今夏新品襯衫', price: 890, image: '/image/product5-1.jpg', hoverImage: '/image/product5-2.jpg' },
    { id: 6, name: '今夏新品襯衫', price: 890, image: '/image/product6-1.jpg', hoverImage: '/image/product6-2.jpg' },
    { id: 7, name: '今夏新品襯衫', price: 890, image: '/image/product7-1.jpg', hoverImage: '/image/product7-2.jpg' },
    { id: 8, name: '今夏新品襯衫', price: 890, image: '/image/product8-1.jpg', hoverImage: '/image/product8-2.jpg' },
    { id: 9, name: '今夏新品襯衫', price: 890, image: '/image/product9-1.jpg', hoverImage: '/image/product9-2.jpg' },
    { id: 10, name: '今夏新品襯衫', price: 890, image: '/image/product10-1.jpg', hoverImage: '/image/product10-2.jpg' },
    { id: 11, name: '今夏新品襯衫', price: 890, image: '/image/product11-1.jpg', hoverImage: '/image/product11-2.jpg' },
    { id: 12, name: '今夏新品襯衫', price: 890, image: '/image/product12-1.jpg', hoverImage: '/image/product12-2.jpg' },
])

const currentPage = ref(1)
const pageSize = 10
const minHeight = ref(0)
const totalPages = computed(() =>
    Math.ceil(products.value.length / pageSize)
)

const paginatedProducts = computed(() => {
    const start = (currentPage.value - 1) * pageSize
    return products.value.slice(start, start + pageSize)
})

const goPrev = () => {
    if (currentPage.value > 1) currentPage.value--
}

const goNext = () => {
    if (currentPage.value < totalPages.value) currentPage.value++
}


function updateHeight() {
  const card = document.querySelector('.product-card')
  if (card) {
    minHeight.value = Math.max(card.offsetHeight * 2 + 25, 800)
  }
}

onMounted(() => {
  updateHeight()
  window.addEventListener('resize', updateHeight)
  setTimeout(updateHeight, 100) // 防圖片影響
})

onUnmounted(() => {
  window.removeEventListener('resize', updateHeight)
})
</script>


<style scoped>
main {
    padding: 60px 150px;
    color: #736B60;
}

h2 {
    text-align: center;
    font-weight: bold;
    font-size: 20px;
}

p {
    text-align: center;
    font-size: 16px;
}

.product-list {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 24px;
}

section {
    display: flex;
    flex-direction: column;
    gap: 30px;
}

.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 16px;
    margin-top: 24px;
}

.pagination button {
    background-color: #E5AAA3;
    color: white;
    padding: 8px 16px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.3s;
}

.pagination button[disabled] {
    opacity: 0.5;
    cursor: not-allowed;
}
</style>