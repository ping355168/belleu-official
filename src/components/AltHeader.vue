<template>
    <header :class="{ scrolled: isScrolled }">
        <div class="header-left">
            <div class="header-logo">
                <router-link to="/" class="logo-link">BELLEU</router-link>
            </div>
            <nav>
                <router-link to="/" class="nav-link">最新商品</router-link>
                <router-link to="/" class="nav-link">熱門商品</router-link>
                <router-link to="/" class="nav-link">上身商品</router-link>
                <router-link to="/" class="nav-link">下身商品</router-link>
            </nav>
        </div>
        <div class="header-right">
            <div class="search">
                <input type="text" class="input">
                <router-link to="/" class="search-logo">
                    <font-awesome-icon icon="fa-solid fa-magnifying-glass" />
                </router-link>
            </div>
            <router-link to="/" class="nav-link">登入</router-link>
            <router-link to="/" class="nav-link">註冊</router-link>
        </div>
    </header>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

const isScrolled = ref(false)

const handleScroll = () => {
    isScrolled.value = window.scrollY > 0
}

onMounted(() => {
    window.addEventListener('scroll', handleScroll)
})

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll)
})
</script>

<style scoped>
header {
    color: white;
    width: 100%;
    position: fixed;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-sizing: border-box;
    padding: 0 60px;
    z-index: 999999;
    background: linear-gradient(180deg, rgba(0, 0, 0, 0.30) 0%, rgba(56, 56, 56, 0.23) 49%, rgba(230, 230, 230, 0.00) 100%);
}

.header-logo {
    font-family: 'Gaegu';
    font-size: 40px;
}

.header-left {
    display: flex;
    flex-direction: row;
    align-items: center;
    gap: 20px;
}

nav {
    display: flex;
    flex-direction: row;
}

.nav-link {
    color: white;
    text-decoration: none;
    font-size: 18px;
    padding: 10px 20px;
}

.logo-link {
    text-decoration: none;
    color: white;
}

.input {
    border: none;
    border-bottom: 1px solid white;
    outline: none;
    background: transparent;
    padding: 5px 5px;
    box-sizing: border-box;
}

.header-right {
    display: flex;
    flex-direction: row;
    align-items: center;
}

.search {
    position: relative;
    display: flex;
    align-items: center;
}

.search-logo {
    position: absolute;
    color: white;
    right: 0;
}


.scrolled {
    top: 0;
    background: none;
    border-bottom: 1px solid #999;
    background-color: #F6F4EE;
}

.scrolled .nav-link,
.scrolled .search-logo,
.scrolled .logo-link {
    color: #4B4237;
}

.scrolled .input {
    border-bottom: 1px solid #4B4237;
}
</style>
