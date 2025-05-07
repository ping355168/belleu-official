<template>
    <!-- 頁首區塊，捲動時加上 scrolled 類別 -->
    <header :class="{ scrolled: isScrolled }">

        <!-- 左側：Logo 與導覽列 -->
        <div class="header-left">
            <div class="header-logo">
                <router-link to="/" class="logo-link">BELLEU</router-link>
            </div>
            <nav>
                <router-link to="#" class="nav-link">最新商品</router-link>
                <router-link to="#" class="nav-link">熱門商品</router-link>
                <router-link to="#" class="nav-link">上身商品</router-link>
                <router-link to="#" class="nav-link">下身商品</router-link>
            </nav>
        </div>

        <!-- 右側：搜尋欄與登入註冊 -->
        <div class="header-right">
            <!-- 搜尋區 -->
            <div class="search">
                <input type="text" class="input">
                <router-link to="#" class="search-logo">
                    <font-awesome-icon icon="fa-solid fa-magnifying-glass" />
                </router-link>
            </div>

            <!-- 判斷登入狀態 -->
            <template v-if="user">
                <span class="nav-link user-email">{{ user.email }}</span>
                <button class="nav-link logout-btn" @click="logout">登出</button>
            </template>
            <template v-else>
                <router-link to="/login" class="nav-link">登入</router-link>
                <router-link to="/register" class="nav-link">註冊</router-link>
            </template>

        </div>
    </header>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import { useRouter } from 'vue-router'
import Swal from 'sweetalert2'

const router = useRouter()
const isScrolled = ref(false)
const user = ref(null)

// 捲動效果
const handleScroll = () => {
    isScrolled.value = window.scrollY > 0
}
onMounted(() => {
    window.addEventListener('scroll', handleScroll)

    // 嘗試從 localStorage 讀取登入資料
    const stored = localStorage.getItem('user')
    if (stored) {
        user.value = JSON.parse(stored)
    }
})
onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll)
})

const logout = async () => {
  localStorage.removeItem('user')
  user.value = null

  await Swal.fire({
    icon: 'info',
    title: '已登出',
    text: '期待下次見面 👋',
    timer: 1600,
    showConfirmButton: false
  })
}

</script>


<style scoped>
header {
    top: 0;
    background: none;
    border-bottom: 1px solid #999;
    background-color: #F6F4EE;
    color: #4B4237;
    width: 100%;
    position: fixed;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-sizing: border-box;
    padding: 0 60px;
    z-index: 999999;
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
    color: #4B4237;
    text-decoration: none;
    font-size: 18px;
    padding: 10px 20px;
}

.logo-link {
    text-decoration: none;
    color: #4B4237;
}

.input {
    border: none;
    border-bottom: 1px solid #4B4237;
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
    color: #4B4237;
    right: 0;
}
.user-email {
  font-weight: bold;
  color: inherit;
  margin-left: 16px;
}

.logout-btn {
  background: none;
  border: none;
  font-weight: bold;
  color: inherit;
  cursor: pointer;
  padding: 10px 20px;
}
.logout-btn:hover {
  text-decoration: underline;
}

</style>
