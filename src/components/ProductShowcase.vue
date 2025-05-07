<template>
    <main>
        <section>
            <!-- 區塊標題 -->
            <header>
                <h2>Belleu比露為您推薦</h2>
                <p>我們為你精選的新品！⛱️</p>
            </header>

            <!-- 商品列表（含最小高度控制） -->
            <ul class="product-list" :style="{ minHeight: minHeight + 'px' }">
                <li v-for="item in paginatedProducts" :key="item.id">
                    <!-- 單一商品卡片元件 -->
                    <ProductCard :product="item" />
                </li>
            </ul>

            <!-- 分頁按鈕 -->
            <div class="pagination">
                <button @click="goPrev" :disabled="currentPage === 1">上一頁</button>
                <span>第 {{ currentPage }} / {{ totalPages }} 頁</span>
                <button @click="goNext" :disabled="currentPage === totalPages">下一頁</button>
            </div>
        </section>
    </main>


</template>


<script setup>
// 匯入需要的函式與元件
import { ref, computed, onMounted, onUnmounted } from 'vue'
import axios from 'axios'
import ProductCard from '@/components/ProductCard.vue'

// 商品資料、目前頁數與畫面最小高度
const products = ref([])
const currentPage = ref(1)
const pageSize = 10
const minHeight = ref(0)

// 計算總頁數
const totalPages = computed(() =>
    Math.ceil(products.value.length / pageSize)
)

// 根據目前頁數取得當頁商品資料
const paginatedProducts = computed(() => {
    const start = (currentPage.value - 1) * pageSize
    return products.value.slice(start, start + pageSize)
})

// 前一頁按鈕邏輯
const goPrev = () => {
    if (currentPage.value > 1) currentPage.value--
}

// 下一頁按鈕邏輯
const goNext = () => {
    if (currentPage.value < totalPages.value) currentPage.value++
}

// 根據商品卡片高度，動態設定最小容器高度
function updateHeight() {
    const card = document.querySelector('.product-card')
    if (card) {
        minHeight.value = Math.max(card.offsetHeight * 2 + 25, 800)
    }
}

// 畫面初始化時載入商品資料與設定 resize 事件
onMounted(async () => {
    try {
        const res = await axios.get('http://localhost/belleu/api/getProducts.php')
        console.log('🔥 products:', typeof res.data, res.data)
        products.value = res.data
        updateHeight()
        setTimeout(updateHeight, 100) // 等待圖片載入再更新高度
    } catch (err) {
        console.error('❌ 錯誤：無法取得產品資料', err)
    }

    // 畫面大小改變時重新計算高度
    window.addEventListener('resize', updateHeight)
})

// 離開頁面時移除事件監聽
onUnmounted(() => {
    window.removeEventListener('resize', updateHeight)
})
</script>


<style scoped>
/* 整體頁面主區塊的內距與文字顏色 */
main {
    padding: 60px 150px;
    /* 上下 60px、左右 150px 的內距 */
    color: #736B60;
    /* 頁面主文字色調（柔和棕） */
}

/* 標題樣式 */
h2 {
    text-align: center;
    /* 置中對齊 */
    font-weight: bold;
    /* 粗體 */
    font-size: 20px;
    /* 字體大小 */
}

/* 副標題（段落）樣式 */
p {
    text-align: center;
    /* 置中對齊 */
    font-size: 16px;
    /* 字體大小 */
}

/* 商品清單樣式：使用 5 欄 Grid 排版 */
.product-list {
    display: grid;
    /* 使用 CSS Grid */
    grid-template-columns: repeat(5, 1fr);
    /* 每列 5 欄，平均寬度 */
    gap: 24px;
    /* 欄與欄之間的間距 */
}

/* 每個 section 區塊垂直排列，元件之間保留間距 */
section {
    display: flex;
    /* 使用 Flexbox 垂直排列內容 */
    flex-direction: column;
    gap: 30px;
    /* 區塊間距 */
}

/* 分頁容器：置中排列按鈕與頁數 */
.pagination {
    display: flex;
    /* 使用 Flexbox 水平排列 */
    justify-content: center;
    /* 水平置中 */
    align-items: center;
    /* 垂直置中 */
    gap: 16px;
    /* 按鈕與文字間距 */
    margin-top: 24px;
    /* 與上方列表的間距 */
}

/* 分頁按鈕樣式 */
.pagination button {
    background-color: #E5AAA3;
    /* 按鈕背景色（品牌感） */
    color: white;
    /* 字體顏色 */
    padding: 8px 16px;
    /* 內距（上下8px、左右16px） */
    border: none;
    /* 移除邊框 */
    border-radius: 6px;
    /* 圓角 */
    cursor: pointer;
    /* 滑鼠懸停變手型 */
    transition: 0.3s;
    /* 動畫效果 */
}

/* 當按鈕被禁用時的樣式 */
.pagination button[disabled] {
    opacity: 0.5;
    /* 半透明 */
    cursor: not-allowed;
    /* 滑鼠變成禁止符號 */
}
</style>
