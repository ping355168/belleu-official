<template>
    <main>
        <aside>
            <swiper :navigation="true" :modules="modules" class="mySwiper">
                <swiper-slide><img src="/image/item_1.jpg" alt="" class="swiper"></swiper-slide>
                <swiper-slide><img src="/image/item_2.jpg" alt="" class="swiper"></swiper-slide>
                <swiper-slide><img src="/image/item_3.jpg" alt="" class="swiper"></swiper-slide>
                <swiper-slide><img src="/image/item_4.jpg" alt="" class="swiper"></swiper-slide>
            </swiper>
        </aside>
        <article>
            <div class="left"></div>
            <div class="right">
                <h1>Kitsch學院風鈕扣A字百褶裙</h1>

                <form action="" method="get">
                    <label for="color"></label>
                    <div class="color-options">
                        <input type="radio" name="color" value="black" id="black">
                        <label for="black">
                            <div class="black"></div>
                        </label>

                        <input type="radio" name="color" value="brown" id="brown">
                        <label for="brown">
                            <div class="brown"></div>
                        </label>
                    </div>
                    <label for="size"></label>
                    <div class="size-options">
                        <input type="radio" name="size" value="S" id="S">
                        <label for="S">
                            <div class="S">
                                <p>S</p>
                            </div>
                        </label>
                        <input type="radio" name="size" value="M" id="M">
                        <label for="M">
                            <div class="M">
                                <p>M</p>
                            </div>
                        </label>
                        <input type="radio" name="size" value="L" id="L">
                        <label for="L">
                            <div class="L">
                                <p>L</p>
                            </div>
                        </label>
                    </div>
                    <label for="number"></label>
                    <div class="number_select">
                        <input type="number" name="number" id="number">
                    </div>
                </form>
            </div>
        </article>
    </main>
</template>

<script setup>
import { Swiper, SwiperSlide } from 'swiper/vue';

import 'swiper/css';

import 'swiper/css/navigation';

import { Navigation } from 'swiper/modules';
const modules = [Navigation]

</script>

<style scoped>
.left {
    width: 50vw;
}

.right {
    width: 50vw;
    padding: 60px 100px;
    box-sizing: border-box;
}

h1 {
    font-weight: bold;
}

aside {
    width: 50%;
    position: fixed;
}

article {
    display: flex;
    width: 100%;
}

.mySwiper {
    height: 100vh;
}

.swiper {
    width: 100%;
}

main {
    display: flex;
}

::v-deep(.swiper-button-prev) {
    left: 50px;
    color: #4B4237;

}

::v-deep(.swiper-button-next) {
    right: 50px;
    color: #4B4237;
}

.color-options {
    display: flex;
    gap: 10px;
}

.color-options input[type="radio"] {
    display: none;
}

.color-options label {
    padding: 3px;
    border: 1px solid white;
    cursor: pointer;
    user-select: none;
    transition: all 0.2s ease;
}

.color-options label div {
    width: 14px;
    height: 14px;
}

.color-options input[type="radio"]:checked+label {
    border: 1px solid black;
    color: #fff;
    border-color: #000;
}

.black {
    background-color: black;
}

.brown {

    background-color: rgb(91, 66, 48)
}


.size-options {
    display: flex;
    gap: 10px;
}

.size-options input[type="radio"] {
    display: none;
}

.size-options label {
    padding: 0px 10px;
    border: 1px solid white;
    cursor: pointer;
    user-select: none;
    transition: all 0.2s ease;
    box-sizing: border-box;
}

.size-options input[type="radio"]:checked+label {
    border: 1px solid black;
    color: black;
    border-color: #000;
}

p {
    font-size: 12px;
}
</style>