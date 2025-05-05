<template>
    <main>
        <section>
            <header>
                <h2>Belleu比露為您推薦</h2>
                <p>我們為你精選的新品！⛱️</p>
            </header>
            <ul class="product-list">
                <li v-for="item in products" :key="item.id">
                    <ProductCard :product="item" />
                </li>
            </ul>
        </section>
    </main>
</template>

<script setup>
import ProductCard from '@/components/ProductCard.vue'
const products = [
    {
        id: 1,
        name: "今夏新品襯衫",
        price: 890,
        image: "/image/product1-1.jpg",
        hoverImage: "/image/product1-2.jpg"
    },
    {
        id: 2,
        name: "今夏新品襯衫",
        price: 890,
        image: "/image/product2-1.jpg",
        hoverImage: "/image/product2-2.jpg"
    },
    {
        id: 3,
        name: "今夏新品襯衫",
        price: 890,
        image: "/image/product3-1.jpg",
        hoverImage: "/image/product3-2.jpg"
    },
    {
        id: 4,
        name: "今夏新品襯衫",
        price: 890,
        image: "/image/product4-1.jpg",
        hoverImage: "/image/product4-2.jpg"
    },
    {
        id: 5,
        name: "今夏新品襯衫",
        price: 890,
        image: "/image/product5-1.jpg",
        hoverImage: "/image/product5-2.jpg"
    },
    {
        id: 6,
        name: "今夏新品襯衫",
        price: 890,
        image: "/image/product6-1.jpg",
        hoverImage: "/image/product6-2.jpg"
    }
    ,{
        id: 7,
        name: "今夏新品襯衫",
        price: 890,
        image: "/image/product7-1.jpg",
        hoverImage: "/image/product7-2.jpg"
    },{
        id: 8,
        name: "今夏新品襯衫",
        price: 890,
        image: "/image/product8-1.jpg",
        hoverImage: "/image/product8-2.jpg"
    },{
        id: 9,
        name: "今夏新品襯衫",
        price: 890,
        image: "/image/product9-1.jpg",
        hoverImage: "/image/product9-2.jpg"
    },{
        id: 10,
        name: "今夏新品襯衫",
        price: 890,
        image: "/image/product10-1.jpg",
        hoverImage: "/image/product10-2.jpg"
    }
]

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

.product-list{
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 24px;
}
section{
    display: flex;
    flex-direction: column;
    gap: 30px;
}
</style>