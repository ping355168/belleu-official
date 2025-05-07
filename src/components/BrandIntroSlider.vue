<template>
    <!-- 品牌簡介區 -->
    <section class="brand-intro">

        <!-- 區塊標題與描述 -->
        <header>
            <h2>什麼是Belleu？</h2>
            <p>我們希望成為你最溫暖的購物夥伴。</p>
        </header>

        <!-- Swiper 輪播區 -->
        <div class="slider-wrapper">

            <!-- 左右滑動按鈕 -->
            <div class="button-group">
                <div @click="slidePrev" class="swiper-button-prev"></div>
                <div @click="slideNext" class="swiper-button-next"></div>
            </div>

            <!-- Swiper 主體設定 -->
            <swiper ref="mySwiper" @swiper="onSwiperInit" :loop="true" :spaceBetween="20" :breakpoints="{
                0: { slidesPerView: 1 },
                640: { slidesPerView: 2 },
                1024: { slidesPerView: 4 }
            }">

                <!-- 每個 slide 對應一張圖片與標語 -->
                <swiper-slide>
                    <img src="/image/speicial_event_1.jpg" alt="" class="swiper">
                    <h6>因為好看所以1+1🖤</h6>
                </swiper-slide>
                <swiper-slide>
                    <img src="/image/speicial_event_2.jpg" alt="" class="swiper">
                    <h6>這個夏天，我們陪你一起閃✨</h6>
                </swiper-slide>
                <swiper-slide>
                    <img src="/image/speicial_event_3.jpg" alt="" class="swiper">
                    <h6>今晚下單，明早送達！#今夏最速穿搭</h6>
                </swiper-slide>
                <swiper-slide>
                    <img src="/image/speicial_event_4.jpg" alt="" class="swiper">
                    <h6>今夏女孩必備！穿上就出片☀️</h6>
                </swiper-slide>
                <swiper-slide>
                    <img src="/image/speicial_event_5.jpg" alt="" class="swiper">
                    <h6>自拍活動開跑中！你的美，值得上牆💫</h6>
                </swiper-slide>
                <swiper-slide>
                    <img src="/image/speicial_event_6.jpg" alt="" class="swiper">
                    <h6>這個夏天，穿出你的主角光芒🌿</h6>
                </swiper-slide>
                <swiper-slide>
                    <img src="/image/speicial_event_7.jpg" alt="" class="swiper">
                    <h6>拍出今夏最美OOTD🎁</h6>
                </swiper-slide>
                <swiper-slide>
                    <img src="/image/speicial_event_8.jpg" alt="" class="swiper">
                    <h6>從早到晚都好看—夏日穿搭急速送達🚚</h6>
                </swiper-slide>
                <swiper-slide>
                    <img src="/image/speicial_event_9.jpg" alt="" class="swiper">
                    <h6>出門就到貨！夏日穿搭0等待💙</h6>
                </swiper-slide>
                <swiper-slide>
                    <img src="/image/speicial_event_10.jpg" alt="" class="swiper">
                    <h6>你+夏天+自拍=滿分女主角感🌈</h6>
                </swiper-slide>
            </swiper>
        </div>
    </section>
</template>

<script setup>
// 匯入必要功能
import { ref, onMounted, onBeforeUnmount } from 'vue'
import { Swiper, SwiperSlide } from 'swiper/vue'
import 'swiper/css'

// 儲存 Swiper 實體
const mySwiper = ref(null)

// 初始化時取得 Swiper 實體
const onSwiperInit = (swiperInstance) => {
    mySwiper.value = swiperInstance
}

// 左右切換控制函式
const slidePrev = () => {
    mySwiper.value.slidePrev()
}
const slideNext = () => {
    mySwiper.value.slideNext()
}

// 畫面尺寸改變時更新 Swiper
const updateSwiperOnResize = () => {
    if (mySwiper.value) {
        mySwiper.value.update()
    }
}

// 掛載與移除 resize 事件
onMounted(() => {
    window.addEventListener('resize', updateSwiperOnResize)
})
onBeforeUnmount(() => {
    window.removeEventListener('resize', updateSwiperOnResize)
})
</script>


<style scoped>
.brand-intro {
    color: #736B60;
    display: flex;
    flex-direction: column;
    gap: 40px;
    background-color: #F6F4EE;
    padding: 100px 150px;
    box-sizing: border-box;
    overflow: hidden;
}

header {
    display: flex;
    flex-direction: column;
}

h2 {
    text-align: center;
    font-size: 20px;
    font-weight: bold;
}

p {
    text-align: center;
    font-size: 16px;
}

.swiper {
    width: 100%;
}

.slider-wrapper {
    position: relative;
    max-width: 1200px;
    width: 100%;
    margin: 0 auto;
}

::v-deep(.swiper-button-prev) {
    left: -50px;
    color: #4B4237;

}

::v-deep(.swiper-button-next) {
    right: -50px;
    color: #4B4237;
}

h6 {
    font-size: 16px;
}
</style>