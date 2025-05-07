<template>
    <!-- Swiper 輪播主體 -->
    <swiper :slidesPerView="1" :spaceBetween="0" :centeredSlides="true" :autoplay="{
        delay: 5000,
        disableOnInteraction: false
    }" :loop="true" :pagination="{ clickable: true }" :navigation="true" :modules="modules" class="mySwiper">
        <!-- 每張幻燈片圖片 -->
        <swiper-slide><img src="/image/swiper-1.png" alt="swiper-1" class="swiper" /></swiper-slide>
        <swiper-slide><img src="/image/swiper-2.png" alt="swiper-2" class="swiper" /></swiper-slide>
        <swiper-slide><img src="/image/swiper-3.png" alt="swiper-3" class="swiper" /></swiper-slide>
        <swiper-slide><img src="/image/swiper-4.png" alt="swiper-4" class="swiper" /></swiper-slide>
    </swiper>
</template>

<script setup>
// 匯入 Swiper 元件
import { Swiper, SwiperSlide } from 'swiper/vue'

// 匯入必要樣式
import 'swiper/css'
import 'swiper/css/pagination'
import 'swiper/css/navigation'

// 匯入需要的功能模組（自動播放、分頁、導覽箭頭）
import { Autoplay, Pagination, Navigation } from 'swiper/modules'

// 定義啟用的模組
const modules = [Autoplay, Pagination, Navigation]
</script>


<style scoped>
.swiper {
    width: 100%;
}

/* 漂浮箭頭往外一點點 */
::v-deep(.swiper-button-prev) {
    left: 50px;
    color: white;
}

.mySwiper {
    background-color: black;
}

::v-deep(.swiper-button-next) {
    right: 50px;
    color: white;
}

.swiper-slide-prev {
    opacity: 0.4;
}
</style>