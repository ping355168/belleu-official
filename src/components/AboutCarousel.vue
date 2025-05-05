<template>
    <article>
        <div class="title">
            <h1>什麼是Belleu？</h1>
            <p>我們希望成為螢幕彼岸的你 最溫暖的購物夥伴 <br>
                從日常需求的時尚單品，到讓您在重要時刻閃耀的精緻服裝，我們都將陪伴在你的身旁。</p>
        </div>

        <div class="swiper-box">
            <div class="button-group">
                <div @click="slidePrev" class="swiper-button-prev"></div>
                <div @click="slideNext" class="swiper-button-next"></div>
            </div>
            <swiper ref="mySwiper" @swiper="onSwiperInit" :loop="true" :spaceBetween="20" :breakpoints="{
                0: { slidesPerView: 1 },
                640: { slidesPerView: 2 },
                1024: { slidesPerView: 4 }
            }">
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
    </article>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue'
import { Swiper, SwiperSlide } from 'swiper/vue'
import 'swiper/css'

const mySwiper = ref(null)

const onSwiperInit = (swiperInstance) => {
    mySwiper.value = swiperInstance
}

const slidePrev = () => {
    mySwiper.value.slidePrev()
}

const slideNext = () => {
    mySwiper.value.slideNext()
}

const updateSwiperOnResize = () => {
    if (mySwiper.value) {
        mySwiper.value.update()
    }
}

onMounted(() => {
    window.addEventListener('resize', updateSwiperOnResize)
})

onBeforeUnmount(() => {
    window.removeEventListener('resize', updateSwiperOnResize)
})

</script>

<style scoped>
/* 整個區塊容器 */
article {
    color: #736B60;
    display: flex;
    /* 垂直排列子元素 */
    flex-direction: column;
    gap: 40px;
    /* 區塊之間的垂直間距 */
    background-color: #F6F4EE;
    /* 米白色背景 */
    padding: 100px 150px;
    /* 上下左右內距 */
    box-sizing: border-box;
    /* 包含 padding 在寬高內計算 */
    overflow: hidden;
    /* 隱藏溢出的內容（保險用） */
}

/* 標題區容器 */
.title {
    display: flex;
    /* 垂直排列 h1 和 p */
    flex-direction: column;
}

/* 主標題 */
h1 {
    text-align: center;
    /* 置中對齊 */
    font-size: 20px;
    /* 字體大小 */
    font-weight: bold;
    /* 粗體 */
}

/* 主標題下方的介紹文字 */
p {
    text-align: center;
    font-size: 16px;
}

/* Swiper 輪播圖片寬度設定 */
.swiper {
    width: 100%;
    /* 滿版寬度 */
}

.swiper-box {
    position: relative;
    max-width: 1200px;
    width: 100%;
    margin: 0 auto;
}

/* 漂浮箭頭往外一點點 */
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